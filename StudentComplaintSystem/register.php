<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
if (isLoggedIn()) redirect('student/dashboard.php');

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $course = trim($_POST['course'] ?? '');
    $year = trim($_POST['year'] ?? '');

    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6 || !$course || !$year) {
        $error = 'Please fill all fields correctly. Password must be at least 6 characters.';
    } else {
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        if ($check->fetch()) {
            $error = 'An account with this email already exists.';
        } else {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,'student')");
            $stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]);
            $userId = $pdo->lastInsertId();
            $stmt = $pdo->prepare("INSERT INTO students (user_id,course,year) VALUES (?,?,?)");
            $stmt->execute([$userId,$course,$year]);
            $pdo->commit();
            $_SESSION['user'] = ['id'=>$userId,'name'=>$name,'email'=>$email,'role'=>'student'];
            redirect('student/dashboard.php');
        }
    }
}
$pageTitle = 'Create Account';
require_once 'includes/header.php';
?>
<main class="auth-page"><div class="auth-card">
    <span class="eyebrow">NEW STUDENT</span><h1>Create Account</h1>
    <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Full Name<input type="text" name="name" required></label>
        <label>Email<input type="email" name="email" required></label>
        <label>Course<input type="text" name="course" placeholder="B.Tech CSE" required></label>
        <label>Year<input type="text" name="year" placeholder="3rd Year" required></label>
        <label>Password<input type="password" name="password" minlength="6" required></label>
        <button class="btn btn-primary full" type="submit">Create Account</button>
    </form>
    <p class="auth-note">Already registered? <a href="login.php">Login</a></p>
</div></main>
<?php require_once 'includes/footer.php'; ?>