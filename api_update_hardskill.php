<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$skill_id = $data['skill_id'] ?? '';
$name = $data['name'] ?? '';

if (!empty($skill_id) && !empty($name)) {
    $stmt = $pdo->prepare("UPDATE hardskills SET name = ? WHERE skill_id = ?");
    $success = $stmt->execute([$name, $skill_id]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Hardskill successfully updated.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating the hardskill.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient data to update the hardskill.']);
}
?>
