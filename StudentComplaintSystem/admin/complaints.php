<?php
require_once '../includes/config.php'; require_once '../includes/functions.php'; requireAdmin();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=(int)($_POST['id']??0); $status=$_POST['status']??'Pending'; $allowed=['Pending','In Progress','Resolved','Rejected'];
    if($id && in_array($status,$allowed,true)){ $stmt=$pdo->prepare("UPDATE complaints SET status=?,updated_at=NOW() WHERE id=?"); $stmt->execute([$status,$id]); }
    redirect('complaints.php');
}
$stmt=$pdo->query("SELECT c.*,u.name AS student_name,u.email FROM complaints c JOIN students s ON s.id=c.student_id JOIN users u ON u.id=s.user_id ORDER BY c.created_at DESC");
$complaints=$stmt->fetchAll(); $pageTitle='Manage Complaints'; require_once '../includes/header.php';
?>
<main class="dashboard"><div class="container"><div class="page-head"><div><span class="eyebrow">ADMIN / COMPLAINTS</span><h1>All complaints</h1></div></div>
<div class="panel table-wrap"><table><thead><tr><th>Reference</th><th>Student</th><th>Subject</th><th>Category</th><th>Status</th><th>Update</th></tr></thead><tbody>
<?php foreach($complaints as $c): ?><tr><td><?=e($c['reference_no'])?></td><td><?=e($c['student_name'])?></td><td><?=e($c['subject'])?></td><td><?=e($c['category'])?></td><td><span class="status <?=e(complaintStatusClass($c['status']))?>"><?=e($c['status'])?></span></td><td><form method="post" class="inline-form"><input type="hidden" name="id" value="<?=$c['id']?>"><select name="status"><option <?= $c['status']==='Pending'?'selected':''?>>Pending</option><option <?= $c['status']==='In Progress'?'selected':''?>>In Progress</option><option <?= $c['status']==='Resolved'?'selected':''?>>Resolved</option><option <?= $c['status']==='Rejected'?'selected':''?>>Rejected</option></select><button class="btn btn-small" type="submit">Save</button></form></td></tr><?php endforeach; ?>
<?php if(!$complaints): ?><tr><td colspan="6" class="empty">No complaints found.</td></tr><?php endif; ?></tbody></table></div></div></main>
<?php require_once '../includes/footer.php'; ?>