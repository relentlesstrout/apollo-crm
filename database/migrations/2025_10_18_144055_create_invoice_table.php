<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('cleaning_job_id')->constrained('cleaning_jobs')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('amount_owed', 10, 2)->nullable();
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->date('satisfied_at')->nullable();
            $table->date('due_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
