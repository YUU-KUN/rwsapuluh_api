<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class AchievementCategory extends Model
{
    use HasFactory, UUID;

    protected $table = 'achievement_categories';
    protected $fillable = ['category_id', 'achievement_id'];

    public function Category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Achievement() {
        return $this->belongsTo(Achievement::class, 'achievement_id', 'id');
    }
}
