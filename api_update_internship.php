<?php
require_once 'db_config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['internship_id'], $data['company_name'], $data['address'], $data['contact_person'], $data['start_date'], $data['end_date'], $data['student_id'])) {
    $stmt = $pdo->prepare("UPDATE internships SET company_name = ?, address = ?, contact_person = ?, start_date = ?, end_date = ?, student_id = ? WHERE internship_id = ?");
    $success = $stmt->execute([$data['company_name'], $data['address'], $data['contact_person'], $data['start_date'], $data['end_date'], $data['student_id'], $data['internship_id']]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Internship successfully updated.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating the internship.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient data to update the internship.']);
}
?>
