<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class News extends Model
{
    use HasFactory, UUID;
    protected $table = 'news';
    protected $fillable = ['title', 'description', 'image', 'category'];
}
