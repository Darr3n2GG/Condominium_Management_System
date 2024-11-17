const payButton = document.querySelector(".payButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");
const submit = document.querySelector(".confirmPayButton");

payButton.addEventListener("click", () => {
payment.style.display = "flex";
});

close.addEventListener("click", () => {
payment.style.display = "none";
});

submit.addEventListener("click", () => { 
    payment.style.display = "none";
});