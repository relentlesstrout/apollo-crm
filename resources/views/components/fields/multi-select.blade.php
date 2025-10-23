@php
    $uniqueId = 'multiselect_' . ($field_name ?? 'default') . '_' . uniqid();
@endphp

<div class="relative inline-block" id="{{ $uniqueId }}">
    <button type="button" class="multiselect-btn inline-flex items-center gap-x-4 rounded-md bg-gray-200 cursor-pointer px-3.5 py-2.5 text-sm text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
        </svg>
        <span class="block">
            <span class="label-text">{{ $label }}</span>
            <span class="selected-count text-xs ml-1 bg-blue-400 text-white rounded-full px-2 py-0.5" style="display: none;">0</span>
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 chevron transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    <!-- Popup Multi-Select Dropdown -->
    <div class="multiselect-dropdown absolute z-50 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 opacity-0 scale-95 transition-all duration-200 pointer-events-none" style="display: none;">
        <div class="p-4">
            <div class="mb-3">
                <input type="text"
                       class="search-input w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Search...">
            </div>

            <div class="options-container max-h-60 overflow-y-auto">
                @if(isset($options) && count($options) > 0)
                    @foreach($options as $option)
                        @php
                            $isSelected = false;
                            if (isset($selected_values)) {
                                $isSelected = in_array($option, (array)$selected_values);
                            } else {
                                // Handle filter[area][] format from QueryBuilder
                                $fieldNameParts = str_replace(['[', ']'], ['.', ''], $field_name ?? 'multi_select');
                                $requestValues = request()->input($fieldNameParts);
                                if ($requestValues) {
                                    $isSelected = is_array($requestValues) ? in_array($option, $requestValues) : $requestValues === $option;
                                }
                            }
                        @endphp
                        <label class="option-item flex items-center px-2 py-2 hover:bg-gray-100 rounded cursor-pointer" data-value="{{ $option }}">
                            <input type="checkbox"
                                   name="{{ $field_name ?? 'multi_select' }}[]"
                                   value="{{ $option }}"
                                   {{ $isSelected ? 'checked' : '' }}
                                   class="option-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">{{ $option }}</span>
                        </label>
                    @endforeach
                @else
                    <div class="px-2 py-2 text-sm text-gray-500">No options available</div>
                @endif
            </div>

            <div class="mt-3 pt-3 border-t border-gray-200 flex justify-between">
                <button type="button" class="clear-all text-xs text-gray-600 hover:text-gray-800">
                    Clear All
                </button>
                <button type="button" class="select-all text-xs text-blue-600 hover:text-blue-800">
                    Select All
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof initMultiSelect === 'function') {
            initMultiSelect('{{ $uniqueId }}');
        }
    });
</script>
