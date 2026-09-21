<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db_connect.php';

// Checks If User is Logged in or not? If not then show them Login page
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'auth/admin_login.php?error=login_required');
    exit;
}

// If not Admin then show them teachers dashboard, if not teacher then show them students dashboard
if ($_SESSION['role'] !== 'admin') {
    $redirect = ($_SESSION['role'] === 'teacher') ? 'teacher/dashboard.php' : 'student/dashboard.php';
    header('Location: ' . BASE_URL . $redirect . '?error=access_denied');
    exit;
}
