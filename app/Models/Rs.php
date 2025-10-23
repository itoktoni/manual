<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Exception;

class Rs extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'rs';
    protected $primaryKey = 'rs_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'rs_code',
            'rs_nama',
            'rs_alamat',
            'rs_logo',
        ];

    protected $filterable = [
            'rs_code',
            'rs_nama',
            'rs_alamat',
            'rs_logo',
        ];

    protected $sortable = [
            'rs_code',
            'rs_nama',
            'rs_alamat',
            'rs_logo',
        ];

    public static function field_name()
    {
        return 'rs_nama';
    }

    public function rules($id = null)
    {
        $rules = [
            'rs_code' => ['required'],
            'rs_nama' => [''],
            'rs_alamat' => [''],
            'rs_logo' => [''],
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
            $model->compressLogoImage();
        });

        static::updating(function ($model) {
            $model->compressLogoImage();
        });
    }

    /**
     * Compress logo image to 300px width maintaining aspect ratio
     */
    private function compressLogoImage()
    {
        if ($this->rs_logo && $this->isImageUpload($this->rs_logo)) {
            $this->rs_logo = $this->processLogoUpload($this->rs_logo);
        }
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
                return uploadFile($file, 'rs_logos'); // Not a valid image, upload normally
            }

            $originalWidth = $imageInfo[0];

            // If image is already 300px or smaller, upload without resizing
            if ($originalWidth <= 300) {
                return uploadFile($file, 'rs_logos');
            }

            // Calculate resize percentage for 300px width
            $resizePercentage = (300 / $originalWidth) * 100;

            // Upload with resizing
            return uploadFile($file, 'rs_logos', null, $resizePercentage);

        } catch (Exception $e) {
            // If anything fails, upload normally without resizing
            return uploadFile($file, 'rs_logos');
        }
    }
}