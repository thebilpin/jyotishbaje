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
        Schema::create('wallettransaction', function (Blueprint $table) {
            $table->id();
            $table->string('callId', 225)->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('amount')->nullable();
            $table->string('coin')->default(0)->nullable();
            $table->string('userId')->nullable();
            $table->string('transactionType', 45)->nullable();
            $table->string('orderId')->nullable();
            $table->string('puja_recommend_id')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
            $table->string('isCredit')->nullable();
            $table->string('walletType')->default(0)->comment('0:amount, 1:coin')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('aiAstrologerId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallettransaction');
    }
};











