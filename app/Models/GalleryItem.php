<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->image_path ? asset($this->image_path) : '';
    }
}
