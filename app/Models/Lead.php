<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'source',
        'tags',
        'follow_up_date',
        'follow_up_time',
        'meeting_at',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'tags' => 'array',
        'follow_up_date' => 'date',
        'follow_up_time' => 'datetime:H:i',
        'meeting_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
