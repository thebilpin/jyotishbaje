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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->string('orderId')->nullable();
            $table->string('grossAmount')->nullable();
            $table->string('gstPercent')->nullable();
            $table->string('gstAmount')->nullable();
            $table->string('discountAmount')->nullable();
            $table->string('walletBalanceDeducted')->nullable();
            $table->string('netAmount')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->string('astrologerPayment')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};











