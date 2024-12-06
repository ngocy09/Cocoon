<?php
require_once '../config/database.php';

// Lấy danh sách tồn kho
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT * FROM inventory");
    $inventory = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($inventory);
}

// Thêm một mục tồn kho mới
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $conn->query("INSERT INTO inventory (product_id, quantity) VALUES ('$product_id', '$quantity')");
    echo json_encode(["status" => "success"]);
}

// Cập nhật tồn kho
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $quantity = $data['quantity'];
    $conn->query("UPDATE inventory SET quantity = '$quantity' WHERE id = '$id'");
    echo json_encode(["status" => "success"]);
}

// Xóa một mục tồn kho
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $conn->query("DELETE FROM inventory WHERE id = '$id'");
    echo json_encode(["status" => "success"]);
}
?>
