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
        Schema::create('pujas', function (Blueprint $table) {
            $table->id();
            $table->string('category_id')->default(0)->nullable();
            $table->string('sub_category_id')->nullable();
            $table->string('puja_title', 100)->nullable();
            $table->string('slug')->nullable();
            $table->string('puja_subtitle', 100)->nullable();
            $table->string('puja_place', 100)->nullable();
            $table->text('long_description')->nullable();
            $table->text('puja_benefits')->nullable();
            $table->text('puja_images')->nullable();
            $table->string('puja_start_datetime')->nullable();
            $table->string('puja_end_datetime')->nullable();
            $table->string('puja_duration', 100)->nullable();
            $table->text('package_id')->nullable();
            $table->string('puja_status')->nullable();
            $table->string('astrologerId')->nullable();
            $table->decimal('puja_price')->nullable();
            $table->enum('isAdminApproved', ['Pending', 'Approved', 'Rejected', ''])->default('Pending');
            $table->string('isPujaEnded')->nullable()->nullable();
            $table->timestamp('actual_puja_endtime')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pujas');
    }
};











