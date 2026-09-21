<?php
require_once __DIR__ . '/../includes/auth_check_admin.php';
$pageTitle = 'Admin Dashboard';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="alert alert-danger p-4 my-4">
    <h3 class="fw-bold mb-2">This is Admin Dashboard</h3>
    <p class="mb-3">Welcome, <?= htmlspecialchars($_SESSION['name']) ?> (Administrator)!</p>
    <a href="<?= BASE_URL ?>auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
