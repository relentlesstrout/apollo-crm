<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cleaning_jobs', function (Blueprint $table) {
            $table->boolean('due_today')->default(false)->after('scheduled_for');
        });
    }

    public function down(): void
    {
        Schema::table('cleaning_jobs', function (Blueprint $table) {
            $table->dropColumn('due_today');
        });
    }
};
