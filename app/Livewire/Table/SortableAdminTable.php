<?php

namespace App\Livewire\Table;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;

class SortableAdminTable extends Component
{
    use WithPagination;
    public string $sortColumn = 'created_at';
    public string $sortDirection = 'desc';

    public function sortBy(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }
        else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('livewire.sortable-admin-table', [
            'admins' => Admin::query()
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate(10)
        ]);
    }
}
