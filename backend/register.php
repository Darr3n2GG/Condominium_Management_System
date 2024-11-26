<?php
require_once("../lib/Core.php");

$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "";
$DATABASE_NAME = "exampledb";
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (!isset($_POST["username"], $_POST["password"], $_POST["email"])) {
	echo '<script type="text/javascript">
		alert("Please complete the registration form!");
		window.location.href = "../frontend/register.html";
	</script>';
}

if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"])) {
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

if (preg_match("/^[a-zA-Z0-9]+$/", $_POST["username"]) == 0) {
	echo '<script type="text/javascript">
		alert("Username is not valid! Username shall only consists of letters and numbers!");
		window.location.href = "../frontend/register.html";
	</script>';
}

if (strlen($_POST["password"]) > 20 || strlen($_POST["password"]) < 5) {
	echo '<script type="text/javascript">
		alert("Password must be between 5 and 20 characters long!");
		window.location.href = "../frontend/register.html";
	</script>';
}

$core = New Core;

try {
    if (check_account_exists()) {
        insert_new_account();
    }
}

catch (Exception $e) {
    echo "Message : " . $e->getMessage();
}

function check_account_exists() {
    if (check_username_exists()) {
        throw New Exception("Username exists, please choose another!");
    }
    return true;
}

function check_username_exists() {
    global $core;
    $username = $_POST["username"];
    $result = $core->select("SELECT id FROM accounts WHERE username = ?", [$username]);
    return $result;
}

function insert_new_account() {
    global $core;
    $username = $_POST["username"];
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $stmt = $core->insert("INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)", [$username, $hashed_password, $email]);
    echo '<script type="text/javascript">
            alert("Log in success! Redirecting to log in page...");
            window.location.href = "../frontend/login.html";
        </script>';
}
?>