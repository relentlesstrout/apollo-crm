<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'due_today',
    ];

    protected $casts = [
        'scheduled_for' => 'date',
        'completed_at' => 'date',
        'price' => 'decimal:2',
    ];

    public function overdue(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->scheduled_for->lt(now()) && $this->status !== 'completed';
            }
        );
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
