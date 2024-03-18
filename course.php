<?php
require_once 'db_config.php';

class Course {
    public function create($name, $description, $duration, $location) {
        global $pdo;
        $sql = "INSERT INTO courses (name, description, duration, location) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $duration, $location]);
    }

    public function read($course_id = null) {
        global $pdo;
        if ($course_id) {
            $sql = "SELECT * FROM courses WHERE course_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$course_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM courses";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function update($course_id, $name, $description, $duration, $location) {
        global $pdo;
        $sql = "UPDATE courses SET name = ?, description = ?, duration = ?, location = ? WHERE course_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $duration, $location, $course_id]);
    }

    public function delete($course_id) {
        global $pdo;
        $sql = "DELETE FROM courses WHERE course_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$course_id]);
    }
}
?>
