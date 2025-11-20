<?php

namespace App\Livewire\Table;

use App\Models\CleaningJob;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class FilterableCleaningJobsTable extends Component
{
    use WithPagination;

    #[Url]
    public array $area = [];

    #[Url]
    public array $street = [];

    #[Url]
    public array $house = [];

    #[Url]
    public bool $showInactive = false;
    #[Url]
    public bool $onlyScheduled = false;


    public int $perPage = 10;

    public array $sort = ['column' => 'scheduled_for', 'direction' => 'desc'];

    public function updatingArea(): void
    {
        $this->resetPage();
    }

    public function updatingStreet(): void
    {
        $this->resetPage();
    }

    public function updatingHouse(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->area = [];
        $this->street = [];
        $this->house = [];
        $this->resetPage();
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        return $this->query()
            ->orderBy($this->sort['column'], $this->sort['direction'])
            ->paginate($this->perPage);
    }

    #[Computed]
    public function areaOptions(): array
    {
        return Customer::query()
            ->select('area')
            ->whereNotNull('area')
            ->when(count($this->street) > 0, function (Builder $q) {
                $q->wherein('street', $this->street);
            })
            ->distinct()
            ->orderby('area')
            ->pluck('area')
            ->all();
    }

    #[Computed]
    public function streetOptions(): array
    {
        return Customer::query()
            ->select('street')
            ->whereNotNull('street')
            ->when(count($this->area) > 0, function (Builder $q): void {
                $q->whereIn('area', $this->area);
            })
            ->distinct()
            ->orderBy('street')
            ->pluck('street')
            ->all();
    }

    #[Computed]
    public function houseOptions(): array
    {
        return Customer::query()
            ->select('house')
            ->whereNotNull('house')
            ->when(count($this->area) > 0, function (Builder $q): void {
                $q->whereIn('area', $this->area);
            })
            ->when(count($this->street) > 0, function (Builder $q): void {
                $q->whereIn('street', $this->street);
            })
            ->distinct()
            ->orderBy('house')
            ->pluck('house')
            ->all();
    }



    public function query(): Builder
    {
        return CleaningJob::query()
            ->with('customer')
            ->when($this->showInactive, function (Builder $q): void {
                $q->whereHas('customer', function (Builder $sub): void {
                    $sub->onlyTrashed();
                });
            })
            ->when($this->onlyScheduled, function (Builder $q): void {
                $q->where('status', 'scheduled');
            })
            ->when(count($this->area) > 0, function (Builder $q): void {
                $q->whereHas('customer', function (Builder $sub): void {
                    $sub->whereIn('area', $this->area);
                });
            })
            ->when(count($this->street) > 0, function (Builder $q): void {
                $q->whereHas('customer', function (Builder $sub): void {
                    $sub->whereIn('street', $this->street);
                });
            })
            ->when(count($this->house) > 0, function (Builder $q): void {
                $q->whereHas('customer', function (Builder $sub): void {
                    $sub->whereIn('house', $this->house);
                });
            });
    }


    public function render()
    {
        return view('livewire.filterable-cleaning-jobs-table');
    }
}
