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
        Schema::create('course_chapters', function (Blueprint $table) {
            $table->id();
            $table->string('course_id')->nullable();
            $table->string('chapter_name')->nullable();
            $table->text('chapter_description')->nullable();
            $table->text('chapter_images')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('chapter_document')->nullable();
            $table->string('isActive')->nullable()->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
DB::unprepared(file_get_contents(database_path('sql/course_chapters.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_chapters');
    }
};











