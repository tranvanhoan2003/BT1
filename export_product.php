<?php
require 'vendor/autoload.php';
include 'connect.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Nhận ID sản phẩm cần xuất
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Không tìm thấy ID sản phẩm.");
}

// Truy vấn sản phẩm kèm tên kho
$sql = "SELECT p.*, w.name AS warehouse_name
        FROM product AS p
        LEFT JOIN warehouse AS w ON p.warehouse_id = w.id
        WHERE p.id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    die("Không tìm thấy sản phẩm.");
}

// Tạo file Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Tiêu đề phiếu
$sheet->setCellValue('A1', 'PHIẾU NHẬP KHO');
$sheet->mergeCells('A1:H1');
$sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

// Thông tin sản phẩm & kho
$sheet->setCellValue('A3', 'Tên hàng hóa:')->setCellValue('B3', $product['product_name']);
$sheet->setCellValue('A4', 'Mã hàng hóa:')->setCellValue('B4', $product['product_code']);
$sheet->setCellValue('A5', 'Đơn giá nhập:')->setCellValue('B5', $product['import_price']);
$sheet->setCellValue('A6', 'Số lượng:')->setCellValue('B6', $product['quantity']);
$sheet->setCellValue('A7', 'Đơn vị:')->setCellValue('B7', $product['unit']);
$sheet->setCellValue('A8', 'Thành tiền (trước VAT):')->setCellValue('B8', $product['total_price']);
$sheet->setCellValue('A9', 'Đơn giá bán (trước VAT):')->setCellValue('B9', $product['sale_price']);
$sheet->setCellValue('A10', 'VAT (%):')->setCellValue('B10', $product['vat']);
$sheet->setCellValue('A11', 'Kho nhập:')->setCellValue('B11', $product['warehouse_name']);
$sheet->setCellValue('A12', 'Vị trí:')->setCellValue('B12', $product['position']);

// Giãn cột
foreach (range('A', 'H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Xuất file
$filename = 'phieu_nhap_kho_' . $product['product_code'] . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
