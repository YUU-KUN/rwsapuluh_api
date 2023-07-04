<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Institution extends Model
{
    use HasFactory, UUID;

    protected $table = 'institutions';
    protected $fillable = ['name', 'description'];

    public function Structures()
    {
        return $this->hasMany(InstitutionStructure::class);
    }
    
    public function Galleries() {
        return $this->hasMany(InstitutionGallery::class);
    }
}
