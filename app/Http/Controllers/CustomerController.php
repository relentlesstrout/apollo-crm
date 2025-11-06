<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CustomerController extends Controller
{
    public function areas()
    {
        $areas = Customer::pluck('area')->unique();
        return view('customers.areas', ['areas' => $areas]);
    }

    public function streets($area)
    {
        $streets = Customer::where('area', $area)
            ->select('street')
            ->distinct()
            ->get()
            ->pluck('street');

        return view('customers.streets', compact('area', 'streets'));
    }

    public function streetCustomers($area, $street)
    {
        $customers = Customer::with('CleaningJobs')
            ->where('area', $area)
            ->where('street', $street)
            ->paginate(12);

        return view('customers.streetcustomers', compact('customers', 'area', 'street'));
    }

    public function index(Request $request)
    {
        // Determine which customers to show based on show_deleted toggle
        if ($request->input('show_deleted') === '1') {
            // Show only soft-deleted customers
            $query = QueryBuilder::for(Customer::onlyTrashed())
                ->allowedFilters(['house', 'street', 'area']);
        } else {
            // Show only non-deleted customers (default)
            $query = QueryBuilder::for(Customer::class)
                ->allowedFilters(['house', 'street', 'area']);
        }

        $customers = $query->paginate(12);

        $areas = Customer::distinct()->pluck('area');
        $streets = Customer::distinct()->pluck('street');

        return view('customers.index', compact('areas', 'streets', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'house' => 'required|string',
            'street' => 'required|string|max:50',
            'area' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:255',
            'cleaning_frequency_weeks' => 'required|integer|min:4|max:52',
            'first_clean_price' => 'required|numeric|min:0',
            'scheduled_for' => 'required|date',
            ]);

        $customer = Customer::create(collect($validated)->except(['first_clean_price', 'scheduled_for'])->toArray());

        // Create first Job

        $customer->cleaningJobs()->create([
            'price' => $validated['first_clean_price'],
            'scheduled_for' => $validated['scheduled_for'],
            'status' => 'scheduled',
            'completed_at' => null,
            'notes' => null,
        ]);

        return redirect()->route('customers.index')
        ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
