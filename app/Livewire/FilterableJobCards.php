<?php

namespace App\Livewire;

use App\Models\CleaningJob;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class FilterableJobCards extends Component
{
    use WithPagination;

    #[Url]
    public array $area = [];

    #[Url]
    public array $street = [];

    public int $perPage = 20;

    public bool $showCompleted = false;


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
    public function areaOptions(): array
    {
        return Customer::query()
            ->select('area')
            ->whereNotNull('area')
            ->whereHas('cleaningJobs', fn($q) => $q->where('due_today', true))
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
            ->whereHas('cleaningJobs', fn($q) => $q->where('due_today', true))
            ->when(count($this->area) > 0, function (Builder $q): void {
                $q->whereIn('area', $this->area);
            })
            ->distinct()
            ->orderBy('street')
            ->pluck('street')
            ->all();
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        return $this->query()
            ->paginate($this->perPage);
    }

    public function query(): Builder
    {
        return CleaningJob::query()
            ->where('due_today', true)
            ->when($this->showCompleted, function (Builder $q): void {
                $q->where('status', 'completed');
            })
            ->when(count($this->area) > 0, function (Builder $q): void {
                $q->whereIn('area', $this->area);
            })
            ->when(count($this->street) > 0, function (Builder $q): void {
                $q->whereIn('street', $this->street);
            });
    }

    public function toggleComplete($jobId)
    {
        $job = CleaningJob::find($jobId);

        if ($job->status === 'completed') {
            $job->update([
                'status' => 'scheduled',
                'due_today' => true,
                'completed_at' => NULL,
            ]);

        } else {
            $job->update([
                'status' => 'completed',
                'due_today' => true,
                'completed_at' => Carbon::now(),
            ]);

            $cleaningFrequency = $job->customer->cleaning_frequency_weeks;
            $nextScheduledDate = Carbon::now()->addWeeks($cleaningFrequency);

            CleaningJob::create([
                'customer_id' => $job->customer_id,
                'price' => $job->price,
                'scheduled_for' => $nextScheduledDate,
                'status' => 'scheduled',
                'due_today' => false,
                'completed_at' => NULL,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.filterable-job-cards');
    }
}
