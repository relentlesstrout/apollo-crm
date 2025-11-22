@extends('layout.app')

@section('pageTitle')
    <x-page-title
        :title="'Cleaning Job #' . $cleaningJob->id"
        :description="$cleaningJob->customer->fullAddress ?? null"
    />
@endsection

@section('content')
    <div class="flex justify-between items-center p-4 bg-gray-100 border-b border-gray-300">
        <h2 class="text-xl font-bold text-gray-800">
            Cleaning Job Details
        </h2>
        <div class="flex gap-2">
            <x-edit-button :link="route('cleaningJobs.edit', $cleaningJob)" />
            <x-delete-button :link="route('cleaningJobs.destroy', $cleaningJob)" />
        </div>
    </div>

    <div class="p-6 bg-white shadow rounded-md mt-4 max-w-3xl mx-auto">
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Customer</h3>
            <p class="text-gray-800">
                {{ $cleaningJob->customer->house ?? 'N/A' }} - {{ $cleaningJob->customer->street ?? 'N/A' }},
                {{ $cleaningJob->customer->area ?? '' }}
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-sm font-medium text-gray-600">Price</h3>
                <p class="text-gray-900 font-semibold">£{{ number_format($cleaningJob->price, 2) }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-600">Status</h3>
                <p class="text-gray-900">{{ ucfirst($cleaningJob->status) ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-600">Scheduled For</h3>
                <p class="text-gray-900">{{ $cleaningJob->scheduled_for?->format('d/m/Y') ?? 'Not Scheduled' }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-600">Completed At</h3>
                <p class="text-gray-900">{{ $cleaningJob->completed_at?->format('d/m/Y') ?? 'Pending' }}</p>
            </div>
        </div>

        @if($cleaningJob->notes)
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-600">Notes</h3>
                <p class="text-gray-800 whitespace-pre-line">{{ $cleaningJob->notes }}</p>
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('cleaningJobs.index') }}"
               class="inline-block px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                ← Back to Cleaning Jobs
            </a>
        </div>
    </div>
@endsection
