<?php
require_once 'db_config.php';

class Skills {
    // Adding a new skill
    public function create($name, $type) {
        global $pdo;
        $sql = "INSERT INTO skills (name, type) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$name, $type]);
        return $success;
    }

    // Getting the list of skills
    public function read() {
        global $pdo;
        $sql = "SELECT * FROM skills";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Updating a skill
    public function update($skill_id, $name, $type) {
        global $pdo;
        $sql = "UPDATE skills SET name = ?, type = ? WHERE skill_id = ?";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$name, $type, $skill_id]);
        return $success;
    }

    // Deleting a skill
    public function delete($skill_id) {
        global $pdo;
        $sql = "DELETE FROM skills WHERE skill_id = ?";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$skill_id]);
        return $success;
    }
}
?>
