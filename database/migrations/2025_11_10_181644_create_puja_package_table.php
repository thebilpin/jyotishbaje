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
        Schema::create('puja_package', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->string('person', 100)->nullable();
            $table->decimal('package_price')->nullable();
            $table->decimal('package_price_usd')->nullable();
            $table->text('description')->nullable();
            $table->string('package_status')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
DB::unprepared(file_get_contents(database_path('sql/puja_package.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puja_package');
    }
};











