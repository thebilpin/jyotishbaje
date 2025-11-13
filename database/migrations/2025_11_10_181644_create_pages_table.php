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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->string('slug', 225)->nullable();
            $table->enum('type', ['privacy', 'terms', 'aboutus', 'refundpolicy', 'astrologerPrivacy', 'astrologerTerms'])->nullable();
            $table->longText('description')->nullable();
            $table->string('isActive')->nullable()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
DB::unprepared(file_get_contents(database_path('sql/pages.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};











