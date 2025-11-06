<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cleaning_jobs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('price', 10, 2)->nullable();
            $table->date('scheduled_for')->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->date('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cleaning_jobs');
    }
};
