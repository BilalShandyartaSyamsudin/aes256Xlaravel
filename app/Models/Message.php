<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'url', 'apikey', 'uniqued', 'password', 'timestamp', 'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
