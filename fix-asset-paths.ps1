# PowerShell script to fix asset paths in Blade templates
# Removes redundant 'public/' prefix from asset() helper calls

Write-Host "Fixing asset paths across Blade templates..." -ForegroundColor Green

# Get all PHP files in resources/views
$files = Get-ChildItem -Path "c:\astroway\resources\views" -Recurse -Filter "*.blade.php"

$totalReplaced = 0

foreach ($file in $files) {
    $content = Get-Content -Path $file.FullName -Raw
    $originalContent = $content
    
    # Replace asset('public/ with asset('
    $content = $content -replace "asset\('public/", "asset('"
    $content = $content -replace 'asset\("public/', 'asset("'
    $content = $content -replace "asset\(`"public/", "asset(`""
    
    # Replace {{asset('public/ with {{asset('
    $content = $content -replace "\{\{asset\('public/", "{{asset('"
    $content = $content -replace '\{\{asset\("public/', '{{asset("'
    
    # Replace {{ asset('public/ with {{ asset('
    $content = $content -replace "\{\{ asset\('public/", "{{ asset('"
    $content = $content -replace '\{\{ asset\("public/', '{{ asset("'
    
    # Replace {{asset("public/ with {{asset("
    $content = $content -replace '\{\{asset\("public/', '{{asset("'
    
    if ($content -ne $originalContent) {
        Set-Content -Path $file.FullName -Value $content -NoNewline
        $replacedCount = ([regex]::Matches($originalContent, "asset\([`"']public/")).Count
        $totalReplaced += $replacedCount
        Write-Host "  Updated $($file.Name) - $replacedCount replacements" -ForegroundColor Cyan
    }
}

Write-Host "`nTotal replacements: $totalReplaced across $($files.Count) files" -ForegroundColor Green
Write-Host "Done!" -ForegroundColor Green
