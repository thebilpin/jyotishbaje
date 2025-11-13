<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Path to your SQL files
        $sqlPath = database_path('sql');

        // $appdesigns = File::get($sqlPath . '/app_designs.sql');
        // DB::unprepared($appdesigns);
        // $this->command->info(' App design table seeded successfully.');

        // $banners = File::get($sqlPath . '/banners.sql');
        // DB::unprepared($banners);
        // $this->command->info(' banner table seeded successfully.');

        // $flaggroup = File::get($sqlPath . '/flaggroup.sql');
        // DB::unprepared($flaggroup);
        // $this->command->info(' Flag group table seeded successfully.');

        // $systemflag = File::get($sqlPath . '/systemflag.sql');
        // DB::unprepared($systemflag);
        // $this->command->info(' Systemflag table seeded successfully.');

        // $emailtemplates = File::get($sqlPath . '/email_templates.sql');
        // DB::unprepared($emailtemplates);
        // $this->command->info(' Email tepmlate table seeded successfully.');

        // $adminpages = File::get($sqlPath . '/adminpages.sql');
        // DB::unprepared($adminpages);
        // $this->command->info(' Admin Pages table seeded successfully.');

        // $blockkeywords = File::get($sqlPath . '/block-keywords.sql');
        // DB::unprepared($blockkeywords);
        // $this->command->info(' Block keywords table seeded successfully.');

        // $coupons = File::get($sqlPath . '/coupons.sql');
        // DB::unprepared($coupons);
        // $this->command->info(' Coupons table seeded successfully.');

        // $main_source_of_businesses = File::get($sqlPath . '/main_source_of_businesses.sql');
        // DB::unprepared($main_source_of_businesses);
        // $this->command->info(' Main source of businesses table seeded successfully.');

        // $pages = File::get($sqlPath . '/pages.sql');
        // DB::unprepared($pages);
        // $this->command->info(' Pages table seeded successfully.');

        // $countries = File::get($sqlPath . '/countries.sql');
        // DB::unprepared($countries);
        // $this->command->info(' Countries table seeded successfully.');

        // $states = File::get($sqlPath . '/states.sql');
        // DB::unprepared($states);
        // $this->command->info(' States table seeded successfully.');

        // $cities = File::get($sqlPath . '/cities.sql');
        // DB::unprepared($cities);
        // $this->command->info(' Cities table seeded successfully.');

        // $users = File::get($sqlPath . '/users.sql');
        // DB::unprepared($users);
        // $this->command->info(' Users table seeded successfully.');

        // $astrologers = File::get($sqlPath . '/astrologers.sql');
        // DB::unprepared($astrologers);
        // $this->command->info(' Users table seeded successfully.');

        // $data = File::get($sqlPath . '/data.sql');
        // DB::unprepared($data);
        // $this->command->info(' Users table seeded successfully.');

        // $this->call(UsersTableSeeder::class);
    }
}
