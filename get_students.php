<?php
require_once 'db_config.php';

header('Content-Type: application/json');

$stmt = $pdo->query("SELECT student_id, first_name, last_name, email, age, study_year FROM cursisten");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['success' => true, 'students' => $students]);
?>
