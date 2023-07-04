<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class ActivityCategory extends Model
{
    use HasFactory, UUID;
    protected $table = 'activity_categories';
    protected $fillable = ['category_id', 'activity_id'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
