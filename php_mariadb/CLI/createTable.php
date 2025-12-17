<?php 
$host = "localhost";
$user = "dbuser";
$pass = "pass@123";
$db = "phptest";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
};

$sqlQueries = [
    "categories"=>"CREATE TABLE IF NOT EXISTS categories (
    id INT(10) PRIMARY KEY,
    category_name VARCHAR(30),
    category_description VARCHAR(100),
    status BOOLEAN DEFAULT TRUE)
    ", 
    "products"=>"CREATE TABLE IF NOT EXISTS products (
    id INT(10) PRIMARY KEY,
    category_id INT(10),
    product_name VARCHAR(30),
    product_description VARCHAR(100),
    product_price INT(10),
    status BOOLEAN DEFAULT TRUE)
    ",
    "orders"=>"CREATE TABLE IF NOT EXISTS orders (
    id INT(10) PRIMARY KEY,
    customer_name VARCHAR(30),
    customer_address VARCHAR(50),
    customer_email VARCHAR(30),
    customer_phone VARCHAR(10) NOT NULL,
    status VARCHAR(15) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL)
    ",
    "order_details"=>"CREATE TABLE IF NOT EXISTS order_details (
    id INT(10) PRIMARY KEY,
    order_id INT(10),
    product_id INT(10),
    quantity INT(10),
    discount_percent INT(2) NOT NULL)"
];

foreach ($sqlQueries as $tableName =>$sql){
    if($conn->query($sql) === TRUE){
        echo "Table created: {$tableName}<br>";
    }
    else{
        echo "Error" . $conn->error ."<br>";
    }
}
$conn->close();
?>
