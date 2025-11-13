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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('contact_email', 100)->nullable();
            $table->string('contact_name', 100)->nullable();
            $table->mediumText('contact_message')->nullable();
            $table->timestamps();
        });
DB::unprepared(file_get_contents(database_path('sql/contact_us.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};











