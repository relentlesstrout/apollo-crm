<div>
    <!-- Filters Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-end gap-4 flex-wrap">
                <x-filter-dropdown
                    label="Area"
                    name="area"
                    :options="$this->areaOptions"
                    :selected="$area"
                />

                <x-filter-dropdown
                    label="Street"
                    name="street"
                    :options="$this->streetOptions"
                    :selected="$street"
                />

                @if(count($street) > 0 || count($area) > 0)
                    <button type="button" wire:click="clearFilters" class="text-sm text-gray-500 hover:text-gray-700 underline cursor-pointer">
                        Clear Filters
                    </button>
                @endif
            </div>

            <x-status-toggle :showInactive="$showInactive" />
        </div>
    </div>

    <x-customers-table :customers="$this->items" />

    <!-- Pagination -->
    <div class="mt-4">
        {{ $this->items->links() }}
    </div>
</div>
