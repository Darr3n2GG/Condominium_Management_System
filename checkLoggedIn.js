const logOutButton = document.getElementById("logOutButton");
const paymentButton = document.getElementById("paymentButton");

if (!loggedIn) {
    logOutButton.style.display = "none";
    paymentButton.style.display = "none";
}