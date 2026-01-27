<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    /** @use HasFactory<\Database\Factories\QuoteFactory> */
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'house',
        'street',
        'area',
        'phone',
        'cleaning_frequency_weeks',
        'estimate'
    ];

}
