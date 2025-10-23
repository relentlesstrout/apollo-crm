@php
    $uniqueId = 'toggle_' . ($field_name ?? 'default') . '_' . uniqid();
    $isChecked = false;

    // Check if toggle should be checked based on request
    if (isset($checked)) {
        $isChecked = $checked;
    } else {
        $fieldNameParts = str_replace(['[', ']'], ['.', ''], $field_name ?? 'toggle');
        $requestValue = request()->input($fieldNameParts);
        $isChecked = $requestValue === '1' || $requestValue === 'true' || $requestValue === true;
    }

    $activeLabel = $active_label ?? 'Active';
    $inactiveLabel = $inactive_label ?? 'Inactive';
@endphp

<label for="{{ $uniqueId }}" class="relative inline-flex cursor-pointer select-none items-center justify-center rounded-md bg-gray-200 text-sm text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 p-0.5 group">
    <input type="checkbox"
           name="{{ $field_name ?? 'toggle' }}"
           value="1"
           id="{{ $uniqueId }}"
           {{ $isChecked ? 'checked' : '' }}
           class="sr-only">
    <span class="flex items-center space-x-2 rounded py-2 px-4 text-sm font-medium transition-all {{ !$isChecked ? 'bg-blue-200 text-gray-700' : 'text-gray-600 bg-transparent' }}">
        {{ $inactiveLabel }}
    </span>
    <span class="flex items-center space-x-2 rounded py-2 px-4 text-sm font-medium transition-all {{ $isChecked ? 'bg-blue-200 text-gray-700' : 'text-gray-600 bg-transparent' }}">
        {{ $activeLabel }}
    </span>
</label>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof initToggleSwitch === 'function') {
            initToggleSwitch('{{ $uniqueId }}');
        }
    });
</script>
