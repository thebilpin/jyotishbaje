<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations - Remove /public/ prefix from image paths in database
     */
    public function up(): void
    {
        // Only run if tables exist (they're created by seeder, not migrations)
        $schema = DB::getSchemaBuilder();

        // Fix horosign table
        if ($schema->hasTable('horosign')) {
            DB::table('horosign')->update([
                'image' => DB::raw("REPLACE(image, '/public/frontend/', '/frontend/')")
            ]);
            DB::table('horosign')->update([
                'image' => DB::raw("REPLACE(image, 'public/frontend/', 'frontend/')")
            ]);
        }

        // Fix products table
        if ($schema->hasTable('astromall')) {
            DB::table('astromall')->update([
                'productImage' => DB::raw("REPLACE(productImage, '/public/', '/')")
            ]);
        }

        // Fix systemflag table
        if ($schema->hasTable('systemflag')) {
            DB::table('systemflag')->update([
                'value' => DB::raw("REPLACE(value, '/public/frontend/', '/frontend/')")
            ]);
            DB::table('systemflag')->update([
                'value' => DB::raw("REPLACE(value, 'public/frontend/', 'frontend/')")
            ]);
        }

        // Fix blog table
        if ($schema->hasTable('blog')) {
            DB::table('blog')->update([
                'blogImage' => DB::raw("REPLACE(blogImage, '/public/', '/')")
            ]);
        }

        // Fix news table
        if ($schema->hasTable('news')) {
            DB::table('news')->update([
                'bannerImage' => DB::raw("REPLACE(bannerImage, '/public/', '/')")
            ]);
            DB::table('news')->update([
                'newsImage' => DB::raw("REPLACE(newsImage, '/public/', '/')")
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally add rollback logic if needed
    }
};
