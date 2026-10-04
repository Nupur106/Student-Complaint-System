<?php
require_once '../includes/config.php'; require_once '../includes/functions.php'; requireAdmin();
if(isset($_GET['delete'])){ $id=(int)$_GET['delete']; $stmt=$pdo->prepare("DELETE FROM users WHERE id=(SELECT user_id FROM students WHERE id=?)"); $stmt->execute([$id]); redirect('students.php'); }
$students=$pdo->query("SELECT s.*,u.name,u.email FROM students s JOIN users u ON u.id=s.user_id ORDER BY s.id DESC")->fetchAll();
$pageTitle='Students'; require_once '../includes/header.php';
?>
<main class="dashboard"><div class="container"><div class="page-head"><div><span class="eyebrow">ADMIN / STUDENTS</span><h1>Students</h1></div><a class="btn btn-primary" href="add-student.php">+ Add Student</a></div>
<div class="panel table-wrap"><table><thead><tr><th>Name</th><th>Email</th><th>Course</th><th>Year</th><th>Action</th></tr></thead><tbody>
<?php foreach($students as $s): ?><tr><td><?=e($s['name'])?></td><td><?=e($s['email'])?></td><td><?=e($s['course'])?></td><td><?=e($s['year'])?></td><td><a class="danger-link" href="?delete=<?=$s['id']?>" onclick="return confirm('Delete this student?')">Delete</a></td></tr><?php endforeach; ?>
</tbody></table></div></div></main>
<?php require_once '../includes/footer.php'; ?>