<?php
class DB_Ops {
    private $conn;

    public function __construct() {
        $host = "localhost";
        $db_name = "registration_db";  
        $username = "root";  
        $password = "";

        $this->conn = new mysqli($host, $username, $password);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->createDatabase($db_name);

        $this->conn->select_db($db_name);

        $this->createUsersTable();
    }

    private function createDatabase($db_name) {
        $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
        if ($this->conn->query($sql) === FALSE) {
            echo "Error creating database: " . $this->conn->error;
        }
    }

    private function createUsersTable() {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(100) NOT NULL,
            user_name VARCHAR(50) NOT NULL UNIQUE,
            phone VARCHAR(15) NOT NULL,
            whatsapp VARCHAR(15),
            address TEXT,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            user_image VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($this->conn->query($sql) === FALSE) {
            echo "Error creating table: " . $this->conn->error;
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
            // echo "<script>alert('Username already exists. Please choose another one.');</script>";
            return false;
        }
    
        // Insert user
        $stmt = $this->conn->prepare("INSERT INTO users (full_name, user_name, phone, whatsapp, address, password, email, user_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $full_name, $user_name, $phone, $whatsapp, $address, $hashed_password, $email, $user_image);
        return $stmt->execute();
    }
    public function checkUserNameExist($q){
        $stmt = mysqli_stmt_init($this->conn);
        $sql="select user_name FROM users WHERE user_name = ?";
        if (mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt , "s", $q);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result->num_rows > 0) {
                echo "Username already exists. Please choose another one.";
            }
        }
        else{
            echo "";
        }
    }
}
if (isset($_REQUEST["q"])) {
    $db = new DB_Ops();
    $db->checkUserNameExist($_REQUEST["q"]);
}
?>
