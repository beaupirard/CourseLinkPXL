<?php
require_once 'db_config.php';
require_once 'auth_middleware.php';

header('Content-Type: application/json');

// Checking user permissions. Different roles may have access for reading.
// authorize('desired_role');

$type = $_GET['type'] ?? null; // Getting skill type from the request parameters, if available

try {
    if ($type) {
        $stmt = $pdo->prepare("SELECT * FROM skills WHERE type = ?");
        $stmt->execute([$type]);
    } else {
        $stmt = $pdo->query("SELECT * FROM skills");
    }
    $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['success' => true, 'skills' => $skills]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error fetching list of skills: ' . $e->getMessage()]);
}
?>
