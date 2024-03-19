<?php
require_once 'db_config.php'; // Connecting to the database

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT * FROM courses");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'courses' => $courses]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error retrieving the list of courses']);
}
?>
