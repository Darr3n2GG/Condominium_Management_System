<?php
require_once("../lib/Core.php");

session_start();
$core = new Core;

try {
    insertCardInformation();
} catch (Exception $e) {
    echo "Message : " . $e->getMessage();
}

function insertCardInformation() {
    global $core;
    $card_number = $_POST["card_number"];
    $expiry_month = $_POST["expiry_month"];
    $expiry_year = $_POST["expiry_year"];
    //Don't store cvv according to PCI DSS (Payment Card Industry Data Security Standards)

    $query = new Query;
    $query->table = "accounts";
    $query->columns = ["card_number", "expiry_month", "expiry_year"];
    $query->conditions = new Conditions([
        new NullCondition("card_number"),
        new NullCondition("expiry_month"),
        new NullCondition("expiry_year")
    ]);
    $params = [$card_number, $expiry_month, $expiry_year];
    $core->update($query, $params);

    echo '<script type="text/javascript">
        alert("Payment information inserted successfully.");
        window.location.href = "../frontend/payment.php";
    </script>';
}
?>

// $bills = $core->Select("SELECT amount FROM bills WHERE payment_id IS NULL");
// foreach ($bills as $bill) {
// $total_amount += $bill["amount"];
// }


// function assignIdToBills() {
// global $core;
// $id = $_SESSION["id"];

// $query = "SELECT payment_id FROM payments WHERE id = ?";
// $params = [$id];
// $row = $core->Select($query, $params);
// $payment_id = $row[0]["payment_id"];

// $query = "UPDATE bills SET payment_id = ? WHERE payment_id IS NULL";
// $params = [$payment_id];
// $core->Update($query, $params);
// }