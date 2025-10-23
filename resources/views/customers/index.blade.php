@extends('layout.app')

@section('content')


    <div class="flex justify-between items-center p-4 bg-gray-100 border-b border-gray-300">
        <form action="{{ route('customers.index') }}" method="GET" class="flex items-center">
            <input type="text" name="search" placeholder="Search customers..."
                   value="{{ request('search') }}"
                   class="border rounded-md px-3 py-1 text-sm focus:outline-none focus:ring focus:border-blue-300">
            <button type="submit"
                    class="ml-2 bg-blue-500 text-white px-3 py-1 rounded-md text-sm font-semibold hover:bg-blue-600">
                Search
            </button>
        </form>

        <a href="{{ route('customers.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold shadow hover:bg-blue-700">
            + Add New Customer
        </a>
    </div>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-800">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider ">House no. / Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Street</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Area</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Phone no.</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Notes</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($customers as $customer)
                <tr class="odd:bg-gray-50 even:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap  text-ellipsis max-w-xs text-sm text-gray-800">
                        {{ $customer->house }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ">
                        {{ $customer->street }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ">
                        {{ $customer->area }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ">
                        {{ $customer->phone }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-ellipsis">
                        {{ $customer->notes }}
                    </td>
                    <div class="flex gap-2">
                        <td class="px-6 py-4">
                            <x-view-button :link="route('customers.show', $customer)"></x-view-button>
                            <x-edit-button :link="route('customers.edit', $customer)"></x-edit-button>
                            <x-delete-button :link="route('customers.destroy', $customer)"></x-delete-button>
                        </td>
                    </div>
                </tr>
            @endforeach
            </tbody>
        </table>

    <div>
        {{ $customers->links() }}
    </div>

@endsection
