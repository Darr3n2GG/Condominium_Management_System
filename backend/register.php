<?php
require_once("../lib/Core.php");

if (!isset($_POST["name"], $_POST["password"], $_POST["email"])) {
    echo '<script type="text/javascript">
		alert("Please complete the registration form!");
		window.location.href = "../frontend/register.html";
	</script>';
}

if (empty($_POST["name"]) || empty($_POST["password"]) || empty($_POST["email"])) {
    echo '<script type="text/javascript">
		alert("Please complete the registration form");
		window.location.href = "../frontend/register.html";
	</script>';
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo '<script type="text/javascript">
		alert("Email is not valid!");
		window.location.href = "../frontend/register.html";
	</script>';
}

if (preg_match("/^[a-zA-Z0-9]+$/", $_POST["name"]) == 0) {
    echo '<script type="text/javascript">
		alert("Username is not valid! Username shall only consists of letters and numbers!");
		window.location.href = "../frontend/register.html";
	</script>';
    exit;
}

if (strlen($_POST["password"]) > 20 || strlen($_POST["password"]) < 5) {
    echo '<script type="text/javascript">
		alert("Password must be between 5 and 20 characters long!");
		window.location.href = "../frontend/register.html";
	</script>';
    exit;
}

$core = new Core;

try {
    if (check_account_exists()) {
        insert_new_account();
    }
} catch (Exception $e) {
    echo "Message : " . $e->getMessage();
}

function check_account_exists() {
    if (check_name_exists()) {
        throw new Exception("Username exists, please choose another!");
    }
    echo "test";
    return true;
}

function check_name_exists() {
    global $core;
    $name = $_POST["name"];

    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["id"];
    $query->conditions = new Conditions([
        new Condition("name", "=")
    ]);

    $result = $core->read($query, [$name]);
    return $result;
}

function check_is_admin () {
    global $core;
    $admin = $_POST["admin"];

    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["id"];
    $query->conditions = new Conditions([
        new Condition("name", "=")
    ]);

    $result = $core->read($query, [$admin]);
    return $result;
}

function insert_new_account() {
    global $core;
    $name = $_POST["name"];
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $admin = $_POST["admin"];


    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["name", "password", "email", "admin"];

    $core->create($query, [$name, $hashed_password, $email, $admin]);

    echo '<script type="text/javascript">
            alert("Log in success! Redirecting to log in page...");
            window.location.href = "../frontend/login.html";
        </script>';
}
