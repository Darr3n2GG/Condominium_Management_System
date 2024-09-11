<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
// if (!isset($_SESSION['loggedin'])) {
// 	header('Location: login.html');
// 	exit;
// }
if (!isset($_SESSION['loggedin'])) {
    $test = "Login";
} else {
    $test = "Profile";
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
                <h1>Website Title</h1>
                <a href="test.php"><i class="fas fa-user-circle"></i>About</a>
                <a href="test.php"><i class="fas fa-user-circle"></i>Issues</a>
                <a href="test.php"><i class="fas fa-user-circle"></i>Rent Payment</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i><?= $test; ?></a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
            <p>burp</p>
			<!-- <p>Welcome back, <?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?>!</p> -->
		</div>
	</body>
</html>