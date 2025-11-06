<?php

namespace App\Livewire\Table;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

final class FilterableCustomerTable extends Component
{
    use WithPagination;

    public array $area = [];
    public array $street = [];
    public bool $showInactive = false;
    public int $perPage = 10;
    public array $sort = ['column' => 'created_at', 'direction' => 'desc'];

    public function updatingArea(): void
    {
        $this->resetPage();
    }

    public function updatingStreet(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->area = [];
        $this->street = [];
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
            ->when(count($this->street) > 0, function (Builder $q): void {
                $q->whereIn('street', $this->street);
            })
            ->distinct()
            ->orderBy('area')
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

    public function query(): Builder
    {
        return Customer::query()
            ->when($this->showInactive, function (Builder $q): void {
                $q->onlyTrashed();
            })
            ->when(count($this->area) > 0, function (Builder $q): void {
                $q->whereIn('area', $this->area);
            })
            ->when(count($this->street) > 0, function (Builder $q): void {
                $q->whereIn('street', $this->street);
            });
    }

    private function escapeLike(string $value): string
    {
        return addcslashes($value, '\%_');
    }

    public function render()
    {
        return view('livewire.filterable-customer-table');
    }
}
