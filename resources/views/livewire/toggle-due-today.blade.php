<button wire:click="toggle"
        class="px-4 py-2 text-sm font-medium transition-colors inline-flex items-center gap-1
        {{ $job->due_today
            ? 'text-gray-800 hover:text-gray-900'
            : 'text-gray-400 hover:text-gray-600' }}">

    @if($job->due_today)
        <!-- Checkmark icon for Due Today -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5 13l4 4L19 7" />
        </svg>
        Due Today
    @else
        <!-- Plus icon for marking -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Mark as Due Today
    @endif

</button>
