<?php

class User {
    private $id;
    private $login;
    private $password;
    private $email;
    private $firstname;
    private $lastname;

    public function __construct($login, $password, $email, $firstname, $lastname) {
        $this->login = $login;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Secure password hashing
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function create($conn) {
        try {
            // Check if email already exists
            $checkEmailStmt = $conn->prepare("SELECT id FROM utilisateurs WHERE email = ?");
            $checkEmailStmt->bind_param("s", $this->email);
            $checkEmailStmt->execute();
            if ($checkEmailStmt->get_result()->num_rows > 0) {
                return "email_exists";
            }
            
            // Check if login already exists
            $checkLoginStmt = $conn->prepare("SELECT id FROM utilisateurs WHERE login = ?");
            $checkLoginStmt->bind_param("s", $this->login);
            $checkLoginStmt->execute();
            if ($checkLoginStmt->get_result()->num_rows > 0) {
                return "login_exists";
            }
            
            // If neither exists, proceed with creation
            $stmt = $conn->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $this->login, $this->password, $this->email, $this->firstname, $this->lastname);
            
            if ($stmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } catch (mysqli_sql_exception $e) {
            return "error";
        }
    }

    public static function read($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function update($conn, $id, $data) {
        $sql = "UPDATE utilisateurs SET ";
        $params = [];
        $types = "";
        
        foreach ($data as $key => $value) {
            if ($key === 'password') {
                $value = password_hash($value, PASSWORD_DEFAULT);
            }
            $sql .= "$key = ?, ";
            $params[] = $value;
            $types .= "s";
        }
        
        $sql = rtrim($sql, ", ") . " WHERE id = ?";
        $types .= "i";
        $params[] = $id;
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
