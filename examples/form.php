<form method="POST" action="">
    Name: <input type="text" name="name">
    Age: <input type="number" name="age">
    Hobbies: <input type="text" name="hobbies">
    <button type="submit">Submit</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? 'Guest';
    $age = $_POST['age'] ?? 'unknown age';
    $hobbies = $_POST['hobbies'] ?? 'no hobbies';
    echo "Hello, $name!" . PHP_EOL;
    echo "You are $age years old." . PHP_EOL;
    echo "Your hobbies are: $hobbies." . PHP_EOL;
}
?>
