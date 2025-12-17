<?php
require_once "databaseCalls.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? null;

    if ($orderId) {
        deleteOrder($conn, $orderId);
    }

    header("Location: list_orders.php");
    exit;
}
