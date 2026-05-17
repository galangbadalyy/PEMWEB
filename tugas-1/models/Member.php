<?php
class Member {
    private $conn;
    private $table = 'member';

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function login($username, $password) {
        $username = $this->conn->real_escape_string($username);
        $password = md5($password); // password di DB pakai md5

        $query = "SELECT * FROM {$this->table} 
                  WHERE username = '$username' 
                  AND PASSWORD = '$password' 
                  LIMIT 1";

        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }
}