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
        Schema::create('astrologer_assistants', function (Blueprint $table) {
            $table->id();
            $table->string('astrologerId')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('contactNo', 20)->nullable();
            $table->string('gender')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('primarySkill', 100)->nullable();
            $table->string('allSkill', 100)->nullable();
            $table->string('languageKnown')->nullable();
            $table->string('experienceInYears')->nullable();
            $table->string('profile')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/astrologer_assistants.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologer_assistants');
    }
};











