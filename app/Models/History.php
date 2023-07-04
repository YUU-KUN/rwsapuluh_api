<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class History extends Model
{
    use HasFactory, UUID;
    protected $table = 'histories';
    protected $fillable = ['photo', 'content'];
    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        return url('/history') . '/' . $this->photo;
        // return url('storage/' . $this->photo);
    }
}
