<?php
include 'connect.php';

// Lấy id nếu có (từ nút Sửa)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;

if ($id > 0) {
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// Xử lý Submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_code = $_POST['product_code'];
    $import_price = $_POST['import_price'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $total_price = $_POST['total_price'];
    $sale_price = $_POST['sale_price'];
    $vat = $_POST['vat'];
    $warehouse_id = $_POST['warehouse_id'];
    $position = $_POST['position'];

    if ($id > 0) {
        // Cập nhật
        $update_sql = "UPDATE product SET 
            product_name='$product_name', 
            product_code='$product_code', 
            import_price='$import_price', 
            quantity='$quantity', 
            unit='$unit',
            total_price='$total_price',
            sale_price='$sale_price',
            vat='$vat',
            warehouse_id='$warehouse_id',
            position='$position'
            WHERE id = $id";

        if ($conn->query($update_sql) === TRUE) {
            $last_id = $id;
            echo "<script>
                if(confirm('Bạn có muốn xuất file không?')) {
                    window.location.href = 'export_product.php?id=$last_id';
                    // window.location.href = 'product_list.php';
                } else {
                    window.location.href = 'product_list.php';
                }
                    
            </script>";
        } else {
            echo "Lỗi cập nhật: " . $conn->error;
        }
    } else {
        // Thêm mới
        $insert_sql = "INSERT INTO product (product_name, product_code, import_price, quantity, unit, total_price, sale_price, vat, warehouse_id, position)
        VALUES ('$product_name', '$product_code', '$import_price', '$quantity', '$unit', '$total_price', '$sale_price', '$vat', '$warehouse_id', '$position')";

        if ($conn->query($insert_sql) === TRUE) {
            $last_id = $conn->insert_id;
            // Hỏi có xuất file không bằng confirm
            echo "<script>
                if(confirm('Bạn có muốn xuất file không?')) {
                    window.location.href = 'export_product.php?id=$last_id';
                    // window.location.href = 'product_list.php';
                } else {
                    window.location.href = 'product_list.php';
                }
                    
            </script>";
            exit();
        } else {
            echo "Lỗi thêm mới: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Quản lý Sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h3><?php echo $id > 0 ? 'Cập nhật sản phẩm' : 'Thêm mới sản phẩm'; ?></h3>

    <form class="row g-3" method="POST" action="">
        <div class="col-12">
            <label class="form-label">Tên Hàng Hóa</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo $product['product_name'] ?? ''; ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Mã Hàng Hóa</label>
            <input type="text" class="form-control" name="product_code" value="<?php echo $product['product_code'] ?? ''; ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Đơn Giá Nhập</label>
            <input type="number" class="form-control" name="import_price" value="<?php echo $product['import_price'] ?? ''; ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Số Lượng</label>
            <input type="number" class="form-control" name="quantity" value="<?php echo $product['quantity'] ?? ''; ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Đơn Vị</label>
            <input type="text" class="form-control" name="unit" value="<?php echo $product['unit'] ?? ''; ?>">
        </div>
        <div class="col-12">
            <label class="form-label">Thành Tiền (trước VAT)</label>
            <input type="text" class="form-control" name="total_price" value="<?php echo $product['total_price'] ?? ''; ?>">
        </div>
        <div class="col-12">
            <label class="form-label">Đơn Giá Bán (trước VAT)</label>
            <input type="text" class="form-control" name="sale_price" value="<?php echo $product['sale_price'] ?? ''; ?>">
        </div>
        <div class="col-12">
            <label class="form-label">VAT</label>
            <input type="number" class="form-control" name="vat" value="<?php echo $product['vat'] ?? ''; ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Chọn Kho</label>
            <select name="warehouse_id" class="form-select" required>
                <option value="">Chọn kho...</option>
                <?php
                $sql_warehouse = "SELECT id, name FROM warehouse";
                $result_warehouse = $conn->query($sql_warehouse);
                if ($result_warehouse->num_rows > 0) {
                    while ($row_wh = $result_warehouse->fetch_assoc()) {
                        $selected = (isset($product['warehouse_id']) && $product['warehouse_id'] == $row_wh['id']) ? 'selected' : '';
                        echo "<option value='{$row_wh['id']}' $selected>{$row_wh['name']}</option>";
                    }
                } else {
                    echo "<option value=''>Chưa có kho nào</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Vị Trí</label>
            <input type="text" class="form-control" name="position" value="<?php echo $product['position'] ?? ''; ?>">
        </div>

        <div class="col-12 d-flex">
            <button type="submit" class="btn btn-primary me-2"><?php echo $id > 0 ? 'Cập nhật' : 'Thêm mới'; ?></button>
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
            <a href="product_list.php" class="btn btn-success me-2">Danh sách sản phẩm</a>
            <?php if ($id > 0) : ?>
                <a href="index.php" class="btn btn-warning">Hủy sửa</a>
            <?php endif; ?>
        </div>
    </form>
</body>
</html>
