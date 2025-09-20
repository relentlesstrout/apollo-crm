@extends('layout.app')

@section('content')
    <div class="overflow-x-auto shadow-2xl rounded-2xl">
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-800">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider ">House no.</th>
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
                        {{ $customer->house_no }}
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm ">
                        {{ $customer->notes }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
