<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
$pageTitle = 'Student Complaint System';
require_once 'includes/header.php';
?>
<main class="landing">
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <span class="eyebrow">STUDENT SUPPORT PORTAL</span>
                <h1>Raise a complaint. Track the response.</h1>
                <p>Submit student complaints online, follow their status, and let administrators manage issues from one simple system.</p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="login.php">Student Login</a>
                    <a class="btn btn-outline" href="register.php">Create Account</a>
                </div>
            </div>
            <div class="hero-card">
                <div class="hero-card-title">Complaint workflow</div>
                <div class="workflow">
                    <div><b>01</b><span>Submit</span></div>
                    <div><b>02</b><span>Review</span></div>
                    <div><b>03</b><span>Resolve</span></div>
                </div>
                <p>Your complaint gets a reference number so you can track it later.</p>
            </div>
        </div>
    </section>

    <section class="container feature-grid">
        <article class="feature"><span>01</span><h3>Easy submission</h3><p>Students can submit complaints with a category, subject and description.</p></article>
        <article class="feature"><span>02</span><h3>Status tracking</h3><p>See whether a complaint is Pending, In Progress or Resolved.</p></article>
        <article class="feature"><span>03</span><h3>Admin management</h3><p>Administrators can review complaints and update their status.</p></article>
    </section>
</main>
<?php require_once 'includes/footer.php'; ?>