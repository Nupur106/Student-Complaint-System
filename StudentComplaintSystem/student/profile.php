<?php
require_once '../includes/config.php'; require_once '../includes/functions.php'; requireLogin();
if(currentUser()['role']!=='student') redirect('../admin/dashboard.php');
$stmt=$pdo->prepare("SELECT s.* FROM students s WHERE s.user_id=?"); $stmt->execute([currentUser()['id']]); $s=$stmt->fetch();
$pageTitle='My Profile'; require_once '../includes/header.php';
?>
<main class="dashboard"><div class="container narrow"><div class="page-head"><div><span class="eyebrow">PROFILE</span><h1>My profile</h1></div></div><div class="panel profile">
<p><span>Name</span><strong><?=e(currentUser()['name'])?></strong></p>
<p><span>Email</span><strong><?=e(currentUser()['email'])?></strong></p>
<p><span>Course</span><strong><?=e($s['course']??'-')?></strong></p>
<p><span>Year</span><strong><?=e($s['year']??'-')?></strong></p>
</div></div></main>
<?php require_once '../includes/footer.php'; ?>