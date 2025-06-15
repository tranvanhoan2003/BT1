<?php
$servername = "localhost"; // hoặc IP server
$username = "root";        // user của MySQL
$password = "18082003";            // mật khẩu MySQL (nếu có)
$database = "quanlykho"; // tên database của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// echo "Kết nối thành công!";
?>
