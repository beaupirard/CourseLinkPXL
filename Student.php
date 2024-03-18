<?php
require_once 'db_config.php';

class Student {
    // Adding a new student
    public function create($firstName, $lastName, $email, $age, $studyYear) {
        global $pdo;
        $sql = "INSERT INTO cursisten (first_name, last_name, email, age, study_year) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstName, $lastName, $email, $age, $studyYear]);
    }

    // Getting information about student(s)
    public function read($student_id = null) {
        global $pdo;
        if ($student_id) {
            $sql = "SELECT * FROM cursisten WHERE student_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM cursisten";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Updating student information
    public function update($student_id, $firstName, $lastName, $email, $age, $studyYear) {
        global $pdo;
        $sql = "UPDATE cursisten SET first_name = ?, last_name = ?, email = ?, age = ?, study_year = ? WHERE student_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstName, $lastName, $email, $age, $studyYear, $student_id]);
    }

    // Deleting a student
    public function delete($student_id) {
        global $pdo;
        $sql = "DELETE FROM cursisten WHERE student_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$student_id]);
    }
}
?>
