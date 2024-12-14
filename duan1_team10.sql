-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 03, 2024 lúc 08:07 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan1_team10`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_variant_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `deleted_at`, `created_at`) VALUES
(1, 'Balo Du Lịch', NULL, '2024-11-16 19:32:18'),
(2, 'Balo Thể Thao', NULL, '2024-11-16 19:32:18'),
(3, 'Balo Thời Trang Công Sở', NULL, '2024-11-16 19:32:18'),
(4, 'Balo Học Sinh', NULL, '2024-11-16 19:32:18'),
(5, 'Balo Laptop', NULL, '2024-11-16 19:32:18'),
(6, 'Balo đi biển', '2024-11-21 13:36:57', '2024-11-16 19:38:48'),
(8, 'Balo Leo Núi', '2024-11-30 12:40:36', '2024-11-16 19:57:17'),
(9, 'Balo Thú Cưng', '2024-11-21 13:36:51', '2024-11-16 19:57:44'),
(10, 'Balo Adidas', '2024-11-21 13:36:47', '2024-11-16 19:57:53'),
(11, 'Balo Máy Ảnh', NULL, '2024-11-23 19:18:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id`, `name`, `deleted_at`) VALUES
(1, 'Red', NULL),
(2, 'Blue', NULL),
(3, 'Green', NULL),
(4, 'Black', NULL),
(5, 'White', NULL),
(6, 'Yellow', NULL),
(7, 'Pink', NULL),
(8, 'Gray', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, 1, 'Sản phẩm tốt, đẹp', '2024-11-19 12:54:39', '2024-11-23 12:30:24', NULL),
(2, 1, 9, 'Balo bền, dùng được lâu', '2024-11-19 12:54:57', '2024-11-23 12:31:16', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `discount_codes`
--

INSERT INTO `discount_codes` (`id`, `code`, `discount_percent`, `start_date`, `expiry_date`, `is_active`, `deleted_at`) VALUES
(1, 'BLACKFRIDAYT12', 20.00, '2024-12-29', '0000-00-00', 1, '2024-11-24 12:14:56'),
(2, 'SUPERSALESGIANGSINH', 25.00, '2024-12-24', '2024-12-25', 1, NULL),
(3, 'BLACKFRIDAYST12', 20.00, '2024-12-30', '0000-00-00', 0, '2024-11-24 12:29:45'),
(4, 'CHAODONNAMMOI', 25.00, '2025-01-01', '2025-01-03', 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `discount_code_id` int(11) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status_id`, `total_price`, `discount_code_id`, `payment_method`, `shipping_address`, `customer_name`, `customer_email`, `customer_phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 200000.00, NULL, 'Credit Card', '123 Balo Street, HCM', 'Nguyen Van A', 'nguyenvana@example.com', '0901234567', '2024-11-20 03:00:00', '2024-11-20 03:30:00', NULL),
(2, 4, 2, 350000.00, NULL, 'Cash on Delivery', '456 Backpack Road, HN', 'Tran Thi B', 'tranb@example.com', '0912345678', '2024-11-19 05:15:00', '2024-11-19 05:45:00', NULL),
(3, 1, 3, 500000.00, NULL, 'Bank Transfer', '789 Travel Lane, DN', 'Le Thi C', 'lethic@example.com', '0931234567', '2024-11-18 07:20:00', '2024-11-18 07:45:00', NULL),
(4, NULL, NULL, 0.00, NULL, 'momo', 'số8 trịnh văn bô phương canh từ liêm hà nội', 'hau', 'hau@gmail.com', '0388044281', '2024-12-03 15:45:56', '2024-12-03 15:45:56', NULL),
(33, NULL, NULL, 0.00, NULL, 'bank', 'số8 trịnh văn bô phương canh từ liêm hà nội', 'le xuan hau', 'hau12@gmail.com', '0388044381', '2024-12-03 16:35:19', '2024-12-03 16:35:19', NULL),
(34, NULL, NULL, 0.00, NULL, 'bank', 'số8 trịnh văn bô phương canh từ liêm hà nội', 'le xuan hau', 'hau12@gmail.com', '0388044381', '2024-12-03 17:03:36', '2024-12-03 17:03:36', NULL),
(36, NULL, NULL, 0.00, NULL, 'bank', '', '', '', '', '2024-12-03 17:59:37', '2024-12-03 17:59:37', NULL),
(37, NULL, NULL, 0.00, NULL, 'bank', '', '', '', '', '2024-12-03 18:07:37', '2024-12-03 18:07:37', NULL),
(38, NULL, NULL, 0.00, NULL, 'cash', 'số8 trịnh văn bô phương canh từ liêm hà nội', 'le xuan hau', 'hau123@gmail.com', '0388044381', '2024-12-03 18:21:49', '2024-12-03 18:21:49', NULL),
(39, NULL, NULL, 0.00, NULL, 'bank', 'số8 trịnh văn bô phương canh từ liêm hà nội', 'le xuan hau', 'hau1000@gmail.com', '038804428', '2024-12-03 18:43:29', '2024-12-03 18:43:29', NULL),
(40, NULL, NULL, 0.00, NULL, 'bank', 'số8 trịnh văn bô phương canh từ liêm hà nội', 'hau', 'hau1002345@gmail.com', '0388044281', '2024-12-03 18:44:49', '2024-12-03 18:44:49', NULL),
(41, NULL, NULL, 0.00, NULL, 'bank', 'số8 trịnh văn bô phương canh từ liêm hà nội', 'hau', 'hau1000@gmail.com', '0388044381', '2024-12-03 18:59:02', '2024-12-03 18:59:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_variant_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_variant_id`, `quantity`, `price`) VALUES
(1, 1, 2, 1, 150000.00),
(2, 1, 3, 1, 50000.00),
(3, 2, 4, 2, 175000.00),
(4, 3, 5, 1, 250000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `shipping_status` varchar(50) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `payment_status`, `shipping_status`, `deleted_at`) VALUES
(1, 'Chờ Xử Lý', 'Chưa Thanh Toán', 'Chưa Giao Hàng', NULL),
(2, 'Đã Thanh Toán', 'Đã Thanh Toán', 'Chưa Giao Hàng', NULL),
(3, 'Đang Vận Chuyển', 'Đã Thanh Toán', 'Đang Giao Hàng', NULL),
(4, 'Hoàn Thành', 'Đã Thanh Toán', 'Đã Giao Hàng', NULL),
(5, 'Đã Hủy', 'Đã Hoàn Tiền', 'Chưa Giao Hàng', '2024-11-21 05:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `description`, `product_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Balo Du Lịch Chống Nước', 500000.00, NULL, 'product-06-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:35', '2024-11-26 13:18:35'),
(2, 2, 'Balo Thể Thao Adidas', 450000.00, NULL, 'product-05-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:36', '2024-11-26 13:18:36'),
(3, 3, 'Balo Thời Trang Nữ', 300000.00, NULL, 'product-04-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:38', '2024-11-26 13:18:38'),
(4, 4, 'Balo Học Sinh Chống Gù', 250000.00, NULL, 'product-03-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:40', '2024-11-26 13:18:40'),
(5, 5, 'Balo Laptop Cao Cấp', 600000.00, NULL, 'product-20-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:41', '2024-11-26 13:18:41'),
(6, 1, 'Balo Du Lịch Đa Năng', 550000.00, NULL, 'product-20-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:42', '2024-11-26 13:18:42'),
(7, 2, 'Balo Thể Thao Nike', 420000.00, NULL, 'product-06-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:44', '2024-11-26 13:18:44'),
(8, 3, 'Balo Thời Trang Nam', 320000.00, NULL, 'product-05-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:45', '2024-11-26 13:18:45'),
(9, 4, 'Balo Học Sinh Siêu Nhẹ', 220000.00, NULL, 'product-04-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:47', '2024-11-26 13:18:47'),
(10, 5, 'Balo Laptop Thời Trang', 580000.00, NULL, 'product-20-270x300.jpg', '2024-11-09 11:58:59', '2024-11-26 13:18:48', '2024-11-26 13:18:48'),
(12, 3, 'Balo Đi Biển', 180000.00, 'Đẹp', '673c8b8f15019_0925ss0666-large-jpeg-1696388107298.webp', '2024-11-19 12:58:55', '2024-11-26 13:01:09', '2024-11-26 13:01:09'),
(13, 3, 'Balo Spiderman', 499000.00, 'Xấu', '6745bfac64786_5.jpg', '2024-11-26 12:31:40', '2024-11-26 13:01:12', '2024-11-26 13:01:12'),
(14, 3, 'Balo Ironman', 999000.00, 'Ngầu', '6745c689db4f2_3.4.jpg', '2024-11-26 13:00:57', '2024-11-26 13:01:30', '2024-11-26 13:01:30'),
(15, 3, 'Balo Thời Trang Công Sở', 148000.00, 'Xấu', '6745c9fa52ac3_5.6.jpg', '2024-11-26 13:15:38', '2024-11-26 13:18:51', '2024-11-26 13:18:51'),
(16, 5, 'Balo Dell', 299000.00, 'Đẹp', '6745cadb20d41_1.1.jpg', '2024-11-26 13:19:23', '2024-11-30 12:24:12', '2024-11-30 12:24:12'),
(17, 5, 'Balo Asus', 299000.00, 'dâpdjs', '6745caf1e57c4_5.3.jpg', '2024-11-26 13:19:45', '2024-12-03 14:43:45', '2024-12-03 14:43:45'),
(18, 1, 'Balo Thời Trang ', 30000000.00, 'dep', '674f188e6b01e_product-20-270x300.jpg', '2024-12-03 14:41:18', '2024-12-03 14:41:18', NULL),
(19, 2, 'Balo thể thao', 2000000.00, 'xau', '674f19479ca80_product-06-270x300.jpg', '2024-12-03 14:44:23', '2024-12-03 14:44:23', NULL),
(20, 4, 'Balo học sinh', 4000000.00, 'xau', '674f195fb4468_product-05-270x300.jpg', '2024-12-03 14:44:47', '2024-12-03 18:33:34', '2024-12-03 18:33:34'),
(21, 4, 'balo học sinh', 5000000.00, 'xau', '674f199bab381_product-04-270x300.jpg', '2024-12-03 14:45:47', '2024-12-03 14:45:47', NULL),
(22, 5, 'balo laptop', 3000000.00, 'xau', '674f4f17622d1_product-03-270x300.jpg', '2024-12-03 18:33:59', '2024-12-03 18:33:59', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size_id`, `color_id`, `quantity`, `deleted_at`) VALUES
(2, 1, 2, 2, 15, NULL),
(3, 1, 3, 3, 10, NULL),
(4, 2, 1, 4, 25, NULL),
(5, 2, 2, 5, 30, NULL),
(6, 2, 3, 1, 40, NULL),
(7, 3, 1, 6, 35, NULL),
(8, 3, 2, 7, 20, NULL),
(9, 3, 3, 8, 50, NULL),
(10, 4, 1, 2, 30, NULL),
(11, 4, 2, 3, 25, NULL),
(12, 4, 3, 4, 15, NULL),
(13, 5, 1, 1, 18, NULL),
(14, 5, 2, 2, 22, NULL),
(15, 5, 3, 3, 16, NULL),
(16, 5, 4, 4, 25, NULL),
(17, 6, 1, 5, 20, NULL),
(18, 6, 2, 6, 28, NULL),
(19, 6, 3, 7, 12, NULL),
(20, 6, 4, 8, 30, NULL),
(21, 7, 1, 1, 24, NULL),
(22, 7, 2, 3, 18, NULL),
(23, 7, 3, 5, 14, NULL),
(24, 7, 4, 7, 20, NULL),
(25, 8, 1, 2, 26, NULL),
(26, 8, 2, 4, 32, NULL),
(27, 8, 3, 6, 15, NULL),
(28, 8, 4, 8, 18, NULL),
(29, 9, 1, 1, 22, NULL),
(30, 9, 2, 2, 30, NULL),
(31, 9, 3, 3, 25, NULL),
(32, 9, 4, 4, 19, NULL),
(33, 10, 1, 5, 35, NULL),
(34, 10, 2, 6, 28, NULL),
(35, 10, 3, 7, 24, NULL),
(36, 10, 4, 8, 20, NULL),
(37, 1, 3, 4, 35, NULL),
(41, 1, 3, 8, 29, NULL),
(43, 1, 4, 6, 16, NULL),
(45, 1, 2, 7, 35, NULL),
(47, 2, 4, 3, 61, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `deleted_at`) VALUES
(0, 'User', NULL),
(1, 'Admin', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `namesize` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `namesize`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `fullname`, `username`, `email`, `password`, `avatar`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Nguyễn Văn A 2', 'nguyenvana', 'nguyenvana@example.com', 'hashed_password_1', NULL, 1, '2024-11-18 22:44:47', '2024-11-30 12:53:01', '2024-11-30 12:53:01'),
(4, 0, 'Lê Văn C 45', 'levanc234', 'levanc@example.com', 'hashed_password_3', NULL, 1, '2024-11-18 22:44:47', '2024-11-30 12:53:04', '2024-11-30 12:53:04'),
(8, 1, 'Hà Minh Duy', 'minhduy2910', 'minzy1235@gmail.com', '$2y$10$fff2Sfc4Zo3/AH2pccfBc.N5WKfZ/9uG/tLzaQa6gNcc72tIK8dLK', NULL, 1, '2024-11-19 10:25:53', '2024-11-30 12:52:54', NULL),
(9, 1, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$YBaSpvGnpnsPrxS27ArDQOe5G/1BcQFKAK1vnPGKj4VwYYtMW5tle', NULL, 0, '2024-11-26 11:49:06', '2024-11-30 12:46:13', NULL),
(13, 1, 'Hà Minh Duy', 'admin123', 'admin123@gmail.com', '$2y$10$xkcuN10wwuE28qNjkM.2/O7KSmm9kXonJiy1SXLVSnWmJA.ALp/1.', NULL, 1, '2024-11-26 11:55:24', '2024-11-26 11:55:24', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_variant_id` (`product_variant_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `discount_code_id` (`discount_code_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_variant_id` (`product_variant_id`);

--
-- Chỉ mục cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`discount_code_id`) REFERENCES `discount_codes` (`id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_variants_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`),
  ADD CONSTRAINT `product_variants_ibfk_3` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
