<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Exception;

class Customer extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'customer';
    protected $primaryKey = 'customer_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'customer_code',
            'customer_nama',
            'customer_alamat',
            'customer_logo',
        ];

    protected $filterable = [
            'customer_code',
            'customer_nama',
            'customer_alamat',
            'customer_logo',
        ];

    protected $sortable = [
            'customer_code',
            'customer_nama',
            'customer_alamat',
            'customer_logo',
        ];

    public static function field_name()
    {
        return 'customer_nama';
    }

    public function rules($id = null)
    {
        $rules = [
            'customer_code' => ['required', 'string', 'max:255'],
            'customer_nama' => ['nullable', 'string', 'max:255'],
            'customer_alamat' => ['nullable', 'string'],
            'customer_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ];

        return $rules;
    }

    /**
     * Boot method to handle automatic image compression
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (request()->hasFile('customer_logo')) {
                $model->customer_logo = request()->file('customer_logo');
            }

            $model->compressLogoImage();
        });
    }

    /**
     * Compress logo image to 300px width maintaining aspect ratio
     */
    private function compressLogoImage()
    {
        if ($this->customer_logo && $this->isImageUpload($this->customer_logo)) {
            // Delete old logo if exists
            if ($this->getOriginal('customer_logo') && file_exists(public_path('storage/' . $this->getOriginal('customer_logo')))) {
                unlink(public_path('storage/' . $this->getOriginal('customer_logo')));
            }
            $this->customer_logo = $this->processLogoUpload($this->customer_logo);
        } elseif ($this->customer_logo && is_string($this->customer_logo)) {
            // If it's already a string path, keep it as is (don't process existing paths)
            return;
        } elseif (!$this->customer_logo) {
            // If no logo, delete old if exists and set to null
            if ($this->getOriginal('customer_logo') && file_exists(public_path('storage/' . $this->getOriginal('customer_logo')))) {
                unlink(public_path('storage/' . $this->getOriginal('customer_logo')));
            }
            $this->customer_logo = null;
        }
        // If it's something else, let it pass through
    }

    /**
     * Check if the value is an uploaded image file
     */
    private function isImageUpload($value)
    {
        return $value instanceof UploadedFile && $this->isImageFile($value);
    }

    /**
     * Check if uploaded file is an image
     */
    private function isImageFile(UploadedFile $file)
    {
        $imageMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        return in_array($file->getMimeType(), $imageMimes);
    }

    /**
     * Process logo upload with compression
     */
    private function processLogoUpload($file)
    {
        try {
            // Get original image dimensions to calculate resize percentage
            $imageInfo = getimagesize($file->getPathname());
            if (!$imageInfo) {
                return uploadFile($file, 'logos'); // Not a valid image, upload normally
            }

            $originalWidth = $imageInfo[0];

            // If image is already 300px or smaller, upload without resizing
            if ($originalWidth <= 300) {
                return uploadFile($file, 'logos');
            }

            // Calculate resize percentage for 300px width
            $resizePercentage = (300 / $originalWidth) * 100;

            // Upload with resizing
            return uploadFile($file, 'logos', null, $resizePercentage);

        } catch (Exception $e) {
            // If anything fails, upload normally without resizing
            return uploadFile($file, 'logos');
        }
    }
}