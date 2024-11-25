<?php
require_once("../lib/Core.php");

session_start();
$core = New Core;
$username = $_POST["username"];
$password = $_POST["password"];

function check_username_exists() {
    global $core;
    global $username;
    $result = $core->get_result("SELECT * FROM accounts WHERE username = ?", [$username]);
    if ($result->num_rows <= 0) {
        throw new Exception("Username does not exist");
    }
    return true;
}

function get_password_from() : string {
    global $core;
    global $username;
    $result = $core->get_result("SELECT password FROM accounts WHERE username = ?", [$username]);
    $row = $result->fetch_assoc();
    return $row['password'];
}

function get_id_from() : string {
    global $core;
    global $username;
    $result = $core->get_result("SELECT id FROM accounts WHERE username = ?", [$username]);
    $row = $result->fetch_assoc();
    return $row['id'];
}

try {
    if (!isset($username, $password)) {
        throw New Exception("Please fill both the username and password fields!");
    }

    check_username_exists();
    $hashed_password = get_password_from();
    if (password_verify($password, $hashed_password)) {
        $id = get_id_from();
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
?>