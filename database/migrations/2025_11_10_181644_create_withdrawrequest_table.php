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
        Schema::create('withdrawrequest', function (Blueprint $table) {
            $table->id();
            $table->string('astrologerId')->nullable()->index('withdrawrequest_astrologer_idx');
            $table->decimal('withdrawAmount', 10)->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('status', 45)->nullable();
            $table->string('isActive')->nullable()->default(1);
            $table->string('isDelete')->nullable()->default(0);
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
            $table->string('paymentMethod', 45)->nullable();
            $table->string('upiId', 45)->nullable();
            $table->string('accountNumber', 45)->nullable();
            $table->string('ifscCode', 45)->nullable();
            $table->string('pan_card', 45)->nullable();
            $table->string('tds_pay_amount', 45)->nullable();
            $table->string('pay_amount', 45)->nullable();
            $table->string('accountHolderName', 100)->nullable();
            $table->text('Note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawrequest');
    }
};











