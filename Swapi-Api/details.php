<?php
$type = $_GET['type'] ?? '';
$id   = $_GET['id'] ?? '';

if (!$type || !$id) {
    die("Invalid request");
}

$_GET['type'] = $type;
$_GET['id']   = $id;

// Call API internally
ob_start();
require __DIR__ . "/api/details.php";
$response = ob_get_clean();

$item = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h3 class="mb-4"><?php echo $item['name'] ?? $item['title']; ?></h3>

  <ul class="list-group">
    <?php foreach ($item as $key => $value): ?>
    <li class="list-group-item">
        <strong><?php echo ucfirst(str_replace('_', ' ', $key)); ?>:</strong>
        <?php
        if (is_array($value)) {
            $names = [];
            foreach ($value as $v) {
                if (filter_var($v, FILTER_VALIDATE_URL)) {
                    $related = json_decode(file_get_contents($v), true);
                    $names[] = $related['name'] ?? $related['title'] ?? $v;
                } else {
                    $names[] = $v;
                }
            }
            echo implode(', ', $names);
        } else {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                $related = json_decode(file_get_contents($value), true);
                echo $related['name'] ?? $related['title'] ?? $value;
            } else {
                echo $value;
            }
        }
        ?>
    </li>
<?php endforeach; ?>

  </ul>

  <a href="list.php?type=<?php echo $type; ?>" class="btn btn-secondary mt-4">Back</a>
</div>

</body>
</html>
