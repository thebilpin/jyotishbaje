<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Check if admin table exists
        if (!Schema::hasTable('admin')) {
            Schema::create('admin', function ($table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
        
        // Create default admin if doesn't exist
        DB::table('admin')->updateOrInsert(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        // Ensure system flags exist
        $flags = [
            ['name' => 'AdminLogo', 'value' => 'images/default-logo.svg'],
            ['name' => 'AppName', 'value' => 'Astroway Admin'],
        ];
        
        foreach ($flags as $flag) {
            DB::table('systemflag')->updateOrInsert(
                ['name' => $flag['name']],
                ['value' => $flag['value']]
            );
        }
    }
}