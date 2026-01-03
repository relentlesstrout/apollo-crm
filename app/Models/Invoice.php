<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    protected $fillable = [
        'job_id',
        'amount_owed',
        'amount_paid',
        'satisfied_at',
        'due_at',
    ];

    public function cleaningJob()
    {
        return $this->belongsTo(CleaningJob::class);
    }

}
