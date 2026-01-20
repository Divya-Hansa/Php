<?php
$type = $_GET['type'] ?? '';

$allowed = ['people', 'films', 'planets', 'species', 'starships'];
if (!in_array($type, $allowed)) {
    echo json_encode(['results' => []]);
    exit;
}

$url = "https://swapi.info/api/$type";
$data = file_get_contents($url);

echo $data;
