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
        Schema::create('report_types', function (Blueprint $table) {
            $table->id();
            $table->string('reportImage')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
        });
DB::unprepared(file_get_contents(database_path('sql/report_types.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_types');
    }
};











