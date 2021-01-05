<?php
require_once('./config/database.php');

class User extends Database {
    private $table = 'users';
    private $conn;

    public function __construct($db) {
         $this->conn = $db;
    }

    // Register
    public function register() {
        $message = '';
        if(!empty($_POST["register"]) && $_POST["fullname"] != '' && $_POST["email"] != '' && $_POST["password"] != '') {
            $user_exist = "SELECT * FROM ".$this->table."";
            $user_exist .= " WHERE email = ?";
            $stmt = $this->conn->prepare($user_exist);
            $stmt->bind_param("s", $_POST["email"]);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $message = "User already exist with this email address.";
            }
            else {
                $password = md5($_POST["password"]);
                $insert_query = "INSERT INTO ".$this->table." (username, email, password) VALUES (?,?,?)";
                $stmt = $this->conn->prepare($insert_query);
                $stmt->bind_param("sss", $_POST["fullname"], $_POST["email"], $password);
                $stmt->execute();
                header("Location: index.php?status=1");
            }
        }
        return $message;
    }

    // Login
    public function login() {
        $message = '';
        if(!empty($_POST["login"]) && $_POST["email"] != '' && $_POST["password"] != '') {
            $login_query = "SELECT * FROM ".$this->table." ";
            $login_query .= "WHERE email = ? AND password = ?";
            $stmt = $this->conn->prepare($login_query);
            $password = md5($_POST["password"]);
            $stmt->bind_param("ss", $_POST["email"], $password);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $_SESSION["user_id"] = $user['user_id'];
                $_SESSION["user_name"] = $user['username'];
                $_SESSION["user_role"] = $user['role'];
                return true;
            }
            else {
                $message = "User Not Found!!";
            }
        }
        return $message;
    }

    // LoggedIn
    public function loggedIn() {
        if(!empty($_SESSION["user_id"])) {
            return true;
        }
        else {
            return false;
        }
    }

    // Listing Developers
    public function listDev() {
        $list_dev = "SELECT user_id, username, email ";
        $list_dev .= "FROM ".$this->table." WHERE role = 'dev' AND status_code = '0'";
        $stmt = $this->conn->prepare($list_dev);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
?>
