<?php

$type = $_GET['type'] ?? '';
$id   = $_GET['id'] ?? '';

$allowed = ['people', 'films', 'planets', 'species', 'starships'];

if (!in_array($type, $allowed) || !$id) {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

$url = "https://swapi.info/api/$type/$id";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$response = curl_exec($ch);

if ($response === false) {
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}

echo $response;
