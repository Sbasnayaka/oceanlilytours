<?php
/**
 * Ocean Lilly Tours - Database Migration Runner
 * 
 * Usage: Access this file via browser ONLY ONCE:
 * https://jerzy.lk/oceanlilly/backend/migrate.php
 * 
 * This script will:
 * 1. Connect to your database
 * 2. Create all 16 tables
 * 3. Setup indexes
 * 4. Create initial admin user
 * 5. Insert default settings
 */

// Set execution time to 5 minutes (for large databases)
set_time_limit(300);

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define base path
define('BASE_PATH', __DIR__);

// Check if Laravel is installed
if (!file_exists(BASE_PATH . '/vendor/autoload.php')) {
    die('<h2>❌ Laravel Not Installed</h2><p>Please run: <code>composer install</code> first in backend/ folder via SSH or cPanel Terminal</p>');
}

// Load Laravel
try {
    require BASE_PATH . '/vendor/autoload.php';
    $app = require BASE_PATH . '/bootstrap/app.php';
    $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
} catch (Exception $e) {
    die('<h2>❌ Error Loading Laravel</h2><pre>' . $e->getMessage() . '</pre>');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ocean Lilly Tours - Database Migration</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 {
            color: #667eea;
            text-align: center;
            margin-bottom: 10px;
        }
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .button-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        button {
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }
        .btn-primary {
            background: #667eea;
            color: white;
        }
        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: #f39c12;
            color: white;
        }
        .btn-secondary:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        .output {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            max-height: 400px;
            overflow-y: auto;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            color: #333;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .success {
            color: #27ae60;
            background: #d5f4e6;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            display: none;
        }
        .error {
            color: #e74c3c;
            background: #fadbd8;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            display: none;
        }
        .warning {
            color: #f39c12;
            background: #fef5e7;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .steps {
            background: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .steps ol {
            margin: 10px 0;
            padding-left: 20px;
        }
        .steps li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🌊 Ocean Lilly Tours</h1>
        <h2 style="text-align: center; color: #764ba2;">Database Migration Tool</h2>
        <p class="subtitle">Automated database setup for admin portal</p>

        <div class="warning">
            <strong>⚠️ Important:</strong> This tool should only be run ONCE during initial setup. Running it multiple times may cause issues.
        </div>

        <div class="steps">
            <strong>This tool will:</strong>
            <ol>
                <li>Verify database connection</li>
                <li>Create all 16 database tables</li>
                <li>Setup indexes for performance</li>
                <li>Create migration tracking table</li>
                <li>Insert default settings</li>
                <li>Create initial admin user</li>
            </ol>
        </div>

        <div class="success" id="success"></div>
        <div class="error" id="error"></div>

        <div class="button-group">
            <button class="btn-primary" onclick="runMigrations()">▶ Run All Migrations</button>
            <button class="btn-secondary" onclick="verifyCon nection()">🔍 Verify Connection</button>
            <button class="btn-danger" onclick="rollback()">↩️ Rollback (Reset)</button>
        </div>

        <div id="output" class="output" style="display: none;"></div>
    </div>

    <script>
        function log(message) {
            const output = document.getElementById('output');
            output.style.display = 'block';
            output.textContent += (output.textContent ? '\n' : '') + message;
            output.scrollTop = output.scrollHeight;
        }

        function clear() {
            document.getElementById('output').textContent = '';
            document.getElementById('success').style.display = 'none';
            document.getElementById('error').style.display = 'none';
        }

        function showSuccess(message) {
            const el = document.getElementById('success');
            el.textContent = '✅ ' + message;
            el.style.display = 'block';
        }

        function showError(message) {
            const el = document.getElementById('error');
            el.textContent = '❌ ' + message;
            el.style.display = 'block';
        }

        async function verifyConnection() {
            clear();
            log('🔍 Verifying database connection...');
            
            try {
                const response = await fetch('migrate-api.php?action=verify', {
                    method: 'GET',
                    headers: {'Content-Type': 'application/json'}
                });
                
                const result = await response.json();
                if (result.success) {
                    showSuccess(result.message);
                    log(JSON.stringify(result, null, 2));
                } else {
                    showError(result.message);
                    log(result.error);
                }
            } catch (error) {
                showError('Connection test failed: ' + error.message);
                log(error.message);
            }
        }

        async function runMigrations() {
            clear();
            if (!confirm('⚠️ This will create all database tables. Continue?')) {
                return;
            }

            log('🚀 Starting database migrations...\n');
            
            try {
                const response = await fetch('migrate-api.php?action=migrate', {
                    method: 'GET',
                    headers: {'Content-Type': 'application/json'}
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showSuccess(result.message);
                    log('\n✅ MIGRATION COMPLETE!\n');
                    log('Tables created: ' + result.tables_count);
                    log('Indexes created: ' + result.indexes_count);
                } else {
                    showError(result.message);
                    log('\n❌ Migration failed:\n' + result.error);
                }
            } catch (error) {
                showError('Migration error: ' + error.message);
                log(error.stack);
            }
        }

        async function rollback() {
            clear();
            if (!confirm('⚠️ WARNING: This will DELETE all tables! Are you sure?')) {
                return;
            }

            if (!confirm('🚨 FINAL WARNING: This cannot be undone! Backup first!')) {
                return;
            }

            log('⏮️ Rolling back migrations...\n');
            
            try {
                const response = await fetch('migrate-api.php?action=rollback', {
                    method: 'GET',
                    headers: {'Content-Type': 'application/json'}
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showSuccess(result.message);
                    log('\n✅ ROLLBACK COMPLETE!');
                } else {
                    showError(result.message);
                    log('\n❌ Rollback failed:\n' + result.error);
                }
            } catch (error) {
                showError('Rollback error: ' + error.message);
            }
        }

        // Auto-verify connection on load
        window.addEventListener('load', function() {
            log('[' + new Date().toLocaleTimeString() + '] Migration Tool Loaded');
            log('Ready! Click a button to begin.\n');
        });
    </script>
</body>
</html>
