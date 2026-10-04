<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
requireLogin();
if (currentUser()['role'] !== 'student') redirect('../admin/dashboard.php');
$stmt = $pdo->prepare("SELECT * FROM students WHERE user_id=?");
$stmt->execute([currentUser()['id']]);
$student = $stmt->fetch();
$stmt = $pdo->prepare("SELECT COUNT(*) FROM complaints WHERE student_id=?");
$stmt->execute([$student['id']]);
$total = $stmt->fetchColumn();
$stmt = $pdo->prepare("SELECT COUNT(*) FROM complaints WHERE student_id=? AND status='Resolved'");
$stmt->execute([$student['id']]);
$resolved = $stmt->fetchColumn();
$pageTitle='Student Dashboard';
require_once '../includes/header.php';
?>
<main class="dashboard"><div class="container">
<div class="page-head"><div><span class="eyebrow">STUDENT PORTAL</span><h1>Welcome, <?= e(currentUser()['name']) ?></h1><p>Manage and track your complaints from here.</p></div><a class="btn btn-primary" href="new-complaint.php">+ New Complaint</a></div>
<div class="stats"><div><span>Total Complaints</span><strong><?= $total ?></strong></div><div><span>Resolved</span><strong><?= $resolved ?></strong></div><div><span>Course</span><strong><?= e($student['course'] ?? '-') ?></strong></div></div>
<div class="panel"><div class="panel-head"><h2>Quick actions</h2></div><div class="quick-grid"><a href="new-complaint.php">Submit a complaint →</a><a href="complaints.php">View my complaints →</a><a href="profile.php">View profile →</a></div></div>
</div></main>
<?php require_once '../includes/footer.php'; ?>