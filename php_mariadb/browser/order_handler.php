<?php
require_once "databaseCalls.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $orderId      = $_POST['order_id'] ?? '';
    $customerName = $_POST['customer_name'];
    $status       = $_POST['status'];
    $customerAddress = $_POST['customer_address'];
    $customerEmail   = $_POST['customer_email'];
    $customerPhone   = $_POST['customer_phone'];
    $status          = $_POST['status'];

    $productIds = $_POST['product_id'] ?? [];
    $quantities = $_POST['quantity'] ?? [];
    $discounts  = $_POST['discount_percent'] ?? [];

    createEditOrder(
        $conn,
        $orderId,
        $customerName,
        $customerAddress,
        $customerEmail,
        $customerPhone,
        $status,
        $productIds,
        $quantities,
        $discounts
    );

    // Redirect to list after save
    header("Location: list_orders.php");
    exit;
}
