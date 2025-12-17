<?php
require_once "databaseCalls.php";

$action = $_GET['action'] ?? '';
$orderId = $_GET['id'] ?? null;
$customerAddress = '';
$customerEmail   =  '';
$customerName    = '';
$customerPhone   = '';
$status          = 'Pending';
$orderDetails    = [];

$products = getProducts($conn);

$customerName = '';
$status = 'Pending';
$orderDetails = [];

if ($action === 'edit' && $orderId) {
    $order = getOrderById($conn, $orderId);
    if ($order) {
        $customerName = $order['customer_name'];
        $customerAddress = $order['customer_address'];
        $customerEmail = $order['customer_email'];  
        $customerPhone = $order['customer_phone'];
        $status = $order['status'];
        $orderDetails = getOrdersDetails($conn, $orderId);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $action === 'edit' ? 'Edit' : 'Create' ?> Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="container mx-auto py-12">

<h2 class="text-2xl font-bold mb-6"><?= $action === 'edit' ? 'Edit' : 'Create' ?> Order</h2>

<form method="POST" action="order_handler.php">

    <input type="hidden" name="order_id" value="<?= $orderId ?? '' ?>">

    <div class="mb-4">
        <label>Customer Name</label>
        <input type="text" name="customer_name" class="border p-2 w-full h-10" value="<?= $customerName ?>" required>
    </div>
    <div class="mb-4">
        <label>Customer Address</label>
        <input type="text" name="customer_address" class="border p-2 w-full" value="<?= $customerAddress ?>" required>
    </div>
    <div class="mb-4">
        <label>Customer Email</label>
        <input type="email" name="customer_email" class="border p-2 w-full" value="<?= $customerEmail ?>" required>
    </div>
    <div class="mb-4">
        <label>Customer Phone</label>
        <input type="text" name="customer_phone" class="border p-2 w-full" value="<?= $customerPhone ?>" required>
    </div>
    <div class="mb-4">
        <label>Status</label>
        <select name="status" class="border p-2 w-full">
            <option value="Pending" <?= $status === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Completed" <?= $status === 'Completed' ? 'selected' : '' ?>>Completed</option>
        </select>
    </div>
    

    <h3 class="font-bold mb-2">Products</h3>

    <!-- EXISTING PRODUCTS -->
    <?php
    if (!empty($orderDetails)) {
        foreach ($orderDetails as $d) {
            ?>
            <div class="flex gap-2 mb-2">
                <select name="product_id[]" class="border p-2">
                    <option value="">Select Product</option>
                    <?php
                    foreach ($products as $p) {
                        $selected = ($p['id'] == $d['product_id']) ? 'selected' : '';
                        echo "<option value='{$p['id']}' $selected>{$p['product_name']}</option>";
                    }
                    ?>
                </select>
                <h5 class="flex align-middle p-2 pl-2">Quantity</h5>
                <input type="number" name="quantity[]" class="border p-2 w-20" value="<?= $d['quantity'] ?>">
                <h5 class="flex align-middle p-2 pl-2">Discount</h5>
                <input type="number" name="discount_percent[]" class="border p-2 w-20" value="<?= $d['discount_percent'] ?>">
            </div>
            <?php
        }
    }
    ?>

    <!-- EMPTY ROWS FOR ADDITIONAL PRODUCTS -->
    <?php
    $maxProducts = 4;
    $existingCount = count($orderDetails);
    $newRows = $maxProducts - $existingCount;
    for ($i = 0; $i < $newRows; $i++) {
        ?>
        <div class="flex gap-2 mb-2">
            <select name="product_id[]" class="border p-2">
                <option value="">Select Product</option>
                <?php
                foreach ($products as $p) {
                    echo "<option value='{$p['id']}'>{$p['product_name']}</option>";
                }
                ?>
            </select>
            <h5 class="flex align-middle p-2 pl-2">Quantity</h5>
            <input type="number" name="quantity[]" class="border p-2 w-20">
            <h5 class="flex align-middle p-2 pl-2">Discount</h5>
            <input type="number" name="discount_percent[]" class="border p-2 w-20">
        </div>
        <?php
    }
    ?>

    <button type="submit" class="bg-green-600 text-white p-2 rounded mt-4">
        Save Order
    </button>

    <a href="list_orders.php" class="bg-gray-500 text-white p-2 rounded mt-4 inline-block ml-2">
        Cancel
    </a>

    <div class="mt-6">
        <a href="../index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Home</a>
    </div>
</form>

</body>
</html>
