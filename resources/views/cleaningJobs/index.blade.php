@extends('layout.app')

@section('content')
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif
    <form method="GET" action="{{ route('cleaningJobs.index') }}" class="filters pb-6" id="cleaningJobs-filter-form">
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

                @include('components.fields.multi-select', [
                'label' => 'House',
                'options' => $houses,
                'field_name' => 'filter[house]'
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
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Customer</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Price</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Scheduled For</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Notes</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Completed At</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($cleaningJobs as $job)
            <tr class="odd:bg-gray-50 even:bg-gray-100">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    {{ $job->customer->house ?? '' }} - {{ $job->customer->street ?? '' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    £{{ number_format($job->price, 2) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $job->scheduled_for?->format('d/m/Y H:i') ?? 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $job->status ?? 'N/A' }}
                </td>
                <td class="px-6 py-4 text-sm text-ellipsis max-w-xs">
                    {{ $job->notes ?? '' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $job->completed_at?->format('d/m/Y H:i') ?? 'Pending' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <x-view-button :link="route('cleaningJobs.show', $job)"></x-view-button>
                    <x-edit-button :link="route('cleaningJobs.edit', $job)"></x-edit-button>
                    <x-delete-button :link="route('cleaningJobs.destroy', $job)"></x-delete-button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $cleaningJobs->appends(request()->query())->links() }}
    </div>

@endsection
