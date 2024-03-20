<?php
require_once 'db_config.php';
require_once 'auth_middleware.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

// Checking user permissions. Only admin can update skills.
authorize('admin');

if (isset($data['skill_id'], $data['name'], $data['type'])) {
    $stmt = $pdo->prepare("UPDATE skills SET name = ?, type = ? WHERE skill_id = ?");
    $success = $stmt->execute([$data['name'], $data['type'], $data['skill_id']]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Skill successfully updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating skill']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient data to update skill']);
}
?>
