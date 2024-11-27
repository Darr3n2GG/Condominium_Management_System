const payButton = document.querySelector(".payButton");
const payment = document.querySelector(".payment-modal");
const close = document.querySelector(".closeModal");
const submit = document.querySelector(".confirmPayButton");

payButton.addEventListener("click", () => {
payment.style.display = "flex";
});

close.addEventListener("click", () => {
payment.style.display = "none";
});

