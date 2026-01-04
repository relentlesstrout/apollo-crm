<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CustomerSoftDeleteTest extends TestCase
{
    use RefreshDatabase;

    private function createCustomer(): Customer
    {
        return Customer::factory()->create([
            'house' => '12',
            'street' => 'High Street',
            'area' => 'Blaydon',
            'phone' => '07123456789',
            'notes' => 'Side gate open',
            'cleaning_frequency_weeks' => 8,
        ]);
    }

    #[Test]
    public function customer_can_be_soft_deleted(): void
    {
        $customer = $this->createCustomer();

        $response = $this->delete("/customers/{$customer->id}");

        // Redirect after delete
        $response->assertRedirect(route('customers.index'));

        // Assert row still exists but is soft deleted
        $this->assertSoftDeleted('customers', [
            'id' => $customer->id,
        ]);

        // Default queries should not return it
        $this->assertNull(Customer::find($customer->id));

        // But it should exist when including trashed records
        $this->assertNotNull(
            Customer::withTrashed()->find($customer->id)
        );
    }

    #[Test]
    public function soft_deleted_customer_can_be_restored(): void
    {
        $customer = $this->createCustomer();

        $customer->delete();

        $this->assertSoftDeleted('customers', [
            'id' => $customer->id,
        ]);

        $response = $this->patch("/customers/{$customer->id}/restore");

        $response->assertRedirect(route('customers.index'));

        // Customer should no longer be soft deleted
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'deleted_at' => null,
        ]);
    }

}
