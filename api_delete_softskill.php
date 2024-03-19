<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$skill_id = $data['skill_id'] ?? '';

if (!empty($skill_id)) {
    $stmt = $pdo->prepare("DELETE FROM softskills WHERE skill_id = ?");
    $success = $stmt->execute([$skill_id]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Softskill successfully deleted.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting the softskill.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'You must specify the skill ID for deletion.']);
}
?>
