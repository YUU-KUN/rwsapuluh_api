<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Vision extends Model
{
    use HasFactory, UUID;
    protected $table = 'visions';
    protected $fillable = ['vision'];
}
