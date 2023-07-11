<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Organization extends Model
{
    use HasFactory, UUID;
    protected $table = 'organizations';
    protected $fillable = ['name', 'position', 'photo'];
    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        return url('/') . '/organization/' . $this->photo;
    }
}
