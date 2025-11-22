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


                @if(count($street) > 0 || count($area) > 0)
                    <button type="button" wire:click="clearFilters" class="text-sm text-gray-500 hover:text-gray-700 underline cursor-pointer">
                        Clear Filters
                    </button>
                @endif

                <x-toggle
                    :model="'showCompleted'"
                    :true-label="'Completed Jobs'"
                    :false-label="'Todays Jobs'"
                    :value="$showCompleted"
                />
            </div>
        </div>
        <div class="flex flex-col gap-4 mt-5">
            @foreach($this->items() as $job)
                <x-job-card :job="$job"/>
            @endforeach
        </div>
    </div>
</div>
