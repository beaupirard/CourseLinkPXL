<?php
// api_create_skill.php
require_once 'db_config.php';
require_once 'auth_middleware.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

// Checking user permissions. Only admin can create skills.
authorize('admin');

if (isset($data['name'], $data['type']) && ($data['type'] == 'softskill' || $data['type'] == 'hardskill')) {
    $stmt = $pdo->prepare("INSERT INTO skills (name, type) VALUES (?, ?)");
    $success = $stmt->execute([$data['name'], $data['type']]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Skill successfully added']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding skill']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient data or invalid skill type']);
}
?>
