<?php
class DB_Ops {
    private $conn;

    public function __construct() {
        $host = "localhost";
        $db_name = "registration_db";  // Fixed database name
        $username = "ADMIN";  
        $password = "12345";

        // Establish database connection
        $this->conn = new mysqli($host, $username, $password, $db_name);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

   
    public function insertUser($full_name, $user_name, $phone, $whatsapp, $address, $password, $email, $user_image) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
        // Check if username already exists
        $check_stmt = $this->conn->prepare("SELECT user_name FROM users WHERE user_name = ?");
        $check_stmt->bind_param("s", $user_name);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
    
        if ($result->num_rows > 0) {
            echo "<script>alert('Username already exists. Please choose another one.');</script>";
            return false;
        }
    
        // Insert user
        $stmt = $this->conn->prepare("INSERT INTO users (full_name, user_name, phone, whatsapp, address, password, email, user_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $full_name, $user_name, $phone, $whatsapp, $address, $hashed_password, $email, $user_image);
        return $stmt->execute();
    }
    
}
?>

