<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class ActivityImage extends Model
{
    use HasFactory, UUID;

    protected $table = 'activity_images';
    protected $fillable = ['activity_id', 'image'];

    protected $appends = ['image_path'];
    
    public function getImagePathAttribute() {
        return url('/') . '/activity/' . $this->image;
    }
}