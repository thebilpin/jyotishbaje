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
        Schema::create('teammember', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->nullable();
            $table->string('contactNo', 45)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('password', 200)->nullable();
            $table->string('isActive')->nullable()->default(1);
            $table->string('isDelete')->nullable()->default(0);
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
            $table->longText('profile')->nullable();
            $table->string('teamRoleId')->nullable();
            $table->string('userId')->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/teammember.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teammember');
    }
};











