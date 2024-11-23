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
                <a href="test.php"><i class="fas fa-user-circle"></i>Issues</a>
                <a href="payment.php"><i class="fa-solid fa-credit-card"></i>Payment</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i><?= $test; ?></a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
            <h2>Welcome to the Island Crest Website!</h2>
            <p>The Island Crest is a renowned condominium complex, recognized for its architectural distinction and luxurious amenities. Situated in a prime location in a bustling urban area, the Island Crest has earned a reputation as one of the most prestigious residential addresses in its city. Its design, combining modern living with comfort and functionality, sets it apart as a symbol of luxury and convenience.</p>

            <h2>Architectural Design and Layout</h2>
            <p>The Island Crest stands out for its cutting-edge architectural design. Its sleek, modern facade features a combination of glass and steel, which gives it a futuristic look while maximizing natural light within the building. The design emphasizes both aesthetics and practicality, offering residents panoramic views of the city skyline, as well as efficient space utilization within each unit.
            Inside, the condominium boasts spacious, well-planned apartments, ranging from one-bedroom units to expansive penthouse suites. Each unit is designed with high ceilings, large windows, and open floor plans to create an airy and inviting atmosphere. High-quality materials, such as marble flooring and premium fixtures, are used throughout, enhancing the luxurious feel.
            The Island Crest’s layout also prioritizes privacy and exclusivity. Many units come with private balconies or terraces, giving residents their own personal outdoor space to enjoy the city views. The building's elevators are designed to serve only a few units per floor, ensuring minimal disturbance and a high level of security.</p>
            
            <h2>Amenities</h2>
            <p>One of the key features that elevate the Island Crest is its extensive range of high-end amenities. Residents have access to a private fitness center, which is fully equipped with state-of-the-art gym equipment, a yoga studio, and a heated indoor swimming pool. There are also spa facilities, including saunas and massage rooms, for relaxation and rejuvenation.
            For social gatherings, the Island Crest offers a luxurious lounge area, a private dining room, and a rooftop garden with breathtaking views. The rooftop space is particularly popular among residents for hosting events or simply unwinding after a long day. A concierge service is available 24/7 to assist with anything from restaurant reservations to dry cleaning, ensuring that residents’ needs are always met.
            The condominium also places a strong emphasis on safety and convenience. It is equipped with a high-tech security system, including keycard access, surveillance cameras, and on-site security personnel. Additionally, the building offers ample parking space and features electric vehicle charging stations, keeping pace with modern demands for sustainability.</p>
            
            <h2>Prime Location</h2>
            <p>The location of the Island Crest further adds to its appeal. Situated in a prime district, it offers easy access to major business hubs, shopping centers, restaurants, and cultural attractions. Its proximity to public transportation and key roadways makes commuting to other parts of the city convenient. For residents who prefer a more active lifestyle, nearby parks and recreational facilities provide opportunities for outdoor activities.
            The surrounding neighborhood is a blend of upscale residential properties, fine dining establishments, and high-end retail stores, giving residents an ideal balance between city living and a serene environment.</p>
            
            <h2>Community and Lifestyle</h2>
            <p>Living in the Island Crest is not just about luxury; it is also about becoming part of an exclusive community. The condominium fosters a sense of belonging among its residents, hosting regular social events and activities that encourage interaction. From wine tastings to fitness challenges, there are plenty of opportunities for residents to connect and build relationships.
            The lifestyle in the Island Crest is tailored to professionals, families, and individuals seeking both comfort and prestige. Its high-end features, combined with the vibrant community atmosphere, make it a sought-after residence for those who value quality living.</p>
            
            <h2>What are you waiting for? Make the Island Crest your first and only home!</h2>
        </div>
	</body>
</html>