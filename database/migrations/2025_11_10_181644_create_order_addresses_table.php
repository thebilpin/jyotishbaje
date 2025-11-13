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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('name')->nullable();
            $table->string('phoneNumber', 20)->nullable();
            $table->string('phoneNumber2', 20)->nullable();
            $table->string('flatNo')->nullable();
            $table->string('locality')->nullable();
            $table->string('landmark')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
            $table->string('countryCode', 45)->nullable();
            $table->string('alternateCountryCode', 45)->nullable();
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};











