<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class VisionImage extends Model
{
    use HasFactory, UUID;
    protected $fillable = ['image'];
    protected $appends = ['image_url'];

    function getImageUrlAttribute() {
        return url('/') . '/vision/' . $this->image;
    }
}
