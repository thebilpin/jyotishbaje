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
        Schema::create('admin_get_commissions', function (Blueprint $table) {
            $table->id();
            $table->string('commissionTypeId')->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('amount')->nullable();
            $table->string('commissionId')->nullable();
            $table->string('description', 100)->nullable();
            $table->string('orderId')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_get_commissions');
    }
};











