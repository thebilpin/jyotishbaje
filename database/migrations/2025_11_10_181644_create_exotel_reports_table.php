<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exotel_reports', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('sid')->nullable();
            $table->string('call_from', 100)->nullable();
            $table->string('call_to', 100)->nullable();
            $table->string('callerId', 100)->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('status', 100)->nullable();
            $table->string('recording_url')->nullable();
            $table->string('status_url')->nullable();
            $table->text('full_report')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
DB::unprepared(file_get_contents(database_path('sql/exotel_reports.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exotel_reports');
    }
};











