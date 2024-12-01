<?php
require_once("../lib/Core.php");

session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: login.html");
    exit;
}

$core = new Core;

$query = new Query;
$query->table = "payments";
$query->columns = ["payment_id"];
$query->conditions = new Conditions([
    new Condition("paid", "=")
]);
$payment_row = $core->read($query, [0]);
if ($payment_row) {
    $payment_id = $payment_row[0]["payment_id"];
    $query = new Query;
    $query->table = "bills";
    $query->columns = ["date", "amount", "remarks"];
    $query->conditions = new Conditions([
        new Condition("payment_id", "=")
    ]);
    $rows = $core->read($query, [$payment_id]);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Island Crest - Payment</title>
    <link href="../assets/payment.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body class="loggedin">
    <nav class="navbar">
        <div class="container">
            <a href="home.php" class="logo">Island Crest</a>
            <ul class="nav-links">
                <li><a href="feedback.html"><i class="fa-solid fa-comment"></i> Feedback</a></li>
                <li><a href="payment.php"><i class="fas fa-credit-card"></i> Payment</a></li>
                <li><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
                <li><a href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </nav>
    <header class="content">
        <h2>Payment Page</h2>
        <p> <?php if ($payment_row) {
                echo "Your payment history are below:";
            } else {
                echo "No previous payment.";
            } ?> </p>
        <table class="table">
            <?php if ($payment_row) { ?>
                <thead>
                    <tr>
                        <th>Date
                        <th>Amount
                        <th>Remarks
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td> <?php echo $row["date"]; ?> </td>
                            <td> <?php echo "RM" . $row["amount"]; ?> </td>
                            <td> <?php echo $row["remarks"]; ?> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } ?>
        </table>
    </header>

    <?php if ($payment_row) { ?>
        <button class="payButton">Pay here</button>

        <?php if ($payment_row) { ?>
            <div class="payment-modal hidden">
                <div class="payment-container">
                    <h1 class="payTitle">Card Information</h1>
                    <form name="paymentForm" action="../backend/paymentModel.php" method="post">
                        <input type="number" name="card_number" placeholder="Card Number" class="payInput" required>
                        <div class="cardInfo">
                            <input type="number" name="expiry_month" placeholder="MM" class="payInput sm" required>
                            <input type="number" name="expiry_year" placeholder="YYYY" class="payInput sm" required>
                            <input type="number" name="cvv" placeholder="CVV" class="payInput sm" required>
                        </div>
                        <button type="submit" class="confirmPayButton">Confirm Payment</button>
                        <button type="button" class="closeModal">Cancel</button>
                    </form>
                </div>
            </div>
        <?php } ?>
        <script src="../scripts/payment.js"></script>
    <?php } ?>

</body>

</html>