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

    //TODO
//    public function customer()
//    {
//        return $this->hasOneThrough(
//            Customer::class,
//            CleaningJob::class,
//            'id',          // the key on cleaning_jobs that invoices.job_id references (cleaning_jobs.id)
//            'id',          // the key on customers that cleaning_jobs.customer_id references (customers.id)
//            'job_id',      // local key on invoices (invoices.job_id -> cleaning_jobs.id)
//            'customer_id'  // local key on cleaning_jobs (cleaning_jobs.customer_id -> customers.id)
//        );
//    }

}
