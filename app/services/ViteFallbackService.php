<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ViteFallbackService
{
    /**
     * Create fallback manifest if it doesn't exist
     */
    public static function ensureManifest()
    {
        $manifestPath = public_path('build/manifest.json');
        
        if (!File::exists($manifestPath)) {
            // Create build directory if it doesn't exist
            $buildDir = public_path('build');
            if (!File::exists($buildDir)) {
                File::makeDirectory($buildDir, 0755, true);
            }
            
            // Create assets directory
            $assetsDir = public_path('build/assets');
            if (!File::exists($assetsDir)) {
                File::makeDirectory($assetsDir, 0755, true);
            }
            
            // Create fallback manifest
            $manifest = [
                'resources/css/app.css' => [
                    'file' => 'assets/app.css',
                    'src' => 'resources/css/app.css'
                ],
                'resources/js/app.js' => [
                    'file' => 'assets/app.js',
                    'src' => 'resources/js/app.js'
                ]
            ];
            
            File::put($manifestPath, json_encode($manifest, JSON_PRETTY_PRINT));
            
            // Create empty CSS and JS files if they don't exist
            $cssPath = public_path('build/assets/app.css');
            $jsPath = public_path('build/assets/app.js');
            
            if (!File::exists($cssPath)) {
                File::put($cssPath, self::getDefaultCSS());
            }
            
            if (!File::exists($jsPath)) {
                File::put($jsPath, self::getDefaultJS());
            }
        }
    }
    
    /**
     * Get default CSS content
     */
    private static function getDefaultCSS()
    {
        return '
/* Fallback CSS for Admin Dashboard */
body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
.login { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
.loader { position: fixed; top: 0; left: 0; right: 0; bottom: 0; width: 100%; background: rgba(48, 48, 48, 0.75); z-index: 10000; display: flex; align-items: center; justify-content: center; }
.form-control { display: block; width: 100%; padding: 0.375rem 0.75rem; font-size: 1rem; border: 1px solid #ced4da; border-radius: 0.375rem; }
.btn { display: inline-block; padding: 0.375rem 0.75rem; font-size: 1rem; border-radius: 0.375rem; cursor: pointer; }
.btn-primary { color: #fff; background-color: #0d6efd; border-color: #0d6efd; }
        ';
    }
    
    /**
     * Get default JS content
     */
    private static function getDefaultJS()
    {
        return '
/* Fallback JS for Admin Dashboard */
console.log("Admin dashboard loaded with fallback assets");
        ';
    }
}