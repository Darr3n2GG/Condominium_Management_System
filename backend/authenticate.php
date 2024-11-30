<?php
require_once("../lib/Core.php");

session_start();
$core = new Core;

try {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!isset($username, $password)) {
        throw new Exception("Please fill both the username and password fields!");
    }

    check_username_exists();
    $hashed_password = get_password_from($username);
    if (password_verify($password, $hashed_password)) {
        $id = get_id_from($username);
        session_regenerate_id();
        $_SESSION["loggedin"] = TRUE;
        $_SESSION["name"] = $username;
        $_SESSION["id"] = $id;
        header("Location: ../frontend/home.php");
    } else {
        throw new Exception("Invalid username or password");
    }
} catch (Exception $e) {
    echo "Message : " . $e->getMessage();
}

function check_username_exists(): bool {
    global $core;
    $username = $_POST["username"];
    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["*"];
    $query->setConditions([["name", "=", false]]);

    $result = $core->read($query, [$username]);
    if (!$result) {
        throw new Exception("Invalid username or password.");
    }
    return true;
}

function get_password_from($username): string {
    global $core;
    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["password"];
    $query->setConditions([["name", "=", false]]);
    $result = $core->read($query, [$username]);
    return $result[0]["password"];
}

function get_id_from($username): string {
    global $core;
    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["id"];
    $query->setConditions([["name", "=", false]]);
    $result = $core->read($query, [$username]);
    return $result[0]["id"];
}
