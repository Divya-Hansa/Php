<?php
require_once "databaseCalls.php";

$orderDetails = getAllOrderDetails($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="container mx-auto py-10">

<h2 class="text-2xl font-bold mb-6">Edit Order Details</h2>

<table class="border-collapse border border-gray-400 w-full">
    <thead>
        <tr class="bg-gray-200">
            <th class="border p-2">Order ID</th>
            <th class="border p-2">Customer</th>
            <th class="border p-2">Product</th>
            <th class="border p-2">Quantity</th>
            <th class="border p-2">Discount (%)</th>
            <th class="border p-2">Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($orderDetails as $d): ?>
        <tr>
            <form method="POST" action="EditOrderDetailsHandler.php">
                <td class="border p-2"><?= $d['order_id'] ?></td>
                <td class="border p-2"><?= $d['customer_name'] ?></td>
                <td class="border p-2"><?= $d['product_name'] ?></td>

                <td class="border p-2">
                    <input type="number"
                           name="quantity"
                           value="<?= $d['quantity'] ?>"
                           class="border p-1 w-20">
                </td>

                <td class="border p-2">
                    <input type="number"
                           name="discount_percent"
                           value="<?= $d['discount_percent'] ?>"
                           class="border p-1 w-20">
                </td>

                <td class="border p-2 text-center">
                    <input type="hidden" name="detail_id" value="<?= $d['id'] ?>">
                    <button type="submit"
                            class="bg-blue-600 text-white px-3 py-1 rounded">
                        Update
                    </button>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="list_orders.php"
   class="inline-block mt-6 bg-gray-600 text-white px-4 py-2 rounded">
    Back to Orders
</a>

</body>
</html>
