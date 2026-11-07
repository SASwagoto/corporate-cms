<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'full_name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'payload',
        'ip_address',
        'status',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}