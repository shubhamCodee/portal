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
        'company_name',
        'first_name',
        'last_name',
        'department',
        'designation',
        'lead_cost',
        'total_lead_cost',
        'currency',
        'percentage',
        'follow_up_at',
        'closed_date',
        'website',
        'city',
        'address',
    ];

    protected $casts = [
        'tags' => 'array',

        'follow_up_date' => 'date',
        'follow_up_time' => 'datetime:H:i',
        'meeting_at' => 'datetime',
        'follow_up_at' => 'datetime',
        'closed_date' => 'date',

        'lead_cost' => 'decimal:2',
        'total_lead_cost' => 'decimal:2',
        'percentage' => 'decimal:2',

        'is_active' => 'boolean',
    ];
}
