<?php

namespace App\Http\Controllers;

use App\Models\CleaningJob;
use App\Models\Customer;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;


class CleaningJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cleaningJobs = QueryBuilder::for(CleaningJob::class)
            ->allowedFilters(['customer_id', 'price', 'scheduled_for', 'status', 'completed_at'])
            ->paginate(12);

        $filters = CleaningJob::select('customer_id',
            'price',
            'scheduled_for',
            'status',
            'completed_at')->get()->unique();

        return view('cleaningJobs.index', compact('cleaningJobs', 'filters'));
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

    }

    public function today()
    {
        $todaysJobs = CleaningJob::where('scheduled_at', today())->get();

        return view('cleaningJobs.today', ['todayJobs' => $todaysJobs]);
    }
}

