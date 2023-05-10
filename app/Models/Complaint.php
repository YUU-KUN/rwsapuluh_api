<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Complaint extends Model
{
    use HasFactory, UUID;
    protected $table = 'complaints';

    protected $fillable = ['name', 'email', 'phone', 'subject', 'message'];
}
