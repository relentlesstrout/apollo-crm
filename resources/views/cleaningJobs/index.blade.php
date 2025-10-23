@extends('layout.app')

    @section('content')

        <div class="flex justify-between items-center p-4 bg-gray-100 border-b border-gray-300">
            <form action="{{ route('cleaningJobs.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search jobs..."
                       value="{{ request('search') }}"
                       class="border rounded-md px-3 py-1 text-sm focus:outline-none focus:ring focus:border-blue-300">
                <button type="submit"
                        class="ml-2 bg-blue-500 text-white px-3 py-1 rounded-md text-sm font-semibold hover:bg-blue-600">
                    Search
                </button>
            </form>

            <a href="{{ route('cleaningJobs.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold shadow hover:bg-blue-700">
                + Add New Job
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
                        <a href="{{ route('cleaningJobs.show', $job) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs md:text-sm font-bold">View</a>
                        <a href="{{ route('cleaningJobs.edit', $job) }}" class="bg-green-500 text-white px-3 py-1 rounded-md text-xs md:text-sm font-bold">Edit</a>
                        <form action="{{ route('cleaningJobs.destroy', $job) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs md:text-sm font-bold cursor-pointer" onclick="return confirm('Delete this job?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $cleaningJobs->links() }}
        </div>

    @endsection
