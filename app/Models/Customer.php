<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'house_no',
        'street',
        'area',
        'phone',
        'notes',
        'cancelled'
    ];

    public function cleaningJobs()
    {
        return $this->hasMany(CleaningJob::class);
    }

}
