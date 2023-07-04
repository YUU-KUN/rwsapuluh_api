<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class InstitutionStructure extends Model
{
    use HasFactory, UUID;
    protected $table = 'institution_structures';
    protected $fillable = ['name', 'institution_id', 'position'];

    public function Institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
