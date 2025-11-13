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
        Schema::create('help_support_quations', function (Blueprint $table) {
            $table->id();
            $table->string('helpSupportId')->nullable();
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
            $table->string('isChatWithus')->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/help_support_quations.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_support_quations');
    }
};











