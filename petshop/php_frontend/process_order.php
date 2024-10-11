<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$data = json_encode([
    'user_id' => $user_id,
    'product_id' => $product_id,
    'quantity' => $quantity
]);

// URL del servidor Flask que corre en PyCharm
$url = 'http://localhost:5000/process_order'; // Cambia 'localhost' por la IP si es necesario

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
