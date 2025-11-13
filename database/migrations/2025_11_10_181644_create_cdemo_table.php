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
        Schema::create('cdemo', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->nullable();
            $table->string('description', 45)->nullable();
            $table->string('created_at')->nullable()->useCurrent();
        });
DB::unprepared(file_get_contents(database_path('sql/cdemo.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdemo');
    }
};











