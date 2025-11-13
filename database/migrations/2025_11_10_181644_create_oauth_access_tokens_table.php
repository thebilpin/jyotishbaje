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
        Schema::create('oauth_access_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary()->nullable();
            $table->string('user_id')->nullable();
            $table->string('client_id')->nullable();
            $table->string('name')->nullable();
            $table->text('scopes')->nullable();
            $table->string('revoked')->nullable();
            $table->timestamps();
            $table->string('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oauth_access_tokens');
    }
};











