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
        Schema::create('blockastrologer', function (Blueprint $table) {
            $table->id();
            $table->string('astrologerId')->nullable();
            $table->string('userId')->nullable();
            $table->longText('reason')->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/blockastrologer.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blockastrologer');
    }
};











