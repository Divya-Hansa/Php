<?php
$host = "localhost";
$user = "dbuser";
$pass = "pass@123";
$db = "phptest";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error){
    die("Connection failed : " . $conn->connect_error);
}

function getOrders($conn){
    $result = $conn->query("SELECT id, customer_name, created_at, status FROM orders");
    $orders = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $orders[] = $row;
        }
    }
    return $orders;
}

function getOrdersDetails($conn, $orderId){
    if($orderId){
        $sql ="SELECT od.*, p.product_name
        FROM order_details od
        JOIN products p ON od.product_id = p.id
        WHERE od.order_id = ".$orderId;
    } else {
        $sql ="SELECT od.*, p.product_name
        FROM order_details od
        JOIN products p ON od.product_id = p.id";
    }

    $result = $conn->query($sql);
    $orderDetails = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $orderDetails[] = $row;
        }
    }
    return $orderDetails;
}

function getOrderById($conn, $orderId){
    $sql = "SELECT * FROM orders WHERE id = $orderId";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function getProducts($conn){
    $sql = "SELECT id, product_name FROM products ORDER BY product_name";
    $result = $conn->query($sql);

    $products = [];
    while($row = $result->fetch_assoc()){
        $products[] = $row;
    }
    return $products;
}

function createEditOrder(
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
){
    /* CREATE */
    if (empty($orderId)) {
       $sql = "
            INSERT INTO orders (customer_name, customer_address, customer_email, customer_phone, status, created_at)
            VALUES ('$customerName', '$customerAddress', '$customerEmail', '$customerPhone', '$status', NOW())
        ";
        $conn->query($sql);
        $orderId = $conn->insert_id;
    }
    /* EDIT */
    else {
        $sql = "
            UPDATE orders
            SET customer_name = '$customerName',
                status = '$status'
            WHERE id = $orderId
        ";
        $conn->query($sql);

        $conn->query("DELETE FROM order_details WHERE order_id = $orderId");
    }

    /* Insert order details */
    for ($i = 0; $i < count($productIds); $i++) {
        if (empty($productIds[$i])) continue;

        $pid = $productIds[$i];
        $qty = $quantities[$i];
        $dis = $discounts[$i];

        $sql = "
            INSERT INTO order_details (order_id, product_id, quantity, discount_percent)
            VALUES ($orderId, $pid, $qty, $dis)
        ";
        $conn->query($sql);
    }

    return $orderId;
}

function deleteOrder($conn, $orderId) {
    $orderId = intval($orderId); 

    if ($orderId <= 0) return false;

    // Delete related order_details first
    $conn->query("DELETE FROM order_details WHERE order_id = $orderId");

    // Delete the order itself
    $conn->query("DELETE FROM orders WHERE id = $orderId");

    return true;
}

function getAllOrderDetails($conn) {
    $sql = "
        SELECT 
            od.id,
            od.order_id,
            o.customer_name,
            p.product_name,
            od.quantity,
            od.discount_percent
        FROM order_details od
        JOIN orders o ON od.order_id = o.id
        JOIN products p ON od.product_id = p.id
        ORDER BY od.order_id ASC    ";

    $result = $conn->query($sql);
    $rows = [];

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}

function getOrderDetailById($conn, $detailId) {
    $detailId = intval($detailId);

    $sql = "
        SELECT 
            od.*,
            p.product_name
        FROM order_details od
        JOIN products p ON od.product_id = p.id
        WHERE od.id = $detailId
    ";

    $result = $conn->query($sql);
    return $result->fetch_assoc();
}


function getOrderWithDetails($conn, $orderId) {
    $orderId = intval($orderId);

    $orderSql = "SELECT * FROM orders WHERE id = $orderId";
    $orderRes = $conn->query($orderSql);
    $order = $orderRes->fetch_assoc();

    $detailsSql = "
        SELECT od.id AS order_detail_id,
               od.product_id,
               od.quantity,
               od.discount_percent,
               p.product_name
        FROM order_details od
        JOIN products p ON p.id = od.product_id
        WHERE od.order_id = $orderId
    ";

    $detailsRes = $conn->query($detailsSql);
    $details = [];

    while ($row = $detailsRes->fetch_assoc()) {
        $details[] = $row;
    }

    return [
        'order' => $order,
        'details' => $details
    ];
}

function updateOrderDetail($conn, $detailId, $quantity, $discountPercent) {
    $detailId = intval($detailId);
    $quantity = intval($quantity);
    $discountPercent = intval($discountPercent);

    $sql = "
        UPDATE order_details
        SET 
            quantity = $quantity,
            discount_percent = $discountPercent
        WHERE id = $detailId
    ";

    return $conn->query($sql);
}

?>