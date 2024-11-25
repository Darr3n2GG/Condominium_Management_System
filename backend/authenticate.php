<?php
require_once("../lib/Core.php");

session_start();
$core = New Core;
$username = $_POST["username"];
$password = $_POST["password"];

function check_username_exists() : bool {
    global $core;
    global $username;
    if (!$result = $core->select("SELECT * FROM accounts WHERE username = ?", [$username])) {
        throw new Exception("Invalid username or password.");
    }
    return true;
}

function get_password() : string {
    global $core;
    global $username;
    $result = $core->select("SELECT password FROM accounts WHERE username = ?", [$username]);
    return $result[0]["password"];
}

function get_id() : string {
    global $core;
    global $username;
    $result = $core->select("SELECT id FROM accounts WHERE username = ?", [$username]);
    return $result[0]["id"];
}

try {
    if (!isset($username, $password)) {
        throw New Exception("Please fill both the username and password fields!");
    }

    check_username_exists();
    $hashed_password = get_password();
    if (password_verify($password, $hashed_password)) {
        $id = get_id();
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
    echo "Message : " . $e->getMessage();
}
?>