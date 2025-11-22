<div>
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

                <x-filter-dropdown
                    label="House"
                    name="street"
                    :options="$this->houseOptions"
                    :selected="$house"
                    />

                @if(count($street) > 0 || count($area) > 0)
                    <button type="button" wire:click="clearFilters" class="text-sm text-gray-500 hover:text-gray-700 underline cursor-pointer">
                        Clear Filters
                    </button>
                @endif
            </div>

            <x-toggle
            :model="'showInactive'"
            :true-label="'Inactive'"
            :false-label="'Active'"
            :value="$showInactive"
            />

            <x-toggle
                :model="'onlyScheduled'"
                :true-label="'Scheduled'"
                :false-label="'All Jobs'"
                :value="$onlyScheduled"
            />

        </div>
    </div>

    <x-cleaning-jobs-table
        :cleaning-jobs="$this->items"
        :sort-field="$sortField"
        :sort-direction="$sortDirection"
        wire:click="sortBy()"
    />

    <div class="mt-4">
        {{ $this->items->links() }}
    </div>
</div>
