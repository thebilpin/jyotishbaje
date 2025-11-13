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
        Schema::create('astrotalk_in_news', function (Blueprint $table) {
            $table->id();
            $table->string('newsDate')->nullable();
            $table->string('channel')->nullable();
            $table->string('link')->nullable();
            $table->string('bannerImage')->nullable();
            $table->longText('description')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
        });
        DB::unprepared(file_get_contents(database_path('sql/astrotalk_in_news.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrotalk_in_news');
    }
};











