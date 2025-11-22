@props([
'model', // The Livewire property to toggle (string)
'trueLabel' => 'On', // Label for true state
'falseLabel' => 'Off', // Label for false state
'value' => false, // Current boolean value
])


<div class="relative inline-flex select-none items-center justify-center rounded-md bg-gray-200 text-sm text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 p-0.5">
    <button
        type="button"
        wire:click="$set('{{ $model }}', false)"
        class="flex items-center space-x-2 rounded py-2 px-4 text-sm font-medium transition-all cursor-pointer {{ !$value ? 'bg-blue-200 text-gray-700' : 'text-gray-600 bg-transparent' }}">
        {{ $falseLabel }}
    </button>

    <button
        type="button"
        wire:click="$set('{{ $model }}', true)"
        class="flex items-center space-x-2 rounded py-2 px-4 text-sm font-medium transition-all cursor-pointer {{ $value ? 'bg-blue-200 text-gray-700' : 'text-gray-600 bg-transparent' }}">
        {{ $trueLabel }}
    </button>
</div>

