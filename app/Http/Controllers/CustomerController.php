<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query();

        if ($request->filled('search')) {
            $customers->where('house_no', 'like', '%' . $request->search . '%')
                ->orWhere('street', 'like', '%' . $request->search . '%')
                ->orWhere('area', 'like', '%' . $request->search . '%');
        }

        $customers = $customers->paginate(30);

        return view('customers.index', compact('customers'));
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
