<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Activity extends Model
{
    use HasFactory, UUID;
    protected $table = 'activities';
    protected $fillable = ['title', 'description', 'image'];
    protected $appends = ['image_url'];
    
    public function Categories() {
        return $this->hasMany(ActivityCategory::class);
    }

    public function getImageUrlAttribute() {
        return url('/') . '/activity/' . $this->image;
    }
}
