<?php

namespace Feature\CleaningJob;

use App\Models\CleaningJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CleaningJobUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper functions for data and creating a CleaningJob
     */

    private function validCleaningJobData(array $overrides = []): array
    {
        return array_merge([
            'price' => '30',
            'scheduled_for' => '2025-03-28 00:00:00',
            'status' => 'completed',
            'notes' => 'Eos quia nulla porro est tenetur',
            'due_today' => true,
        ], $overrides);
    }

    private function createCleaningJob(array $overrides = []): CleaningJob
    {
        return CleaningJob::factory()->create($this->validCleaningJobData($overrides));
    }

    public function test_cleaning_job_can_be_updated():void
    {
        $cleaningJob = $this->createCleaningJob();

        $response = $this->put("/cleaningJobs/{$cleaningJob->id}",
        [
            'price' => '25',
            'status' => 'completed',
            'scheduled_for' => '2025-03-30 00:00:00',
            'completed_at' => '2025-03-31 00:00:00',
            'notes' => 'testing testing',
        ]);

        $response->assertRedirect(route('cleaningJobs.index'));

        $this->assertDatabaseHas('cleaning_jobs', [
            'id' => $cleaningJob->id,
            'price' => '25',
            'status' => 'completed',
            'scheduled_for' => '2025-03-30 00:00:00',
            'completed_at' => '2025-03-31 00:00:00',
            'notes' => 'testing testing',
        ]);
    }
    public function test_validation_errors_triggered_on_invalid_data(): void
    {
        $cleaningJob = $this->createCleaningJob();

        $response = $this->from("/cleaningJobs/{$cleaningJob->id}/edit")
            ->put("/cleaningJobs/{$cleaningJob->id}", [
                'price' => null,
                'status' => null,
                'scheduled_for' => null,
                'completed_at' => 'error',
                'notes' => 123,
            ]);

        $response->assertRedirect("/cleaningJobs/{$cleaningJob->id}/edit");
        $response->assertSessionHasErrors([
            'price',
            'status',
            'scheduled_for',
            'completed_at',
            'notes',
        ]);
    }
}
