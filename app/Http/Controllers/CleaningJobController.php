<?php

namespace App\Http\Controllers;

use App\Models\CleaningJob;
use App\Models\Customer;
use Illuminate\Http\Request;

class CleaningJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cleaningJobs = CleaningJob::all();

        return view('cleaningJobs.index', ['cleaningJobs' => $cleaningJobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CleaningJob $cleaningJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CleaningJob $cleaningJob)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CleaningJob $cleaningJob)
    {
        $cleaningJob->update($request->all());

        if ($request->status === 'completed' && !$cleaningJob->customer->cancelled) {
            CleaningJob::create([
                'customer_id' => $cleaningJob->customer_id,
                'scheduled_at' => $cleaningJob->completed_at->copy()->addWeeks(4),
                'price' => $cleaningJob->customer->standard_price,
                'status' => 'scheduled',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CleaningJob $cleaningJob)
    {
        //
    }


    public function scheduleNextJobs()
    {
        $customers = Customer::where('cancelled', false)->get();

        foreach ($customers as $customer) {
            CleaningJob::create([
                'customer_id' => $customer->id,
                'scheduled_at' => now()->addWeeks(4),
                'price' => $customer->price,
                'status' => 'scheduled',
                'paid' => false,
            ]);
        }

        return 'Jobs scheduled!';
    }

    public function today()
    {
        $todaysJobs = CleaningJob::where('scheduled_at', today())->get();

        return view('cleaningJobs.today', ['todayJobs' => $todaysJobs]);
    }
}

