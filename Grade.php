<?php
require_once 'db_config.php';

class Grade {
    // Adding a grade for a student
    public function create($student_id, $course_id, $docent_id, $academic_year, $grade) {
        global $pdo;
        $sql = "INSERT INTO student_grades (student_id, course_id, docent_id, academic_year, grade) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$student_id, $course_id, $docent_id, $academic_year, $grade]);
    }

    // Getting information about grades
    public function read($grade_id = null) {
        global $pdo;
        if ($grade_id) {
            $sql = "SELECT * FROM student_grades WHERE grade_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$grade_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM student_grades";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Updating a grade
    public function update($grade_id, $student_id, $course_id, $docent_id, $academic_year, $grade) {
        global $pdo;
        $sql = "UPDATE student_grades SET student_id = ?, course_id = ?, docent_id = ?, academic_year = ?, grade = ? WHERE grade_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$student_id, $course_id, $docent_id, $academic_year, $grade, $grade_id]);
    }

    // Deleting a grade
    public function delete($grade_id) {
        global $pdo;
        $sql = "DELETE FROM student_grades WHERE grade_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$grade_id]);
    }
}
?>
