<?php
require_once 'db_config.php';

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Checking in the admins table
$stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
$stmt->execute([$email]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['user_id'] = $admin['admin_id'];
    $_SESSION['role'] = 'admin';
    // Redirecting the admin to the control panel
    exit;
}

// Searching in the docenten table
$stmt = $pdo->prepare("SELECT * FROM docenten WHERE email = ?");
$stmt->execute([$email]);
$docent = $stmt->fetch(PDO::FETCH_ASSOC);

if ($docent && password_verify($password, $docent['password'])) {
    $_SESSION['user_id'] = $docent['docent_id'];
    $_SESSION['role'] = 'docent';
    // Redirecting the docent to the corresponding page
    exit;
}

// Searching in the cursisten table
$stmt = $pdo->prepare("SELECT * FROM cursisten WHERE email = ?");
$stmt->execute([$email]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student && password_verify($password, $student['password'])) {
    $_SESSION['user_id'] = $student['student_id'];
    $_SESSION['role'] = 'student';
    // Redirecting the student to the corresponding page
    exit;
}

// If authentication failed
echo "Incorrect login or password.";
?>
