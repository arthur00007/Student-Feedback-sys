<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'student_feedback');
define('DB_USER', 'root');
define('DB_PASS', '');

// Base URL calculation (works for both php -S and subfolder hosting)
if (!defined('BASE_URL')) {
    $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? '');
    $appDir  = str_replace('\\', '/', dirname(__DIR__));
    $rel     = str_replace($docRoot, '', $appDir);
    $base    = '/' . ltrim($rel, '/');
    if ($base !== '/') {
        $base = rtrim($base, '/') . '/';
    }
    define('BASE_URL', $base);
}

if (!class_exists('PDO')) {
    die('<div style="font-family:sans-serif;padding:24px;background:#fff1f0;color:#cf1322;border:1px solid #ffa39e;margin:30px;border-radius:8px;">
        <h3 style="margin-top:0;">PHP PDO Extension Missing</h3>
        <p>Your PHP installation is missing the PDO MySQL extension required to connect to the database.</p>
        <p>Run the following command in your terminal, then reload:</p>
        <pre style="background:#1f1f1f;color:#73d13d;padding:12px;border-radius:6px;font-size:14px;">sudo dnf install -y php-pdo php-mysqlnd</pre>
    </div>');
}

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('<div style="font-family:sans-serif;padding:20px;background:#fff2f0;color:#a8071a;border:1px solid #ffccc7;margin:20px;border-radius:8px;">
        <h3>Database Connection Failed</h3>
        <p>' . htmlspecialchars($e->getMessage()) . '</p>
    </div>');
}
