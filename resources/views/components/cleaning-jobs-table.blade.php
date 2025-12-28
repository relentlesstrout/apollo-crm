@props(['cleaning-jobs'])
@php
    $columns = [
        'fullAddress' => 'Address',
        'price' => 'Price',
        'scheduled_for' => 'Scheduled For',
        'status' => 'Status',
        'notes' => 'Notes',
        'completed_at' => 'Completed At'
    ];
@endphp

<div class="flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm outline-1 outline-black/2">
                <table class="relative min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        @foreach($columns as $field => $label)
                            <th scope="col" class="py-3.5 pr-3 pl-4 text-center text-sm font-semibold text-gray-900 sm:pl-6 cursor-pointer"
                            wire:click="sortBy('{{ $field }}')" class="cursor-pointer">
                                {{ $label }}
                                @if($sortField === $field)
                                    {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                                @endif
                            </th>
                        @endforeach
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-center text-sm font-semibold text-gray-900 sm:pl-6">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($cleaningJobs as $job)
                        <tr wire:key="{{ $job->id }}">
                            <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-6">
                                <div class="flex items-center">
                                    <div class="ml-1">
                                        <div class="font-medium text-gray-900">{{ $job->customer->fullAddress ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                £{{ number_format($job->price, 2) }}
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                {{ $job->scheduled_for?->format('d/m/Y') ?? 'N/A' }}
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                {{ $job->status ?? 'N/A' }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 max-w-xs whitespace-normal break-words">
                                {{ $job->notes ?? '' }}
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                {{ $job->completed_at?->format('d/m/Y') ?? 'Pending' }}
                            </td>
                            <td class="py-4 pr-4 pl-3 text-sm whitespace-nowrap text-center">
                                <x-view-button :link="route('cleaningJobs.show', $job)" />
                                <x-edit-button :link="route('cleaningJobs.edit', $job)" />
                                <x-delete-button :link="route('cleaningJobs.destroy', $job)" />
                                <livewire:toggle-due-today :job="$job" :key="$job->id" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-4 text-sm text-gray-500 text-center">
                                No jobs found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
