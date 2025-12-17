<?php
$name = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {
    $name = $_GET['name'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>GET Example</title>
</head>
<body>
    <h1>Greeting Form</h1>

    <form method="GET" action="">
        Enter your name: 
        <input type="text" name="name" placeholder="Your name">
        <button type="submit">Submit</button>
    </form>

    <?php if ($name): ?>
        <h2>Hello, <?= $name ?>!</h2>
    <?php endif; ?>
</body>
</html>
