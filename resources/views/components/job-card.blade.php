@props(['job'])

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-4 flex flex-col relative">

    {{-- Top Row: Address + Price --}}
    <div class="flex justify-between items-start mb-3">

        {{-- Address formatted like an address --}}
        <div class="text-gray-900 font-semibold text-sm leading-tight">
            {!! nl2br(e($job->customer->full_address)) !!}
        </div>

        {{-- Price badge --}}
        <div class="bg-green-100 text-green-700 font-bold text-lg px-3 py-1 rounded-lg shadow-sm">
            £{{ number_format($job->price, 2) }}
        </div>
    </div>

    {{-- Notes Box (BOTTOM LEFT) --}}
    <div class="mt-auto">
        <div class="bg-gray-100 border border-gray-300 rounded-md px-3 py-2 text-sm max-w-[70%]">
            @if(!empty($job->notes))
                <p class="text-gray-700 whitespace-pre-line">{{ $job->notes }}</p>
            @else
                <p class="text-gray-400 italic">No notes</p>
            @endif
        </div>
    </div>

    {{-- Action Button --}}
    <div class="pt-4">
        <button
            wire:click="toggleComplete({{ $job->id }})"
            class="w-fit px-4 py-2 text-sm font-medium transition-colors inline-flex items-center gap-1
            {{ $job->status === 'completed'
                ? 'text-gray-800 hover:text-gray-900'
                : 'text-green-600 hover:text-green-800' }}"
        >
            @if($job->status === 'completed')
                <!-- Checkmark icon for completed -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Completed
            @else
                <!-- Clipboard/check icon for marking complete -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2 4-4m5.25-2.25V18a2.25 2.25 0 01-2.25 2.25H7.5A2.25 2.25 0 015.25 18V5.25A2.25 2.25 0 017.5 3h3.379a2.25 2.25 0 011.59.659l.382.382h3.349A2.25 2.25 0 0118.75 6v0z" />
                </svg>
                Mark Complete
            @endif
        </button>
    </div>

</div>



{{--@props(['job'])--}}

{{--<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-3">--}}
{{--    <div class="flex justify-between items-start mb-2">--}}
{{--        --}}{{-- Customer address --}}
{{--        <div class="text-gray-900 font-semibold text-sm leading-tight">--}}
{{--            {{ $job->customer->full_address ?? 'No address available' }}--}}
{{--        </div>--}}

{{--        --}}{{-- Price --}}
{{--        <div class="text-gray-700 font-medium text-sm">--}}
{{--            £{{ number_format($job->price, 2) }}--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    --}}{{-- Notes --}}
{{--    @if(!empty($job->notes))--}}
{{--    <div class="text-gray-600 text-sm whitespace-pre-line">--}}
{{--        {{ $job->notes }}--}}
{{--    </div>--}}
{{--    @else--}}
{{--    <div class="text-gray-400 text-sm italic">No notes</div>--}}
{{--    @endif--}}

{{--    <button--}}
{{--        wire:click="markAsComplete({{ $job->id }})"--}}
{{--        class="px-4 py-2 text-sm font-medium transition-colors inline-flex items-center gap-1--}}
{{--    {{ $job->status === 'completed'--}}
{{--        ? 'text-gray-800 hover:text-gray-900'--}}
{{--        : 'text-green-600 hover:text-green-800' }}">--}}

{{--        @if($job->status === 'completed')--}}
{{--            <!-- Checkmark icon when job is completed -->--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />--}}
{{--            </svg>--}}
{{--            Completed--}}
{{--        @else--}}
{{--            <!-- Clipboard check icon for marking complete -->--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                      d="M9 12l2 2 4-4m5.25-2.25V18a2.25 2.25 0 01-2.25 2.25H7.5A2.25 2.25 0 015.25 18V5.25A2.25 2.25 0 017.5 3h3.379a2.25 2.25 0 011.59.659l.382.382h3.349A2.25 2.25 0 0118.75 6v0z" />--}}
{{--            </svg>--}}
{{--            Mark Complete--}}
{{--        @endif--}}
{{--    </button>--}}

{{--</div>--}}
