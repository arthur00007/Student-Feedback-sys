<?php
require_once __DIR__ . '/../includes/auth_check_teacher.php';
$pageTitle = 'Teacher Dashboard';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div>
                <h2 class="fw-bold mb-1">Teacher Dashboard</h2>
                <p class="text-body-secondary mb-0">Welcome back, <?= htmlspecialchars($_SESSION['name']) ?>!</p>
            </div>
            <span class="badge bg-success fs-6 px-3 py-2 d-inline-flex align-items-center gap-1">
                <?= icon('teacher', 'app-icon') ?> Teacher
            </span>
        </div>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'access_denied'): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notice:</strong> You tried to access a page reserved for another role.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">📊 Feedback Reports</h5>
                        <p class="card-text text-body-secondary">
                            View ratings, analytics, and comments from your students.
                        </p>
                        <button class="btn btn-outline-success btn-sm" disabled>Coming Soon</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">📚 Assigned Courses</h5>
                        <p class="card-text text-body-secondary">
                            See subjects and sections assigned to you for feedback.
                        </p>
                        <button class="btn btn-outline-secondary btn-sm" disabled>Coming Soon</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">👤 Teacher Profile</h5>
                        <p class="card-text text-body-secondary mb-1"><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
                        <p class="card-text text-body-secondary"><strong>Role:</strong> Teacher</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
