-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 15, 2025 lúc 11:44 PM
-- Phiên bản máy phục vụ: 9.3.0
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlykho`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `import_price` decimal(15,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `total_price` decimal(15,2) DEFAULT NULL,
  `sale_price` decimal(15,2) DEFAULT NULL,
  `vat` decimal(5,2) DEFAULT NULL,
  `warehouse_id` int DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_code`, `import_price`, `quantity`, `unit`, `total_price`, `sale_price`, `vat`, `warehouse_id`, `position`) VALUES
(20, 'Iphone X', 'zzzfff', 1000.00, 11, 'chiếc', 1.00, 1000.00, 101.00, 1, 'tầng 2'),
(21, 'Iphone Xkkkkk', 'zzz', 1000.00, 1, 'chiếc', 1.00, 1000.00, 10.00, 1, 'tầng 2'),
(22, 'Iphone Xkkkkk', 'zzz', 1000.00, 1, 'chiếc', 1.00, 1000.00, 10.00, 1, 'tầng 2'),
(23, 'mmm', 'mmm', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(24, 'mmm', 'cc', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(25, 'mmm', 'â', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(26, 'mmm', 'kkkkk', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(27, 'mmm', 'xxxxx', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(29, 'mmm', 'cccc', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(30, 'mmm', 'aa', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(31, 'mmm', 'aa', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(32, 'mmm', 'ccvvv', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(33, 'mmm', 'ccvvv', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(34, 'mmm', 'ccvvv', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(35, 'mmm', 'ccvvv', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11'),
(36, 'mmm', 'ccvvv', 1234.00, 1, 'ff', 123.00, 234.00, 12.00, 1, '11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `location`) VALUES
(1, 'kho 1', 'hà nội');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Chỉ mục cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
