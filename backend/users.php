<?php
require_once '../config/database.php';

// Lấy danh sách người dùng
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT users.*, roles.role_name FROM users 
                            INNER JOIN roles ON users.role_id = roles.id");
    $users = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($users);
}

// Thêm người dùng mới
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mã hóa mật khẩu
    $role_id = $_POST['role_id'];
    $conn->query("INSERT INTO users (username, password, role_id) VALUES ('$username', '$password', '$role_id')");
    echo json_encode(["status" => "success"]);
}

// Cập nhật người dùng
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $username = $data['username'];
    $role_id = $data['role_id'];
    $conn->query("UPDATE users SET username = '$username', role_id = '$role_id' WHERE id = '$id'");
    echo json_encode(["status" => "success"]);
}

// Xóa người dùng
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $conn->query("DELETE FROM users WHERE id = '$id'");
    echo json_encode(["status" => "success"]);
}
?>
