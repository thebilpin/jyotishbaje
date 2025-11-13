<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Insert essential systemflag data
        DB::table('systemflag')->insert([
            ['name' => 'professionTitle', 'value' => 'Astrologer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'appName', 'value' => 'Astroway', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'appVersion', 'value' => '1.0.0', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create admin user
        DB::table('admin')->insert([
            'name' => 'Admin',
            'email' => 'admin@astroway.com',
            'contactNo' => '1234567890',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        echo "Initial data seeded successfully!\n";
        echo "Admin login: admin@astroway.com / admin123\n";
    }
}
