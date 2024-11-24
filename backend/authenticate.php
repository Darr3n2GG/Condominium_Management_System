<?php
session_start();
$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "";
$DATABASE_NAME = "exampledb";
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (!isset($_POST["username"], $_POST["password"])) {
	exit("Please fill both the username and password fields!");
}

function executeAndStore($stmt, $types, ...$params) {
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;
}

require_once("../lib/UserLogin.php");
$UserLogin = new UserLogin($_POST["username"], $_POST["password"]);
$UserLogin->login();

?>