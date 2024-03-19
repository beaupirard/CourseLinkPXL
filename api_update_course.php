<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['course_id'], $data['name'], $data['description'], $data['duration'], $data['location'])) {
    $stmt = $pdo->prepare("UPDATE courses SET name = ?, description = ?, duration = ?, location = ? WHERE course_id = ?");
    $success = $stmt->execute([
        $data['name'], 
        $data['description'], 
        $data['duration'], 
        $data['location'], 
        $data['course_id']
    ]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Course successfully updated.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating the course.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient data to update the course.']);
}
?>
