<?php

namespace Feature\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Helper functions for data and creating a customer
     */
    private function validCustomerData(array $overrides = []): array
    {
        return array_merge([
            'house' => '12',
            'street' => 'High Street',
            'area' => 'Blaydon',
            'phone' => '07123456789',
            'notes' => 'Side gate open',
            'cleaning_frequency_weeks' => 8,
        ], $overrides);
    }

    private function createCustomer(array $overrides = []): Customer
    {
        return Customer::factory()->create($this->validCustomerData($overrides));
    }

//    Tests


    public function test_customer_can_be_updated(): void
    {
        $customer = $this->createCustomer();

        $response = $this->put("/customers/{$customer->id}", [
            'house' => '99',
            'street' => 'New Street',
            'area' => 'Newtown',
            'phone' => '07999999999',
            'notes' => 'Updated notes',
            'cleaning_frequency_weeks' => 12,
        ]);

        $response->assertRedirect((route('customers.index')));

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'house' => '99',
            'street' => 'New Street',
            'area' => 'Newtown',
            'phone' => '07999999999',
            'notes' => 'Updated notes',
            'cleaning_frequency_weeks' => 12,
        ]);
    }

    public function test_validation_errors_triggered_on_invalid_data(): void
    {
        $customer = $this->createCustomer();

        $response = $this->from("/customers/{$customer->id}/edit")
            ->put("/customers/{$customer->id}", [
                'house' => '',
                'street' => str_repeat('A', 100),
                'area' => '',
                'phone' => '1234567890123456789012345',
                'notes' => str_repeat('X', 300),
                'cleaning_frequency_weeks' => 2,
            ]);

        $response->assertRedirect("/customers/{$customer->id}/edit");
        $response->assertSessionHasErrors([
            'house',
            'street',
            'area',
            'phone',
            'notes',
            'cleaning_frequency_weeks',
        ]);
    }

    public function test_only_fields_that_are_fillable_can_be_updated(): void
    {
        $customer = $this->createCustomer();

        $response = $this->put("/customers/{$customer->id}", [
            'id' => 999, // should be ignored
            'created_at' => now()->subDays(10), // should be ignored
            'house' => '55',
            'street' => 'High Street',
            'area' => 'Blaydon',
            'phone' => '07123456789',
            'notes' => 'Side gate open',
            'cleaning_frequency_weeks' => 8,
        ]);

        $customer->refresh();

        $this->assertEquals('55', $customer->house);
        $this->assertNotEquals(999, $customer->id);
    }
}
