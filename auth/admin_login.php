<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db_connect.php';

// Redirect if already logged in as admin
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: ' . BASE_URL . 'admin/dashboard.php');
        exit;
    }
}

$pageTitle = 'Admin Portal Login';
$error = '';

if (isset($_GET['error']) && $_GET['error'] === 'login_required') {
    $error = 'Admin authentication required to access this area.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Please enter both admin email and password.';
    } else {
        $stmt = $pdo->prepare('SELECT user_id, name, email, password, role FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] !== 'admin') {
                $error = 'Access denied. This portal is restricted to administrators only.';
            } else {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name']    = $user['name'];
                $_SESSION['email']   = $user['email'];
                $_SESSION['role']    = 'admin';

                header('Location: ' . BASE_URL . 'admin/dashboard.php');
                exit;
            }
        } else {
            $error = 'Invalid admin email or password.';
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-5">
        <div class="card shadow-sm border-danger-subtle my-4">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill mb-2 d-inline-flex align-items-center gap-1">
                        <?= icon('admin', 'app-icon') ?> Restricted Access
                    </div>
                    <h3 class="fw-bold mb-1">Admin Portal</h3>
                    <p class="text-body-secondary small">System Administrator Sign In</p>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>auth/admin_login.php" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 py-2 fw-semibold">
                        Enter Admin Panel
                    </button>
                </form>

                <hr class="my-4">

                <div class="text-center small">
                    <a href="<?= BASE_URL ?>auth/login.php" class="text-decoration-none">
                        &larr; Back to Student &amp; Teacher Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
