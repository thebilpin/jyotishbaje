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
        Schema::create('horoscopefeedback', function (Blueprint $table) {
            $table->id();
            $table->longText('feedback')->nullable();
            $table->string('feedbacktype', 50)->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
            $table->string('userId')->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/horoscopefeedback.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horoscopefeedback');
    }
};











