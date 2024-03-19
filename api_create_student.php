<?php
require_once 'db_config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['first_name'], $data['last_name'], $data['email'], $data['age'], $data['study_year'])) {
    $stmt = $pdo->prepare("INSERT INTO cursisten (first_name, last_name, email, age, study_year) VALUES (?, ?, ?, ?, ?)");
    $result = $stmt->execute([$data['first_name'], $data['last_name'], $data['email'], $data['age'], $data['study_year']]);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Student successfully added.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding the student.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient data to add the student.']);
}
?>
