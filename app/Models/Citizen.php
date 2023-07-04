<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Citizen extends Model
{
    use HasFactory, UUID;
    protected $table = 'citizens';
    protected $fillable = ['name', 'gender', 'is_head_of_family', 'rt', 'position'];
}
