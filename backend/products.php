<?php
require_once '../config/database.php';

// Lấy danh sách sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT * FROM products");
    $products = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($products);
}

// Thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $inventory = $_POST['inventory'];
    $conn->query("INSERT INTO products (name, price, inventory) VALUES ('$name', '$price', '$inventory')");
    echo json_encode(["status" => "success"]);
}
?>
