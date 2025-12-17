<?php
$host = "localhost";
$user = "dbuser";
$pass = "pass@123";
$db = "phptest";
$port = "3306";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$sqlInserts = [
    "categories" => 
        "INSERT IGNORE INTO categories (id, category_name, category_description, status) 
         VALUES (1, 'Electronics', 'Electronic gadgets and devices', 1),
                (2, 'Clothing', 'Apparel and garments', 1),
                (3, 'Stationery', 'Office and school supplies', 1),
                (4, 'Books', 'ebooks and printed books', 1);
        ",
    "products" => 
        "INSERT IGNORE INTO products (id, category_id, product_name, product_description, product_price, status) 
         VALUES (1, 1, 'Smartphone', 'Latest model smartphone', 699, 1),
                (2, 1, 'Laptop', 'High performance laptop', 999, 1),
                (3, 2, 'T-Shirt', '100% cotton t-shirt', 19, 1),
                (4, 2, 'Jeans', 'Denim jeans', 49, 1),
                (5, 3, 'Notebook', '200-page notebook', 5, 1),
                (6, 3, 'Pen Set', 'Set of 5 ballpoint pens', 10, 1),
                (7, 4, 'Novel', 'Bestselling fiction novel', 15, 1),
                (8, 4, 'Textbook', 'Academic textbook', 60, 1);
        ",
    "orders" => 
        "INSERT IGNORE INTO orders (id, customer_name, customer_address, customer_email, customer_phone, status) 
         VALUES (1, 'John Doe', '123 Main St', 'john.doe@example.com', '0909129101', 1),
                (2, 'Jane Smith', '456 Oak Ave', 'jane.smith@example.com', '9876543210', 1),
                (3, 'Hermoine Johnson', '789 Pine Rd', 'hermoine.johnson@example.com', '5551234567', 1);
        ",
    "order_details" => 
        "INSERT IGNORE INTO order_details (id, order_id, product_id, quantity, discount_percent) 
         VALUES (1, 1, 1, 1, 0),
                (2, 1, 3, 2, 10),
                (3, 2, 2, 1, 5),
                (4, 2, 4, 1, 0),
                (5, 3, 5, 3, 15),
                (6, 3, 6, 1, 0);
        ",
];

try {
    $conn = new mysqli($host, $user, $pass, $db, $port);

    foreach ($sqlInserts as $tableName => $sql) {
        $conn->query($sql);
        echo "Inserted data into: {$tableName}\n";
    }

} catch (mysqli_sql_exception $e) {
    echo "SQL Error: " . $e->getCode() ." " .$e->getMessage() . "\n";
}

$conn->close();
?>