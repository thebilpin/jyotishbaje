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
        Schema::create('adminpages', function (Blueprint $table) {
            $table->id();
            $table->string('pageName', 45)->nullable();
            $table->string('pageGroup')->nullable();
            $table->string('icon', 45)->nullable();
            $table->string('route', 45)->nullable();
            $table->string('displayOrder')->nullable();
            $table->timestamps();
        });
DB::unprepared(file_get_contents(database_path('sql/adminpages.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adminpages');
    }
};











