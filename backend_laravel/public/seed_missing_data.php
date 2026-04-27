<?php
/**
 * Ocean Lilly Tours - Seed Missing Data (No-SSH)
 *
 * Place in: backend_laravel/public/seed_missing_data.php
 * Visit:   https://jerzy.lk/oceanlilly/backend_laravel/public/seed_missing_data.php
 *
 * This will populate the admin portal with the existing Navbar and Footer items.
 */
declare(strict_types=1);

header('Content-Type: text/html; charset=utf-8');

try {
    $basePath = __DIR__ . '/..';
    $autoload = $basePath . '/vendor/autoload.php';
    $bootstrap = $basePath . '/bootstrap/app.php';

    if (!file_exists($autoload) || !file_exists($bootstrap)) {
        die('<h2>Laravel is not installed (missing vendor/ or bootstrap/app.php).</h2>');
    }

    require_once $autoload;
    $app = require $bootstrap;
    $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    // Run the specific seeder for Navbar, Footer, etc.
    $exitCode = $kernel->call('db:seed', [
        '--class' => 'Database\\Seeders\\FrontendDataSeeder',
        '--force' => true,
    ]);

    $output = $kernel->output();

    if ($exitCode === 0) {
        echo "<h2 style='color: green;'>✅ Success: Data Seeded!</h2>";
        echo "<p>The existing Navbar links, Footer content, and About Us defaults have been added to the database.</p>";
        echo "<p>You can now see them in the Admin Portal.</p>";
        echo "<pre style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>" . htmlspecialchars($output) . "</pre>";
    } else {
        echo "<h2 style='color: red;'>❌ Error: Seeding Failed</h2>";
        echo "<pre style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>" . htmlspecialchars($output) . "</pre>";
    }

} catch (\Throwable $e) {
    echo "<h2 style='color: red;'>❌ Unhandled Error</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
