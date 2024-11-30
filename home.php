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
    <title>Island Crest - Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
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

    <header class="home">
        <div class="home-content">
            <h1>Welcome to Island Crest</h1>
            <p>Your dream home in the heart of the city.</p>
            <a href="#details" class="btn">Learn More</a>
        </div>
    </header>

    <main id="details" class="container">
        <section class="section">
            <h2>About Island Crest</h2>
            <p>The Island Crest is a renowned condominium complex, blending luxurious living with modern convenience.</p>
        </section>

        <section class="features">
            <div class="feature">
                <i class="fas fa-building fa-3x"></i>
                <h3>Architectural Design</h3>
                <p>Cutting-edge design combining glass and steel for modern aesthetics and efficiency.</p>
            </div>
            <div class="feature">
                <i class="fas fa-swimming-pool fa-3x"></i>
                <h3>Luxurious Amenities</h3>
                <p>Private fitness center, spa facilities, rooftop garden, and more.</p>
            </div>
            <div class="feature">
                <i class="fas fa-map-marker-alt fa-3x"></i>
                <h3>Prime Location</h3>
                <p>Located in the heart of the city with access to major hubs and attractions.</p>
            </div>
        </section>

        <section class="section">
            <h2>Community & Lifestyle</h2>
            <p>Join an exclusive community where luxury meets a vibrant lifestyle. Regular events and activities await you.</p>
        </section>

        <section class="features">
            <div class="feature">
                <i class="fas fa-users fa-3x"></i>
                <h3>Social Gatherings</h3>
                <p>Social gatherings to stimulate the relationship among residents</p>
            </div>
            <div class="feature">
                <i class="fas fa-dumbbell fa-3x"></i>
                <h3>Fitness Challenges and Health Programs</h3>
                <p>Ensure residents have healthy lifestyle and a fit body.</p>
            </div>
            <div class="feature">
                <i class="fas fa-child fa-3x"></i>
                <h3>Children’s play areas and kid-friendly activities</h3>
                <p>Maintain a family-oriented community</p>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Island Crest. All rights reserved.</p>
            <a href="admin/ad-home.html"><i class="fa-solid fa-user-tie"></i> Admin Page</a>
        </div>
    </footer>

    <script src="home.js"></script>
</body>

</html>
