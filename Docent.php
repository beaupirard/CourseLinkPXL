<?php
require_once 'db_config.php';

class Docent {
    public function create($firstName, $lastName, $email, $password) {
        global $pdo;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashing the password
        $sql = "INSERT INTO docenten (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);
    }

    public function read($docent_id = null) {
        global $pdo;
        if ($docent_id) {
            $sql = "SELECT docent_id, first_name, last_name, email FROM docenten WHERE docent_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$docent_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT docent_id, first_name, last_name, email FROM docenten";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function update($docent_id, $firstName, $lastName, $email, $password = null) {
        global $pdo;
        $sql = "UPDATE docenten SET first_name = ?, last_name = ?, email = ?" . ($password ? ", password = ?" : "") . " WHERE docent_id = ?";
        $params = [$firstName, $lastName, $email];
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $params[] = $hashedPassword;
        }
        $params[] = $docent_id;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }

    public function delete($docent_id) {
        global $pdo;
        $sql = "DELETE FROM docenten WHERE docent_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$docent_id]);
    }
}
?>
