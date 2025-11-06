@extends('layout.app')

@section('pageTitle')
    <x-page-title title="All Customers">
        <x-slot:actions>
            <x-primary-button :href="route('customers.create')">Add Customer</x-primary-button>
        </x-slot:actions>
    </x-page-title>
@endsection

@section('content')

    <!-- Filters Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <!-- Street Filter -->
                <div class="relative inline-block">
                    <button type="button" class="inline-flex items-center gap-x-4 rounded-md bg-gray-200 cursor-pointer px-3.5 py-2.5 text-sm text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg>
                        <span class="block">Street</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>

                <!-- Area Filter -->
                <div class="relative inline-block">
                    <button type="button" class="inline-flex items-center gap-x-4 rounded-md bg-gray-200 cursor-pointer px-3.5 py-2.5 text-sm text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg>
                        <span class="block">Area</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Active/Inactive Toggle -->
            <div class="relative inline-flex cursor-pointer select-none items-center justify-center rounded-md bg-gray-200 text-sm text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 p-0.5">
                <span class="flex items-center space-x-2 rounded py-2 px-4 text-sm font-medium transition-all bg-blue-200 text-gray-700">
                    Inactive
                </span>
                <span class="flex items-center space-x-2 rounded py-2 px-4 text-sm font-medium transition-all text-gray-600 bg-transparent">
                    Active
                </span>
            </div>
        </div>
    </div>

    <div class="flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm outline-1 outline-black/2">
                    <table class="relative min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Address</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($customers as $customer)
                            <tr>
                                <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-6">
                                    <div class="flex items-center">
                                        <div class="ml-1">
                                            <div class="font-medium text-gray-900">{{ $customer->house }}</div>
                                            <div class="mt-1 text-gray-500">{{ $customer->street }}, {{ $customer->area }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                    <div class="text-gray-900">{{ $customer->phone }}</div>
                                </td>
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                    @if($customer->deleted_at)
                                        <x-inactive-label />
                                    @else
                                        <x-active-label />
                                    @endif
                                </td>
                                <td class="py-4 pr-4 pl-3 text-sm whitespace-nowrap text-gray-500 text-center">
                                     <a class="cursor-pointer underline" href="{{ route('customers.show', $customer) }}">View Customer</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
