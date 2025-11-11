<?php

namespace App\Livewire;

use App\Models\CleaningJob;
use Carbon\Carbon;
use Livewire\Component;

class CompletedButton extends Component
{
    public function toggleStatus(int $cleaningJobId)
    {
        $cleaningJob = CleaningJob::find($cleaningJobId);

        if ($cleaningJob->status == 'completed') {
            $cleaningJob->status = 'scheduled';
        } else {
            $cleaningJob->status = 'completed';
        }

        $cleaningJob->save();
        return $cleaningJob;

    }

    public function render()
    {
        $upcomingJobs = CleaningJob::query()
            ->whereDate('scheduled_for', '<=', Carbon::today()->addWeek())
            ->where('status', 'scheduled')
            ->orderBy('scheduled_for', 'asc')
            ->get();

        return view('livewire.completed-button', compact('upcomingJobs'));
    }
}
