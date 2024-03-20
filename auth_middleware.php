<?php
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Loading environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function authenticate() {
    if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Access token is missing.']);
        exit;
    }

    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    $arr = explode(" ", $authHeader);

    if (count($arr) != 2) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Access token is malformed.']);
        exit;
    }

    $jwt = $arr[1];
    try {
        $decoded = JWT::decode($jwt, new Key($_ENV['JWT_SECRET_KEY'], 'HS256'));
        return $decoded;
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Access token is invalid: ' . $e->getMessage()]);
        exit;
    }
}

function authorize($role) {
    $decoded = authenticate();
    if ($decoded->data->role != $role) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'You do not have permission to access this resource.']);
        exit;
    }
}
?>
