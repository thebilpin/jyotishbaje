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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('blogImage', 200)->nullable();
            $table->string('blogCategoryId')->nullable();
            $table->longText('description')->nullable();
            $table->string('viewer')->nullable();
            $table->string('author', 100)->nullable();
            $table->string('postedOn')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
            $table->string('extension', 45)->nullable();
            $table->string('previewImage', 200)->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/blogs.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};











