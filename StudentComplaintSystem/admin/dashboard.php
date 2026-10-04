<?php
require_once '../includes/config.php'; require_once '../includes/functions.php'; requireAdmin();
$totalStudents=$pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
$totalComplaints=$pdo->query("SELECT COUNT(*) FROM complaints")->fetchColumn();
$pending=$pdo->query("SELECT COUNT(*) FROM complaints WHERE status='Pending'")->fetchColumn();
$resolved=$pdo->query("SELECT COUNT(*) FROM complaints WHERE status='Resolved'")->fetchColumn();
$pageTitle='Admin Dashboard'; require_once '../includes/header.php';
?>
<main class="dashboard"><div class="container"><div class="page-head"><div><span class="eyebrow">ADMIN PANEL</span><h1>Complaint management</h1><p>Review student complaints and keep their status updated.</p></div></div>
<div class="stats"><div><span>Students</span><strong><?=$totalStudents?></strong></div><div><span>Total Complaints</span><strong><?=$totalComplaints?></strong></div><div><span>Pending</span><strong><?=$pending?></strong></div><div><span>Resolved</span><strong><?=$resolved?></strong></div></div>
<div class="panel"><div class="panel-head"><h2>Administration</h2></div><div class="quick-grid"><a href="complaints.php">Manage complaints →</a><a href="students.php">View students →</a><a href="add-student.php">Add student →</a></div></div>
</div></main>
<?php require_once '../includes/footer.php'; ?>