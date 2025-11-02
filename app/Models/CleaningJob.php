<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleaningJob extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'price',
        'status',
        'scheduled_for',
        'completed_at',
    ];

    protected $casts = [
        'scheduled_for' => 'date',
        'completed_at' => 'date',
        'price' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
