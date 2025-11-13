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
        Schema::create('highest_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('qualificationName')->nullable();
            $table->timestamps();
        });
DB::unprepared(file_get_contents(database_path('sql/highest_qualifications.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('highest_qualifications');
    }
};











