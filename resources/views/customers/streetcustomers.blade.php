@extends('layout.app')

@section('pageTitle')
    <x-page-title :title="$street . ' – ' . $area" />
@endsection

@section('content')

    <div class="flex justify-between items-center p-4 bg-gray-100 border-b border-gray-300">
        <h2 class="text-xl font-bold text-gray-800">
            {{ $street }} – {{ $area }}
        </h2>

        <a href="{{ route('customers.streets', ['area' => $area]) }}"
           class="bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow hover:bg-gray-800">
            ← Back to Streets
        </a>
    </div>

    <table class="min-w-full border border-gray-200 divide-y divide-gray-200 mt-4">
        <thead class="bg-gray-800">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">House No.</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jobs</th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($customers as $customer)
            <tr class="odd:bg-gray-50 even:bg-gray-100 align-top">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-semibold">
                    {{ $customer->house_number ?? '-' }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($customer->jobs as $job)
                                <li>
                                    <span class="font-medium text-gray-800">{{ $job->description ?? 'No description' }}</span>
                                    <span class="text-gray-500 text-xs">
                                        ({{ $job->completed_at ? \Carbon\Carbon::parse($job->date)->format('d M Y') : 'No date' }})
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                    No customers found on this street.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4 px-4">
        {{ $customers->links() }}
    </div>

@endsection
