<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class SecondGalleryItem extends Model
{
    use HasFactory;

    protected $appends = ['resized_to_original_size'];

    protected $fillable = [
        'image',
        'thumbnail',
        'position',
        'size_in_kb',
        'english_title',
        'arabic_title',
        'sec_gallery_category_id',
    ];

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/second-gallery/' . $this->image);
    }
    
    public function getResizedToOriginalSizeAttribute(): ? string
    {
        $path = public_path('uploads/second-gallery/' . $this->image);

        if (!file_exists($path)) {
            return null;
        }

        $originalImage = Image::make($path);

        if ($this->size_in_kb === null) {
            return (string) $originalImage->encode('data-url');
        }

        $quality = 90;
        do {
            $resizedImage = $originalImage->encode('webp', $quality);
            $currentSizeKB = strlen($resizedImage) / 1024;
            $quality -= 5;
        } while ($currentSizeKB > $this->size_in_kb && $quality > 0);

        return (string) $resizedImage->encode('data-url');
    }
}
