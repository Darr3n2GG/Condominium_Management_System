<?php
require_once("Core.php");

class UserLogin extends Core {
    function login($username, $password) {
        try {
            $this->check_username_exists($username);
            $hashed_password = $this->get_password_from($username);
            if (password_verify($password, $hashed_password)) {
                $id = $this->get_id_from($username);
                session_regenerate_id();
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["name"] = $username;
                $_SESSION["id"] = $id;
                header("Location: ../frontend/home.php");
            } else {
                throw New Exception("Invalid username or password");
            }
        }

        catch (Exception $e) {
            echo "Message :" . $e->getMessage();
        }
    }

    function get_id_from($username) {
        $result = $this->get_result("SELECT id FROM accounts WHERE username = ?", [$username]);
        $row = $result->fetch_assoc();
        return $row['id'];
    }

    function get_password_from($username) {
        $result = $this->get_result("SELECT password FROM accounts WHERE username = ?", [$username]);
        $row = $result->fetch_assoc();
        return $row['password'];
    }

    function check_username_exists($username) {
        try {
            $result = $this->get_result("SELECT * FROM accounts WHERE username = ?", [$username]);
            if ($result->num_rows > 0) {
                return true;
            } else {
                throw New Exception("Username does not exist");
            }
        }

        catch (Exception $e) {
            echo "Message :" . $e->getMessage();
        }
    }
}
?>