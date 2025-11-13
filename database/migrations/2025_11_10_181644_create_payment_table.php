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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('paymentMode', 45)->nullable();
            $table->enum('payment_for', ['wallet', 'puja', 'course', 'topupchat', 'topupcall'])->default('wallet');
            $table->string('paymentReference', 45)->nullable();
            $table->string('inr_usd_conversion_rate')->nullable()->default(1);
            $table->string('amount')->nullable();
            $table->string('userId')->nullable();
            $table->string('paymentStatus', 45)->nullable();
            $table->string('signature', 200)->nullable();
            $table->longText('orderId')->nullable();
            $table->string('cashback_amount')->nullable();
            $table->text('payment_order_info')->nullable();
            $table->string('durationchat', 100)->nullable();
            $table->string('chatId')->nullable();
            $table->string('durationcall', 100)->nullable();
            $table->string('callId')->nullable();
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};











