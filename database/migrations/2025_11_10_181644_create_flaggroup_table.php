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
        Schema::create('flaggroup', function (Blueprint $table) {
            $table->id();
            $table->string('flagGroupName', 45)->nullable();
            $table->string('parentFlagGroupId')->nullable();
            $table->string('displayOrder')->nullable();
            $table->string('isActive')->nullable()->default(1);
            $table->string('isDelete')->nullable()->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->longText('description')->nullable();
            $table->string('viewenable')->nullable()->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/flaggroup.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flaggroup');
    }
};











