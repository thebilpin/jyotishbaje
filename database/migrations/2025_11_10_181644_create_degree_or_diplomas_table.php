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
        Schema::create('degree_or_diplomas', function (Blueprint $table) {
            $table->id();
            $table->string('degreeName')->nullable();
            $table->timestamps();
        });
DB::unprepared(file_get_contents(database_path('sql/degree_or_diplomas.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degree_or_diplomas');
    }
};











