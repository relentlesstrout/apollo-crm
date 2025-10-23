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
//        $customers = Customer::query();
//
//        if ($request->filled('search')) {
//            $customers->where(function($query) use ($request) {
//                $query->where('house_no', 'like', '%' . $request->search . '%')
//                    ->orWhere('street', 'like', '%' . $request->search . '%')
//                    ->orWhere('area', 'like', '%' . $request->search . '%');
//            });
//        }
//
//        if ($request->filled('area')) {
//            $customers->where('area', $request->input('area'));
//        }
//        $customers = $customers->paginate(30);

        $customers = QueryBuilder::for(Customer::class)
            ->allowedFilters(['house', 'street', 'area'])
            ->paginate(12);

        $filters = Customer::select('house', 'street', 'area')->get()->unique();


        return view('customers.index', compact('filters', 'customers'));
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
            'house_no' => 'required|string',
            'street' => 'required|string|max:50',
            'area' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:255'
        ]);

        Customer::create($validated);

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
