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

paymentForm["expiry_year"].min = new Date().getFullYear();
paymentForm["expiry_year"].max = new Date().getFullYear() + 10;

paymentForm["expiry_year"].oninput = function () {
    if (this.value.length > 4) {
        this.value = this.value.slice(0,4); 
    }
}

paymentForm["expiry_month"].oninput = function () {
    if (this.value.length > 2) {
        this.value = this.value.slice(0,2); 
    }
}