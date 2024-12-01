<?php
$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "";
$DATABASE_NAME = "condodb";
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit("Failed to connect to MySQL: " . mysqli_connect_error());
}

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Island Crest Admin - User</title>
		<link href="../assets/ad-admin.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
                <a href="ad-home.html" id="left">Island Crest</a>
                <a href="ad-payment.php"><i class="fa-solid fa-credit-card"></i>Manage Payment</a>
				<a href="ad-user.php"><i class="fas fa-user-circle"></i>Manage User</a>
				<a href="../backend/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
        <div class="content">
			<h2>User Management Page</h2>
			<div>
				<p>Users are below:</p>
                <table class="table">
					<thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>House Number</th>
                    </tr>
					</thead>
					<tbody>
                        <?php
                        // Check if rows exist
                        if ($result->num_rows > 0) {
                            // Output each row as a table row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>"; // Adjust column names as per your database
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['house_number'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No data found</td></tr>";
                        }
                        ?>
					</tbody>
                </table>
			</div>
		</div>
    </body>
</html>