<?php

namespace Database\Seeders;

use App\Models\CleaningJob;
use App\Models\Customer;
use App\Models\Invoice;
use Database\Factories\CleaningJobFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::factory()->count(20)->create();

        foreach ($customers as $customer) {
            $cleaningJobs = CleaningJob::factory()->count(11)->forCustomer($customer)->markCompleted()->create();

            foreach ($cleaningJobs as $cleaningJob) {
                    Invoice::factory()->forCleaningJob($cleaningJob)->create();
                }

            CleaningJob::factory()->count(1)->forCustomer($customer)->dueWithinOneWeek()->create();

        }
    }
}
