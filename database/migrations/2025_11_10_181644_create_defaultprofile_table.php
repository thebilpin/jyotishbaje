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
        Schema::create('defaultprofile', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->nullable();
            $table->string('profile', 200)->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/defaultprofile.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defaultprofile');
    }
};











