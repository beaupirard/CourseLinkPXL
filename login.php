<?php
require_once 'db_config.php';

header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM docenten WHERE email = ?");
$stmt->execute([$email]);
$docent = $stmt->fetch(PDO::FETCH_ASSOC);

if ($docent && password_verify($password, $docent['password'])) {
    // Here should be the logic for creating a session or JWT token
    echo json_encode(['success' => true, 'message' => 'Login successful.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Incorrect email or password.']);
}
?>
