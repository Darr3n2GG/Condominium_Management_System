const logOutButton = document.getElementById("logOutButton");
const paymentButton = document.getElementById("paymentButton");
const logInButton = document.getElementById("logInButton");
const profileButton = document.getElementById("profileButton");
const feedbackButton = document.getElementById("feedbackButton");

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

if (!loggedIn) {
    logOutButton.style.display = "none";
    paymentButton.style.display = "none";
    profileButton.style.display = "none";
    feedbackButton.style.display = "none";
}