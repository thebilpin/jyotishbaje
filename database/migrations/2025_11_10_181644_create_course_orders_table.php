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
        Schema::create('course_orders', function (Blueprint $table) {
            $table->id();
            $table->string('astrologerId')->nullable();
            $table->string('course_id')->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('course_price')->nullable();
            $table->string('course_gst_amount')->nullable();
            $table->string('course_total_price')->nullable();
            $table->enum('payment_type', ['wallet', 'online'])->nullable()->default('wallet');
            $table->enum('course_order_status', ['pending', 'success', 'failed'])->nullable()->default('pending');
            $table->enum('course_completion_status', ['completed', 'incomplete'])->nullable()->default('incomplete');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_orders');
    }
};











