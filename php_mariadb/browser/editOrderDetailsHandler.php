<?php
require_once "databaseCalls.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $detailId = $_POST['detail_id'] ?? null;
    $quantity = $_POST['quantity'] ?? 0;
    $discount = $_POST['discount_percent'] ?? 0;

    if ($detailId) {
        updateOrderDetail($conn, $detailId, $quantity, $discount);
    }

    header("Location: edit_order_details.php");
    exit;
}
