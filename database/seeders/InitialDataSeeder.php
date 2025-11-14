<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Insert essential systemflag data (only if not exists)
        $systemFlags = [
            ['name' => 'professionTitle', 'value' => 'Astrologer'],
            ['name' => 'appName', 'value' => 'Astroway'],
            ['name' => 'appVersion', 'value' => '1.0.0'],
        ];

        foreach ($systemFlags as $flag) {
            DB::table('systemflag')->updateOrInsert(
                ['name' => $flag['name']],
                array_merge($flag, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        // Create admin user (only if not exists)
        DB::table('admin')->updateOrInsert(
            ['email' => 'admin@astroway.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@astroway.com',
                'contactNo' => '1234567890',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        echo "Initial data seeded successfully!\n";
        echo "Admin login: admin@astroway.com / admin123\n";
    }
}
