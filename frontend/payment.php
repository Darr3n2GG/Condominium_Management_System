<?php
require_once("../lib/Core.php");

session_start();
if (!isset($_SESSION["loggedin"])) {
	header("Location: login.html");
	exit;
}

$core = New Core;

$payment_row = $core->Select("SELECT payment_id FROM payments WHERE paid = 0");
if ($payment_row) {
    $payment_id = $payment_row[0]["payment_id"];
    $rows = $core->Select("SELECT date, amount, remarks FROM bills WHERE payment_id = ?", [$payment_id]);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>World Residence Centre</title>
		<link href="../assets/style.css" rel="stylesheet" type="text/css">
        <link href="../assets/payment.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>World Residence Centre</h1>
                <a href="home.php"><i class="fa-solid fa-house"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Payment Page</h2>
			<div>
				<p> <?php if ($payment_row) { 
                    echo "Your payment history are below:"; 
                } else {
                    echo "No payment";
                }?> </p>
                <?php if ($payment_row) { ?>
                    <table class="table">
                        <tr>
                            <th>Date <th>Amount <th>Remarks
                        </tr>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td> <?php echo $row["date"]; ?> </td>
                            <td> <?php echo "RM"  . $row["amount"]; ?> </td>
                            <td> <?php echo $row["remarks"]; ?> </td>
                        </tr>
                    <?php } ?>
                    </table>
                <?php } ?>
			</div>
		</div>
        <?php if ($payment_row) { ?>
            <button class="payButton">Pay here</button>
            <div class="payment">
                <form name="paymentForm" action="../backend/paymentModel.php" method="post">
                    <h1 class="payTitle">Card Information</h1>
                    <div class="cardIcons"> <!--Card icon missing !!!-->
                        <img src="./img/Contact/visa.png" width="40" alt="" class="cardIcon">
                        <img src="./img/Contact/master.png" alt="" width="40" class="cardIcon">
                    </div>
                    <input type="number" name="card_number" class="payInput" placeholder="Card Number" required>
                    <div class="cardInfo">
                        <input type="number" name="expiry_month" placeholder="mm" class="payInput sm" min="1" max="12" required>
                        <input type="number" name="expiry_year" placeholder="yyyy" class="payInput sm" required>
                        <input type="number" name="cvv" placeholder="cvv" class="payInput sm" required>
                    </div>
                    <button type="submit" class="confirmPayButton">Checkout!</button>
                    <span class="close">X</span>
                </form>
            </div>
            <?php } ?>
        <script src="../scripts/payment.js"></script>
	</body>
</html>