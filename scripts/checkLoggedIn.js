const logOutButton = document.getElementById("logOutButton");
const paymentButton = document.getElementById("paymentButton");
const logInButton = document.getElementById("logInButton")
const profileButton = document.getElementById("profileButton");

if (!loggedIn) {
    logOutButton.style.display = "none";
    paymentButton.style.display = "none";
    profileButton.style.display = "none";
} else {
    logInButton.style.display = "none";
}