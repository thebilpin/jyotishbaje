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
        // Fix horosign table
        DB::table('horosign')->update([
            'image' => DB::raw("REPLACE(image, '/public/frontend/', '/frontend/')")
        ]);
        DB::table('horosign')->update([
            'image' => DB::raw("REPLACE(image, 'public/frontend/', 'frontend/')")
        ]);

        // Fix products table
        DB::table('astromall')->update([
            'productImage' => DB::raw("REPLACE(productImage, '/public/', '/')")
        ]);

        // Fix systemflag table
        DB::table('systemflag')->update([
            'value' => DB::raw("REPLACE(value, '/public/frontend/', '/frontend/')")
        ]);
        DB::table('systemflag')->update([
            'value' => DB::raw("REPLACE(value, 'public/frontend/', 'frontend/')")
        ]);

        // Fix blog table
        DB::table('blog')->update([
            'blogImage' => DB::raw("REPLACE(blogImage, '/public/', '/')")
        ]);

        // Fix news table
        DB::table('news')->update([
            'bannerImage' => DB::raw("REPLACE(bannerImage, '/public/', '/')")
        ]);
        DB::table('news')->update([
            'newsImage' => DB::raw("REPLACE(newsImage, '/public/', '/')")
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally add rollback logic if needed
    }
};
