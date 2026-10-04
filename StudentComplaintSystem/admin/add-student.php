<?php
require_once '../includes/config.php'; require_once '../includes/functions.php'; requireAdmin();
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=trim($_POST['name']??'');$email=trim($_POST['email']??'');$course=trim($_POST['course']??'');$year=trim($_POST['year']??'');$password=$_POST['password']??'student123';
    if(!$name||!filter_var($email,FILTER_VALIDATE_EMAIL)||!$course||!$year){$error='Fill all fields correctly.';}
    else{
        try{
            $pdo->beginTransaction();
            $stmt=$pdo->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,'student')");
            $stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]);
            $uid=$pdo->lastInsertId();
            $stmt=$pdo->prepare("INSERT INTO students(user_id,course,year) VALUES(?,?,?)");
            $stmt->execute([$uid,$course,$year]);$pdo->commit();redirect('students.php');
        }catch(PDOException $e){if($pdo->inTransaction())$pdo->rollBack();$error='Email may already exist.';}
    }
}
$pageTitle='Add Student';require_once '../includes/header.php';
?>
<main class="dashboard"><div class="container narrow"><div class="page-head"><div><span class="eyebrow">ADMIN / STUDENTS</span><h1>Add student</h1></div></div><div class="panel">
<?php if($error):?><div class="alert error"><?=e($error)?></div><?php endif;?>
<form method="post" class="form-grid"><label>Name<input name="name" required></label><label>Email<input type="email" name="email" required></label><label>Course<input name="course" required></label><label>Year<input name="year" required></label><label>Password<input type="password" name="password" value="student123" required></label><button class="btn btn-primary" type="submit">Add Student</button></form>
</div></div></main>
<?php require_once '../includes/footer.php'; ?>