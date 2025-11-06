@extends('layout.app')

@section('content')
    <div class="flex justify-between items-center p-4 bg-gray-100 border-b border-gray-300">
        <h2 class="text-xl font-bold text-gray-800">
            Customer Details
        </h2>
        <div class="flex gap-2">
            <x-edit-button :link="route('customers.edit', $customer)" />
            <x-delete-button :link="route('customers.destroy', $customer)" />
        </div>
    </div>

    <div class="p-6 bg-white shadow rounded-md mt-4 max-w-3xl mx-auto">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-sm font-medium text-gray-600">House</h3>
                <p class="text-gray-900 font-semibold">{{ $customer->house }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-600">Street</h3>
                <p class="text-gray-900">{{ $customer->street }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-600">Area</h3>
                <p class="text-gray-900">{{ $customer->area }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-600">Phone</h3>
                <p class="text-gray-900">{{ $customer->phone ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-600">Cleaning Frequency (Weeks)</h3>
                <p class="text-gray-900">{{ $customer->cleaning_frequency_weeks ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-600">Status</h3>
                <p class="text-gray-900">
                    @if($customer->trashed())
                        <span class="text-red-600 font-semibold">Inactive</span>
                    @else
                        <span class="text-green-600 font-semibold">Active</span>
                    @endif
                </p>
            </div>
        </div>

        @if($customer->notes)
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-600">Notes</h3>
                <p class="text-gray-800 whitespace-pre-line">{{ $customer->notes }}</p>
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('customers.index') }}"
               class="inline-block px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                ← Back to Customers
            </a>
        </div>
    </div>

    @if($customer->cleaningJobs->count() > 0)
        <div class="mt-8 bg-white shadow rounded-md p-6 max-w-5xl mx-auto">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Cleaning Jobs</h3>

            <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Scheduled For</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Completed At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($customer->cleaningJobs as $job)
                    <tr class="odd:bg-gray-50 even:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            £{{ number_format($job->price, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $job->scheduled_for?->format('d/m/Y') ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ ucfirst($job->status) ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $job->completed_at?->format('d/m/Y') ?? 'Pending' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-view-button :link="route('cleaningJobs.show', $job)" />
                            <x-edit-button :link="route('cleaningJobs.edit', $job)" />
                            <x-delete-button :link="route('cleaningJobs.destroy', $job)" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="mt-8 max-w-3xl mx-auto bg-yellow-50 border border-yellow-200 text-yellow-700 rounded p-4">
            <p>No cleaning jobs found for this customer.</p>
        </div>
    @endif
@endsection

