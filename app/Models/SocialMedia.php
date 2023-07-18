<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class SocialMedia extends Model
{
    use HasFactory, UUID;
    protected $table = 'social_media';
    protected $fillable = ['url', 'label'];
}
