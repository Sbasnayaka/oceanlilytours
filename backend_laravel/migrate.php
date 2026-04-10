<?php
/**
 * Ocean Lilly Tours - Database Migration Runner (No-SSH)
 *
 * Place in: backend/migrate.php
 * Visit:   https://<domain>/<path>/backend/migrate.php
 *
 * Requires:
 * - backend/.env configured correctly
 * - backend/vendor present (since server has no composer)
 * - backend/migrate-api.php present
 */
declare(strict_types=1);

set_time_limit(300);
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('BASE_PATH', __DIR__);

if (!file_exists(BASE_PATH . '/vendor/autoload.php')) {
    http_response_code(500);
    die('<h2>Laravel Not Installed</h2><p>Missing <code>vendor/</code>. Deploy backend with vendor included.</p>');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ocean Lilly Tours - Database Migration</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 900px; margin: 0 auto; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .container { background: white; border-radius: 10px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        h1 { color: #667eea; text-align: center; margin-bottom: 10px; }
        .subtitle { text-align: center; color: #666; margin-bottom: 30px; font-size: 14px; }
        .button-group { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px; }
        button { padding: 15px 30px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: all 0.3s ease; font-weight: bold; }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5568d3; transform: translateY(-2px); box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4); }
        .btn-secondary { background: #f39c12; color: white; }
        .btn-secondary:hover { background: #e67e22; transform: translateY(-2px); }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-danger:hover { background: #c0392b; transform: translateY(-2px); }
        .output { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; padding: 20px; margin-top: 20px; max-height: 400px; overflow-y: auto; font-family: 'Courier New', monospace; font-size: 13px; color: #333; white-space: pre-wrap; word-wrap: break-word; }
        .success { color: #27ae60; background: #d5f4e6; padding: 15px; border-radius: 5px; margin-bottom: 15px; display: none; }
        .error { color: #e74c3c; background: #fadbd8; padding: 15px; border-radius: 5px; margin-bottom: 15px; display: none; }
        .warning { color: #f39c12; background: #fef5e7; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
        .steps { background: #ecf0f1; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-size: 14px; }
        .steps ol { margin: 10px 0; padding-left: 20px; }
        .steps li { margin: 5px 0; }
        code { background: #f1f3f5; padding: 2px 6px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ocean Lilly Tours</h1>
        <h2 style="text-align: center; color: #764ba2;">Database Migration Tool</h2>
        <p class="subtitle">Automated database setup for admin portal</p>

        <div class="warning">
            <strong>Important:</strong> Run this only during initial setup. After success, delete <code>migrate.php</code> and <code>migrate-api.php</code>.
        </div>

        <div class="steps">
            <strong>This tool will:</strong>
            <ol>
                <li>Verify database connection</li>
                <li>Run Laravel migrations</li>
            </ol>
        </div>

        <div class="success" id="success"></div>
        <div class="error" id="error"></div>

        <div class="button-group">
            <button class="btn-secondary" onclick="verifyConnection()">Verify Connection</button>
            <button class="btn-primary" onclick="runMigrations()">Run All Migrations</button>
            <button class="btn-danger" onclick="rollback()">Rollback (migrate:fresh)</button>
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

        function clearOutput() {
            document.getElementById('output').textContent = '';
            document.getElementById('success').style.display = 'none';
            document.getElementById('error').style.display = 'none';
        }

        function showSuccess(message) {
            const el = document.getElementById('success');
            el.textContent = 'OK: ' + message;
            el.style.display = 'block';
        }

        function showError(message) {
            const el = document.getElementById('error');
            el.textContent = 'ERROR: ' + message;
            el.style.display = 'block';
        }

        async function callApi(action) {
            const response = await fetch('migrate-api.php?action=' + encodeURIComponent(action), {
                method: 'GET',
                headers: {'Content-Type': 'application/json'}
            });
            const text = await response.text();
            let json = null;
            try { json = JSON.parse(text); } catch (e) {}
            if (!json) throw new Error('Non-JSON response: ' + text);
            return json;
        }

        async function verifyConnection() {
            clearOutput();
            log('Verifying database connection...');
            try {
                const result = await callApi('verify');
                if (result.success) {
                    showSuccess(result.message);
                } else {
                    showError(result.message);
                }
                log(JSON.stringify(result, null, 2));
            } catch (error) {
                showError(error.message);
                log(error.stack || error.message);
            }
        }

        async function runMigrations() {
            clearOutput();
            if (!confirm('This will run migrations. Continue?')) return;
            log('Starting migrations...');
            try {
                const result = await callApi('migrate');
                if (result.success) showSuccess(result.message);
                else showError(result.message);
                log(JSON.stringify(result, null, 2));
            } catch (error) {
                showError(error.message);
                log(error.stack || error.message);
            }
        }

        async function rollback() {
            clearOutput();
            if (!confirm('WARNING: This will DROP all tables via migrate:fresh. Continue?')) return;
            if (!confirm('Final warning: this cannot be undone. Continue?')) return;
            log('Running migrate:fresh...');
            try {
                const result = await callApi('rollback');
                if (result.success) showSuccess(result.message);
                else showError(result.message);
                log(JSON.stringify(result, null, 2));
            } catch (error) {
                showError(error.message);
                log(error.stack || error.message);
            }
        }

        window.addEventListener('load', function() {
            log('Migration Tool Loaded');
            log('Tip: Click \"Verify Connection\" first.');
        });
    </script>
</body>
</html>

