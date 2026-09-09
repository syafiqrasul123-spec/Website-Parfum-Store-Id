<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    // TAMBAHKAN PROPERTI FILLABLE INI
    protected $fillable = [
        'ip_address',
        'url_visited',
        'user_agent',
        'user_id',
    ];
}