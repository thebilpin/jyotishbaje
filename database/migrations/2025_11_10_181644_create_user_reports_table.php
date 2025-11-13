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
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('contactNo', 20)->nullable();
            $table->string('gender')->nullable();
            $table->string('birthDate')->nullable();
            $table->string('birthTime')->nullable();
            $table->string('birthPlace')->nullable();
            $table->string('occupation')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('answerLanguage')->nullable();
            $table->string('partnerName')->nullable();
            $table->string('partnerBirthDate')->nullable();
            $table->string('partnerBirthTime')->nullable();
            $table->string('partnerBirthPlace')->nullable();
            $table->string('comments')->nullable();
            $table->longText('reportFile')->nullable();
            $table->string('reportType')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
            $table->string('countryCode', 45)->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('reportRate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reports');
    }
};











