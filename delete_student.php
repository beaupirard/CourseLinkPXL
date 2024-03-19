<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['student_id'])) {
    $stmt = $pdo->prepare("DELETE FROM cursisten WHERE student_id = ?");
    $success = $stmt->execute([$data['student_id']]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Student successfully deleted.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting the student.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Student ID not specified.']);
}
?>
