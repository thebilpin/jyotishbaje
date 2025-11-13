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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('contactNo', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->date('birthDate')->nullable();
            $table->time('birthTime')->nullable();
            $table->text('profile')->nullable();
            $table->string('birthPlace', 50)->nullable();
            $table->text('addressLine1')->nullable();
            $table->text('addressLine2')->nullable();
            $table->string('country', 45)->default('india')->nullable();
            $table->string('location', 100)->nullable();
            $table->string('pincode')->nullable();
            $table->string('gender', 30)->nullable();
            $table->string('referral_token', 100)->nullable();
            $table->string('referrer_id')->nullable()->default(0);
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->enum('userRoleName', ['SUPERADMIN', 'ADMIN', 'SUBADMIN', 'USER', 'OTHER'])->default('OTHER');
            $table->timestamps();
            $table->string('fcm_token', 400)->nullable();
            $table->longText('token')->nullable();
            $table->string('expirationDate')->nullable();
            $table->string('countryCode', 45)->default('+91')->nullable();
            $table->string('isProfileComplete')->nullable();
            $table->softDeletes();
        });
DB::unprepared(file_get_contents(database_path('sql/users.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};











