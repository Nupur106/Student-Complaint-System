<?php if (!isset($pageTitle)) $pageTitle = 'Student Complaint System'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?> | Student Complaint System</title>
<link rel="stylesheet" href="<?= (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/student/') !== false) ? '../' : '' ?>assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="container nav">
        <a class="brand" href="<?= (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/student/') !== false) ? '../' : '' ?>index.php"><span>SC</span> Student Complaint System</a>
        <nav>
            <?php if (isLoggedIn()): ?>
                <?php if (currentUser()['role'] === 'admin'): ?>
                    <a href="../admin/dashboard.php">Dashboard</a>
                    <a href="../admin/complaints.php">Complaints</a>
                    <a href="../admin/students.php">Students</a>
                <?php else: ?>
                    <a href="../student/dashboard.php">Dashboard</a>
                    <a href="../student/complaints.php">My Complaints</a>
                    <a href="../student/new-complaint.php">New Complaint</a>
                <?php endif; ?>
                <a href="<?= (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/student/') !== false) ? '../' : '' ?>logout.php">Logout</a>
            <?php else: ?>
                <a href="<?= (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/student/') !== false) ? '../' : '' ?>login.php">Login</a>
                <a class="nav-button" href="<?= (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/student/') !== false) ? '../' : '' ?>register.php">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>