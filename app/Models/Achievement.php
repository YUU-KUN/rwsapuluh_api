<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Achievement extends Model
{
    use HasFactory, UUID;

    protected $table = 'achievements';
    protected $fillable = ['title', 'image', 'description'];
    protected $appends = ['image_url'];

    public function Categories() {
        return $this->hasMany(AchievementCategory::class);
    }

    public function getImageUrlAttribute() {
        return url('/') . '/achievement/' . $this->image;
    }
}
