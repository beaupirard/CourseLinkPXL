<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['course_id'])) {
    $stmt = $pdo->prepare("DELETE FROM courses WHERE course_id = ?");
    $success = $stmt->execute([$data['course_id']]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Course successfully deleted.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting the course.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Course ID not specified for deletion.']);
}
?>
