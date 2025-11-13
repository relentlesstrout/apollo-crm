<?php

namespace App\Http\Controllers;

use App\Models\CleaningJob;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;


class CleaningJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(CleaningJob::class)
            ->with('customer')
            ->allowedFilters([
                'price',
                'scheduled_for',
                'status',

                // Filter by multiple areas
                AllowedFilter::callback('area', function ($query, $values) {
                    $values = (array) $values; // ensure it’s an array (from multi-select)
                    $query->whereHas('customer', function ($q) use ($values) {
                        $q->whereIn('area', $values);
                    });
                }),

                // Filter by multiple streets
                AllowedFilter::callback('street', function ($query, $values) {
                    $values = (array) $values;
                    $query->whereHas('customer', function ($q) use ($values) {
                        $q->whereIn('street', $values);
                    });
                }),
            ]);

        $cleaningJobs = $query->paginate(12);

        // Distinct area/street lists for dropdown options
        $areas = Customer::distinct()->pluck('area')->filter();
        $streets = Customer::distinct()->pluck('street')->filter();
        $houses = Customer::distinct()->pluck('house')->filter();

        return view('cleaningJobs.index', compact('cleaningJobs', 'areas', 'streets', 'houses'));
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
        return view('cleaningJobs.show', compact('cleaningJob'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CleaningJob $cleaningJob)
    {
        return view('cleaningJobs.edit', compact('cleaningJob'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CleaningJob $cleaningJob)
    {
        $cleaningJob->update($request->all());
        return redirect()->route('cleaningJobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CleaningJob $cleaningJob)
    {
        $cleaningJob->delete();
        return redirect()->route('cleaningJobs.index');
    }

    public function scheduling()
    {
        $upcomingJobs = CleaningJob::query()
            ->whereDate('scheduled_for', '<=', Carbon::today()->addWeek())
            ->where('status', 'scheduled')
            ->orderBy('scheduled_for', 'asc')
            ->get();

        return view('cleaningJobs.scheduling', compact('upcomingJobs'));
    }

    public function markDueToday($id)
    {
        $job = CleaningJob::findOrFail($id);

        $job->due_today = !$job->due_today;
        $job->save();
    }

    public function indexToday()
    {
        $jobsToday = CleaningJob::where('status', 'scheduled')
            ->where('due_today', true)
            ->get();

        return view('cleaningJobs.today', compact('jobsToday'), [
            'jobsToday' => $jobsToday,
        ]);
    }
}
