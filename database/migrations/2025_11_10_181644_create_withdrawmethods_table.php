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
        Schema::create('withdrawmethods', function (Blueprint $table) {
            $table->id();
            $table->string('method_name')->nullable();
            $table->string('method_id')->nullable();
            $table->string('isActive')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
DB::unprepared(file_get_contents(database_path('sql/withdrawmethods.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawmethods');
    }
};











