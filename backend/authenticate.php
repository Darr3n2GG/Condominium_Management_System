<?php
require_once("../lib/Core.php");

session_start();
$core = new Core;

try {
    if (!isset($_POST["name"], $_POST["password"])) {
        throw new Exception("Please fill both the name and password fields!");
    }

    $name = $_POST["name"];
    $password = $_POST["password"];

    check_name_exists();
    $hashed_password = get_password_from($name);
    if (password_verify($password, $hashed_password)) {
        $id = get_id_from($name);
        session_regenerate_id();
        $_SESSION["loggedin"] = TRUE;
        $_SESSION["name"] = $name;
        $_SESSION["id"] = $id;
        header("Location: ../frontend/home.php");
    } else {
        throw new Exception("Invalid name or password");
    }
} catch (Exception $e) {
    echo "Message : " . $e->getMessage();
}

function check_name_exists(): bool {
    global $core;
    $name = $_POST["name"];
    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["*"];
    $query->conditions = new Conditions([
        new Condition("name", "=")
    ]);

    $result = $core->read($query, [$name]);
    if (!$result) {
        throw new Exception("Invalid name or password.");
    }
    return true;
}

function get_password_from($name): string {
    global $core;
    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["password"];
    $query->conditions = new Conditions([
        new Condition("name", "=")
    ]);
    $result = $core->read($query, [$name]);
    return $result[0]["password"];
}

function get_id_from($name): string {
    global $core;
    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["id"];
    $query->conditions = new Conditions([
        new Condition("name", "=")
    ]);
    $result = $core->read($query, [$name]);
    return $result[0]["id"];
}
