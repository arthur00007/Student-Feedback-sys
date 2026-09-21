<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config/db_connect.php';

// If already logged in, redirect directly to their dashboard
if (isset($_SESSION['user_id'])) {
    $redirect = match ($_SESSION['role']) {
        'admin' => 'admin/dashboard.php',
        'teacher' => 'teacher/dashboard.php',
        default => 'student/dashboard.php',
    };
    header('Location: ' . BASE_URL . $redirect);
    exit;
}

$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';
?>

<div class="row align-items-center py-5">
    <div class="col-lg-7 text-center text-lg-start mb-5 mb-lg-0">
        <h1 class="display-4 fw-bold mb-3">
            Empower Education with Honest Feedback
        </h1>
        <p class="lead text-body-secondary mb-4">
            A secure and confidential feedback system connecting Students, Teachers, and Administration to continuously improve teaching and learning quality.
        </p>
        <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-start">
            <a href="<?= BASE_URL ?>auth/login.php" class="btn btn-primary btn-lg px-4">
                Sign In
            </a>
            <a href="<?= BASE_URL ?>auth/register.php" class="btn btn-outline-secondary btn-lg px-4">
                Register
            </a>
            <a href="<?= BASE_URL ?>auth/admin_login.php" class="btn btn-outline-danger btn-lg px-4">
                Admin Portal
            </a>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow border-0 p-3">
            <div class="card-body">
                <h4 class="fw-bold mb-3">System Roles</h4>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex gap-3 align-items-center px-0">
                        <div class="p-2 rounded bg-primary-subtle text-primary">
                            <?= icon('student', 'app-icon-lg') ?>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">Students</h6>
                            <small class="text-body-secondary">Provide feedback for assigned course teachers.</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex gap-3 align-items-center px-0">
                        <div class="p-2 rounded bg-success-subtle text-success">
                            <?= icon('teacher', 'app-icon-lg') ?>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">Teachers</h6>
                            <small class="text-body-secondary">Review aggregated analytics and student evaluation.</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex gap-3 align-items-center px-0">
                        <div class="p-2 rounded bg-danger-subtle text-danger">
                            <?= icon('admin', 'app-icon-lg') ?>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">Administrators</h6>
                            <small class="text-body-secondary">Oversee courses, faculty assignments, and reports.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
