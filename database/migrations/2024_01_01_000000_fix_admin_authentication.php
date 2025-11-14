<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        // Create admin table if it doesn't exist
        if (!Schema::hasTable('admin')) {
            Schema::create('admin', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
            
            // Insert default admin user
            DB::table('admin')->insert([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Ensure systemflag table has required entries
        $systemFlags = [
            ['name' => 'AdminLogo', 'value' => 'images/default-logo.svg'],
            ['name' => 'AppName', 'value' => 'Astroway Admin'],
        ];
        
        foreach ($systemFlags as $flag) {
            DB::table('systemflag')->updateOrInsert(
                ['name' => $flag['name']],
                ['value' => $flag['value']]
            );
        }
    }
    
    public function down()
    {
        Schema::dropIfExists('admin');
    }
};