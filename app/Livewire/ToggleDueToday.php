<?php

namespace App\Livewire;

use App\Models\CleaningJob;
use Livewire\Component;

class ToggleDueToday extends Component
{
    public $job;

    public function mount(CleaningJob $job)
    {
        $this->job = $job;
    }

    public function toggle()
    {
        $this->job->due_today = !$this->job->due_today;
        $this->job->save();

        $this->job->refresh();
    }

    public function render()
    {
        return view('livewire.toggle-due-today');
    }
}
