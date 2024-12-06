<?php
require_once '../config/database.php';

// Lấy danh sách các vai trò
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT * FROM roles");
    $roles = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($roles);
}

// Thêm vai trò mới
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role_name = $_POST['role_name'];
    $conn->query("INSERT INTO roles (role_name) VALUES ('$role_name')");
    echo json_encode(["status" => "success"]);
}

// Cập nhật vai trò
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $role_name = $data['role_name'];
    $conn->query("UPDATE roles SET role_name = '$role_name' WHERE id = '$id'");
    echo json_encode(["status" => "success"]);
}

// Xóa vai trò
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $conn->query("DELETE FROM roles WHERE id = '$id'");
    echo json_encode(["status" => "success"]);
}
?>
