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
        Schema::create('sub_category', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id')->default(0)->nullable();
            $table->string('category_name', 100)->default('')->nullable();
            $table->string('category_image', 200)->default('')->nullable();
            $table->timestamps();
        });
DB::unprepared(file_get_contents(database_path('sql/sub_category.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_category');
    }
};











