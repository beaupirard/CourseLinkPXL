<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['internship_id'])) {
    $stmt = $pdo->prepare("DELETE FROM internships WHERE internship_id = ?");
    $success = $stmt->execute([$data['internship_id']]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Internship successfully deleted.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting the internship.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Internship ID not specified for deletion.']);
}
?>
