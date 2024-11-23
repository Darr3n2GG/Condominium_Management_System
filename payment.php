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
                <a href="test.php"><i class="fas fa-user-circle"></i>Issues</a>
                <a href="payment.php"><i class="fa-solid fa-credit-card"></i>Payment</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i><?= $test; ?></a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Payment Page</h2>
			<div>
				<p>Your payment history are below:</p>
				<table class="table">
					<tr>
						<th>Date <th>Payment <th>Remarks
					</tr>
                    <tr>
                        <td>25 October 2024 <td>RM 10.00 <td>Maintenance Fee
                    </tr>
				</table>
			</div>
		</div>
        <button class="payButton">Pay here</button>
        <div class="payment">
            <h1 class="payTitle">Personal Information</h1>
            <form action>
                <label>Full Name</label>
                <input type="text" name="name" placeholder="John Doe" class="payInput">
                <br>
                <label>Phone Number</label>
                <input type="number" name="phone" placeholder="+6012 345 6781" class="payInput" maxlength="13">
                <br>
                <h1 class="payTitle">Payment Details</h1>
                <input type="number" name="amount" placeholder="RM" class="payInput sm">
                <input type="text" name="remarks" placeholder="Remarks" class="payInput">
                <br>
                <h1 class="payTitle">Card Information</h1>
                <div class="cardIcons"> <!--Card icon missing !!!-->
                    <img src="./img/Contact/visa.png" width="40" alt="" class="cardIcon">
                    <img src="./img/Contact/master.png" alt="" width="40" class="cardIcon">
                </div>
                <input type="number" name="card_number" class="payInput" placeholder="Card Number" maxlength="16">
                <div class="cardInfo">
                    <input type="number" name="expiry_month" placeholder="mm" class="payInput sm" maxlength="2">
                    <input type="number" name="expiry_year" placeholder="yyyy" class="payInput sm" maxlength="4">
                    <input type="number" name="cvv" placeholder="cvv" class="payInput sm">
                </div>
                <button type="submit" class="confirmPayButton">Checkout!</button>
                <span class="close">X</span>
            </form>
        </div>
        <script src="payment.js"></script>
	</body>
</html>