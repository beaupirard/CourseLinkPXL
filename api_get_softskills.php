<?php
require_once 'db_config.php';

header('Content-Type: application/json');

$stmt = $pdo->query("SELECT * FROM softskills");
$softskills = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['success' => true, 'softskills' => $softskills]);
?>
