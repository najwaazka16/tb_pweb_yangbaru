<?php
// add_to_cart.php
$conn = new mysqli('localhost', 'username', 'password', 'database');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    $result = $conn->query("SELECT * FROM cart WHERE product_id = $productId");

    if ($result->num_rows > 0) {
        $conn->query("UPDATE cart SET quantity = quantity + $quantity WHERE product_id = $productId");
    } else {
        $conn->query("INSERT INTO cart (product_id, quantity) VALUES ($productId, $quantity)");
    }
}

$conn->close();
?>
