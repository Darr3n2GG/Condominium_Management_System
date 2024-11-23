<?php
session_start();
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
		<title>Island Crest</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
                <a href="home.php" id="left">Island Crest</a>
                <a href="issue.php"><i class="fa-solid fa-comment"></i>Issues</a>
                <a href="payment.php"><i class="fa-solid fa-credit-card"></i>Payment</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i><?= $test; ?></a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
        </nav>
        <div class="content">
            <h2>Issue Page</h2>
            <div>
                <p>Lol bro thought he could report issues</p>
            </div>
        </div>
    </body>
</html>