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
}
