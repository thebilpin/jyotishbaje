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
        Schema::create('countries2', function (Blueprint $table) {
            $table->id();
            $table->string('shortname', 155)->nullable();
            $table->string('name', 150)->nullable();
            $table->string('phonecode')->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/countries2.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries2');
    }
};











