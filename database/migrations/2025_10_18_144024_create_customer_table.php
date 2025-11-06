<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table): void {
            $table->id();
            $table->string('house')->nullable();
            $table->string('street')->nullable();
            $table->string('area')->nullable();
            $table->string('phone')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedTinyInteger('cleaning_frequency_weeks')->default(4);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
