<?php
require_once 'db_config.php';
require_once 'Course.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['name']) && !empty($data['description']) && !empty($data['duration']) && !empty($data['location'])) {
    $course = new Course();
    try {
        $course->create($data['name'], $data['description'], $data['duration'], $data['location']);
        echo json_encode(['success' => true, 'message' => 'Course successfully added']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error adding the course']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient data to add the course']);
}
?>
