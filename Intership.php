<?php
require_once 'db_config.php';

class Internship {
    // Adding a new internship position
    public function create($companyName, $address, $contactPerson, $start_date, $end_date, $student_id = null) {
        global $pdo;
        $sql = "INSERT INTO internships (company_name, address, contact_person, start_date, end_date, student_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$companyName, $address, $contactPerson, $start_date, $end_date, $student_id]);
    }

    // Getting information about internship(s)
    public function read($internship_id = null) {
        global $pdo;
        if ($internship_id) {
            $sql = "SELECT * FROM internships WHERE internship_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$internship_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM internships";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Updating internship information
    public function update($internship_id, $companyName, $address, $contactPerson, $start_date, $end_date, $student_id = null) {
        global $pdo;
        $sql = "UPDATE internships SET company_name = ?, address = ?, contact_person = ?, start_date = ?, end_date = ?, student_id = ? WHERE internship_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$companyName, $address, $contactPerson, $start_date, $end_date, $student_id, $internship_id]);
    }

    // Deleting an internship position
    public function delete($internship_id) {
        global $pdo;
        $sql = "DELETE FROM internships WHERE internship_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$internship_id]);
    }
}
?>
