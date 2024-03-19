<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'] ?? '';

if (!empty($name)) {
    $stmt = $pdo->prepare("INSERT INTO softskills (name) VALUES (?)");
    $success = $stmt->execute([$name]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Softskill successfully added.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding the softskill.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'You must specify the name of the skill.']);
}
?>
