<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
requireLogin();
if (currentUser()['role'] !== 'student') redirect('../admin/dashboard.php');
$stmt=$pdo->prepare("SELECT c.* FROM complaints c JOIN students s ON s.id=c.student_id WHERE s.user_id=? ORDER BY c.created_at DESC");
$stmt->execute([currentUser()['id']]); $complaints=$stmt->fetchAll();
$pageTitle='My Complaints'; require_once '../includes/header.php';
?>
<main class="dashboard"><div class="container"><div class="page-head"><div><span class="eyebrow">MY COMPLAINTS</span><h1>Complaint history</h1></div><a class="btn btn-primary" href="new-complaint.php">+ New Complaint</a></div>
<?php if(isset($_GET['success'])): ?><div class="alert success">Complaint submitted successfully.</div><?php endif; ?>
<div class="panel table-wrap"><table><thead><tr><th>Reference</th><th>Subject</th><th>Category</th><th>Status</th><th>Date</th></tr></thead><tbody>
<?php foreach($complaints as $c): ?><tr><td><b><?=e($c['reference_no'])?></b></td><td><?=e($c['subject'])?></td><td><?=e($c['category'])?></td><td><span class="status <?=e(complaintStatusClass($c['status']))?>"><?=e($c['status'])?></span></td><td><?=e(date('d M Y',strtotime($c['created_at'])))?></td></tr><?php endforeach; ?>
<?php if(!$complaints): ?><tr><td colspan="5" class="empty">No complaints submitted yet.</td></tr><?php endif; ?></tbody></table></div></div></main>
<?php require_once '../includes/footer.php'; ?>