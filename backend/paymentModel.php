<?php
require_once("../lib/Core.php");

session_start();
$core = New Core;

try {
    insertCardInformation();
}

catch (Exception $e) {
    echo "Message : " . $e->getMessage();
}

function insertCardInformation() {
    global $core;
    $id = $_SESSION["id"];
    $card_number = $_POST["card_number"];
    $expiry_month = $_POST["expiry_month"];
    $expiry_year = $_POST["expiry_year"];
    //Don't store cvv according to PCI DSS (Payment Card Industry Data Security Standards)

    $query = "INSERT INTO payment (id, card_number, expiry_month, expiry_year) VALUES (?, ?, ?, ?)";
    $params = [$id, $card_number, $expiry_month, $expiry_year];
    $core->Insert($query, $params);

    echo '<script type="text/javascript">
        alert("Payment information inserted successfully.");
        window.location.href = "../frontend/payment.php";
    </script>';
}