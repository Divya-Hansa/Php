<?php require'databaseCalls.php';
$orderDetails = getOrdersDetails($conn, null);
$conn->close();
 ?>
<!DOCTYPE html>
<html>  
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>List of orders</title>
</head>
<body class="bg-blue-100 p-2">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center my-6 gap-6">
            <h1 class="text-3xl font-bold text-gray-800">Orders Details</h1>
                <table class="w-auto justify-center mx-auto bg-white p-6">
                    <thead class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-lg font-bold"> ID</th>
                            <th class="px-6 py-3 text-lg font-bold">Order ID</th>
                            <th class="px-6 py-3 text-lg font-bold">Product Id</th>
                            <th class="px-6 py-3 text-lg font-bold">Product Name</th>
                            <th class="px-6 py-3 text-lg font-bold">Quantity</th>
                            <th class="px-6 py-3 text-lg font-bold">Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orderDetails as $order): ?>
                            <tr>
                                <td class="border px-6 py-4 text-center"><?php echo $order['id']; ?></td>
                                <td class="border px-6 py-4 text-center"><?php echo $order['order_id']; ?></td>
                                <td class="border px-6 py-4 text-center"><?php echo $order['product_id']; ?></td>
                                <td class="border px-6 py-4 text-center"><?php echo $order['product_name']; ?></td>
                                <td class="border px-6 py-4 text-center"><?php echo $order['quantity']; ?></td>
                                <td class="border px-6 py-4 text-center"><?php echo $order['discount_percent']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($orderDetails)): ?>
                            <tr>
                                <td colspan="4" class="border px-6 py-4 text-center">No orders found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <div class="text-center mt-12">
                <a href="../index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
