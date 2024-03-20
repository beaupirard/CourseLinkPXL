<?php
require_once 'db_config.php';
require_once 'auth_middleware.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

// Checking user permissions. Only admin can delete skills.
authorize('admin');

if (isset($data['skill_id'])) {
    $stmt = $pdo->prepare("DELETE FROM skills WHERE skill_id = ?");
    $success = $stmt->execute([$data['skill_id']]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Skill successfully deleted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting skill']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No skill ID specified for deletion']);
}
?>
