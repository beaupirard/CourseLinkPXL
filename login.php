<?php
require_once 'vendor/autoload.php';
require_once 'db_config.php';

// Loading environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
    exit;
}

// Initializing variables for JWT
$secretKey = $_ENV['JWT_SECRET_KEY'];
$issuer = $_ENV['JWT_ISSUER'];
$audience = $_ENV['JWT_AUDIENCE'];

$user = null;

// Attempt to find a lecturer
$stmt = $pdo->prepare("SELECT docent_id AS user_id, password, 'docent' AS role FROM docenten WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If not found, search among administrators
if (!$user) {
    $stmt = $pdo->prepare("SELECT admin_id AS user_id, password, 'admin' AS role FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($user && password_verify($password, $user['password'])) {
    // Generating JWT
    $payload = [
        'iss' => $issuer,
        'aud' => $audience,
        'iat' => time(),
        'exp' => time() + (60 * 60), // Token valid for 1 hour
        'data' => [
            'user_id' => $user['user_id'],
            'role' => $user['role']
        ]
    ];

    $jwt = \Firebase\JWT\JWT::encode($payload, $secretKey);
    echo json_encode(['success' => true, 'message' => 'Login successful.', 'token' => $jwt, 'role' => $user['role']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Incorrect email or password.']);
}
?>
