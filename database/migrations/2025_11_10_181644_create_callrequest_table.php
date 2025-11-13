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
        Schema::create('callrequest', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('astrologerId')->nullable()->nullable();
            $table->string('callStatus', 45)->nullable();
            $table->string('channelName', 45)->nullable();
            $table->string('token', 400)->nullable();
            $table->string('totalMin', 45)->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('inr_to_coin_conversion')->default(0)->nullable();
            $table->string('callRate', 45)->nullable();
            $table->string('deduction')->nullable();
            $table->string('call_duration')->nullable();
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
            $table->string('deductionFromAstrologer')->nullable();
            $table->string('sId', 45)->nullable();
            $table->string('sId1', 45)->nullable();
            $table->string('chatId', 200)->nullable();
            $table->string('isFreeSession')->nullable();
            $table->string('call_type')->nullable()->default(0);
            $table->string('call_method', 100)->nullable()->default('agora');
            $table->string('validated_till')->nullable();
            $table->string('is_emergency')->default(0)->nullable();
            $table->string('IsSchedule')->nullable();
            $table->date('schedule_date')->nullable();
            $table->time('schedule_time')->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/callrequest.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callrequest');
    }
};











