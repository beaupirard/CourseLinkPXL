<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['student_id'], $data['first_name'], $data['last_name'], $data['email'], $data['age'], $data['study_year'])) {
    $stmt = $pdo->prepare("UPDATE cursisten SET first_name = ?, last_name = ?, email = ?, age = ?, study_year = ? WHERE student_id = ?");
    $success = $stmt->execute([
        $data['first_name'], 
        $data['last_name'], 
        $data['email'], 
        $data['age'], 
        $data['study_year'], 
        $data['student_id']
    ]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Student data successfully updated.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating student data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient data to update student. Make sure all fields are filled.']);
}
?>
