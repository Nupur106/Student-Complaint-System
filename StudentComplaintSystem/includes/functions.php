<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function redirect($path) {
    header('Location: ' . $path);
    exit;
}
function isLoggedIn() {
    return isset($_SESSION['user']);
}
function currentUser() {
    return $_SESSION['user'] ?? null;
}
function requireLogin() {
    if (!isLoggedIn()) redirect('../login.php');
}
function requireAdmin() {
    requireLogin();
    if (currentUser()['role'] !== 'admin') redirect('../student/dashboard.php');
}
function complaintStatusClass($status) {
    return strtolower(str_replace(' ', '-', $status));
}