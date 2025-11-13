@props(['cleaning-jobs'])

<div class="flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm outline-1 outline-black/2">
                <table class="relative min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Address</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Scheduled For</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Notes</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Completed At</th>
                        <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-6 text-center">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($cleaningJobs as $job)

                        <tr>
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
