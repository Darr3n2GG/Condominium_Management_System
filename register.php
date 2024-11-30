<?php
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
		window.location.href = "register.html";
	</script>';
}

if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"])) {
	echo '<script type="text/javascript">
		alert("Please complete the registration form");
		window.location.href = "register.html";
	</script>';
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	echo '<script type="text/javascript">
		alert("Email is not valid!");
		window.location.href = "register.html";
	</script>';
}

if (preg_match("/^[a-zA-Z0-9]+$/", $_POST["username"]) == 0) {
	echo '<script type="text/javascript">
		alert("Username is not valid! Username shall only consists of letters and numbers!");
		window.location.href = "register.html";
	</script>';
}

if (strlen($_POST["password"]) > 20 || strlen($_POST["password"]) < 5) {
	echo '<script type="text/javascript">
		alert("Password must be between 5 and 20 characters long!");
		window.location.href = "register.html";
	</script>';
}

function execute_and_store($stmt, $types, ...$params) {
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;
}
function check_username_exists() {
    $stmt = $GLOBALS["con"]->prepare("SELECT id FROM accounts WHERE username = ?");
    $stmt = execute_and_store($stmt, "s", $_POST["username"]);
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}
function check_house_number_exists() {
    $stmt = $GLOBALS["con"]->prepare("SELECT id FROM accounts WHERE house_number = ?");
    $stmt = execute_and_store($stmt, "s", $_POST["house_number"]);
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}
function insert_new_account() {
    $con = $GLOBALS["con"];
    if ($stmt = $con->prepare("INSERT INTO accounts (username, password, email, house_number) VALUES (?, ?, ?, ?)")) {
        // We do not want to expose passwords in our database
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $stmt = execute_and_store($stmt, "ssss", $_POST["username"], $password, $_POST["email"], $_POST["house_number"]);
        echo '<script type="text/javascript">
				alert("Log in success! Redirecting to log in page...");
				window.location.href = "login.html";
			</script>';
    } else {
        error_in_prepare_statement();
    }
}
function error_in_prepare_statement() {
    // Something is wrong with the SQL statement, check to make sure your accounts table exists with all three fields.
    echo "Could not prepare statement!";
}
function check_account_exists() {
    if (check_username_exists()) {
        echo "Username exists, please choose another!";
        return false;
    } elseif (check_house_number_exists()) {
        echo "House Number exists, please choose another!";
        return false;
    } else {
        return true;
    }
}

if (check_account_exists()) {
    insert_new_account();
}

$con->close();
?>