<?php
require_once __DIR__ . '/../includes/auth_check_admin.php';
$pageTitle = 'Admin Dashboard';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div>
                <h2 class="fw-bold mb-1">Admin Dashboard</h2>
                <p class="text-body-secondary mb-0">Welcome, <?= htmlspecialchars($_SESSION['name']) ?> (Administrator)</p>
            </div>
            <span class="badge bg-danger fs-6 px-3 py-2 d-inline-flex align-items-center gap-1">
                <?= icon('admin', 'app-icon') ?> Admin
            </span>
        </div>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'access_denied'): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notice:</strong> Access denied to requested page.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 border-start border-primary border-4">
                    <div class="card-body">
                        <h6 class="card-subtitle text-body-secondary mb-2">Management</h6>
                        <h5 class="card-title fw-bold">👥 Users</h5>
                        <p class="card-text text-body-secondary small">View and manage students &amp; teachers.</p>
                        <button class="btn btn-outline-primary btn-sm" disabled>Manage</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 border-start border-success border-4">
                    <div class="card-body">
                        <h6 class="card-subtitle text-body-secondary mb-2">Curriculum</h6>
                        <h5 class="card-title fw-bold">📚 Courses</h5>
                        <p class="card-text text-body-secondary small">Create courses and map teachers.</p>
                        <button class="btn btn-outline-success btn-sm" disabled>Manage</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 border-start border-warning border-4">
                    <div class="card-body">
                        <h6 class="card-subtitle text-body-secondary mb-2">Feedback Forms</h6>
                        <h5 class="card-title fw-bold">❓ Questions</h5>
                        <p class="card-text text-body-secondary small">Set feedback criteria and questions.</p>
                        <button class="btn btn-outline-warning btn-sm" disabled>Manage</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 border-start border-danger border-4">
                    <div class="card-body">
                        <h6 class="card-subtitle text-body-secondary mb-2">Analytics</h6>
                        <h5 class="card-title fw-bold">📈 Reports</h5>
                        <p class="card-text text-body-secondary small">View college-wide feedback reports.</p>
                        <button class="btn btn-outline-danger btn-sm" disabled>View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
