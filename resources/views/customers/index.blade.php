@extends('layout.app')

@section('content')
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif
    <form method="GET" action="{{ route('customers.index') }}" class="filters pb-6" id="customer-filter-form">
        <div class="flex justify-between items-end">
            <div class="flex gap-4 items-end">
                @include('components.fields.multi-select', [
                    'label' => 'Area',
                    'options' => $areas,
                    'field_name' => 'filter[area]'
                ])

                @include('components.fields.multi-select', [
                'label' => 'Street',
                'options' => $streets,
                'field_name' => 'filter[street]'
                ])


                @include('components.fields.toggle-switch', [
                    'field_name' => 'show_deleted',
                    'inactive_label' => 'Active Customers',
                    'active_label' => 'Inactive Customers'
                ])
            </div>
            <div>
                <button type="submit" class="items-center gap-x-4 rounded-md cursor-pointer px-3.5 py-2.5 text-sm text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
                    Apply Filter
                </button>
            </div>
        </div>
    </form>
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
            <tr class="odd:bg-gray-50 even:bg-gray-100 {{ $customer->trashed() ? 'opacity-50 bg-red-50' : '' }}">
                <td class="px-6 py-4 whitespace-nowrap text-ellipsis max-w-xs text-sm text-gray-800">
                    {{ $customer->house }}
                    @if($customer->trashed())
                        <span class="ml-2 text-xs bg-red-500 text-white px-2 py-0.5 rounded">Deleted</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $customer->street }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $customer->area }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
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
