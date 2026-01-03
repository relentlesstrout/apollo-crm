<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerStoreTest extends TestCase
{
    use RefreshDatabase;
    private function validCustomerData(array $overrides = []): array
    {
        return array_merge([
            'house' => '12',
            'street' => 'High Street',
            'area' => 'Blaydon',
            'phone' => '07123456789',
            'notes' => 'Side gate open',
            'cleaning_frequency_weeks' => 8,
            'first_clean_price' => 30.00,
            'scheduled_for' => '2026-01-10 00:00:00',
        ], $overrides);
    }

    public function test_customer_and_first_job_are_created()
    {
        $response = $this->post('/customers', $this->validCustomerData());

        $response->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', [
            'house' => '12',
            'street' => 'High Street',
            'area' => 'Blaydon',
            'phone' => '07123456789',
            'notes' => 'Side gate open',
            'cleaning_frequency_weeks' => 8,
        ]);

        $this->assertDatabaseHas('cleaning_jobs', [
            'price' => 30.00,
            'scheduled_for' => '2026-01-10 00:00:00',
        ]);
    }

    public function test_first_job_is_linked_to_customer()
    {
        $this->post('/customers', $this->validCustomerData());

        $customer = Customer::first();

        $this->assertCount(1, $customer->cleaningJobs);
        $this->assertEquals(30.00, $customer->cleaningJobs->first()->price);
    }

    public function test_price_and_schedule_are_not_saved_on_customer()
    {
        $this->post('/customers', $this->validCustomerData());

        $customer = Customer::first();

        $this->assertObjectNotHasProperty('first_clean_price', $customer);
        $this->assertObjectNotHasProperty('scheduled_for', $customer);
    }

    public function test_house_is_required()
    {
        $response = $this->post('/customers', $this->validCustomerData([
            'house' => '',
        ]));

        $response->assertSessionHasErrors('house');
    }

    public function test_cleaning_frequency_must_be_between_4_and_52()
    {
        $response = $this->post('/customers', $this->validCustomerData([
            'cleaning_frequency_weeks' => 2,
        ]));

        $response->assertSessionHasErrors('cleaning_frequency_weeks');
    }

    public function test_first_clean_price_must_be_numeric()
    {
        $response = $this->post('/customers', $this->validCustomerData([
            'first_clean_price' => 'abc',
        ]));

        $response->assertSessionHasErrors('first_clean_price');
    }

    public function test_scheduled_for_must_be_a_valid_date()
    {
        $response = $this->post('/customers', $this->validCustomerData([
            'scheduled_for' => 'not-a-date',
        ]));

        $response->assertSessionHasErrors('scheduled_for');
    }

}
