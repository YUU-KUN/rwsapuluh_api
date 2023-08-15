<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class OrganizationImage extends Model
{
    use HasFactory, UUID;
    protected $fillable = ['image'];
    protected $appends = ['image_url'];

    function getImageUrlAttribute() {
        return url('/') . '/organization/' . $this->image;
    }
}
