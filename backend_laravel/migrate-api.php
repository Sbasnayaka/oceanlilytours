<?php
/**
 * Ocean Lilly Tours - Migration API (No-SSH)
 *
 * Called by migrate.php via fetch():
 *   migrate-api.php?action=verify|migrate|rollback
 *
 * Important:
 * - Keep this file outside /public (it will still be web-accessible via direct URL)
 * - Delete after initial setup, or protect with a secret token.
 */
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function respond(array $payload, int $statusCode = 200): void {
    http_response_code($statusCode);
    echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

try {
    $basePath = __DIR__;
    $autoload = $basePath . '/vendor/autoload.php';
    $bootstrap = $basePath . '/bootstrap/app.php';

    if (!file_exists($autoload) || !file_exists($bootstrap)) {
        respond([
            'success' => false,
            'message' => 'Laravel is not installed (missing vendor/ or bootstrap/app.php).',
        ], 500);
    }

    require_once $autoload;
    $app = require $bootstrap;
    $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

    // Ensure env/config are loaded
    $kernel->bootstrap();

    $action = isset($_GET['action']) ? (string)$_GET['action'] : 'verify';

    if ($action === 'verify') {
        /** @var \Illuminate\Database\Connection $conn */
        $conn = \Illuminate\Support\Facades\DB::connection();
        $pdo = $conn->getPdo();

        respond([
            'success' => true,
            'message' => 'Database connection OK.',
            'driver' => $conn->getDriverName(),
            'database' => $conn->getDatabaseName(),
            'server_version' => $pdo->getAttribute(\PDO::ATTR_SERVER_VERSION),
            'laravel' => \Illuminate\Foundation\Application::VERSION,
        ]);
    }

    if ($action === 'migrate') {
        $exitCode = $kernel->call('migrate', [
            '--force' => true,
        ]);

        $output = $kernel->output();

        // Basic counts (best-effort)
        $tablesCount = null;
        try {
            $schema = \Illuminate\Support\Facades\DB::getSchemaBuilder();
            $tablesCount = count($schema->getAllTables());
        } catch (\Throwable $e) {
            $tablesCount = null;
        }

        respond([
            'success' => $exitCode === 0,
            'message' => $exitCode === 0 ? 'Migrations completed.' : 'Migrations failed.',
            'exit_code' => $exitCode,
            'tables_count' => $tablesCount,
            'output' => $output,
        ], $exitCode === 0 ? 200 : 500);
    }

    if ($action === 'rollback') {
        $exitCode = $kernel->call('migrate:fresh', [
            '--force' => true,
        ]);

        $output = $kernel->output();

        respond([
            'success' => $exitCode === 0,
            'message' => $exitCode === 0 ? 'Database reset completed (migrate:fresh).' : 'Database reset failed.',
            'exit_code' => $exitCode,
            'output' => $output,
        ], $exitCode === 0 ? 200 : 500);
    }

    respond([
        'success' => false,
        'message' => 'Unknown action. Use action=verify|migrate|rollback.',
    ], 400);
} catch (\Throwable $e) {
    respond([
        'success' => false,
        'message' => 'Unhandled error.',
        'error' => $e->getMessage(),
    ], 500);
}

