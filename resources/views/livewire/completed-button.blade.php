<div class="container mx-auto p-6"> <h1 class="text-2xl font-bold mb-4">Jobs Due</h1>

    @if($upcomingJobs->isEmpty())
        <p>No cleaning jobs scheduled for the next week.</p>
    @else
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-800">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Scheduled Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>

            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($upcomingJobs as $job)
                <tr class="odd:bg-gray-50 even:bg-gray-100 {{ $job->overdue ? 'bg-red-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        {{ $job->customer->fullAddress ?? 'Unknown' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        {{ $job->scheduled_for?->format('d/m/Y') ?? 'N/A' }}
                        @if($job->overdue)
                            <span class="text-red-600 font-bold ml-2">Overdue</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        £{{ number_format($job->price, 2) }}
                    </td>
                    <td>
                        <div class="flex items-center">
                            <input wire:click="toggleStatus({{ $job->id }})"
                                   id="completed-checkbox"
                                   name="completed-checkbox"
                                   type="checkbox"
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <label for="completed-checkbox" class="ml-2 block text-sm text-gray-900">
                                Completed
                            </label>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
</div>

