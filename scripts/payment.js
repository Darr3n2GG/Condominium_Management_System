const payButton = document.querySelector(".payButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");
const submit = document.querySelector(".confirmPayButton");
const paymentForm = document.forms["paymentForm"]

payButton.addEventListener("click", () => {
    payment.style.display = "flex";
});

close.addEventListener("click", () => {
    payment.style.display = "none";
});

function validateForm() {
    if (!validateExpiryMonth() || !validateExpiryYear())
        return false;
}

function validateExpiryYear() {
    let expiry_year = paymentForm["expiry_year"].value;
    if (expiry_year.length != 4) {
        alert("Expiry year must be 4 digits");
        return false;
    }
}

function validateExpiryMonth() {
    let expiry_month = paymentForm["expiry_month"].value;
    if (expiry_month < 1 || expiry_month > 12) {
        alert("Expiry month must be between 1 and 12");
        return false;
    }
}