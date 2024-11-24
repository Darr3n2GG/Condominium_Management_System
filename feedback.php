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
        <link href="payment.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
                <a href="home.php" id="left">Island Crest</a>
                <a href="feedback.php"><i class="fa-solid fa-comment"></i>Feedback</a>
                <a href="payment.php"><i class="fa-solid fa-credit-card"></i>Payment</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i><?= $test; ?></a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
        </nav>
        <div class="content">
            <h2>Feedback Page</h2>
            <div>
                <form action>
                    <h1 class="payTitle">Suggestions</h1>
                    <textarea type="text" name="suggestions"></textarea>
                    <h1 class="payTitle">Contact</h1>
                    <input type="text" name="name" placeholder="Full Name" class="payInput">
                    <input type="email" name="email" placeholder="Email Address" class="payInput">
                    <input type="number" name="phone-no" placeholder="Phone Number" class="payInput">
                    <br>
                    <button type="submit" class="confirmPayButton" id="submitFeedback">Submit Feedback</button>
                    <br>
                </form>
            </div>
        </div>
    </body>
</html>