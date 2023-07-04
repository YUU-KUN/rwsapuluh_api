<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Mission extends Model
{
    use HasFactory, UUID;
    protected $table = 'missions';
    protected $fillable = ['mission'];
}
