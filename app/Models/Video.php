<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Video extends Model
{
    use HasFactory, UUID;
    protected $table = 'videos';
    protected $fillable = ['title', 'description', 'video_url'];
    // protected $appends = ['video_url'];

    // public function getVideoUrlAttribute() {
    //     return url('/') . '/video/' . $this->video;
    // }
}
