<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class InstitutionGallery extends Model
{
    use HasFactory, UUID;

    protected $table = 'institution_galleries';
    protected $fillable = ['institution_id', 'image'];
    protected $appends = ['image_url'];

    public function Institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function getImageUrlAttribute()
    {
        return url('/') . '/gallery/' . $this->image;
    }


}
