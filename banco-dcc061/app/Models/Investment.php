<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'term_months',
        'minimum_value',
        'profitability',
    ];

    protected $casts = [
        'minimum_value' => 'decimal:2',
        'profitability' => 'decimal:2',
    ];
}
