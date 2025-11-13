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
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('notificationId')->nullable()->nullable();
            $table->string('chatRequestId')->nullable();
            $table->string('callRequestId')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->string('notification_type')->default(0)->nullable();
            $table->string('is_read')->nullable()->nullable();
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
        Schema::dropIfExists('user_notifications');
    }
};











