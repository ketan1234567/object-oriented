<?php



class User {
    private $username;
    private $email;
    private $password;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function validate() {
        // Basic validation
        if (empty($this->username) || empty($this->email) || empty($this->password)) {
            return false;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public function save() {
        // Save user to database (simplified)
        // Assume a PDO instance is available as $pdo
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO uers (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$this->username, $this->email, password_hash($this->password, PASSWORD_BCRYPT)]);
    }
}



