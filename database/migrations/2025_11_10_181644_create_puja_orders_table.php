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
        Schema::create('puja_orders', function (Blueprint $table) {
            $table->id();
            $table->string('astrologer_id')->default(0)->nullable();
            $table->string('astrologer_joined_at')->nullable();
            $table->string('user_id')->default(0)->nullable();
            $table->string('puja_id')->default(0)->nullable();
            $table->string('puja_name', 100)->nullable();
            $table->string('puja_start_datetime')->nullable();
            $table->string('puja_end_datetime')->nullable();
            $table->string('puja_duration', 100)->nullable();
            $table->string('package_id')->default(0)->nullable();
            $table->string('package_name', 100)->nullable();
            $table->string('package_person', 100)->nullable();
            $table->string('address_id')->default(0)->nullable();
            $table->string('address_name', 100)->nullable();
            $table->string('addressCountryCode')->nullable();
            $table->string('address_number', 100)->nullable();
            $table->string('address_flatno', 50)->nullable();
            $table->string('address_ locality', 100)->nullable();
            $table->string('address_city', 100)->nullable();
            $table->string('address_state', 100)->nullable();
            $table->string('address_country', 100)->nullable();
            $table->string('address_pincode')->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('order_price')->nullable();
            $table->string('order_gst_amount')->nullable();
            $table->string('order_total_price')->nullable();
            $table->string('payment_type', 100)->nullable();
            $table->string('payment_id')->nullable();
            $table->string('address_landmark', 100)->nullable();
            $table->enum('puja_order_status', ['pending', 'placed', 'ongoing', 'completed'])->default('pending');
            $table->text('puja_video')->nullable();
            $table->enum('is_puja_approved', ['approved', 'rejected', 'pending', 'requested'])->default('pending');
            $table->tinyInteger('reminder_sent')->default(0);
            $table->string('puja_refund_status')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puja_orders');
    }
};











