<?php

if (! function_exists('sortUrl')) {
    function sortUrl($sort, $route)
    {
        $direction = request('sort') === $sort && request('direction') === 'asc' ? 'desc' : 'asc';

        return route($route, array_merge(request()->query(), ['sort' => $sort, 'direction' => $direction]));
    }
}

if (! function_exists('module')) {
    function module($action = null)
    {
        $route = request()->route();
        if ($route) {
            $controller = $route->getController();
            if (method_exists($controller, 'module')) {
                return $controller->module($action);
            }
        }
        return null;
    }
}

if (! function_exists('uploadFile')) {
    function uploadFile($file, $directory = 'uploads', $filename = null, $resizePercentage = null)
    {
        // Check if file exists and is valid
        if (!$file || !$file->isValid()) {
            return false;
        }

        // Get file info
        $extension = strtolower($file->getClientOriginalExtension());
        $originalName = $file->getClientOriginalName();

        // Define image types
        $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Check if file is an image and resize percentage is provided
        if ($resizePercentage && in_array($extension, $imageTypes)) {
            return uploadAndResizeImage($file, $directory, $filename, $resizePercentage);
        }

        // Create directory path
        $uploadPath = storage_path('app/public/' . $directory);

        // Create directory if it doesn't exist (cross-platform)
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Generate unique filename if not provided
        if (!$filename) {
            $filename = time() . '_' . uniqid() . '.' . $extension;
        }

        // Store file
        $file->move($uploadPath, $filename);

        // Return relative path for web access
        return $directory . '/' . $filename;
    }
}

if (! function_exists('uploadAndResizeImage')) {
    function uploadAndResizeImage($file, $directory, $filename, $resizePercentage)
    {
        // Validate resize percentage (should be between 1 and 100)
        $resizePercentage = max(1, min(100, (int)$resizePercentage));

        try {
            // Get original image dimensions
            $imageInfo = getimagesize($file->getPathname());
            if (!$imageInfo) {
                return false; // Not a valid image
            }

            $originalWidth = $imageInfo[0];
            $originalHeight = $imageInfo[1];

            // Calculate new dimensions
            $newWidth = (int)($originalWidth * $resizePercentage / 100);
            $newHeight = (int)($originalHeight * $resizePercentage / 100);

            // Create new image based on type
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    $originalImage = imagecreatefromjpeg($file->getPathname());
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    // Preserve transparency for PNG
                    imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
                    imagealphablending($newImage, false);
                    imagesavealpha($newImage, true);
                    break;
                case IMAGETYPE_PNG:
                    $originalImage = imagecreatefrompng($file->getPathname());
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    imagealphablending($newImage, false);
                    imagesavealpha($newImage, true);
                    break;
                case IMAGETYPE_GIF:
                    $originalImage = imagecreatefromgif($file->getPathname());
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    break;
                case IMAGETYPE_WEBP:
                    $originalImage = imagecreatefromwebp($file->getPathname());
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    break;
                default:
                    return false; // Unsupported image type
            }

            if (!$originalImage || !$newImage) {
                return false;
            }

            // Resize image
            imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

            // Create directory path
            $uploadPath = storage_path('app/public/' . $directory);
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Generate unique filename if not provided
            $extension = strtolower($file->getClientOriginalExtension());
            if (!$filename) {
                $filename = time() . '_' . uniqid() . '.' . $extension;
            }

            $filePath = $uploadPath . '/' . $filename;

            // Save resized image
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    imagejpeg($newImage, $filePath, 90); // 90% quality
                    break;
                case IMAGETYPE_PNG:
                    imagepng($newImage, $filePath);
                    break;
                case IMAGETYPE_GIF:
                    imagegif($newImage, $filePath);
                    break;
                case IMAGETYPE_WEBP:
                    imagewebp($newImage, $filePath, 90); // 90% quality
                    break;
            }

            // Clean up memory
            imagedestroy($originalImage);
            imagedestroy($newImage);

            // Return relative path for web access
            return $directory . '/' . $filename;

        } catch (Exception $e) {
            // Log error if needed
            return false;
        }
    }
}

if (! function_exists('uploadMultipleFiles')) {
    function uploadMultipleFiles($files, $directory = 'uploads')
    {
        $uploadedFiles = [];

        if (!$files) {
            return $uploadedFiles;
        }

        foreach ($files as $file) {
            $uploadedPath = uploadFile($file, $directory);
            if ($uploadedPath) {
                $uploadedFiles[] = $uploadedPath;
            }
        }

        return $uploadedFiles;
    }
}

if (! function_exists('getRsOptions')) {
    function getRsOptions()
    {
        return \App\Helpers\Query::getRsOptions();
    }
}

if (! function_exists('getRsSelectOptions')) {
    function getRsSelectOptions()
    {
        return \App\Helpers\Query::getRsSelectOptions();
    }
}

if (! function_exists('getRsCollection')) {
    function getRsCollection()
    {
        return \App\Helpers\Query::getRsCollection();
    }
}

if (! function_exists('searchRs')) {
    function searchRs($search)
    {
        return \App\Helpers\Query::searchRs($search);
    }
}
