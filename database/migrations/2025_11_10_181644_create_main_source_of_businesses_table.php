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
        Schema::create('main_source_of_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('jobName')->nullable();
            $table->timestamps();
        });
DB::unprepared(file_get_contents(database_path('sql/main_source_of_businesses.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_source_of_businesses');
    }
};











