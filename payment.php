<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    $test = "Login";
} else {
    $test = "Profile";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Island Crest - Payment</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="payment_feedback.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body class="loggedin">
<nav class="navbar">
        <div class="container">
            <a href="home.php" class="logo">Island Crest</a>
            <ul class="nav-links">
                <li><a href="feedback.html"><i class="fa-solid fa-comment"></i> Feedback</a></li>
                <li><a href="payment.php"><i class="fa-solid fa-credit-card"></i> Payment</a></li>
                <li><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </nav>
    <header class="content">
        <h2>Payment Page</h2>
        <p>Your payment history is listed below:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Payment</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>25 October 2024</td>
                    <td>RM 10.00</td>
                    <td>Maintenance Fee</td>
                </tr>
            </tbody>
        </table>
</header>

    <button class="payButton">Pay Here</button>

    
    <div class="payment-modal hidden"> <!--Class "hidden" not found-->
        <div class="payment-container">
            <h1 class="payTitle">Personal Information</h1>
            <form method="post">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe" class="payInput" required>
                
                <label for="phone">Phone Number</label>
                <input type="number" id="phone" name="phone" placeholder="+6012 345 6781" class="payInput" required>
                
                <h1 class="payTitle">Payment Details</h1>
                <input type="number" name="amount" placeholder="RM" class="payInput sm" required>
                <input type="text" name="remarks" placeholder="Remarks" class="payInput">
                
                <h1 class="payTitle">Card Information</h1>
                <div class="cardIcons"> 
                    <img src="./img/Contact/visa.png" alt="Visa" width="40" class="cardIcon">
                    <img src="./img/Contact/master.png" alt="MasterCard" width="40" class="cardIcon">
                </div>
                <input type="text" name="card_number" placeholder="Card Number" class="payInput" maxlength="16" required>
                <div class="cardInfo">
                    <input type="text" name="expiry_month" placeholder="MM" class="payInput sm" maxlength="2" required>
                    <input type="text" name="expiry_year" placeholder="YYYY" class="payInput sm" maxlength="4" required>
                    <input type="text" name="cvv" placeholder="CVV" class="payInput sm" maxlength="3" required>
                </div>
                <button type="submit" class="confirmPayButton">Confirm Payment</button>
                <button type="button" class="closeModal">Cancel</button>
            </form>
        </div>
    </div>

    <script src="payment.js"></script>
</body>
</html>
