<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Service extends Model
{
    use HasFactory, UUID;
    protected $table = 'services';
    protected $fillable = ['name', 'description'];
}
