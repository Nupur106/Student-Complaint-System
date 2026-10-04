<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
if (isLoggedIn()) redirect(currentUser()['role'] === 'admin' ? 'admin/dashboard.php' : 'student/dashboard.php');

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'], 'name' => $user['name'],
            'email' => $user['email'], 'role' => $user['role']
        ];
        redirect($user['role'] === 'admin' ? 'admin/dashboard.php' : 'student/dashboard.php');
    }
    $error = 'Invalid email or password.';
}
$pageTitle = 'Login';
require_once 'includes/header.php';
?>
<main class="auth-page"><div class="auth-card">
    <span class="eyebrow">ACCOUNT ACCESS</span><h1>Login</h1>
    <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Email<input type="email" name="email" required></label>
        <label>Password<input type="password" name="password" required></label>
        <button class="btn btn-primary full" type="submit">Login</button>
    </form>
    <p class="auth-note">Student? <a href="register.php">Create an account</a></p>
    <p class="demo-note">Demo admin: admin@school.com / admin123</p>
</div></main>
<?php require_once 'includes/footer.php'; ?>