<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'house',
        'street',
        'area',
        'phone',
        'notes',
        'cancelled',
        'price',
        'scheduled_for',
        'status',
        'completed_at'
    ];

    public function cleaningJobs()
    {
        return $this->hasMany(CleaningJob::class)->orderby('completed_at', 'desc');
    }

    //TODO
    public function invoices()
    {
//        return $this->hasManyThrough(
//            Invoice::class,
//            CleaningJob::class,
//            'customer_id', // Foreign key on cleaning_jobs table
//            'job_id',      // Foreign key on invoices table
//            'id',          // Local key on customers table
//            'id'           // Local key on cleaning_jobs table
//        );
        return $this->hasManyThrough(Invoice::class, CleaningJob::class);
    }

    public function fullAddress(): Attribute
    {
        return Attribute::make(
            get: function () {
                return implode("\n", array_filter([
                    $this->house . ' ' . $this->street,
                    $this->area,
                ]));
            }
        );
    }

}
