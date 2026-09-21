<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'auth/login.php?error=login_required');
    exit;
}

if ($_SESSION['role'] !== 'teacher') {
    $redirect = ($_SESSION['role'] === 'admin') ? 'admin/dashboard.php' : 'student/dashboard.php';
    header('Location: ' . BASE_URL . $redirect . '?error=access_denied');
    exit;
}
