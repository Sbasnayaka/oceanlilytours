<?php
/**
 * Ocean Lilly Tours — One-Time Migration Runner
 * ===============================================
 * PURPOSE : Runs any pending Laravel migrations on the live server
 *           without needing SSH or command-line access.
 * USAGE   : Visit https://jerzy.lk/oceanlilly/backend_laravel/public/run_migrations.php
 *           in your browser ONCE.
 * SAFETY  : Delete this file from your cPanel immediately after use.
 * -----------------------------------------------------------------
 */

// ── Bootstrap Laravel ──────────────────────────────────────────────
define('LARAVEL_START', microtime(true));
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// ── Run migrations ─────────────────────────────────────────────────
echo '<pre style="font-family:monospace;background:#111;color:#0f0;padding:20px;">';
echo "Ocean Lilly Tours — Migration Runner\n";
echo "======================================\n\n";

try {
    $exitCode = Artisan::call('migrate', ['--force' => true]);
    echo Artisan::output();

    if ($exitCode === 0) {
        echo "\n✅  ALL MIGRATIONS COMPLETED SUCCESSFULLY.\n";
    } else {
        echo "\n⚠️  Some migrations may have failed. Check the output above.\n";
    }
} catch (\Exception $e) {
    echo "\n❌  ERROR: " . $e->getMessage() . "\n";
}

echo "\n\n⚠️  IMPORTANT: DELETE this file (run_migrations.php) from your cPanel now!\n";
echo '</pre>';
