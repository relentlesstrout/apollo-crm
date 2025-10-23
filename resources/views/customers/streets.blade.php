@extends('layout.app')

@section('content')

    <div class="flex justify-between items-center p-4 bg-gray-100 border-b border-gray-300">
        <h2 class="text-xl font-bold text-gray-800">
            Streets in {{ $area }}
        </h2>

        <a href="{{ route('customers.areas') }}"
           class="bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow hover:bg-gray-800">
            ← Back to Areas
        </a>
    </div>

    <table class="min-w-full border border-gray-200 divide-y divide-gray-200 mt-4">
        <thead class="bg-gray-800">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Street Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($streets as $street)
            <tr class="odd:bg-gray-50 even:bg-gray-100">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    {{ $street }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('customers.streetCustomers', ['area' => $area, 'street' => $street]) }}"
                       class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs md:text-sm font-bold hover:bg-blue-600">
                        View Customers
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                    No streets found for this area.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
