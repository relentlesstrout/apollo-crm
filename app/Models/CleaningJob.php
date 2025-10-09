<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleaningJob extends Model
{
    protected $fillable = [
        'customer_id',
        'price',
        'scheduled_at',
        'status',
        'paid',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
        'paid' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
