<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
requireLogin();
if (currentUser()['role'] !== 'student') redirect('../admin/dashboard.php');
$stmt=$pdo->prepare("SELECT id FROM students WHERE user_id=?"); $stmt->execute([currentUser()['id']]); $student=$stmt->fetch();
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $category=trim($_POST['category']??''); $subject=trim($_POST['subject']??''); $description=trim($_POST['description']??'');
    if (!$category || !$subject || !$description) $error='Please fill all fields.';
    else {
        $reference='CMP-'.date('Ymd').'-'.strtoupper(substr(bin2hex(random_bytes(4)),0,6));
        $stmt=$pdo->prepare("INSERT INTO complaints (student_id,reference_no,category,subject,description) VALUES (?,?,?,?,?)");
        $stmt->execute([$student['id'],$reference,$category,$subject,$description]);
        redirect('complaints.php?success=1');
    }
}
$pageTitle='New Complaint'; require_once '../includes/header.php';
?>
<main class="dashboard"><div class="container narrow"><div class="page-head"><div><span class="eyebrow">NEW COMPLAINT</span><h1>Submit an issue</h1><p>Give enough detail so the administration can understand the problem.</p></div></div>
<div class="panel">
<?php if($error): ?><div class="alert error"><?=e($error)?></div><?php endif; ?>
<form method="post" class="form-grid">
<label>Category<select name="category" required><option value="">Select category</option><option>Academic</option><option>Infrastructure</option><option>Faculty</option><option>Hostel</option><option>Library</option><option>Fees</option><option>Other</option></select></label>
<label>Subject<input name="subject" maxlength="150" required></label>
<label class="full-field">Description<textarea name="description" rows="7" required></textarea></label>
<button class="btn btn-primary" type="submit">Submit Complaint</button>
</form></div></div></main>
<?php require_once '../includes/footer.php'; ?>