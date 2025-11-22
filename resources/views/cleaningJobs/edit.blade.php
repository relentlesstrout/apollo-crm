@extends('layout.app')

@section('pageTitle')
    <x-page-title
        :title="'Edit Job #' . $cleaningJob->id"
        :description="$cleaningJob->customer->fullAddress ?? null"
    />
@endsection

@section('content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900">
                Edit Job for {{ $cleaningJob->customer->house ?? 'Unknown Customer' }} - {{ $cleaningJob->customer->street ?? '' }}
            </h2>

            <form action="{{ route('cleaningJobs.update', $cleaningJob->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price (£)</label>
                        <input
                            type="number"
                            step="0.50"
                            name="price"
                            min="0"
                            id="price"
                            value="{{ old('price', $cleaningJob->price) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required
                        >
                    </div>

                    <div class="w-full">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select
                            name="status"
                            id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        >
                            @foreach(['scheduled', 'completed', 'skipped'] as $status)
                                <option value="{{ $status }}" {{ old('status', $cleaningJob->status) == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full">
                        <label for="scheduled_for" class="block mb-2 text-sm font-medium text-gray-900">Scheduled For</label>
                        <input
                            type="date"
                            name="scheduled_for"
                            id="scheduled_for"
                            value="{{ old('scheduled_for', optional($cleaningJob->scheduled_for)->format('Y-m-d')) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        >
                    </div>

                    <div class="w-full">
                        <label for="completed_at" class="block mb-2 text-sm font-medium text-gray-900">Completed At</label>
                        <input
                            type="date"
                            name="completed_at"
                            id="completed_at"
                            value="{{ old('completed_at', optional($cleaningJob->completed_at)->format('Y-m-d')) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        >
                    </div>

                    <div class="sm:col-span-2">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">Notes</label>
                        <textarea
                            name="notes"
                            id="notes"
                            rows="6"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg
                               border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Job notes...">{{ old('notes', $cleaningJob->notes) }}</textarea>
                    </div>
                </div>

                <button
                    type="submit"
                    class="bg-blue-500 items-center px-2 py-2.5 m-4 text-sm font-medium text-center text-white
                       rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                    Update Job
                </button>
            </form>
        </div>
    </section>
@endsection
