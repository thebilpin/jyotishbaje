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
        Schema::create('intakeform', function (Blueprint $table) {
            $table->id();
            $table->string('name', 400)->nullable();
            $table->string('phoneNumber', 200)->nullable();
            $table->string('countryCode', 20)->nullable();
            $table->string('gender', 10)->nullable();
            $table->date('birthDate')->nullable();
            $table->time('birthTime')->nullable();
            $table->string('birthPlace', 400)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('timezone', 45)->nullable();
            $table->string('maritalStatus', 40)->nullable();
            $table->string('occupation', 400)->nullable();
            $table->string('topicOfConcern', 200)->nullable();
            $table->string('partnerName', 400)->nullable();
            $table->string('partnerBirthDate')->nullable();
            $table->string('partnerBirthTime', 40)->nullable();
            $table->string('partnerBirthPlace', 400)->nullable();
            $table->string('userId')->nullable();
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intakeform');
    }
};











