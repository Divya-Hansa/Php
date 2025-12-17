<?php
require_once "databaseCalls.php";
$orders = getOrders($conn);
?>

<!DOCTYPE html>
<html>
<head>
<title>Orders List</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="container mx-auto py-12 bg-blue-100">

<h2 class="text-2xl font-bold mb-4">Orders List</h2>

<table class="border-collapse border border-black-400 w-full pb-6">
    <thead>
        <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-white border-collapse">
            <th class="border p-2">ID</th>
            <th class="border p-2">Customer</th>
            <th class="border p-2">Date</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($orders as $o): ?>
        <tr>
            <td class="border p-2"><?= $o['id'] ?></td>
            <td class="border p-2"><?= $o['customer_name'] ?></td>
            <td class="border p-2"><?= $o['created_at'] ?></td>
            <td class="border p-2"><?= $o['status'] ?></td>
            <td class="border p-2">
                <div class="flex space-x-2">
                <a href="createOrEditOrder.php?action=edit&id=<?= $o['id'] ?>" class="bg-yellow-500 text-white p-1 rounded">
                    Edit
                </a>
               <form method="POST" action="delete_handler.php" 
                    onsubmit="return confirm('Are you sure you want to delete this order?');">
                    <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
                    <button type="submit" class="bg-red-500 text-white p-1 rounded">
                        Delete
                    </button>
                </form>

        </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="createOrEditOrder.php?action=create" class="bg-green-600 text-white p-2 rounded mb-4 inline-block">
    Create New Order
</a>

<div>
    <a href="../index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Home</a>
</div>

</body>
</html>
