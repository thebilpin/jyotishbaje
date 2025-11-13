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
        Schema::create('systemflag', function (Blueprint $table) {
            $table->id();
            $table->string('valueType', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->text('value')->nullable();
            $table->string('isActive', 45)->nullable()->default('1');
            $table->string('isDelete', 45)->nullable()->default('0');
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
            $table->string('displayName', 100)->nullable();
            $table->string('flagGroupId')->nullable();
            $table->longText('description')->nullable();
            $table->string('parent_id')->default(0)->nullable();
            $table->string('viewenable')->nullable()->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/systemflag.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('systemflag');
    }
};











