<?php
$type = $_GET['type'] ?? '';
if (!$type) die("Invalid request");

$_GET['type'] = $type;

ob_start();
require __DIR__ . "/api/list.php";
$response = ob_get_clean();

$data = json_decode($response, true);
$items = is_array($data) ? $data : [];
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo ucfirst($type); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #searchInput {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h3 class="mb-4"><?php echo ucfirst($type); ?></h3>
  <h5><?php echo count($items); ?> items found</h5>

  <?php if (empty($items)): ?>
    <div class="alert alert-warning">No data found</div>
  <?php else: ?>
    <!-- Search bar -->
    <input type="text" id="searchInput" class="form-control" placeholder="Search <?php echo ucfirst($type); ?>...">

    <ul class="list-group" id="itemsList">
      <?php foreach ($items as $item): ?>
        <?php
          $urlParts = explode('/', trim($item['url'], '/'));
          $id = end($urlParts);
        ?>
        <li class="list-group-item">
          <a href="details.php?type=<?php echo $type; ?>&id=<?php echo $id; ?>">
            <?php echo $item['name'] ?? $item['title']; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <a href="index.php" class="btn btn-secondary mt-4">Back</a>
</div>

<script>
// search filter
const searchInput = document.getElementById('searchInput');
const itemsList = document.getElementById('itemsList');
searchInput.addEventListener('input', function() {
  const filter = this.value.toLowerCase();
  const items = itemsList.getElementsByTagName('li');
  for (let i = 0; i < items.length; i++) {
    const text = items[i].textContent || items[i].innerText;
    items[i].style.display = text.toLowerCase().includes(filter) ? '' : 'none';
  }
});
</script>

</body>
</html>
