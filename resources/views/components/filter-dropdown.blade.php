@props(['label', 'name', 'options', 'selected' => []])

<div class="relative inline-block" x-data="{ open: false }">
    <button type="button" @click="open = !open" class="inline-flex items-center gap-x-4 rounded-md bg-gray-200 cursor-pointer px-3.5 py-2.5 text-sm text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 relative">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
        </svg>
        <span class="block">{{ $label }}</span>
        @if(count($selected) > 0)
            <span class="absolute -top-2 -right-2 text-xs bg-blue-200 text-gray-700 rounded-full px-1.5 py-0.5 min-w-[20px] text-center">{{ count($selected) }}</span>
        @endif
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 transition-transform" :class="{ 'rotate-180': open }">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    <div x-show="open" @click.away="open = false" x-transition class="absolute z-50 mt-2 w-64 shadow-lg bg-white border border-gray-200">
        <div class="p-4">
            <div class="max-h-60 overflow-y-auto">
                @foreach($options as $option)
                    <label class="flex items-center px-2 py-2 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0">
                        <input type="checkbox" wire:model.live="{{ $name }}" value="{{ $option }}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">{{ $option }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</div>
