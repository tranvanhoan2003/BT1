<?php
include 'connect.php'; // file kết nối CSDL
// file xóa sản phẩm nếu có

// Truy vấn dữ liệu từ bảng product
$sql = "SELECT p.*, w.name as warehouse_name FROM product p 
        JOIN warehouse w ON p.warehouse_id = w.id";
$result = $conn->query($sql);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa sản phẩm theo id
    $sql = "DELETE FROM product WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Xóa thành công, chuyển về trang danh sách
        header("Location: product_list.php");
        exit();
    } else {
        echo "Lỗi khi xóa sản phẩm: " . $conn->error;
    }
} else {
    // echo "Không tìm thấy sản phẩm cần xóa!";
}
$conn->close();


?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="mb-4">Danh sách sản phẩm</h2>
    <a href="index.php" class="btn btn-success mb-3">Thêm mới sản phẩm</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên hàng hóa</th>
                <th>Mã hàng hóa</th>
                <th>Đơn giá nhập</th>
                <th>Số lượng</th>
                <th>Đơn vị</th>
                <th>Thành tiền</th>
                <th>Đơn giá bán</th>
                <th>VAT</th>
                <th>Kho</th>
                <th>Vị trí</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['product_code']; ?></td>
                    <td><?php echo number_format($row['import_price']); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['unit']; ?></td>
                    <td><?php echo number_format($row['total_price']); ?></td>
                    <td><?php echo number_format($row['sale_price']); ?></td>
                    <td><?php echo $row['vat']; ?>%</td>
                    <td><?php echo $row['warehouse_name']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td>
                        <a href="index.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>

                        <a href="product_list.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
                    </td>
                </tr>
            <?php }
            } else {
                echo "<tr><td colspan='11' class='text-center'>Chưa có dữ liệu</td></tr>";
            } ?>
        </tbody>
    </table>
</body>
</html>

