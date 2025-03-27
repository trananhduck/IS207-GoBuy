-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 27, 2025 lúc 09:23 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gobuy`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_color`
--

CREATE TABLE `table_color` (
  `color_id` int(11) NOT NULL,
  `color_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_color`
--

INSERT INTO `table_color` (`color_id`, `color_name`) VALUES
(1, 'Đỏ'),
(2, 'Xanh dương'),
(3, 'Xanh lá'),
(4, 'Vàng'),
(5, 'Đen'),
(6, 'Trắng'),
(7, 'Tím'),
(8, 'Cam'),
(9, 'Hồng'),
(10, 'Nâu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_customer`
--

CREATE TABLE `table_customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `cust_province` int(11) NOT NULL,
  `cust_district` varchar(100) NOT NULL,
  `cust_address` text NOT NULL,
  `cust_s_name` varchar(100) NOT NULL,
  `cust_s_phone` varchar(50) NOT NULL,
  `cust_s_province` int(11) NOT NULL,
  `cust_s_district` varchar(100) NOT NULL,
  `cust_s_address` text NOT NULL,
  `cust_password` varchar(100) NOT NULL,
  `cust_token` text NOT NULL,
  `cust_datetime` varchar(100) NOT NULL,
  `cust_timestamp` varchar(100) NOT NULL,
  `cust_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_customer`
--

INSERT INTO `table_customer` (`cust_id`, `cust_name`, `cust_email`, `cust_phone`, `cust_province`, `cust_district`, `cust_address`, `cust_s_name`, `cust_s_phone`, `cust_s_province`, `cust_s_district`, `cust_s_address`, `cust_password`, `cust_token`, `cust_datetime`, `cust_timestamp`, `cust_status`) VALUES
(1, 'Nguyễn Văn A', 'vana@gmail.com', '0905123456', 1, 'ABC', '123 Đường Lê Lợi', 'Nguyễn Văn A', '0905123456', 29, 'ABC', '123 Đường Lê Lợi', '5f4dcc3b5aa765d61d8327deb882cf99', 'abc123token1', '2025-02-28 10:00:00', '1746031200', 1),
(2, 'Trần Thị B', 'anhduc9b1cva@gmail.com', '0914345678', 2, 'XYZ', '456 Đường Trần Hưng Đạo', 'Trần Thị B', '1234', 11, 'XYZ', 'DEF', '5f4dcc3b5aa765d61d8327deb882cf99', 'xyz456token2', '2025-02-28 10:10:00', '1746031800', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_customer_message`
--

CREATE TABLE `table_customer_message` (
  `customer_message_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `order_detail` text NOT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_end_category`
--

CREATE TABLE `table_end_category` (
  `ecat_id` int(11) NOT NULL,
  `ecat_name` text NOT NULL,
  `mcat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_end_category`
--

INSERT INTO `table_end_category` (`ecat_id`, `ecat_name`, `mcat_id`) VALUES
(1, 'Mũ & Phụ kiện đầu', 1),
(2, 'Kính râm', 1),
(3, 'Đồng hồ', 1),
(4, 'Dép', 2),
(5, 'Ủng', 2),
(6, 'Áo', 3),
(7, 'Áo thun', 3),
(8, 'Đồng hồ', 4),
(9, 'Kính râm', 4),
(11, 'Giày thể thao', 2),
(12, 'Dép', 6),
(13, 'Giày bệt', 6),
(14, 'Áo hoodie', 7),
(15, 'Áo khoác & Áo choàng', 7),
(16, 'Quần', 7),
(17, 'Quần jeans', 8),
(18, 'Quần jogger', 8),
(19, 'Quần short', 8),
(20, 'Áo thun', 9),
(21, 'Áo sơ mi thường', 9),
(22, 'Áo sơ mi công sở', 9),
(23, 'Áo polo', 9),
(24, 'Áo ba lỗ', 9),
(25, 'Giày thường', 2),
(26, 'Bé trai', 10),
(27, 'Bé gái', 10),
(28, 'Bé trai', 11),
(29, 'Bé gái', 11),
(30, 'Bé trai', 12),
(31, 'Bé gái', 12),
(32, 'Đầm', 7),
(33, 'Áo', 7),
(34, 'Áo thun & Áo ba lỗ', 7),
(35, 'Quần & Quần legging', 7),
(36, 'Đồ thể thao', 7),
(37, 'Quần áo ngoại cỡ', 7),
(38, 'Tất & Đồ bó chân', 7),
(39, 'Nước hoa', 3),
(40, 'Chăm sóc da', 3),
(41, 'Chăm sóc tóc', 3),
(42, 'Trang sức', 4),
(43, 'Chăm sóc mắt', 3),
(44, 'Trang điểm môi', 3),
(45, 'Chăm sóc mặt', 3),
(46, 'Bộ quà tặng', 3),
(47, 'Khăn choàng & Phụ kiện đầu', 4),
(48, 'Bộ nhiều món', 4),
(49, 'Phụ kiện khác', 4),
(50, 'Giày cao gót', 6),
(51, 'Giày sneaker', 6),
(52, 'Giày thể thao', 6),
(53, 'Ủng', 6),
(54, 'Giày thoải mái', 6),
(55, 'Dép & Giày thường', 6),
(56, 'Giày công sở', 2),
(57, 'Thắt lưng', 1),
(58, 'Bộ nhiều món', 1),
(59, 'Phụ kiện khác', 1),
(60, 'Túi xách', 4),
(61, 'Điện thoại & Phụ kiện', 14),
(62, 'Tai nghe', 14),
(63, 'An ninh & Giám sát', 14),
(64, 'Tivi & Thiết bị video', 14),
(65, 'GPS & Định vị', 14),
(66, 'Thiết bị âm thanh gia đình', 14),
(67, 'Linh kiện máy tính', 15),
(68, 'Máy tính & Máy tính bảng', 15),
(69, 'Phụ kiện laptop', 15),
(70, 'Máy in & Màn hình', 15),
(71, 'Linh kiện ngoài', 15),
(72, 'Thiết bị mạng', 15),
(73, 'Thiết bị & Dụng cụ y tế', 16),
(74, 'Chăm sóc răng miệng', 16),
(75, 'Chăm sóc mắt', 16),
(76, 'Vitamin & Thực phẩm bổ sung', 16),
(77, 'Chăm sóc trẻ em & em bé', 17),
(78, 'Đồ dùng gia đình', 17),
(79, 'Văn phòng phẩm & Gói quà', 17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_faq`
--

CREATE TABLE `table_faq` (
  `faq_id` int(11) NOT NULL,
  `faq_title` text NOT NULL,
  `faq_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_faq`
--

INSERT INTO `table_faq` (`faq_id`, `faq_title`, `faq_content`) VALUES
(1, 'Làm thế nào để tìm một sản phẩm?', '<h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><font color=\"#222222\" face=\"opensans, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif\"><span style=\"font-size: 15.7143px;\">Chúng tôi có rất nhiều sản phẩm tuyệt vời để bạn lựa chọn.</span></font></h3><h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><span style=\"font-size: 15.7143px; color: rgb(34, 34, 34); font-family: opensans, \"Helvetica Neue\", Helvetica, Helvetica, Arial, sans-serif;\">Mẹo 1: Nếu bạn đang tìm kiếm một sản phẩm cụ thể, hãy sử dụng hộp tìm kiếm từ khóa nằm ở đầu trang web. Chỉ cần nhập sản phẩm bạn đang tìm và chuẩn bị để ngạc nhiên!</span></h3><h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><font color=\"#222222\" face=\"opensans, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif\"><span style=\"font-size: 15.7143px;\">Mẹo 2: Nếu bạn muốn khám phá danh mục sản phẩm, hãy sử dụng Danh mục cửa hàng trong menu trên cùng và duyệt qua các danh mục yêu thích của bạn, nơi chúng tôi sẽ giới thiệu những sản phẩm tốt nhất trong từng danh mục.</span></font><br><br></h3>\r\n'),
(2, 'Chính sách hoàn trả của bạn là gì?', '<p><span style=\"color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: 14px; text-align: center;\">Bạn có 15 ngày để yêu cầu hoàn tiền sau khi đơn hàng của bạn được giao.</span><br></p>\r\n'),
(3, 'Tôi nhận được sản phẩm bị lỗi/hư hỏng, tôi có thể hoàn tiền không?', '<p>Nếu sản phẩm bạn nhận được bị lỗi hoặc hư hỏng, bạn có thể trả lại sản phẩm trong cùng điều kiện như khi bạn nhận được, với hộp và/hoặc bao bì gốc còn nguyên vẹn. Sau khi chúng tôi nhận được sản phẩm trả lại, chúng tôi sẽ kiểm tra và nếu sản phẩm được xác nhận là bị lỗi hoặc hư hỏng, chúng tôi sẽ xử lý hoàn tiền cùng với bất kỳ khoản phí vận chuyển nào phát sinh.<br></p>\r\n'),
(4, 'Khi nào không thể hoàn trả?', '<p class=\"a  \" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; line-height: 1.6; margin-bottom: 0.714286rem; padding: 0px; font-size: 14px; color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; background-color: rgb(250, 250, 250);\">Có một số trường hợp nhất định mà chúng tôi không thể hỗ trợ hoàn trả:</p><ol style=\"box-sizing: inherit; line-height: 1.6; margin-right: 0px; margin-bottom: 0px; margin-left: 1.25rem; padding: 0px; list-style-position: outside; color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(250, 250, 250);\"><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Yêu cầu hoàn trả được thực hiện sau thời gian quy định là 15 ngày kể từ khi giao hàng.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm đã qua sử dụng, bị hư hỏng hoặc không còn nguyên trạng như khi nhận được.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các danh mục sản phẩm cụ thể như đồ lót, nội y, tất và các sản phẩm quà tặng kèm.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm bị lỗi nhưng thuộc phạm vi bảo hành của nhà sản xuất.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các sản phẩm tiêu hao đã được sử dụng hoặc lắp đặt.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm có số sê-ri bị tẩy xóa hoặc mất.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Bất kỳ mặt hàng nào bị thiếu phụ kiện đi kèm như nhãn giá, tem mác, bao bì gốc, quà tặng kèm.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các sản phẩm dễ vỡ, liên quan đến vệ sinh.</li></ol>\r\n'),
(5, 'Những sản phẩm nào không thể hoàn trả?', '<p>Những sản phẩm không thể hoàn trả bao gồm:</p><p>Các sản phẩm xả kho có ghi rõ chính sách không hoàn trả<br></p><p>Khi trong điều kiện ưu đãi có ghi rõ rằng sản phẩm đó không thể hoàn trả.</p><p>Các sản phẩm thuộc các loại sau:</p><ul><li>Đồ lót</li><li>Nội y</li><li>Tất</li><li>Phần mềm</li><li>Album nhạc</li><li>Sách</li><li>Đồ bơi</li><li>Sản phẩm làm đẹp &amp; nước hoa</li><li>Vớ</li></ul><p>Ngoài ra, các sản phẩm tiêu hao đã sử dụng hoặc lắp đặt cũng không thể hoàn trả. Điều này phù hợp với Luật bảo vệ người tiêu dùng về các sản phẩm không được hoàn trả.<br></p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_mid_category`
--

CREATE TABLE `table_mid_category` (
  `mcat_id` int(11) NOT NULL,
  `mcat_name` text NOT NULL,
  `tcat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_mid_category`
--

INSERT INTO `table_mid_category` (`mcat_id`, `mcat_name`, `tcat_id`) VALUES
(1, 'Phụ kiện nam', 1),
(2, 'Giày nam', 1),
(3, 'Sản phẩm làm đẹp', 2),
(4, 'Phụ kiện', 2),
(6, 'Giày', 2),
(7, 'Quần áo', 2),
(8, 'Quần', 1),
(9, 'Áo thun & Áo sơ mi', 1),
(10, 'Quần áo', 3),
(11, 'Giày', 3),
(12, 'Phụ kiện', 3),
(14, 'Thiết bị điện tử', 4),
(15, 'Máy tính', 4),
(16, 'Sức khỏe', 5),
(17, 'Đồ gia dụng', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_order`
--

CREATE TABLE `table_order` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `size` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `payment_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_page`
--

CREATE TABLE `table_page` (
  `id` int(11) NOT NULL,
  `about_title` text NOT NULL,
  `about_content` text NOT NULL,
  `about_banner` text NOT NULL,
  `about_meta_title` text NOT NULL,
  `faq_title` text NOT NULL,
  `faq_banner` text NOT NULL,
  `faq_meta_title` text NOT NULL,
  `contact_title` text NOT NULL,
  `contact_banner` text NOT NULL,
  `contact_meta_title` text NOT NULL,
  `pgallery_title` text NOT NULL,
  `pgallery_banner` text NOT NULL,
  `pgallery_meta_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_page`
--

INSERT INTO `table_page` (`id`, `about_title`, `about_content`, `about_banner`, `about_meta_title`, `faq_title`, `faq_banner`, `faq_meta_title`, `contact_title`, `contact_banner`, `contact_meta_title`, `pgallery_title`, `pgallery_banner`, `pgallery_meta_title`) VALUES
(1, 'About Us', 'abcdefghiklm', 'about-banner.jpg', 'About Us', 'FAQ', 'fag-banner.jpg', 'FAQ', 'Liên hệ', 'contact-banner.jpg', 'Liên hệ', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_payment`
--

CREATE TABLE `table_payment` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `txnid` varchar(255) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `card_number` varchar(50) NOT NULL,
  `card_cvv` varchar(10) NOT NULL,
  `card_month` varchar(10) NOT NULL,
  `card_year` varchar(10) NOT NULL,
  `bank_transaction_info` text NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `shipping_status` varchar(20) NOT NULL,
  `payment_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `table_payment`
--

INSERT INTO `table_payment` (`id`, `customer_id`, `customer_name`, `customer_email`, `payment_date`, `txnid`, `paid_amount`, `card_number`, `card_cvv`, `card_month`, `card_year`, `bank_transaction_info`, `payment_method`, `payment_status`, `shipping_status`, `payment_id`) VALUES
(1, 1, 'Nguyễn Văn A', 'vana@gmail.com', '2025-02-28 11:00:00', 'TXN123456A', 500000.00, '4111111111111111', '123', '02', '2028', 'Bank XYZ - Successful', 'Bank Deposit', 'Completed', 'Pending', 'PAYID123A'),
(2, 2, 'Trần Thị B', 'anhduc9b1cva@gmail.com', '2025-02-28 11:15:00', 'TXN789101B', 750000.00, '5555555555554444', '456', '05', '2029', 'Bank ABC - Successful', 'Bank Deposit', 'Completed', 'Completed', 'PAYID456B');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_photo`
--

CREATE TABLE `table_photo` (
  `id` int(11) NOT NULL,
  `caption` text NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_photo`
--

INSERT INTO `table_photo` (`id`, `caption`, `photo`) VALUES
(1, 'Photo 1', 'photo-1.jpg'),
(2, 'Photo 2', 'photo-2.jpg'),
(3, 'Photo 3', 'photo-3.jpg'),
(4, 'Photo 4', 'photo-4.jpg'),
(5, 'Photo 5', 'photo-5.jpg'),
(6, 'Photo 6', 'photo-6.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product`
--

CREATE TABLE `table_product` (
  `p_id` int(11) NOT NULL,
  `p_name` text NOT NULL,
  `p_old_price` varchar(10) NOT NULL,
  `p_current_price` varchar(10) NOT NULL,
  `p_qty` int(10) NOT NULL,
  `p_featured_photo` text NOT NULL,
  `p_description` text NOT NULL,
  `p_short_description` text NOT NULL,
  `p_feature` text NOT NULL,
  `p_return_policy` text NOT NULL,
  `p_total_order` int(11) NOT NULL,
  `p_is_featured` int(1) NOT NULL,
  `p_is_active` int(1) NOT NULL,
  `ecat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_product`
--

INSERT INTO `table_product` (`p_id`, `p_name`, `p_old_price`, `p_current_price`, `p_qty`, `p_featured_photo`, `p_description`, `p_short_description`, `p_feature`, `p_return_policy`, `p_total_order`, `p_is_featured`, `p_is_active`, `ecat_id`) VALUES
(22, 'Bộ PC Gaming', '950', '850', 12, 'product-featured-22.jpg', '<p>Linh kiện máy tính chất lượng cao, đảm bảo hiệu suất mạnh mẽ và độ bền vượt trội. Phù hợp cho cả người dùng phổ thông và game thủ, hỗ trợ nâng cấp hệ thống một cách dễ dàng.</p><div><br></div>', '<p>\"Nâng cấp máy tính của bạn với linh kiện chất lượng cao, giá siêu hấp dẫn!\"</p><div><br></div>', '<p>Hiệu suất ổn định: Đáp ứng nhu cầu từ làm việc, giải trí đến chơi game chuyên nghiệp.</p><p>Tương thích cao: Dễ dàng lắp đặt, phù hợp với nhiều dòng máy.</p><p>Chất liệu bền bỉ: Linh kiện chính hãng, tuổi thọ cao.</p><p>Tiết kiệm năng lượng: Hoạt động hiệu quả, giảm tiêu thụ điện năng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ hộp, phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do lỗi người dùng.</p><div><br></div>', 0, 0, 1, 67),
(23, 'Thiết bị làm mát laptop', '950', '850', 12, 'product-featured-23.jpg', '<p>Linh kiện máy tính chất lượng cao, đảm bảo hiệu suất mạnh mẽ và độ bền vượt trội. Phù hợp cho cả người dùng phổ thông và game thủ, hỗ trợ nâng cấp hệ thống một cách dễ dàng.</p><div><br></div>', '<p>\"Nâng cấp máy tính của bạn với linh kiện chất lượng cao, giá siêu hấp dẫn!\"</p><div><br></div>', '<p>Hiệu suất ổn định: Đáp ứng nhu cầu từ làm việc, giải trí đến chơi game chuyên nghiệp.</p><p>Tương thích cao: Dễ dàng lắp đặt, phù hợp với nhiều dòng máy.</p><p>Chất liệu bền bỉ: Linh kiện chính hãng, tuổi thọ cao.</p><p>Tiết kiệm năng lượng: Hoạt động hiệu quả, giảm tiêu thụ điện năng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ hộp, phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do lỗi người dùng.</p><div><br></div>', 0, 0, 1, 67),
(24, 'Bộ PC Gaming', '950', '850', 12, 'product-featured-24.jpg', '<p>Linh kiện máy tính chất lượng cao, đảm bảo hiệu suất mạnh mẽ và độ bền vượt trội. Phù hợp cho cả người dùng phổ thông và game thủ, hỗ trợ nâng cấp hệ thống một cách dễ dàng.</p><p><br></p>', '<p>\"Nâng cấp máy tính của bạn với linh kiện chất lượng cao, giá siêu hấp dẫn!\"</p><p><br></p>', '<p>Hiệu suất ổn định: Đáp ứng nhu cầu từ làm việc, giải trí đến chơi game chuyên nghiệp.</p><p>Tương thích cao: Dễ dàng lắp đặt, phù hợp với nhiều dòng máy.</p><p>Chất liệu bền bỉ: Linh kiện chính hãng, tuổi thọ cao.</p><p>Tiết kiệm năng lượng: Hoạt động hiệu quả, giảm tiêu thụ điện năng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ hộp, phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do lỗi người dùng.</p><div><br></div>', 0, 0, 1, 67),
(25, 'Bàn phím cơ', '880', '720', 20, 'product-featured-25.jpg', '<p>Linh kiện bàn phím chất lượng cao, phù hợp để nâng cấp hoặc thay thế, giúp trải nghiệm gõ phím mượt mà và bền bỉ hơn. Tương thích với nhiều loại bàn phím cơ và văn phòng.</p>', '<p>\"Linh kiện bàn phím chất lượng cao, bền bỉ, phù hợp nâng cấp hoặc thay thế cho mọi loại bàn phím.\"</p><div><br></div>', '<p>Chất liệu bền bỉ: Nhựa ABS/PBT, kim loại chống gỉ, tuổi thọ cao.</p><p>Tương thích đa dạng: Phù hợp với nhiều loại switch và layout bàn phím.</p><p>Hiệu suất tối ưu: Phản hồi nhanh, độ nhạy cao, nâng cao trải nghiệm gõ phím.</p><p>Dễ dàng thay thế: Thiết kế tiện lợi, hỗ trợ lắp đặt đơn giản.</p><p><br></p>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả với sản phẩm đã qua lắp đặt hoặc hư hỏng do tác động bên ngoài.</p><div><br></div>', 0, 0, 1, 71),
(26, 'Bàn phím bluetooth', '880', '720', 20, 'product-featured-26.jpg', '<p>Linh kiện bàn phím chất lượng cao, phù hợp để nâng cấp hoặc thay thế, giúp trải nghiệm gõ phím mượt mà và bền bỉ hơn. Tương thích với nhiều loại bàn phím cơ và văn phòng.</p><div><br></div>', '<p>\"Linh kiện bàn phím chất lượng cao, bền bỉ, phù hợp nâng cấp hoặc thay thế cho mọi loại bàn phím.\"</p>', '<p>Chất liệu bền bỉ: Nhựa ABS/PBT, kim loại chống gỉ, tuổi thọ cao.</p><p>Tương thích đa dạng: Phù hợp với nhiều loại switch và layout bàn phím.</p><p>Hiệu suất tối ưu: Phản hồi nhanh, độ nhạy cao, nâng cao trải nghiệm gõ phím.</p><p>Dễ dàng thay thế: Thiết kế tiện lợi, hỗ trợ lắp đặt đơn giản.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả với sản phẩm đã qua lắp đặt hoặc hư hỏng do tác động bên ngoài.</p><div><br></div>', 0, 0, 1, 71),
(27, 'Bàn phím cơ', '880', '720', 20, 'product-featured-27.jpg', '<p>Linh kiện bàn phím chất lượng cao, phù hợp để nâng cấp hoặc thay thế, giúp trải nghiệm gõ phím mượt mà và bền bỉ hơn. Tương thích với nhiều loại bàn phím cơ và văn phòng.</p><div><br></div>', '<p>\"Linh kiện bàn phím chất lượng cao, bền bỉ, phù hợp nâng cấp hoặc thay thế cho mọi loại bàn phím.\"</p><div><br></div>', '<p>Chất liệu bền bỉ: Nhựa ABS/PBT, kim loại chống gỉ, tuổi thọ cao.</p><p>Tương thích đa dạng: Phù hợp với nhiều loại switch và layout bàn phím.</p><p>Hiệu suất tối ưu: Phản hồi nhanh, độ nhạy cao, nâng cao trải nghiệm gõ phím.</p><p>Dễ dàng thay thế: Thiết kế tiện lợi, hỗ trợ lắp đặt đơn giản.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả với sản phẩm đã qua lắp đặt hoặc hư hỏng do tác động bên ngoài.</p><div><br></div>', 0, 0, 1, 71),
(28, 'Máy in laser đơn sắc', '980', '900', 30, 'product-featured-28.jpg', '<p>Máy in chất lượng cao, tốc độ in nhanh, phù hợp cho văn phòng và gia đình. Thiết kế nhỏ gọn, dễ sử dụng, hỗ trợ in ấn sắc nét và tiết kiệm chi phí.</p><div><br></div>', '<p>\"Máy in chất lượng cao, tốc độ nhanh, tiết kiệm mực - lựa chọn hoàn hảo cho văn phòng hiện đại!\"</p><div><br></div>', '<p>Công nghệ in hiện đại: In laser/ phun màu sắc nét, độ phân giải cao.</p><p>Tốc độ in nhanh: Đáp ứng nhu cầu in ấn số lượng lớn.</p><p>Kết nối linh hoạt: USB, Wi-Fi, in từ điện thoại dễ dàng.</p><p>Tiết kiệm mực: Hiệu suất cao, chi phí in thấp.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp, hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 70),
(29, 'Máy in laser đơn sắc', '980', '900', 30, 'product-featured-29.jpg', '<p>Máy in chất lượng cao, tốc độ in nhanh, phù hợp cho văn phòng và gia đình. Thiết kế nhỏ gọn, dễ sử dụng, hỗ trợ in ấn sắc nét và tiết kiệm chi phí.</p>', '<p>\"Máy in chất lượng cao, tốc độ nhanh, tiết kiệm mực - lựa chọn hoàn hảo cho văn phòng hiện đại!\"</p><div><br></div>', '<p>Công nghệ in hiện đại: In laser/ phun màu sắc nét, độ phân giải cao.</p><p>Tốc độ in nhanh: Đáp ứng nhu cầu in ấn số lượng lớn.</p><p>Kết nối linh hoạt: USB, Wi-Fi, in từ điện thoại dễ dàng.</p><p>Tiết kiệm mực: Hiệu suất cao, chi phí in thấp.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp, hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p>', 0, 0, 1, 70),
(30, 'Máy in màu', '980', '900', 30, 'product-featured-30.jpg', '<p>Máy in chất lượng cao, tốc độ in nhanh, phù hợp cho văn phòng và gia đình. Thiết kế nhỏ gọn, dễ sử dụng, hỗ trợ in ấn sắc nét và tiết kiệm chi phí.</p><div><br></div>', '<p>\"Máy in chất lượng cao, tốc độ nhanh, tiết kiệm mực - lựa chọn hoàn hảo cho văn phòng hiện đại!\"</p><div><br></div>', '<p>Công nghệ in hiện đại: In laser/ phun màu sắc nét, độ phân giải cao.</p><p>Tốc độ in nhanh: Đáp ứng nhu cầu in ấn số lượng lớn.</p><p>Kết nối linh hoạt: USB, Wi-Fi, in từ điện thoại dễ dàng.</p><p>Tiết kiệm mực: Hiệu suất cao, chi phí in thấp.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp, hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 70),
(31, 'Macbook Air', '850', '799', 35, 'product-featured-31.jpg', '<p>Laptop hiệu năng mạnh mẽ, thiết kế sang trọng, phù hợp cho học tập, làm việc và giải trí. Trang bị công nghệ hiện đại, mang đến trải nghiệm mượt mà, đáp ứng mọi nhu cầu sử dụng.</p><div><br></div>', '<p>\"Laptop hiệu năng cao, thiết kế sang trọng - hoàn hảo cho công việc và giải trí!\"</p><div><br></div>', '<p>Cấu hình mạnh: Vi xử lý tiên tiến, RAM lớn, SSD tốc độ cao.</p><p>Màn hình sắc nét: Độ phân giải Full HD trở lên, hình ảnh sống động.</p><p>Thiết kế hiện đại: Mỏng nhẹ, bền bỉ, dễ dàng mang theo.</p><p>Pin lâu, sạc nhanh: Đáp ứng nhu cầu sử dụng cả ngày.</p><p>Hệ thống tản nhiệt tốt: Hoạt động ổn định, không bị quá nóng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm bị hư hỏng do người dùng hoặc đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 68),
(32, 'Macbook Air', '850', '799', 35, 'product-featured-32.jpg', '<p>Laptop hiệu năng mạnh mẽ, thiết kế sang trọng, phù hợp cho học tập, làm việc và giải trí. Trang bị công nghệ hiện đại, mang đến trải nghiệm mượt mà, đáp ứng mọi nhu cầu sử dụng.</p><p><br></p>', '<p>\"Laptop hiệu năng cao, thiết kế sang trọng - hoàn hảo cho công việc và giải trí!\"</p><div><br></div>', '<p>Cấu hình mạnh: Vi xử lý tiên tiến, RAM lớn, SSD tốc độ cao.</p><p>Màn hình sắc nét: Độ phân giải Full HD trở lên, hình ảnh sống động.</p><p>Thiết kế hiện đại: Mỏng nhẹ, bền bỉ, dễ dàng mang theo.</p><p>Pin lâu, sạc nhanh: Đáp ứng nhu cầu sử dụng cả ngày.</p><p>Hệ thống tản nhiệt tốt: Hoạt động ổn định, không bị quá nóng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm bị hư hỏng do người dùng hoặc đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 68),
(33, 'Ipad Gen 11', '720', '650', 30, 'product-featured-33.jpg', '<p>Máy tính bảng hiệu năng mạnh mẽ, thiết kế mỏng nhẹ, phù hợp cho công việc, giải trí và học tập. Màn hình sắc nét, pin lâu dài, giúp bạn tận hưởng trải nghiệm mượt mà mọi lúc mọi nơi.</p><p><br></p>', '<p>\"Máy tính bảng màn hình sắc nét, hiệu năng mạnh mẽ - đáp ứng mọi nhu cầu giải trí và công việc!\"</p><div><br></div>', '<p>Màn hình chất lượng cao: Hiển thị sắc nét, cảm ứng nhạy.</p><p>Hiệu năng ổn định: Chip xử lý mạnh mẽ, đa nhiệm mượt mà.</p><p>Dung lượng pin lớn: Sử dụng liên tục nhiều giờ liền.</p><p>Thiết kế hiện đại: Mỏng, nhẹ, dễ dàng mang theo.</p><p>Hỗ trợ kết nối: Wi-Fi, 4G/5G (tùy phiên bản), Bluetooth tiện lợi.</p>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hộp.</p><p>Không áp dụng đổi trả với sản phẩm đã kích hoạt bảo hành hoặc bị hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 68),
(34, 'Thiết bị phát WiFi', '500', '450', 20, 'product-featured-34.jpg', '<p>Thiết bị mạng chất lượng cao, giúp kết nối internet ổn định, tốc độ nhanh và bảo mật tối ưu. Phù hợp cho gia đình, văn phòng và doanh nghiệp.</p><div><br></div>', '<p>\"Thiết bị mạng ổn định, tốc độ cao - đảm bảo kết nối mượt mà cho công việc và giải trí!\"</p><div><br></div>', '<p>Tốc độ cao: Hỗ trợ băng thông mạnh, truyền tải dữ liệu mượt mà.</p><p>Kết nối ổn định: Giảm nhiễu, đảm bảo tín hiệu ổn định.</p><p>Dễ dàng cài đặt: Giao diện thân thiện, thiết lập nhanh chóng.</p><p>Bảo mật cao: Mã hóa tiên tiến, bảo vệ dữ liệu người dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và hộp đựng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 72),
(35, 'Thiết bị phát WiFi', '500', '450', 20, 'product-featured-35.jpg', '<div>Thiết bị mạng chất lượng cao, giúp kết nối internet ổn định, tốc độ nhanh và bảo mật tối ưu. Phù hợp cho gia đình, văn phòng và doanh nghiệp.</div><div><br></div>', '<p>\"Thiết bị mạng ổn định, tốc độ cao - đảm bảo kết nối mượt mà cho công việc và giải trí!\"</p><div><br></div>', '<p>Tốc độ cao: Hỗ trợ băng thông mạnh, truyền tải dữ liệu mượt mà.</p><p>Kết nối ổn định: Giảm nhiễu, đảm bảo tín hiệu ổn định.</p><p>Dễ dàng cài đặt: Giao diện thân thiện, thiết lập nhanh chóng.</p><p>Bảo mật cao: Mã hóa tiên tiến, bảo vệ dữ liệu người dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và hộp đựng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p>', 0, 0, 1, 72),
(36, 'Thiết bị phát WiFi', '500', '450', 20, 'product-featured-36.jpg', '<p>Thiết bị mạng chất lượng cao, giúp kết nối internet ổn định, tốc độ nhanh và bảo mật tối ưu. Phù hợp cho gia đình, văn phòng và doanh nghiệp.</p><p><br></p>', '<p>\"Thiết bị mạng ổn định, tốc độ cao - đảm bảo kết nối mượt mà cho công việc và giải trí!\"</p><div><br></div>', '<p>Tốc độ cao: Hỗ trợ băng thông mạnh, truyền tải dữ liệu mượt mà.</p><p>Kết nối ổn định: Giảm nhiễu, đảm bảo tín hiệu ổn định.</p><p>Dễ dàng cài đặt: Giao diện thân thiện, thiết lập nhanh chóng.</p><p>Bảo mật cao: Mã hóa tiên tiến, bảo vệ dữ liệu người dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và hộp đựng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p>', 0, 0, 1, 72),
(37, 'Camera an ninh', '820', '750', 30, 'product-featured-37.jpg', '<p>Thiết bị an ninh và giám sát hiện đại, giúp bảo vệ ngôi nhà, văn phòng và tài sản của bạn 24/7. Công nghệ tiên tiến, hình ảnh sắc nét, dễ dàng lắp đặt và sử dụng.</p><div><br></div>', '<p>\"Thiết bị an ninh và giám sát hiện đại - bảo vệ an toàn cho ngôi nhà và doanh nghiệp của bạn!\"</p><div><br></div>', '<p>Hình ảnh chất lượng cao: Độ phân giải Full HD/4K, hỗ trợ ban đêm.</p><p>Kết nối thông minh: Điều khiển từ xa qua ứng dụng điện thoại.</p><p>Phát hiện chuyển động: Cảnh báo tức thời khi có hoạt động bất thường.</p><p>Lưu trữ linh hoạt: Hỗ trợ thẻ nhớ, lưu trữ đám mây.</p><p>Dễ dàng lắp đặt: Tương thích với nhiều không gian và hệ thống an ninh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do khách hàng.</p>', 0, 0, 1, 63),
(38, 'Camera an ninh', '820', '750', 30, 'product-featured-38.jpg', '<p>Thiết bị an ninh và giám sát hiện đại, giúp bảo vệ ngôi nhà, văn phòng và tài sản của bạn 24/7. Công nghệ tiên tiến, hình ảnh sắc nét, dễ dàng lắp đặt và sử dụng.</p><p><br></p>', '<p>\"Thiết bị an ninh và giám sát hiện đại - bảo vệ an toàn cho ngôi nhà và doanh nghiệp của bạn!\"</p><div><br></div>', '<p>Hình ảnh chất lượng cao: Độ phân giải Full HD/4K, hỗ trợ ban đêm.</p><p>Kết nối thông minh: Điều khiển từ xa qua ứng dụng điện thoại.</p><p>Phát hiện chuyển động: Cảnh báo tức thời khi có hoạt động bất thường.</p><p>Lưu trữ linh hoạt: Hỗ trợ thẻ nhớ, lưu trữ đám mây.</p><p>Dễ dàng lắp đặt: Tương thích với nhiều không gian và hệ thống an ninh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do khách hàng.</p><div><br></div>', 0, 0, 1, 63),
(39, 'Camera an ninh', '820', '750', 30, 'product-featured-39.jpg', '<p>Thiết bị an ninh và giám sát hiện đại, giúp bảo vệ ngôi nhà, văn phòng và tài sản của bạn 24/7. Công nghệ tiên tiến, hình ảnh sắc nét, dễ dàng lắp đặt và sử dụng.</p><div><br></div>', '<p>\"Thiết bị an ninh và giám sát hiện đại - bảo vệ an toàn cho ngôi nhà và doanh nghiệp của bạn!\"</p><div><br></div>', '<p>Hình ảnh chất lượng cao: Độ phân giải Full HD/4K, hỗ trợ ban đêm.</p><p>Kết nối thông minh: Điều khiển từ xa qua ứng dụng điện thoại.</p><p>Phát hiện chuyển động: Cảnh báo tức thời khi có hoạt động bất thường.</p><p>Lưu trữ linh hoạt: Hỗ trợ thẻ nhớ, lưu trữ đám mây.</p><p>Dễ dàng lắp đặt: Tương thích với nhiều không gian và hệ thống an ninh.</p>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do khách hàng.</p><div><br></div>', 0, 0, 1, 63),
(40, 'Iphone15', '960', '890', 40, 'product-featured-40.jpg', '<p>Điện thoại thông minh với thiết kế hiện đại, hiệu năng mạnh mẽ và nhiều tính năng thông minh. Phù hợp cho công việc, giải trí và kết nối mọi lúc, mọi nơi.</p><div><br></div>', '<p>\"Điện thoại thiết kế sang trọng, hiệu năng mạnh mẽ - trải nghiệm mượt mà mọi tác vụ!\"</p><div><br></div>', '<p>Màn hình sắc nét: Công nghệ tiên tiến, hiển thị sống động.</p><p>Hiệu năng mạnh mẽ: Bộ vi xử lý cao cấp, đa nhiệm mượt mà.</p><p>Camera chất lượng cao: Chụp ảnh, quay video sắc nét.</p><p>Dung lượng pin lớn: Sử dụng cả ngày dài, sạc nhanh tiện lợi.</p><p>Bảo mật an toàn: Cảm biến vân tay, nhận diện khuôn mặt.</p>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên hộp, phụ kiện đầy đủ và không có dấu hiệu sử dụng.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc sản phẩm đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 61),
(41, 'Samsung S24 Ultra', '960', '890', 40, 'product-featured-41.jpg', '<p>Điện thoại thông minh với thiết kế hiện đại, hiệu năng mạnh mẽ và nhiều tính năng thông minh. Phù hợp cho công việc, giải trí và kết nối mọi lúc, mọi nơi.</p><div><br></div>', '<p>\"Điện thoại thiết kế sang trọng, hiệu năng mạnh mẽ - trải nghiệm mượt mà mọi tác vụ!\"</p><div><br></div>', '<p>Màn hình sắc nét: Công nghệ tiên tiến, hiển thị sống động.</p><p>Hiệu năng mạnh mẽ: Bộ vi xử lý cao cấp, đa nhiệm mượt mà.</p><p>Camera chất lượng cao: Chụp ảnh, quay video sắc nét.</p><p>Dung lượng pin lớn: Sử dụng cả ngày dài, sạc nhanh tiện lợi.</p><p>Bảo mật an toàn: Cảm biến vân tay, nhận diện khuôn mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên hộp, phụ kiện đầy đủ và không có dấu hiệu sử dụng.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc sản phẩm đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 61),
(42, 'Samsung Galaxy', '960', '890', 40, 'product-featured-42.jpg', '<p>Điện thoại thông minh với thiết kế hiện đại, hiệu năng mạnh mẽ và nhiều tính năng thông minh. Phù hợp cho công việc, giải trí và kết nối mọi lúc, mọi nơi.</p>', '<p>\"Điện thoại thiết kế sang trọng, hiệu năng mạnh mẽ - trải nghiệm mượt mà mọi tác vụ!\"</p><div><br></div>', '<p>Màn hình sắc nét: Công nghệ tiên tiến, hiển thị sống động.</p><p>Hiệu năng mạnh mẽ: Bộ vi xử lý cao cấp, đa nhiệm mượt mà.</p><p>Camera chất lượng cao: Chụp ảnh, quay video sắc nét.</p><p>Dung lượng pin lớn: Sử dụng cả ngày dài, sạc nhanh tiện lợi.</p><p>Bảo mật an toàn: Cảm biến vân tay, nhận diện khuôn mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên hộp, phụ kiện đầy đủ và không có dấu hiệu sử dụng.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc sản phẩm đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 61),
(43, 'Thiết bị định vị', '650', '580', 35, 'product-featured-43.jpg', '<p>Thiết bị GPS & định vị thông minh, giúp xác định vị trí chính xác, theo dõi hành trình và đảm bảo an toàn cho phương tiện, tài sản hoặc cá nhân. Thiết kế nhỏ gọn, dễ dàng lắp đặt và sử dụng.</p><p><br></p>', '<p>\"Thiết bị GPS định vị chính xác, tín hiệu ổn định - an tâm theo dõi mọi hành trình!\"</p><div><br></div>', '<p>Định vị chính xác: Công nghệ GPS tiên tiến, cập nhật vị trí theo thời gian thực.</p><p>Kết nối đa nền tảng: Hỗ trợ ứng dụng trên điện thoại và máy tính.</p><p>Cảnh báo an toàn: Thiết lập vùng an toàn, cảnh báo khi ra khỏi khu vực giới hạn.</p><p>Pin bền bỉ: Thời lượng pin dài, có thể sạc lại hoặc kết nối nguồn trực tiếp.</p><p>Chống nước, chịu lực: Phù hợp cho nhiều điều kiện môi trường.</p><p><br></p>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả cho sản phẩm đã kích hoạt hoặc bị hư hại do người dùng.</p>', 0, 0, 1, 65),
(44, 'Thiết bị định vị', '650', '580', 20, 'product-featured-44.jpg', '<p>Thiết bị GPS & định vị thông minh, giúp xác định vị trí chính xác, theo dõi hành trình và đảm bảo an toàn cho phương tiện, tài sản hoặc cá nhân. Thiết kế nhỏ gọn, dễ dàng lắp đặt và sử dụng.</p><div><br></div>', '<p>\"Thiết bị GPS định vị chính xác, tín hiệu ổn định - an tâm theo dõi mọi hành trình!\"</p><div><br></div>', '<p>Định vị chính xác: Công nghệ GPS tiên tiến, cập nhật vị trí theo thời gian thực.</p><p>Kết nối đa nền tảng: Hỗ trợ ứng dụng trên điện thoại và máy tính.</p><p>Cảnh báo an toàn: Thiết lập vùng an toàn, cảnh báo khi ra khỏi khu vực giới hạn.</p><p>Pin bền bỉ: Thời lượng pin dài, có thể sạc lại hoặc kết nối nguồn trực tiếp.</p><p>Chống nước, chịu lực: Phù hợp cho nhiều điều kiện môi trường.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả cho sản phẩm đã kích hoạt hoặc bị hư hại do người dùng.</p><div><br></div>', 0, 0, 1, 65),
(45, 'Thiết bị định vị', '650', '580', 35, 'product-featured-45.jpg', '<p>Thiết bị GPS & định vị thông minh, giúp xác định vị trí chính xác, theo dõi hành trình và đảm bảo an toàn cho phương tiện, tài sản hoặc cá nhân. Thiết kế nhỏ gọn, dễ dàng lắp đặt và sử dụng.</p><div><br></div>', '<p>\"Thiết bị GPS định vị chính xác, tín hiệu ổn định - an tâm theo dõi mọi hành trình!\"</p><div><br></div>', '<p>Định vị chính xác: Công nghệ GPS tiên tiến, cập nhật vị trí theo thời gian thực.</p><p>Kết nối đa nền tảng: Hỗ trợ ứng dụng trên điện thoại và máy tính.</p><p>Cảnh báo an toàn: Thiết lập vùng an toàn, cảnh báo khi ra khỏi khu vực giới hạn.</p><p>Pin bền bỉ: Thời lượng pin dài, có thể sạc lại hoặc kết nối nguồn trực tiếp.</p><p>Chống nước, chịu lực: Phù hợp cho nhiều điều kiện môi trường.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả cho sản phẩm đã kích hoạt hoặc bị hư hại do người dùng.</p>', 0, 0, 1, 65),
(46, 'Tai nghe bluetooth', '380', '320', 40, 'product-featured-46.jpg', '<p>Tai nghe chất lượng cao với âm thanh sống động, thiết kế hiện đại, mang đến trải nghiệm nghe nhạc, xem phim và đàm thoại tuyệt vời. Phù hợp cho công việc, giải trí và luyện tập thể thao.</p><div><br></div>', '<p>\"Tai nghe âm thanh sống động, kết nối ổn định - tận hưởng trọn vẹn từng giai điệu!\"</p><div><br></div>', '<p>Âm thanh chân thực: Công nghệ âm thanh tiên tiến, bass mạnh mẽ.</p><p>Kết nối ổn định: Hỗ trợ Bluetooth 5.0 / Jack 3.5mm / USB-C (tùy dòng).</p><p>Thoải mái khi sử dụng: Đệm tai êm ái, thiết kế nhẹ, ôm sát tai.</p><p>Pin lâu dài: Thời gian sử dụng lên đến 20 giờ (đối với tai nghe không dây).</p><p>Chống ồn hiệu quả: Lọc tạp âm, nâng cao chất lượng đàm thoại.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm phải nguyên vẹn, đầy đủ hộp và phụ kiện kèm theo.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc hao mòn tự nhiên.</p><div><br></div>', 0, 0, 1, 62),
(47, 'Tai nghe bluetooth', '380', '320', 35, 'product-featured-47.jpg', '<p>Tai nghe chất lượng cao với âm thanh sống động, thiết kế hiện đại, mang đến trải nghiệm nghe nhạc, xem phim và đàm thoại tuyệt vời. Phù hợp cho công việc, giải trí và luyện tập thể thao.</p><div><br></div>', '<p>\"Tai nghe âm thanh sống động, kết nối ổn định - tận hưởng trọn vẹn từng giai điệu!\"</p><div><br></div>', '<p>Âm thanh chân thực: Công nghệ âm thanh tiên tiến, bass mạnh mẽ.</p><p>Kết nối ổn định: Hỗ trợ Bluetooth 5.0 / Jack 3.5mm / USB-C (tùy dòng).</p><p>Thoải mái khi sử dụng: Đệm tai êm ái, thiết kế nhẹ, ôm sát tai.</p><p>Pin lâu dài: Thời gian sử dụng lên đến 20 giờ (đối với tai nghe không dây).</p><p>Chống ồn hiệu quả: Lọc tạp âm, nâng cao chất lượng đàm thoại.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm phải nguyên vẹn, đầy đủ hộp và phụ kiện kèm theo.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc hao mòn tự nhiên.</p><div><br></div>', 0, 0, 1, 62),
(48, 'Tai nghe bluetooth', '380', '320', 30, 'product-featured-48.jpg', '<p>Tai nghe chất lượng cao với âm thanh sống động, thiết kế hiện đại, mang đến trải nghiệm nghe nhạc, xem phim và đàm thoại tuyệt vời. Phù hợp cho công việc, giải trí và luyện tập thể thao.</p><div><br></div>', '<p>\"Tai nghe âm thanh sống động, kết nối ổn định - tận hưởng trọn vẹn từng giai điệu!\"</p><div><br></div>', '<p>Âm thanh chân thực: Công nghệ âm thanh tiên tiến, bass mạnh mẽ.</p><p>Kết nối ổn định: Hỗ trợ Bluetooth 5.0 / Jack 3.5mm / USB-C (tùy dòng).</p><p>Thoải mái khi sử dụng: Đệm tai êm ái, thiết kế nhẹ, ôm sát tai.</p><p>Pin lâu dài: Thời gian sử dụng lên đến 20 giờ (đối với tai nghe không dây).</p><p>Chống ồn hiệu quả: Lọc tạp âm, nâng cao chất lượng đàm thoại.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm phải nguyên vẹn, đầy đủ hộp và phụ kiện kèm theo.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc hao mòn tự nhiên.</p><div><br></div>', 0, 0, 1, 62),
(49, 'Micro ', '950', '870', 20, 'product-featured-49.jpg', '<p>Thiết bị âm thanh gia đình chất lượng cao, mang đến trải nghiệm âm thanh sống động, chân thực. Thiết kế hiện đại, dễ dàng kết nối và phù hợp với mọi không gian. Lựa chọn hoàn hảo để tận hưởng âm nhạc, phim ảnh và giải trí tại nhà.</p><p><br></p>', '<p>\"Thiết bị âm thanh gia đình chất lượng cao - âm thanh sống động, trải nghiệm giải trí đỉnh cao!\"</p><div><br></div>', '<p>Âm thanh chất lượng cao: Công nghệ tiên tiến, âm bass mạnh mẽ, âm treble trong trẻo.</p><p>Kết nối đa dạng: Hỗ trợ Bluetooth, AUX, USB, HDMI, Optical,...</p><p>Thiết kế sang trọng: Kiểu dáng tinh tế, phù hợp với mọi phong cách nội thất.</p><p>Tiện lợi và dễ sử dụng: Điều khiển từ xa, tích hợp các chế độ âm thanh thông minh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đã qua sử dụng.</p><div><br></div>', 0, 0, 1, 66),
(50, 'Dụng cụ chỉnh âm thanh', '950', '870', 30, 'product-featured-50.jpg', '<p>Thiết bị âm thanh gia đình chất lượng cao, mang đến trải nghiệm âm thanh sống động, chân thực. Thiết kế hiện đại, dễ dàng kết nối và phù hợp với mọi không gian. Lựa chọn hoàn hảo để tận hưởng âm nhạc, phim ảnh và giải trí tại nhà.</p><p><br></p>', '<p>\"Thiết bị âm thanh gia đình chất lượng cao - âm thanh sống động, trải nghiệm giải trí đỉnh cao!\"</p><div><br></div>', '<p>Âm thanh chất lượng cao: Công nghệ tiên tiến, âm bass mạnh mẽ, âm treble trong trẻo.</p><p>Kết nối đa dạng: Hỗ trợ Bluetooth, AUX, USB, HDMI, Optical,...</p><p>Thiết kế sang trọng: Kiểu dáng tinh tế, phù hợp với mọi phong cách nội thất.</p><p>Tiện lợi và dễ sử dụng: Điều khiển từ xa, tích hợp các chế độ âm thanh thông minh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đã qua sử dụng.</p><div><br></div>', 0, 0, 1, 66),
(51, 'Micro', '950', '870', 20, 'product-featured-51.jpg', '<p>Thiết bị âm thanh gia đình chất lượng cao, mang đến trải nghiệm âm thanh sống động, chân thực. Thiết kế hiện đại, dễ dàng kết nối và phù hợp với mọi không gian. Lựa chọn hoàn hảo để tận hưởng âm nhạc, phim ảnh và giải trí tại nhà.</p><p><br></p>', '<p>\"Thiết bị âm thanh gia đình chất lượng cao - âm thanh sống động, trải nghiệm giải trí đỉnh cao!\"</p><div><br></div>', '<p>Âm thanh chất lượng cao: Công nghệ tiên tiến, âm bass mạnh mẽ, âm treble trong trẻo.</p><p>Kết nối đa dạng: Hỗ trợ Bluetooth, AUX, USB, HDMI, Optical,...</p><p>Thiết kế sang trọng: Kiểu dáng tinh tế, phù hợp với mọi phong cách nội thất.</p><p>Tiện lợi và dễ sử dụng: Điều khiển từ xa, tích hợp các chế độ âm thanh thông minh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đã qua sử dụng.</p><div><br></div>', 0, 0, 1, 66),
(52, 'Ti Vi LG', '990', '920', 40, 'product-featured-52.jpg', '<p>Tivi màn hình sắc nét, công nghệ tiên tiến, mang đến trải nghiệm giải trí sống động. Thiết kế hiện đại, phù hợp với mọi không gian sống, từ phòng khách đến phòng ngủ.</p><div><br></div>', '<p>\"Tivi màn hình sắc nét, âm thanh sống động - trải nghiệm giải trí tuyệt vời ngay tại nhà!\"</p><div><br></div>', '<p>Độ phân giải cao: Full HD, 4K, 8K cho hình ảnh chân thực, sắc nét.</p><p>Công nghệ tiên tiến: HDR, OLED, QLED giúp màu sắc sống động, chân thực.</p><p>Âm thanh sống động: Hệ thống loa mạnh mẽ, hỗ trợ Dolby Audio.</p><p>Kết nối đa dạng: HDMI, USB, Wi-Fi, Bluetooth tiện lợi.</p><p>Hệ điều hành thông minh: Android TV, WebOS, Tizen, dễ dàng sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc lỗi do người dùng.</p>', 0, 0, 1, 64),
(53, 'Ti vi LG', '990', '920', 40, 'product-featured-53.jpg', '<p>Tivi màn hình sắc nét, công nghệ tiên tiến, mang đến trải nghiệm giải trí sống động. Thiết kế hiện đại, phù hợp với mọi không gian sống, từ phòng khách đến phòng ngủ.</p><div><br></div>', '<p>\"Tivi màn hình sắc nét, âm thanh sống động - trải nghiệm giải trí tuyệt vời ngay tại nhà!\"</p><div><br></div>', '<p>Độ phân giải cao: Full HD, 4K, 8K cho hình ảnh chân thực, sắc nét.</p><p>Công nghệ tiên tiến: HDR, OLED, QLED giúp màu sắc sống động, chân thực.</p><p>Âm thanh sống động: Hệ thống loa mạnh mẽ, hỗ trợ Dolby Audio.</p><p>Kết nối đa dạng: HDMI, USB, Wi-Fi, Bluetooth tiện lợi.</p><p>Hệ điều hành thông minh: Android TV, WebOS, Tizen, dễ dàng sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc lỗi do người dùng.</p><div><br></div>', 0, 0, 1, 64),
(54, 'Ti vi', '990', '920', 30, 'product-featured-54.jpg', '<p>Tivi màn hình sắc nét, công nghệ tiên tiến, mang đến trải nghiệm giải trí sống động. Thiết kế hiện đại, phù hợp với mọi không gian sống, từ phòng khách đến phòng ngủ.</p><div><br></div>', '<p>\"Tivi màn hình sắc nét, âm thanh sống động - trải nghiệm giải trí tuyệt vời ngay tại nhà!\"</p><div><br></div>', '<p>Độ phân giải cao: Full HD, 4K, 8K cho hình ảnh chân thực, sắc nét.</p><p>Công nghệ tiên tiến: HDR, OLED, QLED giúp màu sắc sống động, chân thực.</p><p>Âm thanh sống động: Hệ thống loa mạnh mẽ, hỗ trợ Dolby Audio.</p><p>Kết nối đa dạng: HDMI, USB, Wi-Fi, Bluetooth tiện lợi.</p><p>Hệ điều hành thông minh: Android TV, WebOS, Tizen, dễ dàng sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc lỗi do người dùng.</p><div><br></div>', 0, 0, 1, 64),
(55, 'Baby Fresh', '600', '600', 540, 'product-featured-55.jpg', '<p>Sản phẩm chăm sóc trẻ em an toàn, tiện lợi, giúp bố mẹ yên tâm chăm sóc bé yêu mỗi ngày. Chất liệu cao cấp, thiết kế thông minh, phù hợp với mọi giai đoạn phát triển của bé.</p><div><br></div>', '<p>\"Thiết bị chăm sóc trẻ em an toàn, tiện lợi - hỗ trợ ba mẹ chăm bé dễ dàng hơn!\"</p><div><br></div>', '<p>An toàn cho bé: Chất liệu không chứa BPA, thân thiện với làn da nhạy cảm.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhu cầu chăm sóc bé hàng ngày.</p><p>Độ bền cao: Chống va đập, dễ vệ sinh và sử dụng lâu dài.</p><p>Đạt tiêu chuẩn chất lượng: Được kiểm định an toàn trước khi đến tay người tiêu dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm đã qua sử dụng hoặc thuộc danh mục vệ sinh cá nhân.</p><div><br></div>', 0, 0, 1, 77),
(56, 'Dầu gội em bé', '600', '540', 35, 'product-featured-56.jpg', '<p>Sản phẩm chăm sóc trẻ em an toàn, tiện lợi, giúp bố mẹ yên tâm chăm sóc bé yêu mỗi ngày. Chất liệu cao cấp, thiết kế thông minh, phù hợp với mọi giai đoạn phát triển của bé.</p><div><br></div>', '<p>\"Thiết bị chăm sóc trẻ em an toàn, tiện lợi - hỗ trợ ba mẹ chăm bé dễ dàng hơn!\"</p><div><br></div>', '<p>An toàn cho bé: Chất liệu không chứa BPA, thân thiện với làn da nhạy cảm.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhu cầu chăm sóc bé hàng ngày.</p><p>Độ bền cao: Chống va đập, dễ vệ sinh và sử dụng lâu dài.</p><p>Đạt tiêu chuẩn chất lượng: Được kiểm định an toàn trước khi đến tay người tiêu dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm đã qua sử dụng hoặc thuộc danh mục vệ sinh cá nhân.</p><div><br></div>', 0, 0, 1, 77),
(57, 'Kem chống hăm', '600', '540', 40, 'product-featured-57.jpg', '<p>Sản phẩm chăm sóc trẻ em an toàn, tiện lợi, giúp bố mẹ yên tâm chăm sóc bé yêu mỗi ngày. Chất liệu cao cấp, thiết kế thông minh, phù hợp với mọi giai đoạn phát triển của bé.</p><div><br></div>', '<p>\"Thiết bị chăm sóc trẻ em an toàn, tiện lợi - hỗ trợ ba mẹ chăm bé dễ dàng hơn!\"</p><div><br></div>', '<p>An toàn cho bé: Chất liệu không chứa BPA, thân thiện với làn da nhạy cảm.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhu cầu chăm sóc bé hàng ngày.</p><p>Độ bền cao: Chống va đập, dễ vệ sinh và sử dụng lâu dài.</p><p>Đạt tiêu chuẩn chất lượng: Được kiểm định an toàn trước khi đến tay người tiêu dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm đã qua sử dụng hoặc thuộc danh mục vệ sinh cá nhân.</p><div><br></div>', 0, 0, 1, 77),
(58, 'Giấy vệ sinh', '550', '480', 40, 'product-featured-58.jpg', '<p>Đồ dùng gia đình tiện ích, giúp tối ưu không gian sống và nâng cao chất lượng cuộc sống. Sản phẩm đa dạng, thiết kế hiện đại, phù hợp với mọi phong cách nội thất.</p><div><br></div>', '<p>\"Đồ dùng gia đình tiện ích, bền bỉ - giúp cuộc sống trở nên dễ dàng và thoải mái hơn!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: An toàn, thân thiện với môi trường.</p><p>Thiết kế thông minh: Tối ưu công năng, dễ sử dụng.</p><p>Dễ dàng vệ sinh: Chống bám bẩn, tiện lợi trong quá trình bảo quản.</p><p>Phù hợp nhiều không gian: Từ nhà bếp, phòng khách đến phòng ngủ.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 78),
(59, 'Bột giặt Omo', '550', '480', 35, 'product-featured-59.jpg', '<p>Đồ dùng gia đình tiện ích, giúp tối ưu không gian sống và nâng cao chất lượng cuộc sống. Sản phẩm đa dạng, thiết kế hiện đại, phù hợp với mọi phong cách nội thất.</p><div><br></div>', '<p>\"Đồ dùng gia đình tiện ích, bền bỉ - giúp cuộc sống trở nên dễ dàng và thoải mái hơn!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: An toàn, thân thiện với môi trường.</p><p>Thiết kế thông minh: Tối ưu công năng, dễ sử dụng.</p><p>Dễ dàng vệ sinh: Chống bám bẩn, tiện lợi trong quá trình bảo quản.</p><p>Phù hợp nhiều không gian: Từ nhà bếp, phòng khách đến phòng ngủ.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 78),
(60, 'Thùng rác', '550', '480', 35, 'product-featured-60.jpg', '<p>Đồ dùng gia đình tiện ích, giúp tối ưu không gian sống và nâng cao chất lượng cuộc sống. Sản phẩm đa dạng, thiết kế hiện đại, phù hợp với mọi phong cách nội thất.</p><div><br></div>', '<p> \"Đồ dùng gia đình tiện ích, bền bỉ - giúp cuộc sống trở nên dễ dàng và thoải mái hơn!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: An toàn, thân thiện với môi trường.</p><p>Thiết kế thông minh: Tối ưu công năng, dễ sử dụng.</p><p>Dễ dàng vệ sinh: Chống bám bẩn, tiện lợi trong quá trình bảo quản.</p><p>Phù hợp nhiều không gian: Từ nhà bếp, phòng khách đến phòng ngủ.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p>', 0, 0, 1, 78),
(61, 'Hộp quà', '200', '150', 40, 'product-featured-61.jpg', '<p>Bộ dụng cụ gói quà sang trọng, giúp bạn tạo nên những món quà đẹp mắt và ý nghĩa. Phù hợp cho mọi dịp: sinh nhật, lễ Tết, kỷ niệm... Chất liệu bền đẹp, dễ sử dụng, mang đến trải nghiệm gói quà chuyên nghiệp ngay tại nhà.</p><div><br></div>', '<p> \"Đồ gói quà đẹp mắt, tinh tế - giúp món quà của bạn thêm ý nghĩa và ấn tượng!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Giấy dày dặn, ruy băng mềm mịn, keo dán chắc chắn.</p><p>Thiết kế đa dạng: Họa tiết tinh tế, màu sắc phong phú, phù hợp nhiều phong cách.</p><p>Dễ sử dụng: Phù hợp cho cả người mới bắt đầu và thợ gói quà chuyên nghiệp.</p><p>Thân thiện môi trường: Một số mẫu sử dụng giấy tái chế, bảo vệ môi trường.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc hư hỏng do vận chuyển.</p><p>Sản phẩm đổi trả cần nguyên vẹn, chưa qua sử dụng, giữ nguyên bao bì.</p><p>Không áp dụng đổi trả với các sản phẩm đã sử dụng hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 79),
(62, 'Giấy gói quà', '200', '150', 35, 'product-featured-62.jpg', '<p>Bộ dụng cụ gói quà sang trọng, giúp bạn tạo nên những món quà đẹp mắt và ý nghĩa. Phù hợp cho mọi dịp: sinh nhật, lễ Tết, kỷ niệm... Chất liệu bền đẹp, dễ sử dụng, mang đến trải nghiệm gói quà chuyên nghiệp ngay tại nhà.</p><div><br></div>', '<p>\"Đồ gói quà đẹp mắt, tinh tế - giúp món quà của bạn thêm ý nghĩa và ấn tượng!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Giấy dày dặn, ruy băng mềm mịn, keo dán chắc chắn.</p><p>Thiết kế đa dạng: Họa tiết tinh tế, màu sắc phong phú, phù hợp nhiều phong cách.</p><p>Dễ sử dụng: Phù hợp cho cả người mới bắt đầu và thợ gói quà chuyên nghiệp.</p><p>Thân thiện môi trường: Một số mẫu sử dụng giấy tái chế, bảo vệ môi trường.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc hư hỏng do vận chuyển.</p><p>Sản phẩm đổi trả cần nguyên vẹn, chưa qua sử dụng, giữ nguyên bao bì.</p><p>Không áp dụng đổi trả với các sản phẩm đã sử dụng hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 79),
(63, 'Hộp quà', '200', '150', 20, 'product-featured-63.jpg', '<p>Bộ dụng cụ gói quà sang trọng, giúp bạn tạo nên những món quà đẹp mắt và ý nghĩa. Phù hợp cho mọi dịp: sinh nhật, lễ Tết, kỷ niệm... Chất liệu bền đẹp, dễ sử dụng, mang đến trải nghiệm gói quà chuyên nghiệp ngay tại nhà.</p><div><br></div>', '<p> \"Đồ gói quà đẹp mắt, tinh tế - giúp món quà của bạn thêm ý nghĩa và ấn tượng!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Giấy dày dặn, ruy băng mềm mịn, keo dán chắc chắn.</p><p>Thiết kế đa dạng: Họa tiết tinh tế, màu sắc phong phú, phù hợp nhiều phong cách.</p><p>Dễ sử dụng: Phù hợp cho cả người mới bắt đầu và thợ gói quà chuyên nghiệp.</p><p>Thân thiện môi trường: Một số mẫu sử dụng giấy tái chế, bảo vệ môi trường.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc hư hỏng do vận chuyển.</p><p>Sản phẩm đổi trả cần nguyên vẹn, chưa qua sử dụng, giữ nguyên bao bì.</p><p>Không áp dụng đổi trả với các sản phẩm đã sử dụng hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 79),
(64, 'Nước rửa mắt', '420', '350', 40, 'product-featured-64.jpg', '<p>Bộ sản phẩm chăm sóc mắt giúp nuôi dưỡng, bảo vệ và làm dịu vùng da nhạy cảm quanh mắt. Công thức dịu nhẹ, an toàn, mang lại đôi mắt tươi trẻ và rạng rỡ.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc mắt dịu nhẹ, an toàn - bảo vệ đôi mắt sáng khỏe mỗi ngày!\"</p><div><br></div>', '<p>Dưỡng ẩm chuyên sâu: Giúp giảm khô da, ngăn ngừa nếp nhăn.</p><p>Giảm quầng thâm & bọng mắt: Thành phần thiên nhiên giúp sáng da, thư giãn vùng mắt.</p><p>An toàn, lành tính: Không chứa paraben, hương liệu nhân tạo, phù hợp cho mọi loại da.</p><p>Thẩm thấu nhanh: Kết cấu nhẹ, không gây bết dính.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không hỗ trợ đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 75),
(65, 'Nước rửa mắt', '420', '350', 35, 'product-featured-65.jpg', '<p>Bộ sản phẩm chăm sóc mắt giúp nuôi dưỡng, bảo vệ và làm dịu vùng da nhạy cảm quanh mắt. Công thức dịu nhẹ, an toàn, mang lại đôi mắt tươi trẻ và rạng rỡ.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc mắt dịu nhẹ, an toàn - bảo vệ đôi mắt sáng khỏe mỗi ngày!\"</p><div><br></div>', '<p>Dưỡng ẩm chuyên sâu: Giúp giảm khô da, ngăn ngừa nếp nhăn.</p><p>Giảm quầng thâm & bọng mắt: Thành phần thiên nhiên giúp sáng da, thư giãn vùng mắt.</p><p>An toàn, lành tính: Không chứa paraben, hương liệu nhân tạo, phù hợp cho mọi loại da.</p><p>Thẩm thấu nhanh: Kết cấu nhẹ, không gây bết dính.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không hỗ trợ đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 75),
(66, 'Thuốc nhỏ mắt', '420', '350', 40, 'product-featured-66.jpg', '<p>Bộ sản phẩm chăm sóc mắt giúp nuôi dưỡng, bảo vệ và làm dịu vùng da nhạy cảm quanh mắt. Công thức dịu nhẹ, an toàn, mang lại đôi mắt tươi trẻ và rạng rỡ.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc mắt dịu nhẹ, an toàn - bảo vệ đôi mắt sáng khỏe mỗi ngày!\"</p><div><br></div>', '<p>Dưỡng ẩm chuyên sâu: Giúp giảm khô da, ngăn ngừa nếp nhăn.</p><p>Giảm quầng thâm & bọng mắt: Thành phần thiên nhiên giúp sáng da, thư giãn vùng mắt.</p><p>An toàn, lành tính: Không chứa paraben, hương liệu nhân tạo, phù hợp cho mọi loại da.</p><p>Thẩm thấu nhanh: Kết cấu nhẹ, không gây bết dính.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không hỗ trợ đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 75),
(67, 'Kem đánh răng', '350', '290', 30, 'product-featured-67.jpg', '<p>Bộ sản phẩm chăm sóc răng miệng giúp bảo vệ nướu, ngăn ngừa mảng bám và mang lại hơi thở thơm mát. Công thức an toàn, phù hợp cho mọi lứa tuổi, hỗ trợ chăm sóc răng miệng toàn diện mỗi ngày.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc răng miệng chất lượng - bảo vệ nụ cười khỏe đẹp mỗi ngày!\"</p><div><br></div>', '<p>Làm sạch hiệu quả: Loại bỏ vi khuẩn, mảng bám và ngăn ngừa sâu răng.</p><p>Thành phần an toàn: Không chứa hóa chất gây hại, phù hợp cho răng nhạy cảm.</p><p>Hơi thở thơm mát: Giúp bạn tự tin suốt cả ngày.</p><p>Đa dạng sản phẩm: Kem đánh răng, bàn chải, nước súc miệng, chỉ nha khoa,...</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải còn nguyên tem, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với các sản phẩm khuyến mãi hoặc đã mở nắp.</p><div><br></div>', 0, 0, 1, 74),
(68, 'Nước súc miệng', '350', '290', 20, 'product-featured-68.jpg', '<p>Bộ sản phẩm chăm sóc răng miệng giúp bảo vệ nướu, ngăn ngừa mảng bám và mang lại hơi thở thơm mát. Công thức an toàn, phù hợp cho mọi lứa tuổi, hỗ trợ chăm sóc răng miệng toàn diện mỗi ngày.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc răng miệng chất lượng - bảo vệ nụ cười khỏe đẹp mỗi ngày!\"</p><div><br></div>', '<p>Làm sạch hiệu quả: Loại bỏ vi khuẩn, mảng bám và ngăn ngừa sâu răng.</p><p>Thành phần an toàn: Không chứa hóa chất gây hại, phù hợp cho răng nhạy cảm.</p><p>Hơi thở thơm mát: Giúp bạn tự tin suốt cả ngày.</p><p>Đa dạng sản phẩm: Kem đánh răng, bàn chải, nước súc miệng, chỉ nha khoa,...</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải còn nguyên tem, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với các sản phẩm khuyến mãi hoặc đã mở nắp.</p><div><br></div>', 0, 0, 1, 74),
(69, 'Bàn chải đánh răng', '350', '290', 30, 'product-featured-69.jpg', '<p>Bộ sản phẩm chăm sóc răng miệng giúp bảo vệ nướu, ngăn ngừa mảng bám và mang lại hơi thở thơm mát. Công thức an toàn, phù hợp cho mọi lứa tuổi, hỗ trợ chăm sóc răng miệng toàn diện mỗi ngày.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc răng miệng chất lượng - bảo vệ nụ cười khỏe đẹp mỗi ngày!\"</p><p><br></p>', '<p>Làm sạch hiệu quả: Loại bỏ vi khuẩn, mảng bám và ngăn ngừa sâu răng.</p><p>Thành phần an toàn: Không chứa hóa chất gây hại, phù hợp cho răng nhạy cảm.</p><p>Hơi thở thơm mát: Giúp bạn tự tin suốt cả ngày.</p><p>Đa dạng sản phẩm: Kem đánh răng, bàn chải, nước súc miệng, chỉ nha khoa,...</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải còn nguyên tem, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với các sản phẩm khuyến mãi hoặc đã mở nắp.</p><div><br></div>', 0, 0, 1, 74),
(70, 'Nhiệt kế', '750', '680', 40, 'product-featured-70.jpg', '<p>Thiết bị và dụng cụ y tế chất lượng cao, đảm bảo an toàn và hiệu quả trong chăm sóc sức khỏe. Sản phẩm đạt tiêu chuẩn y tế, phù hợp cho cả cá nhân và cơ sở y tế chuyên nghiệp.</p><div><br></div>', '<p>\"Thiết bị, dụng cụ y tế chính xác, an toàn - hỗ trợ chăm sóc sức khỏe hiệu quả!\"</p><div><br></div>', '<p>Chất lượng đảm bảo: Sản phẩm đạt tiêu chuẩn an toàn và kiểm định y tế.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhiều nhu cầu khác nhau.</p><p>Độ bền cao: Chất liệu an toàn, đảm bảo sử dụng lâu dài.</p><p>Ứng dụng đa dạng: Dành cho cá nhân, phòng khám, bệnh viện.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng và đầy đủ bao bì, phụ kiện.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc các mặt hàng đặc biệt như kim tiêm, khẩu trang.</p><div><br></div>', 0, 0, 1, 73),
(71, 'Khẩu trang y tế', '750', '680', 20, 'product-featured-71.jpg', '<p>Thiết bị và dụng cụ y tế chất lượng cao, đảm bảo an toàn và hiệu quả trong chăm sóc sức khỏe. Sản phẩm đạt tiêu chuẩn y tế, phù hợp cho cả cá nhân và cơ sở y tế chuyên nghiệp.</p><div><br></div>', '<p> \"Thiết bị, dụng cụ y tế chính xác, an toàn - hỗ trợ chăm sóc sức khỏe hiệu quả!\"</p><div><br></div>', '<p>Chất lượng đảm bảo: Sản phẩm đạt tiêu chuẩn an toàn và kiểm định y tế.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhiều nhu cầu khác nhau.</p><p>Độ bền cao: Chất liệu an toàn, đảm bảo sử dụng lâu dài.</p><p>Ứng dụng đa dạng: Dành cho cá nhân, phòng khám, bệnh viện.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng và đầy đủ bao bì, phụ kiện.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc các mặt hàng đặc biệt như kim tiêm, khẩu trang.</p><div><br></div>', 0, 0, 1, 73),
(72, 'Dụng cụ vệ sinh ', '750', '680', 35, 'product-featured-72.jpg', '<p>Thiết bị và dụng cụ y tế chất lượng cao, đảm bảo an toàn và hiệu quả trong chăm sóc sức khỏe. Sản phẩm đạt tiêu chuẩn y tế, phù hợp cho cả cá nhân và cơ sở y tế chuyên nghiệp.</p><p><br></p>', '<p>\"Thiết bị, dụng cụ y tế chính xác, an toàn - hỗ trợ chăm sóc sức khỏe hiệu quả!\"</p><div><br></div>', '<p>Chất lượng đảm bảo: Sản phẩm đạt tiêu chuẩn an toàn và kiểm định y tế.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhiều nhu cầu khác nhau.</p><p>Độ bền cao: Chất liệu an toàn, đảm bảo sử dụng lâu dài.</p><p>Ứng dụng đa dạng: Dành cho cá nhân, phòng khám, bệnh viện.</p><div><br></div>', '<p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng và đầy đủ bao bì, phụ kiện.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc các mặt hàng đặc biệt như kim tiêm, khẩu trang.</p><div><br></div>', 0, 0, 1, 73);
INSERT INTO `table_product` (`p_id`, `p_name`, `p_old_price`, `p_current_price`, `p_qty`, `p_featured_photo`, `p_description`, `p_short_description`, `p_feature`, `p_return_policy`, `p_total_order`, `p_is_featured`, `p_is_active`, `ecat_id`) VALUES
(73, 'Vitamin tốt cho sức khỏe', '530', '470', 40, 'product-featured-73.jpg', '<p>Vitamin và thực phẩm chức năng hỗ trợ tăng cường sức khỏe, bổ sung dưỡng chất thiết yếu cho cơ thể. Sản phẩm chất lượng cao, an toàn, phù hợp với nhiều đối tượng sử dụng.</p><div><br></div>', '<p>\"Vitamin bổ sung dinh dưỡng, tăng cường sức khỏe - tràn đầy năng lượng mỗi ngày!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Chiết xuất từ nguyên liệu an toàn, không chứa chất bảo quản độc hại.</p><p>Công dụng đa dạng: Hỗ trợ tăng cường miễn dịch, làm đẹp da, cải thiện sức khỏe tổng thể.</p><p>Dễ sử dụng: Dạng viên nang, bột, nước tiện lợi, dễ hấp thu.</p><p>Đạt tiêu chuẩn chất lượng: Chứng nhận an toàn thực phẩm, kiểm định nghiêm ngặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa mở nắp, nguyên tem niêm phong và còn hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc bị hư hỏng do bảo quản sai cách.</p><div><br></div>', 0, 0, 1, 76),
(74, 'Vitamin tốt cho sức khỏe', '530', '470', 40, 'product-featured-74.jpg', '<p>Vitamin và thực phẩm chức năng hỗ trợ tăng cường sức khỏe, bổ sung dưỡng chất thiết yếu cho cơ thể. Sản phẩm chất lượng cao, an toàn, phù hợp với nhiều đối tượng sử dụng.</p><p><br></p>', '<p> \"Vitamin bổ sung dinh dưỡng, tăng cường sức khỏe - tràn đầy năng lượng mỗi ngày!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Chiết xuất từ nguyên liệu an toàn, không chứa chất bảo quản độc hại.</p><p>Công dụng đa dạng: Hỗ trợ tăng cường miễn dịch, làm đẹp da, cải thiện sức khỏe tổng thể.</p><p>Dễ sử dụng: Dạng viên nang, bột, nước tiện lợi, dễ hấp thu.</p><p>Đạt tiêu chuẩn chất lượng: Chứng nhận an toàn thực phẩm, kiểm định nghiêm ngặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa mở nắp, nguyên tem niêm phong và còn hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc bị hư hỏng do bảo quản sai cách.</p><div><br></div>', 0, 0, 1, 76),
(75, 'Vitamin tốt cho sức khỏe', '530', '470', 35, 'product-featured-75.jpg', '<p>Vitamin và thực phẩm chức năng hỗ trợ tăng cường sức khỏe, bổ sung dưỡng chất thiết yếu cho cơ thể. Sản phẩm chất lượng cao, an toàn, phù hợp với nhiều đối tượng sử dụng.</p><p><br></p>', '<p>\"Vitamin bổ sung dinh dưỡng, tăng cường sức khỏe - tràn đầy năng lượng mỗi ngày!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Chiết xuất từ nguyên liệu an toàn, không chứa chất bảo quản độc hại.</p><p>Công dụng đa dạng: Hỗ trợ tăng cường miễn dịch, làm đẹp da, cải thiện sức khỏe tổng thể.</p><p>Dễ sử dụng: Dạng viên nang, bột, nước tiện lợi, dễ hấp thu.</p><p>Đạt tiêu chuẩn chất lượng: Chứng nhận an toàn thực phẩm, kiểm định nghiêm ngặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa mở nắp, nguyên tem niêm phong và còn hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc bị hư hỏng do bảo quản sai cách.</p><div><br></div>', 0, 0, 1, 76),
(76, 'Áo polo nam ngắn tay', '450', '390', 100, 'product-featured-76.jpg', '<p>Áo polo nam cao cấp – thiết kế thanh lịch, chất liệu cotton thoáng mát, thấm hút mồ hôi tốt. Kiểu dáng trẻ trung, dễ phối đồ, phù hợp cho cả đi làm, dạo phố và chơi thể thao.</p><div><br></div>', '<p>\"Áo polo nam thanh lịch, chất liệu thoáng mát - phù hợp mọi hoàn cảnh!\"</p><div><br></div>', '<p>✔ Chất liệu: Cotton cao cấp, co giãn 4 chiều</p><p>✔ Kiểu dáng: Slim fit, cổ bẻ cứng cáp</p><p>✔ Đường may tỉ mỉ, bền đẹp</p><p>✔ Nhiều màu sắc sang trọng, dễ phối đồ</p><p><br></p>', '<p>🔹 Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu.</p><p>🔹 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng.</p><p>🔹 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển).</p><div><br></div>', 0, 0, 1, 23),
(77, 'Áo polo nam ngắn tay', '450', '390', 100, 'product-featured-77.jpg', '<p>Áo polo nam cao cấp – thiết kế thanh lịch, chất liệu cotton thoáng mát, thấm hút mồ hôi tốt. Kiểu dáng trẻ trung, dễ phối đồ, phù hợp cho cả đi làm, dạo phố và chơi thể thao.</p><p><br></p>', '<p>\"Áo polo nam thanh lịch, chất liệu thoáng mát - phù hợp mọi hoàn cảnh!\"</p><div><br></div>', '<p>✔ Chất liệu: Cotton cao cấp, co giãn 4 chiều</p><p>✔ Kiểu dáng: Slim fit, cổ bẻ cứng cáp</p><p>✔ Đường may tỉ mỉ, bền đẹp</p><p>✔ Nhiều màu sắc sang trọng, dễ phối đồ</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu.</p><p>🔹 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng.</p><p>🔹 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển).</p><div><br></div>', 0, 0, 1, 23),
(78, 'Áo polo nam ngắn tay', '450', '390', 100, 'product-featured-78.jpg', '<p>Áo polo nam cao cấp – thiết kế thanh lịch, chất liệu cotton thoáng mát, thấm hút mồ hôi tốt. Kiểu dáng trẻ trung, dễ phối đồ, phù hợp cho cả đi làm, dạo phố và chơi thể thao.</p><p><br></p>', '<p>\"Áo polo nam thanh lịch, chất liệu thoáng mát - phù hợp mọi hoàn cảnh!\"</p><div><br></div>', '<p>✔ Chất liệu: Cotton cao cấp, co giãn 4 chiều</p><p>✔ Kiểu dáng: Slim fit, cổ bẻ cứng cáp</p><p>✔ Đường may tỉ mỉ, bền đẹp</p><p>✔ Nhiều màu sắc sang trọng, dễ phối đồ</p><p><br></p>', '<p>🔹 Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu.</p><p>🔹 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng.</p><p>🔹 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển).</p><div><br></div>', 0, 0, 1, 23),
(80, 'Áo sơ mi dài tay', '600', '520', 150, 'product-featured-80.jpg', '<p>Áo sơ mi công sở nam cao cấp, thiết kế thanh lịch, phù hợp cho môi trường văn phòng và sự kiện quan trọng. Chất liệu vải mềm mại, thoáng khí, thấm hút mồ hôi tốt, mang lại cảm giác thoải mái cả ngày dài. Đường may tỉ mỉ, form dáng chuẩn giúp tôn lên phong thái lịch lãm.</p><div><br></div>', '<p>\"Áo sơ mi công sở nam lịch lãm, chất liệu cao cấp - tự tin mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/Polyester cao cấp, thoáng mát</p><p>✔ Form slim fit/regular fit thời trang, dễ phối đồ</p><p>✔ Màu sắc trang nhã, không phai, bền đẹp theo thời gian</p><p>✔ Cổ áo đứng form, khuy cài chắc chắn</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>Không áp dụng đổi trả với sản phẩm đã giặt hoặc hư hỏng do khách hàng</p><div><br></div>', 0, 0, 1, 22),
(81, 'Sơ mi công sở tay dài cho nam', '600', '520', 150, 'product-featured-81.jpg', '<p>Áo sơ mi công sở nam cao cấp, thiết kế thanh lịch, phù hợp cho môi trường văn phòng và sự kiện quan trọng. Chất liệu vải mềm mại, thoáng khí, thấm hút mồ hôi tốt, mang lại cảm giác thoải mái cả ngày dài. Đường may tỉ mỉ, form dáng chuẩn giúp tôn lên phong thái lịch lãm.</p><div><br></div>', '<p>\"Áo sơ mi công sở nam lịch lãm, chất liệu cao cấp - tự tin mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/Polyester cao cấp, thoáng mát</p><p>✔ Form slim fit/regular fit thời trang, dễ phối đồ</p><p>✔ Màu sắc trang nhã, không phai, bền đẹp theo thời gian</p><p>✔ Cổ áo đứng form, khuy cài chắc chắn</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>Không áp dụng đổi trả với sản phẩm đã giặt hoặc hư hỏng do khách hàng</p><div><br></div>', 0, 0, 1, 22),
(82, 'Sơ mi tay ngắn cho nam', '600', '520', 130, 'product-featured-82.jpg', '<p>Áo sơ mi công sở nam cao cấp, thiết kế thanh lịch, phù hợp cho môi trường văn phòng và sự kiện quan trọng. Chất liệu vải mềm mại, thoáng khí, thấm hút mồ hôi tốt, mang lại cảm giác thoải mái cả ngày dài. Đường may tỉ mỉ, form dáng chuẩn giúp tôn lên phong thái lịch lãm.</p><p><br></p>', '<p>\"Áo sơ mi công sở nam lịch lãm, chất liệu cao cấp - tự tin mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/Polyester cao cấp, thoáng mát</p><p>✔ Form slim fit/regular fit thời trang, dễ phối đồ</p><p>✔ Màu sắc trang nhã, không phai, bền đẹp theo thời gian</p><p>✔ Cổ áo đứng form, khuy cài chắc chắn</p><p><br></p>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>Không áp dụng đổi trả với sản phẩm đã giặt hoặc hư hỏng do khách hàng</p><div><br></div>', 0, 0, 1, 22),
(83, 'Áo thun mùa hè cho nam', '350', '280', 200, 'product-featured-83.jpg', '<p>Áo thun nam phong cách trẻ trung, chất liệu cotton mềm mại, thoáng khí, thấm hút mồ hôi tốt. Thiết kế basic dễ phối đồ, phù hợp cho mọi hoàn cảnh từ đi chơi, đi làm đến tập luyện thể thao.</p><div><br></div>', '<p>\"Áo thun nam mềm mại, thoáng mát - phong cách năng động cho mọi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu cotton co giãn, thoáng mát</p><p>✔ Form dáng chuẩn, không bai nhão sau khi giặt</p><p>✔ Đa dạng màu sắc, dễ dàng phối hợp trang phục</p><p>✔ Đường may chắc chắn, bền đẹp theo thời gian</p><div><br></div>', '<p>🔄 Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>🚫 Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc giặt tẩy</p><p>📦 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 20),
(84, 'Áo thun cổ chun mùa hè', '350', '280', 140, 'product-featured-84.jpg', '<p>Áo thun nam phong cách trẻ trung, chất liệu cotton mềm mại, thoáng khí, thấm hút mồ hôi tốt. Thiết kế basic dễ phối đồ, phù hợp cho mọi hoàn cảnh từ đi chơi, đi làm đến tập luyện thể thao.</p><p><br></p>', '<p>\"Áo thun nam mềm mại, thoáng mát - phong cách năng động cho mọi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu cotton co giãn, thoáng mát</p><p>✔ Form dáng chuẩn, không bai nhão sau khi giặt</p><p>✔ Đa dạng màu sắc, dễ dàng phối hợp trang phục</p><p>✔ Đường may chắc chắn, bền đẹp theo thời gian</p><div><br></div>', '<p>🔄 Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>🚫 Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc giặt tẩy</p><p>📦 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 20),
(85, 'Áo thun vải mát ', '350', '280', 150, 'product-featured-85.jpg', '<p>Áo thun nam phong cách trẻ trung, chất liệu cotton mềm mại, thoáng khí, thấm hút mồ hôi tốt. Thiết kế basic dễ phối đồ, phù hợp cho mọi hoàn cảnh từ đi chơi, đi làm đến tập luyện thể thao.</p><div><br></div>', '<p>\"Áo thun nam mềm mại, thoáng mát - phong cách năng động cho mọi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu cotton co giãn, thoáng mát</p><p>✔ Form dáng chuẩn, không bai nhão sau khi giặt</p><p>✔ Đa dạng màu sắc, dễ dàng phối hợp trang phục</p><p>✔ Đường may chắc chắn, bền đẹp theo thời gian</p><div><br></div>', '<p>🔄 Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>🚫 Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc giặt tẩy</p><p>📦 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 20),
(86, 'Dép quai ngang thoải mái', '290', '230', 200, 'product-featured-86.jpg', '<p>Dép nam thời trang, thiết kế hiện đại, chất liệu cao cấp, êm ái và bền bỉ. Phù hợp cho cả đi trong nhà và ngoài trời, mang lại cảm giác thoải mái suốt ngày dài.</p><p><br></p>', '<p>\"Dép nam bền đẹp, êm ái - thoải mái di chuyển mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu chống trơn trượt, êm chân</p><p>✔ Kiểu dáng thời thượng, dễ phối đồ</p><p>✔ Đế bền, đàn hồi tốt, thoáng khí</p><p>✔ Đa dạng màu sắc, kích cỡ</p><div><br></div>', '<p>🔹 Đổi trả trong vòng 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất hoặc giao nhầm mẫu/màu/size.</p><p>🔹 Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>🔹 Không hỗ trợ đổi trả do chọn sai kích cỡ hoặc sở thích cá nhân.</p><div><br></div>', 0, 0, 1, 4),
(87, 'Dép quai ngang thoải mái', '290', '230', 250, 'product-featured-87.jpg', '<p>Dép nam thời trang, thiết kế hiện đại, chất liệu cao cấp, êm ái và bền bỉ. Phù hợp cho cả đi trong nhà và ngoài trời, mang lại cảm giác thoải mái suốt ngày dài.</p><p><br></p>', '<p>\"Dép nam bền đẹp, êm ái - thoải mái di chuyển mọi lúc, mọi nơi!\"</p>', '<p>✔ Chất liệu chống trơn trượt, êm chân</p><p>✔ Kiểu dáng thời thượng, dễ phối đồ</p><p>✔ Đế bền, đàn hồi tốt, thoáng khí</p><p>✔ Đa dạng màu sắc, kích cỡ</p><div><br></div>', '<p>🔹 Đổi trả trong vòng 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất hoặc giao nhầm mẫu/màu/size.</p><p>🔹 Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>🔹 Không hỗ trợ đổi trả do chọn sai kích cỡ hoặc sở thích cá nhân.</p><div><br></div>', 0, 0, 1, 4),
(88, 'Dép quai ngang thoải mái', '290', '230', 230, 'product-featured-88.jpg', '<p>Dép nam thời trang, thiết kế hiện đại, chất liệu cao cấp, êm ái và bền bỉ. Phù hợp cho cả đi trong nhà và ngoài trời, mang lại cảm giác thoải mái suốt ngày dài.</p><p><br></p>', '<p>\"Dép nam bền đẹp, êm ái - thoải mái di chuyển mọi lúc, mọi nơi!\"</p>', '<p>✔ Chất liệu chống trơn trượt, êm chân</p><p>✔ Kiểu dáng thời thượng, dễ phối đồ</p><p>✔ Đế bền, đàn hồi tốt, thoáng khí</p><p>✔ Đa dạng màu sắc, kích cỡ</p><div><br></div>', '<p>🔹 Đổi trả trong vòng 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất hoặc giao nhầm mẫu/màu/size.</p><p>🔹 Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>🔹 Không hỗ trợ đổi trả do chọn sai kích cỡ hoặc sở thích cá nhân.</p><div><br></div>', 0, 0, 1, 4),
(89, 'Giày da bóng cho nam', '820', '750', 240, 'product-featured-89.jpg', '<p>Giày công sở nam cao cấp – thiết kế thanh lịch, chất liệu da thật mềm mại, bền bỉ. Đế cao su chống trượt, êm ái, phù hợp cho môi trường công sở và các dịp quan trọng.</p><p><br></p>', '<p>\"Giày công sở nam sang trọng, bền đẹp - tôn lên vẻ lịch lãm, chuyên nghiệp!\"</p><div><br></div>', '<p>✔ Chất liệu da bò thật, bền đẹp theo thời gian</p><p>✔ Đế cao su chống trơn trượt, ma sát tốt</p><p>✔ Kiểu dáng sang trọng, dễ phối đồ</p><p>✔ Lót giày êm ái, thoáng khí, mang cả ngày không đau chân</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu lỗi từ nhà sản xuất</p><p>🔹 Sản phẩm chưa qua sử dụng, còn nguyên hộp và hóa đơn</p><p>🔹 Hỗ trợ đổi size miễn phí (tùy điều kiện)</p><div><br></div>', 0, 0, 1, 56),
(90, 'Giày da cao cấp cho nam', '820', '750', 200, 'product-featured-90.jpg', '<p>Giày công sở nam cao cấp – thiết kế thanh lịch, chất liệu da thật mềm mại, bền bỉ. Đế cao su chống trượt, êm ái, phù hợp cho môi trường công sở và các dịp quan trọng.</p><p><br></p>', '<p> \"Giày công sở nam sang trọng, bền đẹp - tôn lên vẻ lịch lãm, chuyên nghiệp!\"</p><div><br></div>', '<p>✔ Chất liệu da bò thật, bền đẹp theo thời gian</p><p>✔ Đế cao su chống trơn trượt, ma sát tốt</p><p>✔ Kiểu dáng sang trọng, dễ phối đồ</p><p>✔ Lót giày êm ái, thoáng khí, mang cả ngày không đau chân</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu lỗi từ nhà sản xuất</p><p>🔹 Sản phẩm chưa qua sử dụng, còn nguyên hộp và hóa đơn</p><p>🔹 Hỗ trợ đổi size miễn phí (tùy điều kiện)</p>', 0, 0, 1, 56),
(91, 'Giày da đi làm dành cho nam', '820', '750', 240, 'product-featured-91.jpg', '<p>Giày công sở nam cao cấp – thiết kế thanh lịch, chất liệu da thật mềm mại, bền bỉ. Đế cao su chống trượt, êm ái, phù hợp cho môi trường công sở và các dịp quan trọng.</p><p><br></p>', '<p>\"Giày công sở nam sang trọng, bền đẹp - tôn lên vẻ lịch lãm, chuyên nghiệp!\"</p><div><br></div>', '<p>✔ Chất liệu da bò thật, bền đẹp theo thời gian</p><p>✔ Đế cao su chống trơn trượt, ma sát tốt</p><p>✔ Kiểu dáng sang trọng, dễ phối đồ</p><p>✔ Lót giày êm ái, thoáng khí, mang cả ngày không đau chân</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu lỗi từ nhà sản xuất</p><p>🔹 Sản phẩm chưa qua sử dụng, còn nguyên hộp và hóa đơn</p><p>🔹 Hỗ trợ đổi size miễn phí (tùy điều kiện)</p><div><br></div>', 0, 0, 1, 56),
(92, 'Sandal đi học thoải mái', '590', '520', 300, 'product-featured-92.jpg', '<p>Giày sandal nam thời trang, thiết kế năng động, phù hợp cho cả đi chơi và dạo phố. Chất liệu cao cấp, đế chống trơn trượt, mang lại cảm giác êm ái và thoải mái suốt cả ngày.</p><p><br></p>', '<p>\"Giày nam đơn giản, thoải mái - phù hợp cho mọi hoạt động hằng ngày!\"</p><div><br></div>', '<p>✔ Chất liệu bền bỉ, thoáng khí</p><p>✔ Đế cao su chống trơn, bám đường tốt</p><p>✔ Quai dán chắc chắn, dễ điều chỉnh</p><p>✔ Thiết kế thời trang, phù hợp nhiều phong cách</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem, chưa qua sử dụng</p><p>Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 25),
(93, 'Shondo mang đi học thoải mái', '590', '520', 260, 'product-featured-93.jpg', '<p>Giày sandal nam thời trang, thiết kế năng động, phù hợp cho cả đi chơi và dạo phố. Chất liệu cao cấp, đế chống trơn trượt, mang lại cảm giác êm ái và thoải mái suốt cả ngày.</p><p><br></p>', '<p>\"Giày nam đơn giản, thoải mái - phù hợp cho mọi hoạt động hằng ngày!\"</p><div><br></div>', '<p>✔ Chất liệu bền bỉ, thoáng khí</p><p>✔ Đế cao su chống trơn, bám đường tốt</p><p>✔ Quai dán chắc chắn, dễ điều chỉnh</p><p>✔ Thiết kế thời trang, phù hợp nhiều phong cách</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem, chưa qua sử dụng</p><p>Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 25),
(94, 'Sandal đi học cho nam', '590', '520', 320, 'product-featured-94.jpg', '<p>Giày sandal nam thời trang, thiết kế năng động, phù hợp cho cả đi chơi và dạo phố. Chất liệu cao cấp, đế chống trơn trượt, mang lại cảm giác êm ái và thoải mái suốt cả ngày.</p><p><br></p>', '<p>\"Giày nam đơn giản, thoải mái - phù hợp cho mọi hoạt động hằng ngày!\"</p><div><br></div>', '<p>✔ Chất liệu bền bỉ, thoáng khí</p><p>✔ Đế cao su chống trơn, bám đường tốt</p><p>✔ Quai dán chắc chắn, dễ điều chỉnh\r\n<br class=\"Apple-interchange-newline\"></p><p>✔ Thiết kế thời trang, phù hợp nhiều phong cách</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem, chưa qua sử dụng</p><p>Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 25),
(95, 'Thắt lưng da cao cấp', '550', '480', 200, 'product-featured-95.jpg', '<p>Thắt lưng nam cao cấp, thiết kế sang trọng, chất liệu da thật bền bỉ, khóa hợp kim chống gỉ. Phù hợp với mọi phong cách từ công sở đến dạo phố.</p><div><br></div>', '<p>\"Thắt lưng nam da cao cấp, bền đẹp - tôn lên vẻ lịch lãm, nam tính!\"</p><div><br></div>', '<p>✅ Chất liệu da thật mềm mại, bền đẹp theo thời gian</p><p>✅ Khóa tự động/bấm tiện lợi, chắc chắn</p><p>✅ Độ dài điều chỉnh linh hoạt, phù hợp nhiều vòng eo</p><p>✅ Phù hợp với nhiều phong cách thời trang</p><div><br></div>', '<p>✔️ Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>✔️ Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng</p><p>✔️ Hỗ trợ đổi size nếu không vừa (chi phí vận chuyển do khách hàng chịu)</p><div><br></div>', 0, 0, 1, 57),
(96, 'Thắt lưng da cao cấp', '550', '480', 120, 'product-featured-96.jpg', '<p>Thắt lưng nam cao cấp, thiết kế sang trọng, chất liệu da thật bền bỉ, khóa hợp kim chống gỉ. Phù hợp với mọi phong cách từ công sở đến dạo phố.</p><p><br></p>', '<p> \"Thắt lưng nam da cao cấp, bền đẹp - tôn lên vẻ lịch lãm, nam tính!\"</p><div><br></div>', '<p>✅ Chất liệu da thật mềm mại, bền đẹp theo thời gian</p><p>✅ Khóa tự động/bấm tiện lợi, chắc chắn</p><p>✅ Độ dài điều chỉnh linh hoạt, phù hợp nhiều vòng eo</p><p>✅ Phù hợp với nhiều phong cách thời trang</p><div><br></div>', '<p>✔️ Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>✔️ Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng</p><p>✔️ Hỗ trợ đổi size nếu không vừa (chi phí vận chuyển do khách hàng chịu)</p><div><br></div>', 0, 0, 1, 57),
(97, 'Thắt lưng da cao cấp', '550', '480', 130, 'product-featured-97.jpg', '<p>Thắt lưng nam cao cấp, thiết kế sang trọng, chất liệu da thật bền bỉ, khóa hợp kim chống gỉ. Phù hợp với mọi phong cách từ công sở đến dạo phố.</p><p><br></p>', '<p>\"Thắt lưng nam da cao cấp, bền đẹp - tôn lên vẻ lịch lãm, nam tính!\"</p><div><br></div>', '<p>✅ Chất liệu da thật mềm mại, bền đẹp theo thời gian</p><p>✅ Khóa tự động/bấm tiện lợi, chắc chắn</p><p>✅ Độ dài điều chỉnh linh hoạt, phù hợp nhiều vòng eo</p><p>✅ Phù hợp với nhiều phong cách thời trang</p><div><br></div>', '<p>✔️ Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>✔️ Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng</p><p>✔️ Hỗ trợ đổi size nếu không vừa (chi phí vận chuyển do khách hàng chịu)</p><div><br></div>', 0, 0, 1, 57),
(98, 'Túi đeo chéo da cao cấp', '720', '650', 200, 'product-featured-98.jpg', '<p>Túi đeo chéo nam phong cách thời trang, thiết kế nhỏ gọn nhưng rộng rãi, phù hợp để đựng điện thoại, ví, chìa khóa và các vật dụng cá nhân. Chất liệu da PU cao cấp (hoặc vải canvas bền đẹp), chống thấm nhẹ, đường may tỉ mỉ, mang lại vẻ nam tính và tiện dụng cho mọi hoàn cảnh.</p><div><br></div>', '<p>\"Túi nam thời trang, tiện lợi - đồng hành cùng bạn mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✅ Thiết kế thời trang, dễ phối đồ</p><p>✅ Chất liệu bền bỉ, chống thấm nước nhẹ</p><p>✅ Ngăn chứa tiện lợi, khóa kéo chắc chắn</p><p>✅ Dây đeo điều chỉnh linh hoạt, phù hợp mọi dáng người</p><div><br></div>', '<p>Hỗ trợ đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với lý do không ưng ý hoặc sử dụng sai cách.</p><div><br></div>', 0, 0, 1, 59),
(99, 'Túi đeo chéo nam vải cao cấp', '720', '650', 130, 'product-featured-99.jpg', '<p>Túi đeo chéo nam phong cách thời trang, thiết kế nhỏ gọn nhưng rộng rãi, phù hợp để đựng điện thoại, ví, chìa khóa và các vật dụng cá nhân. Chất liệu da PU cao cấp (hoặc vải canvas bền đẹp), chống thấm nhẹ, đường may tỉ mỉ, mang lại vẻ nam tính và tiện dụng cho mọi hoàn cảnh.</p><div><br></div>', '<p>\"Túi nam thời trang, tiện lợi - đồng hành cùng bạn mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✅ Thiết kế thời trang, dễ phối đồ</p><p>✅ Chất liệu bền bỉ, chống thấm nước nhẹ</p><p>✅ Ngăn chứa tiện lợi, khóa kéo chắc chắn</p><p>✅ Dây đeo điều chỉnh linh hoạt, phù hợp mọi dáng người</p><div><br></div>', '<p>Hỗ trợ đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với lý do không ưng ý hoặc sử dụng sai cách.</p><div><br></div>', 0, 0, 1, 59),
(100, 'Túi đeo chéo vải chống thấm nước', '720', '650', 150, 'product-featured-100.jpg', '<p>Túi đeo chéo nam phong cách thời trang, thiết kế nhỏ gọn nhưng rộng rãi, phù hợp để đựng điện thoại, ví, chìa khóa và các vật dụng cá nhân. Chất liệu da PU cao cấp (hoặc vải canvas bền đẹp), chống thấm nhẹ, đường may tỉ mỉ, mang lại vẻ nam tính và tiện dụng cho mọi hoàn cảnh.</p><div><br></div>', '<p>\"Túi nam thời trang, tiện lợi - đồng hành cùng bạn mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✅ Thiết kế thời trang, dễ phối đồ</p><p>✅ Chất liệu bền bỉ, chống thấm nước nhẹ</p><p>✅ Ngăn chứa tiện lợi, khóa kéo chắc chắn</p><p>✅ Dây đeo điều chỉnh linh hoạt, phù hợp mọi dáng người</p><div><br></div>', '<p>Hỗ trợ đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với lý do không ưng ý hoặc sử dụng sai cách.</p><div><br></div>', 0, 0, 1, 59),
(101, 'Nón kết nam lưới', '300', '250', 200, 'product-featured-101.jpg', '<p>Nón kết nam phong cách thời trang, thiết kế trẻ trung, chất liệu cao cấp thoáng khí, mang lại cảm giác thoải mái khi đội. Phù hợp cho cả đi chơi, du lịch, thể thao và sử dụng hằng ngày.</p><div><br></div>', '<p>\"Mũ nam thời trang, phong cách - bảo vệ khỏi nắng, hoàn thiện outfit!\"</p><div><br></div>', '<p>✔ Chất liệu: Vải cotton cao cấp, thoáng khí</p><p>✔ Kiểu dáng: Nón lưỡi trai unisex, dễ phối đồ</p><p>✔ Kích thước: Freesize, có dây điều chỉnh phù hợp với nhiều vòng đầu</p><p>✔ Màu sắc: Đa dạng, phù hợp với nhiều phong cách</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu</p><p>✅ Sản phẩm phải còn nguyên tem mác, không qua sử dụng</p><p>✅ Hỗ trợ đổi sang sản phẩm khác hoặc hoàn tiền theo quy định</p><div><br></div>', 0, 0, 1, 1),
(102, 'Nón kết nam phong cách', '300', '250', 150, 'product-featured-102.jpg', '<p>Nón kết nam phong cách thời trang, thiết kế trẻ trung, chất liệu cao cấp thoáng khí, mang lại cảm giác thoải mái khi đội. Phù hợp cho cả đi chơi, du lịch, thể thao và sử dụng hằng ngày.</p><p><br></p>', '<p>\"Mũ nam thời trang, phong cách - bảo vệ khỏi nắng, hoàn thiện outfit!\"</p><div><br></div>', '<p>✔ Chất liệu: Vải cotton cao cấp, thoáng khí</p><p>✔ Kiểu dáng: Nón lưỡi trai unisex, dễ phối đồ</p><p>✔ Kích thước: Freesize, có dây điều chỉnh phù hợp với nhiều vòng đầu</p><p>✔ Màu sắc: Đa dạng, phù hợp với nhiều phong cách</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu</p><p>✅ Sản phẩm phải còn nguyên tem mác, không qua sử dụng</p><p>✅ Hỗ trợ đổi sang sản phẩm khác hoặc hoàn tiền theo quy định</p><div><br></div>', 0, 0, 1, 1),
(103, 'Nón kết nam nhiều màu', '300', '250', 150, 'product-featured-103.jpg', '<p>Nón kết nam phong cách thời trang, thiết kế trẻ trung, chất liệu cao cấp thoáng khí, mang lại cảm giác thoải mái khi đội. Phù hợp cho cả đi chơi, du lịch, thể thao và sử dụng hằng ngày.</p><div><br></div>', '<p>\"Mũ nam thời trang, phong cách - bảo vệ khỏi nắng, hoàn thiện outfit!\"</p><div><br></div>', '<p>✔ Chất liệu: Vải cotton cao cấp, thoáng khí</p><p>✔ Kiểu dáng: Nón lưỡi trai unisex, dễ phối đồ</p><p>✔ Kích thước: Freesize, có dây điều chỉnh phù hợp với nhiều vòng đầu</p><p>✔ Màu sắc: Đa dạng, phù hợp với nhiều phong cách</p><p><br></p>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu</p><p>✅ Sản phẩm phải còn nguyên tem mác, không qua sử dụng</p><p>✅ Hỗ trợ đổi sang sản phẩm khác hoặc hoàn tiền theo quy định</p><div><br></div>', 0, 0, 1, 1),
(104, 'Quần jeans nam loang màu đẹp', '650', '570', 300, 'product-featured-104.jpg', '<p>Quần jeans nam thời trang, phong cách hiện đại, phù hợp cho mọi hoàn cảnh. Chất liệu denim cao cấp, co giãn nhẹ, tạo cảm giác thoải mái suốt cả ngày. Thiết kế trẻ trung, form dáng chuẩn, dễ dàng phối đồ.</p><p><br></p>', '<p>\"Quần jeans nam bền đẹp, phong cách - thoải mái cho mọi hoạt động!\"</p><div><br></div>', '<p>✔ Chất liệu denim bền đẹp, không xù, không bai dão</p><p>✔ Form dáng chuẩn, tôn dáng nam giới</p><p>✔ Co giãn nhẹ, thoải mái vận động</p><p>✔ Dễ phối với áo thun, sơ mi, giày thể thao</p><p><br></p>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất hoặc sai mẫu, sai size.</p><p>✅ Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng và giữ hóa đơn mua hàng.</p><p>✅ Không áp dụng đổi trả với sản phẩm đã qua sử dụng, giặt tẩy hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 17),
(105, 'Quần jeans rách sành điệu', '650', '570', 350, 'product-featured-105.jpg', '<p>Quần jeans nam thời trang, phong cách hiện đại, phù hợp cho mọi hoàn cảnh. Chất liệu denim cao cấp, co giãn nhẹ, tạo cảm giác thoải mái suốt cả ngày. Thiết kế trẻ trung, form dáng chuẩn, dễ dàng phối đồ.</p><div><br></div>', '<p>\"Quần jeans nam bền đẹp, phong cách - thoải mái cho mọi hoạt động!\"</p><div><br></div>', '<p>✔ Chất liệu denim bền đẹp, không xù, không bai dão</p><p>✔ Form dáng chuẩn, tôn dáng nam giới</p><p>✔ Co giãn nhẹ, thoải mái vận động</p><p>✔ Dễ phối với áo thun, sơ mi, giày thể thao</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất hoặc sai mẫu, sai size.</p><p>✅ Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng và giữ hóa đơn mua hàng.</p><p>✅ Không áp dụng đổi trả với sản phẩm đã qua sử dụng, giặt tẩy hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 17),
(106, 'Quần jeans nâu tây ống rộng', '650', '570', 300, 'product-featured-106.jpg', '<p>Quần jeans nam thời trang, phong cách hiện đại, phù hợp cho mọi hoàn cảnh. Chất liệu denim cao cấp, co giãn nhẹ, tạo cảm giác thoải mái suốt cả ngày. Thiết kế trẻ trung, form dáng chuẩn, dễ dàng phối đồ.</p><p><br></p>', '<p>\"Quần jeans nam bền đẹp, phong cách - thoải mái cho mọi hoạt động!\"</p><div><br></div>', '<p>✔ Chất liệu denim bền đẹp, không xù, không bai dão</p><p>✔ Form dáng chuẩn, tôn dáng nam giới</p><p>✔ Co giãn nhẹ, thoải mái vận động</p><p>✔ Dễ phối với áo thun, sơ mi, giày thể thao</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất hoặc sai mẫu, sai size.</p><p>✅ Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng và giữ hóa đơn mua hàng.</p><p>✅ Không áp dụng đổi trả với sản phẩm đã qua sử dụng, giặt tẩy hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 17),
(107, 'Quần dài nỉ tăm nam', '550', '480', 200, 'product-featured-107.jpg', '<p>Quần jogger nam thiết kế năng động, chất liệu cao cấp thoáng khí, co giãn tốt, mang lại sự thoải mái tối đa khi vận động. Phù hợp cho tập luyện, dạo phố hoặc mặc nhà.</p><div><br></div>', '<p>\"Quần jogger nam năng động, thoải mái - hoàn hảo cho tập luyện và dạo phố!\"</p><div><br></div>', '<p>✔ Chất vải mềm mại, co giãn 4 chiều</p><p>✔ Cạp chun linh hoạt, ôm vừa vặn</p><p>✔ Kiểu dáng hiện đại, dễ phối đồ</p><p>✔ Túi tiện lợi, có khóa kéo an toàn</p><div><br></div>', '<p>🔄 Đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc không đúng mô tả</p><p>📦 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>🚚 Hỗ trợ đổi size miễn phí (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 18),
(108, 'Quần Jogger nam kaki', '550', '480', 200, 'product-featured-108.jpg', '<p>Quần jogger nam thiết kế năng động, chất liệu cao cấp thoáng khí, co giãn tốt, mang lại sự thoải mái tối đa khi vận động. Phù hợp cho tập luyện, dạo phố hoặc mặc nhà.</p><div><br></div>', '<p>\"Quần jogger nam năng động, thoải mái - hoàn hảo cho tập luyện và dạo phố!\"</p><div><br></div>', '<p>✔ Chất vải mềm mại, co giãn 4 chiều</p><p>✔ Cạp chun linh hoạt, ôm vừa vặn</p><p>✔ Kiểu dáng hiện đại, dễ phối đồ</p><p>✔ Túi tiện lợi, có khóa kéo an toàn</p><div><br></div>', '<p>🔄 Đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc không đúng mô tả</p><p>📦 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>🚚 Hỗ trợ đổi size miễn phí (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 18),
(109, 'Quần jogger nam chât vải gió cao cấp', '550', '480', 200, 'product-featured-109.jpg', '<p>Quần jogger nam thiết kế năng động, chất liệu cao cấp thoáng khí, co giãn tốt, mang lại sự thoải mái tối đa khi vận động. Phù hợp cho tập luyện, dạo phố hoặc mặc nhà.</p><div><br></div>', '<p>\"Quần jogger nam năng động, thoải mái - hoàn hảo cho tập luyện và dạo phố!\"</p><div><br></div>', '<p>✔ Chất vải mềm mại, co giãn 4 chiều</p><p>✔ Cạp chun linh hoạt, ôm vừa vặn</p><p>✔ Kiểu dáng hiện đại, dễ phối đồ</p><p>✔ Túi tiện lợi, có khóa kéo an toàn</p><div><br></div>', '<p>🔄 Đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc không đúng mô tả</p><p>📦 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>🚚 Hỗ trợ đổi size miễn phí (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 18),
(110, 'Quần short thun thoải mái', '420', '350', 200, 'product-featured-110.jpg', '<p>Quần short nam phong cách thời trang, chất liệu cao cấp, thoáng mát, phù hợp cho cả hoạt động thường ngày và thể thao. Thiết kế năng động, dễ phối đồ, mang lại sự thoải mái tối đa.</p><div><br></div>', '<p>\"Quần short nam thoáng mát, thoải mái - lựa chọn hoàn hảo cho ngày hè!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/jeans/khaki bền đẹp, thấm hút tốt</p><p>✔ Form dáng trẻ trung, dễ kết hợp với áo thun, polo</p><p>✔ Co giãn nhẹ, tạo cảm giác thoải mái khi vận động</p><p>✔ Đường may chắc chắn, bền bỉ theo thời gian</p><div><br></div>', '<p>✅ Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất</p><p>✅ Sản phẩm phải còn nguyên tem, nhãn mác, chưa qua sử dụng</p><p>✅ Hỗ trợ đổi size nếu không vừa (khách hàng chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 19),
(111, 'Quần kaki ngắn nam', '420', '350', 150, 'product-featured-111.jpg', '<p>Quần short nam phong cách thời trang, chất liệu cao cấp, thoáng mát, phù hợp cho cả hoạt động thường ngày và thể thao. Thiết kế năng động, dễ phối đồ, mang lại sự thoải mái tối đa.</p><p><br></p>', '<p>\"Quần short nam thoáng mát, thoải mái - lựa chọn hoàn hảo cho ngày hè!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/jeans/khaki bền đẹp, thấm hút tốt</p><p>✔ Form dáng trẻ trung, dễ kết hợp với áo thun, polo</p><p>✔ Co giãn nhẹ, tạo cảm giác thoải mái khi vận động</p><p>✔ Đường may chắc chắn, bền bỉ theo thời gian</p><div><br></div>', '<p>✅ Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất</p><p>✅ Sản phẩm phải còn nguyên tem, nhãn mác, chưa qua sử dụng</p><p>✅ Hỗ trợ đổi size nếu không vừa (khách hàng chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 19),
(112, 'Quần jeans short nam ', '420', '350', 170, 'product-featured-112.jpg', '<p>Quần short nam phong cách thời trang, chất liệu cao cấp, thoáng mát, phù hợp cho cả hoạt động thường ngày và thể thao. Thiết kế năng động, dễ phối đồ, mang lại sự thoải mái tối đa.</p><div><br></div>', '<p>\"Quần short nam thoáng mát, thoải mái - lựa chọn hoàn hảo cho ngày hè!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/jeans/khaki bền đẹp, thấm hút tốt</p><p>✔ Form dáng trẻ trung, dễ kết hợp với áo thun, polo</p><p>✔ Co giãn nhẹ, tạo cảm giác thoải mái khi vận động</p><p>✔ Đường may chắc chắn, bền bỉ theo thời gian</p><div><br></div>', '<p>✅ Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất</p><p>✅ Sản phẩm phải còn nguyên tem, nhãn mác, chưa qua sử dụng</p><p>✅ Hỗ trợ đổi size nếu không vừa (khách hàng chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 19),
(113, 'Dép Hello Kitty', '290', '230', 300, 'product-featured-113.jpg', '<p>Dép nữ thời trang, thiết kế thanh lịch và thoải mái, phù hợp cho mọi phong cách. Chất liệu cao cấp, bền đẹp, mang đến cảm giác êm ái khi sử dụng. Dễ dàng phối hợp với nhiều trang phục, thích hợp cho đi chơi, dạo phố hay sử dụng hàng ngày.</p><div><br></div>', '<p>\"Dép nữ thời trang, êm ái - thoải mái bước đi mỗi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu: [Cao su mềm/Da tổng hợp/Vải cao cấp]</p><p>✔ Kiểu dáng: [Dép bệt/Dép quai hậu/Dép xỏ ngón]</p><p>✔ Đế chống trơn trượt, êm ái, không gây đau chân</p><p>✔ Nhiều màu sắc thời trang, dễ dàng phối đồ</p><div><br></div>', '<p>Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><p>Khách hàng chịu phí vận chuyển khi đổi trả nếu không phải lỗi từ nhà sản xuất.</p><div><br></div>', 0, 0, 1, 12),
(114, 'Dép quai ngang nữ', '290', '230', 200, 'product-featured-114.jpg', '<p>Dép nữ thời trang, thiết kế thanh lịch và thoải mái, phù hợp cho mọi phong cách. Chất liệu cao cấp, bền đẹp, mang đến cảm giác êm ái khi sử dụng. Dễ dàng phối hợp với nhiều trang phục, thích hợp cho đi chơi, dạo phố hay sử dụng hàng ngày.</p><div><br></div>', '<p>\"Dép nữ thời trang, êm ái - thoải mái bước đi mỗi ngày!\"</p>', '<p>✔ Chất liệu: [Cao su mềm/Da tổng hợp/Vải cao cấp]</p><p>✔ Kiểu dáng: [Dép bệt/Dép quai hậu/Dép xỏ ngón]</p><p>✔ Đế chống trơn trượt, êm ái, không gây đau chân</p><p>✔ Nhiều màu sắc thời trang, dễ dàng phối đồ</p><div><br></div>', '<p>Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><p>Khách hàng chịu phí vận chuyển khi đổi trả nếu không phải lỗi từ nhà sản xuất.</p><div><br></div>', 0, 0, 1, 12),
(115, 'Dép quai ngang', '290', '230', 280, 'product-featured-115.jpg', '<p>Dép nữ thời trang, thiết kế thanh lịch và thoải mái, phù hợp cho mọi phong cách. Chất liệu cao cấp, bền đẹp, mang đến cảm giác êm ái khi sử dụng. Dễ dàng phối hợp với nhiều trang phục, thích hợp cho đi chơi, dạo phố hay sử dụng hàng ngày.</p><p><br></p>', '<p>\"Dép nữ thời trang, êm ái - thoải mái bước đi mỗi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu: [Cao su mềm/Da tổng hợp/Vải cao cấp]</p><p>✔ Kiểu dáng: [Dép bệt/Dép quai hậu/Dép xỏ ngón]</p><p>✔ Đế chống trơn trượt, êm ái, không gây đau chân</p><p>✔ Nhiều màu sắc thời trang, dễ dàng phối đồ</p><div><br></div>', '<p>Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><p>Khách hàng chịu phí vận chuyển khi đổi trả nếu không phải lỗi từ nhà sản xuất.</p><div><br></div>', 0, 0, 1, 12),
(116, 'Giày cao gót đơn giản, cổ điển', '820', '750', 200, 'product-featured-116.jpg', '<p>Giày cao gót nữ thanh lịch, tôn dáng và phù hợp cho mọi dịp – từ công sở đến dạ tiệc. Thiết kế tinh tế, chất liệu bền đẹp, mang lại cảm giác thoải mái và tự tin khi sải bước.</p><div><br></div>', '<p>\"Giày cao gót thanh lịch, tôn dáng - bước đi tự tin, cuốn hút mọi ánh nhìn!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp theo thời gian.</p><p>Thiết kế thời trang: Đa dạng kiểu dáng, màu sắc sang trọng, dễ phối đồ.</p><p>Chiều cao gót: Từ 3cm - 10cm, phù hợp với nhu cầu sử dụng.</p><p>Đế chống trượt: An toàn, chắc chắn khi di chuyển.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 50),
(117, 'Giày cao gót đi tiệc lấp lánh', '820', '750', 200, 'product-featured-117.jpg', '<p>Giày cao gót nữ thanh lịch, tôn dáng và phù hợp cho mọi dịp – từ công sở đến dạ tiệc. Thiết kế tinh tế, chất liệu bền đẹp, mang lại cảm giác thoải mái và tự tin khi sải bước.</p><p><br></p>', '<p>\"Giày cao gót thanh lịch, tôn dáng - bước đi tự tin, cuốn hút mọi ánh nhìn!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp theo thời gian.</p><p>Thiết kế thời trang: Đa dạng kiểu dáng, màu sắc sang trọng, dễ phối đồ.</p><p>Chiều cao gót: Từ 3cm - 10cm, phù hợp với nhu cầu sử dụng.</p><p>Đế chống trượt: An toàn, chắc chắn khi di chuyển.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 50),
(118, 'Giày cao gót đi tiệc bóng loáng', '820', '750', 200, 'product-featured-118.jpg', '<p>Giày cao gót nữ thanh lịch, tôn dáng và phù hợp cho mọi dịp – từ công sở đến dạ tiệc. Thiết kế tinh tế, chất liệu bền đẹp, mang lại cảm giác thoải mái và tự tin khi sải bước.</p><div><br></div>', '<p>\"Giày cao gót thanh lịch, tôn dáng - bước đi tự tin, cuốn hút mọi ánh nhìn!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp theo thời gian.</p><p>Thiết kế thời trang: Đa dạng kiểu dáng, màu sắc sang trọng, dễ phối đồ.</p><p>Chiều cao gót: Từ 3cm - 10cm, phù hợp với nhu cầu sử dụng.</p><p>Đế chống trượt: An toàn, chắc chắn khi di chuyển.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 50),
(119, 'Sandal nữ đi chơi', '750', '750', 680, 'product-featured-119.jpg', '<p>Giày quai hậu nữ thanh lịch, nhẹ nhàng và tiện lợi, phù hợp cho cả đi làm, dạo phố hay dự tiệc. Thiết kế tinh tế với quai hậu cố định giúp ôm chân chắc chắn, mang lại cảm giác thoải mái và tự tin khi di chuyển.</p><p><br></p>', '<p>\"Giày quai hậu thanh lịch, thoải mái - tôn lên vẻ duyên dáng cho mọi bước chân!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp, thoáng khí.</p><p>Thiết kế sang trọng: Quai hậu cố định, giúp bước đi chắc chắn, không lo tuột.</p><p>Chiều cao gót đa dạng: Từ 3cm - 7cm, phù hợp với mọi nhu cầu.</p><p>Đế chống trượt: An toàn, tạo độ bám tốt trên nhiều bề mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 54),
(120, 'Sandal nữ đi học', '750', '680', 150, 'product-featured-120.jpg', '<p>Giày quai hậu nữ thanh lịch, nhẹ nhàng và tiện lợi, phù hợp cho cả đi làm, dạo phố hay dự tiệc. Thiết kế tinh tế với quai hậu cố định giúp ôm chân chắc chắn, mang lại cảm giác thoải mái và tự tin khi di chuyển.</p><div><br></div>', '<p>\"Giày quai hậu thanh lịch, thoải mái - tôn lên vẻ duyên dáng cho mọi bước chân!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp, thoáng khí.</p><p>Thiết kế sang trọng: Quai hậu cố định, giúp bước đi chắc chắn, không lo tuột.</p><p>Chiều cao gót đa dạng: Từ 3cm - 7cm, phù hợp với mọi nhu cầu.</p><p>Đế chống trượt: An toàn, tạo độ bám tốt trên nhiều bề mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 54),
(121, 'Sandal nữ đi học', '750', '680', 200, 'product-featured-121.jpg', '<p>Giày quai hậu nữ thanh lịch, nhẹ nhàng và tiện lợi, phù hợp cho cả đi làm, dạo phố hay dự tiệc. Thiết kế tinh tế với quai hậu cố định giúp ôm chân chắc chắn, mang lại cảm giác thoải mái và tự tin khi di chuyển.</p><p><br></p>', '<p>\"Giày quai hậu thanh lịch, thoải mái - tôn lên vẻ duyên dáng cho mọi bước chân!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp, thoáng khí.</p><p>Thiết kế sang trọng: Quai hậu cố định, giúp bước đi chắc chắn, không lo tuột.</p><p>Chiều cao gót đa dạng: Từ 3cm - 7cm, phù hợp với mọi nhu cầu.</p><p>Đế chống trượt: An toàn, tạo độ bám tốt trên nhiều bề mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 54),
(122, 'Dép crocs nhựa nữ', '520', '450', 150, 'product-featured-122.jpg', '<p>Ủng Crocs nữ nhẹ nhàng, tiện lợi, phù hợp cho mọi hoạt động ngoài trời. Thiết kế chống nước, thoáng khí giúp đôi chân luôn khô ráo và thoải mái cả ngày dài.</p><div><br></div>', '<p>\"Ủng nữ chống trơn, bền đẹp - bảo vệ đôi chân trong mọi điều kiện thời tiết!\"</p><div><br></div>', '<p>Chất liệu Croslite™: Nhẹ, bền, dễ vệ sinh.</p><p>Chống thấm nước: Hoàn hảo cho ngày mưa hay môi trường ẩm ướt.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Kiểu dáng năng động: Phù hợp cho đi chơi, du lịch, làm vườn…</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hộp đựng.</p><p>Không áp dụng đổi trả cho sản phẩm giảm giá hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 53),
(123, 'Crocs nữ', '520', '450', 150, 'product-featured-123.jpg', '<p>Ủng Crocs nữ nhẹ nhàng, tiện lợi, phù hợp cho mọi hoạt động ngoài trời. Thiết kế chống nước, thoáng khí giúp đôi chân luôn khô ráo và thoải mái cả ngày dài.</p><div><br></div>', '<p>\"Ủng nữ chống trơn, bền đẹp - bảo vệ đôi chân trong mọi điều kiện thời tiết!\"</p><div><br></div>', '<p>Chất liệu Croslite™: Nhẹ, bền, dễ vệ sinh.</p><p>Chống thấm nước: Hoàn hảo cho ngày mưa hay môi trường ẩm ướt.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Kiểu dáng năng động: Phù hợp cho đi chơi, du lịch, làm vườn…</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hộp đựng.</p><p>Không áp dụng đổi trả cho sản phẩm giảm giá hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 53),
(124, 'Dép đi trong nhà', '520', '450', 200, 'product-featured-124.jpg', '<p>Ủng Crocs nữ nhẹ nhàng, tiện lợi, phù hợp cho mọi hoạt động ngoài trời. Thiết kế chống nước, thoáng khí giúp đôi chân luôn khô ráo và thoải mái cả ngày dài.</p><div><br></div>', '<p>\"Ủng nữ chống trơn, bền đẹp - bảo vệ đôi chân trong mọi điều kiện thời tiết!\"</p><div><br></div>', '<p>Chất liệu Croslite™: Nhẹ, bền, dễ vệ sinh.</p><p>Chống thấm nước: Hoàn hảo cho ngày mưa hay môi trường ẩm ướt.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Kiểu dáng năng động: Phù hợp cho đi chơi, du lịch, làm vườn…</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hộp đựng.</p><p>Không áp dụng đổi trả cho sản phẩm giảm giá hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 53),
(125, 'Hoodie Zip Thêu', '590', '520', 200, 'product-featured-125.jpg', '<p>Áo hoodie nữ phong cách trẻ trung, năng động, phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, giữ ấm tốt, mang lại cảm giác thoải mái và dễ chịu khi mặc.</p><p><br></p>', '<p>\"Áo hoodie nữ mềm mại, ấm áp - phong cách trẻ trung, năng động!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton/ nỉ dày dặn, co giãn tốt, thoáng khí.</p><p>Kiểu dáng thời trang: Form rộng, dễ phối đồ, phù hợp với nhiều phong cách.</p><p>Thiết kế tiện lợi: Có nón, túi trước, bo gấu giúp giữ ấm tốt hơn.</p><p>Màu sắc đa dạng: Dễ dàng lựa chọn theo sở thích cá nhân.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 14),
(126, 'Hoodie Zip Thêu', '590', '520', 200, 'product-featured-126.jpg', '<p>Áo hoodie nữ phong cách trẻ trung, năng động, phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, giữ ấm tốt, mang lại cảm giác thoải mái và dễ chịu khi mặc.</p><div><br></div>', '<p>\"Áo hoodie nữ mềm mại, ấm áp - phong cách trẻ trung, năng động!\"</p>', '<p>Chất liệu cao cấp: Cotton/ nỉ dày dặn, co giãn tốt, thoáng khí.</p><p>Kiểu dáng thời trang: Form rộng, dễ phối đồ, phù hợp với nhiều phong cách.</p><p>Thiết kế tiện lợi: Có nón, túi trước, bo gấu giúp giữ ấm tốt hơn.</p><p>Màu sắc đa dạng: Dễ dàng lựa chọn theo sở thích cá nhân.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 14),
(127, 'Hoodie Zip Thêu', '590', '520', 260, 'product-featured-127.jpg', '<p>Áo hoodie nữ phong cách trẻ trung, năng động, phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, giữ ấm tốt, mang lại cảm giác thoải mái và dễ chịu khi mặc.</p><p><br></p>', '<p>\"Áo hoodie nữ mềm mại, ấm áp - phong cách trẻ trung, năng động!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton/ nỉ dày dặn, co giãn tốt, thoáng khí.</p><p>Kiểu dáng thời trang: Form rộng, dễ phối đồ, phù hợp với nhiều phong cách.</p><p>Thiết kế tiện lợi: Có nón, túi trước, bo gấu giúp giữ ấm tốt hơn.</p><p>Màu sắc đa dạng: Dễ dàng lựa chọn theo sở thích cá nhân.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 14),
(128, 'Đầm dài', '820', '750', 200, 'product-featured-128.jpg', '<p>Đầm nữ thanh lịch, tôn dáng, phù hợp cho nhiều dịp như đi làm, dạo phố hay dự tiệc. Chất liệu cao cấp, thoáng mát, mang đến sự thoải mái và tự tin cho người mặc.</p><div><br></div>', '<p>\"Đầm nữ duyên dáng, thanh lịch - tôn lên vẻ đẹp quyến rũ, sang trọng!\"</p><div><br></div>', '<p>Chất liệu mềm mại: Vải cao cấp, thấm hút tốt, tạo cảm giác dễ chịu.</p><p>Thiết kế hiện đại: Đa dạng kiểu dáng từ ôm body, suông đến xòe nữ tính.</p><p>Màu sắc thanh lịch: Dễ dàng phối đồ, phù hợp nhiều phong cách.</p><p>Đường may tinh tế: Tôn dáng, bền đẹp theo thời gian.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, hóa đơn và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 32),
(129, 'Đầm xòa trễ vai', '820', '750', 150, 'product-featured-129.jpg', '<p>Đầm nữ thanh lịch, tôn dáng, phù hợp cho nhiều dịp như đi làm, dạo phố hay dự tiệc. Chất liệu cao cấp, thoáng mát, mang đến sự thoải mái và tự tin cho người mặc.</p><div><br></div>', '<p>\"Đầm nữ duyên dáng, thanh lịch - tôn lên vẻ đẹp quyến rũ, sang trọng!\"</p><div><br></div>', '<p>Chất liệu mềm mại: Vải cao cấp, thấm hút tốt, tạo cảm giác dễ chịu.</p><p>Thiết kế hiện đại: Đa dạng kiểu dáng từ ôm body, suông đến xòe nữ tính.</p><p>Màu sắc thanh lịch: Dễ dàng phối đồ, phù hợp nhiều phong cách.</p><p>Đường may tinh tế: Tôn dáng, bền đẹp theo thời gian.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, hóa đơn và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 32);
INSERT INTO `table_product` (`p_id`, `p_name`, `p_old_price`, `p_current_price`, `p_qty`, `p_featured_photo`, `p_description`, `p_short_description`, `p_feature`, `p_return_policy`, `p_total_order`, `p_is_featured`, `p_is_active`, `ecat_id`) VALUES
(130, 'Đầm dự tiệc cưới, hỏi,...', '820', '750', 200, 'product-featured-130.jpg', '<p>Đầm nữ thanh lịch, tôn dáng, phù hợp cho nhiều dịp như đi làm, dạo phố hay dự tiệc. Chất liệu cao cấp, thoáng mát, mang đến sự thoải mái và tự tin cho người mặc.</p><div><br></div>', '<p>\"Đầm nữ duyên dáng, thanh lịch - tôn lên vẻ đẹp quyến rũ, sang trọng!\"</p><div><br></div>', '<p>Chất liệu mềm mại: Vải cao cấp, thấm hút tốt, tạo cảm giác dễ chịu.</p><p>Thiết kế hiện đại: Đa dạng kiểu dáng từ ôm body, suông đến xòe nữ tính.</p><p>Màu sắc thanh lịch: Dễ dàng phối đồ, phù hợp nhiều phong cách.</p><p>Đường may tinh tế: Tôn dáng, bền đẹp theo thời gian.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, hóa đơn và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 32),
(131, 'Quần jeans ống rộng nữ', '650', '570', 150, 'product-featured-131.jpg', '<p>Quần jeans nữ thời trang, thiết kế trẻ trung, tôn dáng và dễ phối đồ. Chất liệu denim cao cấp mang lại cảm giác thoải mái, phù hợp cho mọi hoạt động hàng ngày.</p><p><br></p>', '<p> \"Quần jeans nữ thời trang, tôn dáng - thoải mái, phù hợp mọi phong cách!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: Denim co giãn nhẹ, thoáng khí, giữ form tốt.</p><p>Kiểu dáng đa dạng: Skinny, ống rộng, baggy… phù hợp với nhiều phong cách.</p><p>Màu sắc thời thượng: Xanh denim, đen, trắng, dễ kết hợp trang phục.</p><p>Dễ dàng bảo quản: Giặt máy thoải mái, không xù lông, không phai màu.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, nhãn mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 16),
(132, 'Quần kaki ống rộng', '650', '570', 150, 'product-featured-132.jpg', '<p>Quần jeans nữ thời trang, thiết kế trẻ trung, tôn dáng và dễ phối đồ. Chất liệu denim cao cấp mang lại cảm giác thoải mái, phù hợp cho mọi hoạt động hàng ngày.</p><div><br></div>', '<p>\"Quần jeans nữ thời trang, tôn dáng - thoải mái, phù hợp mọi phong cách!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: Denim co giãn nhẹ, thoáng khí, giữ form tốt.</p><p>Kiểu dáng đa dạng: Skinny, ống rộng, baggy… phù hợp với nhiều phong cách.</p><p>Màu sắc thời thượng: Xanh denim, đen, trắng, dễ kết hợp trang phục.</p><p>Dễ dàng bảo quản: Giặt máy thoải mái, không xù lông, không phai màu.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, nhãn mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 16),
(133, 'Quần jeans ống rộng nữ', '650', '570', 250, 'product-featured-133.jpg', '<p>Quần jeans nữ thời trang, thiết kế trẻ trung, tôn dáng và dễ phối đồ. Chất liệu denim cao cấp mang lại cảm giác thoải mái, phù hợp cho mọi hoạt động hàng ngày.</p><div><br></div>', '<p>\"Quần jeans nữ thời trang, tôn dáng - thoải mái, phù hợp mọi phong cách!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: Denim co giãn nhẹ, thoáng khí, giữ form tốt.</p><p>Kiểu dáng đa dạng: Skinny, ống rộng, baggy… phù hợp với nhiều phong cách.</p><p>Màu sắc thời thượng: Xanh denim, đen, trắng, dễ kết hợp trang phục.</p><p>Dễ dàng bảo quản: Giặt máy thoải mái, không xù lông, không phai màu.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, nhãn mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 16),
(134, 'Mặt nạ dưỡng ẩm', '550', '480', 150, 'product-featured-134.jpg', '<p>Bộ sản phẩm chăm sóc da nữ giúp nuôi dưỡng làn da khỏe mạnh, rạng rỡ. Công thức dịu nhẹ, an toàn, phù hợp với nhiều loại da, cung cấp độ ẩm và dưỡng chất cần thiết cho làn da mềm mịn, tươi trẻ.</p><div><br></div>', '<p> \"Sản phẩm chăm sóc da dịu nhẹ, nuôi dưỡng sâu - cho làn da khỏe đẹp rạng rỡ!\"</p><div><br></div>', '<p>Thành phần an toàn: Chiết xuất thiên nhiên, không chứa hóa chất độc hại.</p><p>Dưỡng ẩm & tái tạo da: Cung cấp độ ẩm, giúp da mịn màng, căng bóng.</p><p>Phù hợp nhiều loại da: Da dầu, da khô, da nhạy cảm,…</p><p>Hấp thụ nhanh: Không gây bết dính, dễ dàng thẩm thấu vào da.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải chưa qua sử dụng, còn nguyên tem niêm phong và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 40),
(135, 'Mặt nạ BNBG', '550', '480', 200, 'product-featured-135.jpg', '<p>Bộ sản phẩm chăm sóc da nữ giúp nuôi dưỡng làn da khỏe mạnh, rạng rỡ. Công thức dịu nhẹ, an toàn, phù hợp với nhiều loại da, cung cấp độ ẩm và dưỡng chất cần thiết cho làn da mềm mịn, tươi trẻ.</p><div><br></div>', '<p> \"Sản phẩm chăm sóc da dịu nhẹ, nuôi dưỡng sâu - cho làn da khỏe đẹp rạng rỡ!\"</p><div><br></div>', '<p>Thành phần an toàn: Chiết xuất thiên nhiên, không chứa hóa chất độc hại.</p><p>Dưỡng ẩm & tái tạo da: Cung cấp độ ẩm, giúp da mịn màng, căng bóng.</p><p>Phù hợp nhiều loại da: Da dầu, da khô, da nhạy cảm,…</p><p>Hấp thụ nhanh: Không gây bết dính, dễ dàng thẩm thấu vào da.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải chưa qua sử dụng, còn nguyên tem niêm phong và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 40),
(136, 'Mặt nạ thạch Luvum', '550', '480', 200, 'product-featured-136.jpg', '<p>Bộ sản phẩm chăm sóc da nữ giúp nuôi dưỡng làn da khỏe mạnh, rạng rỡ. Công thức dịu nhẹ, an toàn, phù hợp với nhiều loại da, cung cấp độ ẩm và dưỡng chất cần thiết cho làn da mềm mịn, tươi trẻ.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc da dịu nhẹ, nuôi dưỡng sâu - cho làn da khỏe đẹp rạng rỡ!\"</p><div><br></div>', '<p>Thành phần an toàn: Chiết xuất thiên nhiên, không chứa hóa chất độc hại.</p><p>Dưỡng ẩm & tái tạo da: Cung cấp độ ẩm, giúp da mịn màng, căng bóng.</p><p>Phù hợp nhiều loại da: Da dầu, da khô, da nhạy cảm,…</p><p>Hấp thụ nhanh: Không gây bết dính, dễ dàng thẩm thấu vào da.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải chưa qua sử dụng, còn nguyên tem niêm phong và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 40),
(137, 'Nước dưỡng tóc tinh dầu bưởi', '490', '420', 260, 'product-featured-137.jpg', '<p>Bộ sản phẩm chăm sóc tóc nữ giúp nuôi dưỡng tóc chắc khỏe, mềm mượt và bồng bềnh. Công thức dịu nhẹ, phù hợp với mọi loại tóc, giúp phục hồi hư tổn và mang lại mái tóc suôn mượt tự nhiên.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc tóc chuyên sâu - nuôi dưỡng mái tóc suôn mượt, chắc khỏe!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Dưỡng chất từ dầu argan, keratin, collagen,...</p><p>Phù hợp mọi loại tóc: Tóc khô, dầu, hư tổn, nhuộm, uốn.</p><p>Cấp ẩm & phục hồi: Giúp tóc mềm mượt, chắc khỏe từ gốc đến ngọn.</p><p>Không chứa hóa chất gây hại: Không sulfate, paraben, an toàn khi sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm chưa qua sử dụng, còn nguyên tem, bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 41),
(138, 'Nước dưỡng tóc Double Rich', '490', '420', 150, 'product-featured-138.jpg', '<p>Bộ sản phẩm chăm sóc tóc nữ giúp nuôi dưỡng tóc chắc khỏe, mềm mượt và bồng bềnh. Công thức dịu nhẹ, phù hợp với mọi loại tóc, giúp phục hồi hư tổn và mang lại mái tóc suôn mượt tự nhiên.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc tóc chuyên sâu - nuôi dưỡng mái tóc suôn mượt, chắc khỏe!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Dưỡng chất từ dầu argan, keratin, collagen,...</p><p>Phù hợp mọi loại tóc: Tóc khô, dầu, hư tổn, nhuộm, uốn.</p><p>Cấp ẩm & phục hồi: Giúp tóc mềm mượt, chắc khỏe từ gốc đến ngọn.</p><p>Không chứa hóa chất gây hại: Không sulfate, paraben, an toàn khi sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm chưa qua sử dụng, còn nguyên tem, bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 41),
(139, 'Dầu dưỡng tóc', '490', '420', 150, 'product-featured-139.jpg', '<p>Bộ sản phẩm chăm sóc tóc nữ giúp nuôi dưỡng tóc chắc khỏe, mềm mượt và bồng bềnh. Công thức dịu nhẹ, phù hợp với mọi loại tóc, giúp phục hồi hư tổn và mang lại mái tóc suôn mượt tự nhiên.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc tóc chuyên sâu - nuôi dưỡng mái tóc suôn mượt, chắc khỏe!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Dưỡng chất từ dầu argan, keratin, collagen,...</p><p>Phù hợp mọi loại tóc: Tóc khô, dầu, hư tổn, nhuộm, uốn.</p><p>Cấp ẩm & phục hồi: Giúp tóc mềm mượt, chắc khỏe từ gốc đến ngọn.</p><p>Không chứa hóa chất gây hại: Không sulfate, paraben, an toàn khi sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm chưa qua sử dụng, còn nguyên tem, bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 41),
(140, 'Nước hoa nữ chính hãng Narciso', '820', '750', 200, 'product-featured-140.jpg', '<p>Nước hoa nữ cao cấp với hương thơm quyến rũ, thanh lịch và bền lâu, giúp bạn tự tin tỏa sáng trong mọi khoảnh khắc. Thích hợp cho công sở, hẹn hò hay những buổi tiệc sang trọng.</p><div><br></div>', '<p> \"Nước hoa quyến rũ, lưu hương lâu - khẳng định phong cách riêng của bạn!\"</p><div><br></div>', '<p>Hương thơm đa dạng: Từ ngọt ngào, tươi mát đến sang trọng, quyến rũ.</p><p>Lưu hương lâu: Giữ mùi từ 6 - 12 giờ tùy dòng nước hoa.</p><p>Dung tích linh hoạt: Có nhiều lựa chọn phù hợp với nhu cầu.</p><p>Thương hiệu uy tín: Cam kết chính hãng, đảm bảo chất lượng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng, đầy đủ hộp và tem niêm phong.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 39),
(141, 'Lilith and Eve Black Opium Eau de Perfume', '820', '750', 200, 'product-featured-141.jpg', '<p>Nước hoa nữ cao cấp với hương thơm quyến rũ, thanh lịch và bền lâu, giúp bạn tự tin tỏa sáng trong mọi khoảnh khắc. Thích hợp cho công sở, hẹn hò hay những buổi tiệc sang trọng.</p><div><br></div>', '<p> \"Nước hoa quyến rũ, lưu hương lâu - khẳng định phong cách riêng của bạn!\"</p><div><br></div>', '<p>Hương thơm đa dạng: Từ ngọt ngào, tươi mát đến sang trọng, quyến rũ.</p><p>Lưu hương lâu: Giữ mùi từ 6 - 12 giờ tùy dòng nước hoa.</p><p>Dung tích linh hoạt: Có nhiều lựa chọn phù hợp với nhu cầu.</p><p>Thương hiệu uy tín: Cam kết chính hãng, đảm bảo chất lượng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng, đầy đủ hộp và tem niêm phong.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 39),
(142, 'Nước hoa nữ ngọt ngào', '820', '750', 200, 'product-featured-142.jpg', '<p>Nước hoa nữ cao cấp với hương thơm quyến rũ, thanh lịch và bền lâu, giúp bạn tự tin tỏa sáng trong mọi khoảnh khắc. Thích hợp cho công sở, hẹn hò hay những buổi tiệc sang trọng.</p><p><br></p>', '<p>\"Nước hoa quyến rũ, lưu hương lâu - khẳng định phong cách riêng của bạn!\"</p><div><br></div>', '<p>Hương thơm đa dạng: Từ ngọt ngào, tươi mát đến sang trọng, quyến rũ.</p><p>Lưu hương lâu: Giữ mùi từ 6 - 12 giờ tùy dòng nước hoa.</p><p>Dung tích linh hoạt: Có nhiều lựa chọn phù hợp với nhu cầu.</p><p>Thương hiệu uy tín: Cam kết chính hãng, đảm bảo chất lượng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng, đầy đủ hộp và tem niêm phong.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 39),
(143, 'Ủng đi mưa bé gái', '420', '350', 200, 'product-featured-143.jpg', '<p>Giày bé gái dễ thương, thoải mái và an toàn cho bé khi vận động. Thiết kế đa dạng, phù hợp cho đi học, đi chơi hay dự tiệc. Chất liệu mềm mại, nâng niu từng bước chân.</p><p><br></p>', '<p>\"Giày bé gái đáng yêu, êm ái - nâng niu từng bước chân của bé!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải/da mềm, thoáng khí, không gây kích ứng da.</p><p>Thiết kế đáng yêu: Màu sắc tươi sáng, họa tiết xinh xắn, phù hợp với nhiều độ tuổi.</p><p>Đế chống trượt: Giúp bé di chuyển an toàn, hạn chế trơn trượt.</p><p>Dễ mang, dễ tháo: Quai dán hoặc chun co giãn tiện lợi cho bé.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 29),
(144, 'Giày búp bê bé gái', '420', '350', 150, 'product-featured-144.jpg', '<p>Giày bé gái dễ thương, thoải mái và an toàn cho bé khi vận động. Thiết kế đa dạng, phù hợp cho đi học, đi chơi hay dự tiệc. Chất liệu mềm mại, nâng niu từng bước chân.</p><div><br></div>', '<p>\"Giày bé gái đáng yêu, êm ái - nâng niu từng bước chân của bé!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải/da mềm, thoáng khí, không gây kích ứng da.</p><p>Thiết kế đáng yêu: Màu sắc tươi sáng, họa tiết xinh xắn, phù hợp với nhiều độ tuổi.</p><p>Đế chống trượt: Giúp bé di chuyển an toàn, hạn chế trơn trượt.</p><p>Dễ mang, dễ tháo: Quai dán hoặc chun co giãn tiện lợi cho bé.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><p><br></p>', 0, 0, 1, 29),
(145, 'Sandal cho bé gái', '420', '350', 200, 'product-featured-145.jpg', '<p>Giày bé gái dễ thương, thoải mái và an toàn cho bé khi vận động. Thiết kế đa dạng, phù hợp cho đi học, đi chơi hay dự tiệc. Chất liệu mềm mại, nâng niu từng bước chân.</p><p><br></p>', '<p>\"Giày bé gái đáng yêu, êm ái - nâng niu từng bước chân của bé!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải/da mềm, thoáng khí, không gây kích ứng da.</p><p>Thiết kế đáng yêu: Màu sắc tươi sáng, họa tiết xinh xắn, phù hợp với nhiều độ tuổi.</p><p>Đế chống trượt: Giúp bé di chuyển an toàn, hạn chế trơn trượt.</p><p>Dễ mang, dễ tháo: Quai dán hoặc chun co giãn tiện lợi cho bé.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 29),
(146, 'Sandal cho bé trai', '420', '350', 150, 'product-featured-146.jpg', '<p>Giày bé trai năng động, thoải mái và bền bỉ, phù hợp cho mọi hoạt động hàng ngày. Thiết kế thời trang, chất liệu an toàn, giúp bé thoải mái vui chơi và vận động cả ngày.</p><p><br></p>', '<p>\"Giày bé trai năng động, bền đẹp - thoải mái cho bé vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Thoáng khí, êm ái, bảo vệ đôi chân bé.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Thiết kế tiện lợi: Dễ mang vào và tháo ra, phù hợp cho bé tự đi giày.</p><p>Mẫu mã đa dạng: Nhiều màu sắc, họa tiết ngộ nghĩnh, phù hợp mọi lứa tuổi.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 28),
(147, 'Giày thể thao bé trai', '420', '350', 150, 'product-featured-147.jpg', '<p>Giày bé trai năng động, thoải mái và bền bỉ, phù hợp cho mọi hoạt động hàng ngày. Thiết kế thời trang, chất liệu an toàn, giúp bé thoải mái vui chơi và vận động cả ngày.</p><p><br></p>', '<p>\"Giày bé trai năng động, bền đẹp - thoải mái cho bé vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Thoáng khí, êm ái, bảo vệ đôi chân bé.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Thiết kế tiện lợi: Dễ mang vào và tháo ra, phù hợp cho bé tự đi giày.</p><p>Mẫu mã đa dạng: Nhiều màu sắc, họa tiết ngộ nghĩnh, phù hợp mọi lứa tuổi.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 28),
(148, 'Sandal cho bé trai', '420', '350', 200, 'product-featured-148.jpg', '<p>Giày bé trai năng động, thoải mái và bền bỉ, phù hợp cho mọi hoạt động hàng ngày. Thiết kế thời trang, chất liệu an toàn, giúp bé thoải mái vui chơi và vận động cả ngày.</p><p><br></p>', '<p>\"Giày bé trai năng động, bền đẹp - thoải mái cho bé vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Thoáng khí, êm ái, bảo vệ đôi chân bé.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Thiết kế tiện lợi: Dễ mang vào và tháo ra, phù hợp cho bé tự đi giày.</p><p>Mẫu mã đa dạng: Nhiều màu sắc, họa tiết ngộ nghĩnh, phù hợp mọi lứa tuổi.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 28),
(149, 'Nón tai bèo bé gái', '300', '250', 200, 'product-featured-149.jpg', '<p>Nón bé gái xinh xắn, bảo vệ bé khỏi nắng và gió, đồng thời tạo điểm nhấn dễ thương cho trang phục. Thiết kế nhẹ nhàng, thoáng khí, phù hợp cho mọi hoạt động ngoài trời.</p><p><br></p>', '<p>\"Nón bé gái xinh xắn, bảo vệ khỏi nắng - cho bé thêm đáng yêu, phong cách!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải cotton/mềm mại, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đáng yêu: Nhiều mẫu mã, màu sắc tươi sáng, phù hợp với bé gái.</p><p>Thoáng mát, dễ chịu: Đội lâu không gây bí bách hay khó chịu.</p><p>Dây cột/chun co giãn: Giúp nón cố định, không bị rơi khi bé vận động.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tem mác, hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc mua theo chương trình khuyến mãi đặc biệt.</p><div><br></div>', 0, 0, 1, 31),
(150, 'Nón kết cho bé gái', '300', '250', 200, 'product-featured-150.jpg', '<p>Nón bé gái xinh xắn, bảo vệ bé khỏi nắng và gió, đồng thời tạo điểm nhấn dễ thương cho trang phục. Thiết kế nhẹ nhàng, thoáng khí, phù hợp cho mọi hoạt động ngoài trời.</p><p><br></p>', '<p> \"Nón bé gái xinh xắn, bảo vệ khỏi nắng - cho bé thêm đáng yêu, phong cách!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải cotton/mềm mại, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đáng yêu: Nhiều mẫu mã, màu sắc tươi sáng, phù hợp với bé gái.</p><p>Thoáng mát, dễ chịu: Đội lâu không gây bí bách hay khó chịu.</p><p>Dây cột/chun co giãn: Giúp nón cố định, không bị rơi khi bé vận động.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tem mác, hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc mua theo chương trình khuyến mãi đặc biệt.</p><div><br></div>', 0, 0, 1, 31),
(151, 'Mũ chống nắng có vành cho bé gái', '300', '250', 150, 'product-featured-151.jpg', '<p>Nón bé gái xinh xắn, bảo vệ bé khỏi nắng và gió, đồng thời tạo điểm nhấn dễ thương cho trang phục. Thiết kế nhẹ nhàng, thoáng khí, phù hợp cho mọi hoạt động ngoài trời.</p><div><br></div>', '<p>\"Nón bé gái xinh xắn, bảo vệ khỏi nắng - cho bé thêm đáng yêu, phong cách!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải cotton/mềm mại, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đáng yêu: Nhiều mẫu mã, màu sắc tươi sáng, phù hợp với bé gái.</p><p>Thoáng mát, dễ chịu: Đội lâu không gây bí bách hay khó chịu.</p><p>Dây cột/chun co giãn: Giúp nón cố định, không bị rơi khi bé vận động.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tem mác, hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc mua theo chương trình khuyến mãi đặc biệt.</p><div><br></div>', 0, 0, 1, 31),
(152, 'Nón kết cho bé trai', '300', '250', 200, 'product-featured-152.jpg', '<p>Nón bé trai thiết kế năng động, thoáng mát, giúp bảo vệ bé khỏi nắng và bụi. Chất liệu mềm mại, an toàn cho làn da nhạy cảm, phù hợp cho mọi hoạt động ngoài trời.</p><div><br></div>', '<p>\"Nón bé trai cá tính, bảo vệ khỏi nắng - cho bé thêm phong cách, năng động, thoải mái mọi lúc!\"</p>', '<p>Chất liệu cao cấp: Cotton thoáng khí, thấm hút mồ hôi tốt.</p><p>Thiết kế thời trang: Kiểu dáng đa dạng, họa tiết đáng yêu, dễ phối đồ.</p><p>Dễ điều chỉnh: Quai dán hoặc nút cài phù hợp với nhiều độ tuổi.</p><p>Bảo vệ tối ưu: Chắn nắng hiệu quả, giúp bé vui chơi thoải mái.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 30),
(153, 'Mũ chống nắng có vành cho bé trai', '300', '250', 150, 'product-featured-153.jpg', '<p>Nón bé trai thiết kế năng động, thoáng mát, giúp bảo vệ bé khỏi nắng và bụi. Chất liệu mềm mại, an toàn cho làn da nhạy cảm, phù hợp cho mọi hoạt động ngoài trời.</p><p><br></p>', '<p>\"Nón bé trai cá tính, bảo vệ khỏi nắng - cho bé thêm phong cách, năng động, thoải mái mọi lúc!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng khí, thấm hút mồ hôi tốt.</p><p>Thiết kế thời trang: Kiểu dáng đa dạng, họa tiết đáng yêu, dễ phối đồ.</p><p>Dễ điều chỉnh: Quai dán hoặc nút cài phù hợp với nhiều độ tuổi.</p><p>Bảo vệ tối ưu: Chắn nắng hiệu quả, giúp bé vui chơi thoải mái.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 30),
(154, 'Mũ len cho bé trai', '300', '250', 200, 'product-featured-154.jpg', '<p>Nón bé trai thiết kế năng động, thoáng mát, giúp bảo vệ bé khỏi nắng và bụi. Chất liệu mềm mại, an toàn cho làn da nhạy cảm, phù hợp cho mọi hoạt động ngoài trời.</p><p><br></p>', '<p>\"Nón bé trai cá tính, bảo vệ khỏi nắng - cho bé thêm phong cách, năng động, thoải mái mọi lúc!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng khí, thấm hút mồ hôi tốt.</p><p>Thiết kế thời trang: Kiểu dáng đa dạng, họa tiết đáng yêu, dễ phối đồ.</p><p>Dễ điều chỉnh: Quai dán hoặc nút cài phù hợp với nhiều độ tuổi.</p><p>Bảo vệ tối ưu: Chắn nắng hiệu quả, giúp bé vui chơi thoải mái.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 30),
(155, 'Đồ bộ tay dài cho bé gái', '300', '250', 200, 'product-featured-155.jpg', '<p>Quần áo bé gái với thiết kế đáng yêu, chất liệu mềm mại, an toàn cho làn da nhạy cảm. Đa dạng mẫu mã, màu sắc tươi sáng, phù hợp cho mọi hoạt động hằng ngày hay các dịp đặc biệt.</p><p><br></p>', '<p>\"Trang phục bé gái dễ thương - Quần áo bé gái xinh xắn, thoáng mát, cho bé thêm đáng yêu và thoải mái suốt ngày dài!\"</p><div><br></div>', '<p>Chất liệu an toàn: Cotton, thun co giãn, vải lanh thoáng mát.</p><p>Thiết kế dễ thương: Kiểu dáng hiện đại, họa tiết sinh động.</p><p>Thoải mái vận động: Form dáng vừa vặn, không gây khó chịu khi bé chơi đùa.</p><p>Dễ giặt, nhanh khô: Bền màu, không xù lông sau nhiều lần giặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 27),
(156, 'Đồ bộ bé gái ba lỗ quần đùi', '300', '250', 200, 'product-featured-156.jpg', '<p>Quần áo bé gái với thiết kế đáng yêu, chất liệu mềm mại, an toàn cho làn da nhạy cảm. Đa dạng mẫu mã, màu sắc tươi sáng, phù hợp cho mọi hoạt động hằng ngày hay các dịp đặc biệt.</p><p><br></p>', '<p>\"Trang phục bé gái dễ thương - Quần áo bé gái xinh xắn, thoáng mát, cho bé thêm đáng yêu và thoải mái suốt ngày dài!\"</p><div><br></div>', '<p>Chất liệu an toàn: Cotton, thun co giãn, vải lanh thoáng mát.</p><p>Thiết kế dễ thương: Kiểu dáng hiện đại, họa tiết sinh động.</p><p>Thoải mái vận động: Form dáng vừa vặn, không gây khó chịu khi bé chơi đùa.</p><p>Dễ giặt, nhanh khô: Bền màu, không xù lông sau nhiều lần giặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 27),
(157, 'Bộ đồ mùa hè cho bé gái', '300', '230', 200, 'product-featured-157.jpg', '<p>Quần áo bé gái với thiết kế đáng yêu, chất liệu mềm mại, an toàn cho làn da nhạy cảm. Đa dạng mẫu mã, màu sắc tươi sáng, phù hợp cho mọi hoạt động hằng ngày hay các dịp đặc biệt.</p><div><br></div>', '<p>\"Trang phục bé gái dễ thương - Quần áo bé gái xinh xắn, thoáng mát, cho bé thêm đáng yêu và thoải mái suốt ngày dài!\"</p><div><br></div>', '<p>Chất liệu an toàn: Cotton, thun co giãn, vải lanh thoáng mát.</p><p>Thiết kế dễ thương: Kiểu dáng hiện đại, họa tiết sinh động.</p><p>Thoải mái vận động: Form dáng vừa vặn, không gây khó chịu khi bé chơi đùa.</p><p>Dễ giặt, nhanh khô: Bền màu, không xù lông sau nhiều lần giặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 27),
(158, 'Set bộ thun tổng hợp cho bé trai', '300', '250', 150, 'product-featured-158.jpg', '<p>Quần áo bé trai thoải mái, năng động, thiết kế đáng yêu phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, an toàn cho làn da nhạy cảm của bé, giúp bé luôn dễ chịu và vui chơi thoải mái.</p><p><br></p>', '<p>\"Trang phục bé trai năng động - Quần áo bé trai cá tính, thoải mái, cho bé tự tin khám phá và vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng mát, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đa dạng: Từ năng động đến lịch sự, phù hợp đi học, đi chơi.</p><p>Đường may chắc chắn: Bền đẹp, không gây kích ứng da.</p><p>Dễ giặt, nhanh khô: Giữ form dáng tốt sau nhiều lần giặt.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 26),
(159, 'Bộ quần áo cộc tay bé trai', '300', '250', 200, 'product-featured-159.jpg', '<p>Quần áo bé trai thoải mái, năng động, thiết kế đáng yêu phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, an toàn cho làn da nhạy cảm của bé, giúp bé luôn dễ chịu và vui chơi thoải mái.</p><div><br></div>', '<p>\"Trang phục bé trai năng động - Quần áo bé trai cá tính, thoải mái, cho bé tự tin khám phá và vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng mát, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đa dạng: Từ năng động đến lịch sự, phù hợp đi học, đi chơi.</p><p>Đường may chắc chắn: Bền đẹp, không gây kích ứng da.</p><p>Dễ giặt, nhanh khô: Giữ form dáng tốt sau nhiều lần giặt.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 26),
(160, 'Bộ đồ bé trai sát nách mùa hè', '300', '250', 120, 'product-featured-160.jpg', '<p>Quần áo bé trai thoải mái, năng động, thiết kế đáng yêu phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, an toàn cho làn da nhạy cảm của bé, giúp bé luôn dễ chịu và vui chơi thoải mái.</p><div><br></div>', '<p>\"Trang phục bé trai năng động - Quần áo bé trai cá tính, thoải mái, cho bé tự tin khám phá và vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng mát, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đa dạng: Từ năng động đến lịch sự, phù hợp đi học, đi chơi.</p><p>Đường may chắc chắn: Bền đẹp, không gây kích ứng da.</p><p>Dễ giặt, nhanh khô: Giữ form dáng tốt sau nhiều lần giặt.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product_color`
--

CREATE TABLE `table_product_color` (
  `id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_product_color`
--

INSERT INTO `table_product_color` (`id`, `color_id`, `p_id`) VALUES
(275, 5, 22),
(276, 6, 22),
(277, 3, 160),
(278, 5, 160),
(279, 2, 159),
(280, 5, 159),
(281, 6, 158),
(282, 10, 158),
(283, 2, 157),
(284, 9, 157),
(285, 6, 156),
(286, 9, 156),
(287, 6, 155),
(288, 4, 154),
(289, 10, 154),
(290, 6, 153),
(291, 6, 152),
(292, 10, 152),
(293, 1, 151),
(294, 6, 151),
(295, 6, 150),
(296, 7, 150),
(297, 6, 149),
(298, 9, 149),
(299, 3, 148),
(300, 5, 148),
(301, 2, 147),
(302, 3, 147),
(303, 5, 146),
(304, 3, 145),
(305, 6, 145),
(306, 6, 144),
(307, 10, 144),
(308, 6, 143),
(309, 9, 143),
(310, 1, 142),
(311, 6, 142),
(312, 6, 141),
(313, 7, 141),
(314, 6, 140),
(315, 9, 140),
(316, 4, 139),
(317, 6, 139),
(318, 4, 138),
(319, 9, 138),
(320, 3, 137),
(321, 5, 137),
(322, 4, 136),
(323, 7, 136),
(324, 1, 135),
(325, 6, 135),
(326, 3, 134),
(327, 6, 134),
(328, 3, 133),
(329, 4, 132),
(330, 10, 132),
(331, 2, 131),
(332, 5, 130),
(333, 6, 130),
(334, 9, 129),
(335, 6, 128),
(336, 9, 128),
(337, 5, 127),
(338, 6, 127),
(339, 2, 125),
(340, 5, 125),
(341, 6, 126),
(342, 5, 124),
(343, 6, 124),
(344, 2, 123),
(345, 4, 123),
(346, 6, 122),
(347, 9, 122),
(348, 5, 121),
(349, 9, 121),
(350, 5, 120),
(351, 6, 120),
(352, 5, 119),
(353, 6, 119),
(354, 6, 118),
(355, 4, 117),
(356, 6, 117),
(357, 5, 116),
(358, 6, 116),
(359, 5, 115),
(360, 6, 115),
(361, 5, 114),
(362, 6, 114),
(363, 6, 113),
(364, 9, 113),
(365, 2, 112),
(366, 2, 111),
(367, 4, 111),
(368, 5, 110),
(369, 6, 110),
(370, 5, 109),
(371, 10, 109),
(372, 4, 108),
(373, 5, 108),
(374, 5, 107),
(375, 6, 107),
(376, 5, 106),
(377, 10, 106),
(378, 2, 105),
(379, 2, 104),
(380, 5, 104),
(381, 5, 103),
(382, 6, 103),
(383, 10, 103),
(384, 5, 102),
(385, 5, 101),
(386, 5, 99),
(387, 5, 98),
(388, 10, 98),
(389, 5, 97),
(390, 6, 97),
(391, 5, 96),
(392, 6, 96),
(393, 5, 95),
(394, 10, 95),
(395, 2, 94),
(396, 5, 94),
(397, 6, 93),
(398, 5, 92),
(399, 6, 92),
(400, 5, 91),
(401, 10, 91),
(402, 5, 90),
(403, 5, 89),
(404, 10, 89),
(405, 2, 88),
(406, 5, 88),
(407, 5, 87),
(408, 6, 87),
(409, 5, 86),
(410, 10, 86),
(411, 6, 85),
(412, 10, 85),
(413, 6, 84),
(414, 5, 83),
(415, 6, 83),
(416, 5, 82),
(417, 6, 82),
(418, 5, 81),
(419, 6, 81),
(422, 2, 80),
(423, 6, 80),
(426, 5, 78),
(427, 6, 78),
(428, 2, 77),
(429, 5, 77),
(430, 5, 76),
(431, 6, 76),
(432, 2, 75),
(433, 6, 75),
(434, 2, 74),
(435, 9, 74),
(436, 3, 73),
(437, 4, 73),
(438, 6, 72),
(439, 9, 72),
(440, 2, 71),
(441, 6, 71),
(442, 5, 70),
(443, 6, 70),
(444, 3, 69),
(445, 9, 69),
(446, 2, 68),
(447, 5, 68),
(448, 6, 67),
(449, 7, 67),
(450, 2, 66),
(451, 6, 66),
(452, 2, 65),
(453, 3, 65),
(454, 3, 64),
(455, 9, 64),
(456, 2, 63),
(457, 9, 63),
(458, 3, 62),
(459, 4, 62),
(460, 4, 61),
(461, 5, 61),
(462, 3, 60),
(463, 5, 60),
(464, 5, 59),
(465, 6, 59),
(466, 4, 58),
(467, 5, 58),
(468, 1, 57),
(469, 4, 57),
(470, 4, 56),
(471, 5, 56),
(472, 1, 55),
(473, 6, 55),
(474, 3, 54),
(475, 6, 54),
(476, 4, 53),
(477, 5, 53),
(478, 5, 52),
(479, 6, 52),
(480, 4, 51),
(481, 5, 51),
(482, 5, 50),
(483, 6, 50),
(484, 5, 49),
(485, 6, 49),
(486, 2, 48),
(487, 5, 48),
(488, 4, 47),
(489, 7, 47),
(490, 6, 46),
(491, 7, 46),
(492, 2, 45),
(493, 6, 45),
(496, 4, 44),
(497, 5, 44),
(500, 5, 43),
(501, 6, 43),
(502, 6, 42),
(503, 7, 42),
(504, 4, 41),
(505, 5, 41),
(506, 6, 40),
(507, 9, 40),
(508, 4, 39),
(509, 6, 39),
(510, 5, 38),
(511, 6, 38),
(512, 5, 37),
(513, 6, 37),
(514, 5, 36),
(515, 6, 36),
(516, 2, 35),
(517, 5, 35),
(518, 5, 34),
(519, 6, 34),
(520, 5, 33),
(521, 6, 33),
(522, 6, 32),
(523, 9, 32),
(524, 5, 31),
(525, 6, 31),
(526, 3, 30),
(527, 6, 30),
(528, 2, 29),
(529, 5, 29),
(530, 5, 28),
(531, 6, 28),
(532, 5, 27),
(533, 6, 27),
(534, 5, 26),
(535, 6, 26),
(536, 2, 25),
(537, 9, 25),
(538, 2, 24),
(539, 5, 24),
(540, 8, 23),
(541, 9, 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product_photo`
--

CREATE TABLE `table_product_photo` (
  `pp_id` int(11) NOT NULL,
  `photo` text NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_product_photo`
--

INSERT INTO `table_product_photo` (`pp_id`, `photo`, `p_id`) VALUES
(29, '29.jpg', 22),
(30, '30.jpg', 23),
(31, '31.jpg', 24),
(32, '32.jpg', 25),
(33, '33.jpg', 26),
(34, '34.jpg', 27),
(35, '35.jpg', 28),
(36, '36.jpg', 29),
(37, '37.jpg', 30),
(38, '38.jpg', 31),
(39, '39.jpg', 32),
(40, '40.jpg', 33),
(41, '41.jpg', 34),
(42, '42.jpg', 35),
(43, '43.jpg', 36),
(44, '44.jpg', 37),
(45, '45.jpg', 38),
(46, '46.jpg', 39),
(47, '47.jpg', 40),
(48, '48.jpg', 41),
(49, '49.jpg', 42),
(50, '50.jpg', 43),
(51, '51.jpg', 44),
(52, '52.jpg', 45),
(53, '53.jpg', 46),
(54, '54.jpg', 47),
(55, '55.jpg', 48),
(56, '56.jpg', 49),
(57, '57.jpg', 50),
(58, '58.jpg', 51),
(59, '59.jpg', 52),
(60, '60.jpg', 53),
(61, '61.jpg', 54),
(62, '62.jpg', 55),
(63, '63.jpg', 56),
(64, '64.jpg', 57),
(65, '65.jpg', 58),
(66, '66.jpg', 59),
(67, '67.jpg', 60),
(68, '68.jpg', 62),
(69, '69.jpg', 63),
(70, '70.jpg', 64),
(71, '71.jpg', 65),
(72, '72.jpg', 66),
(73, '73.jpg', 67),
(74, '74.jpg', 68),
(75, '75.jpg', 69),
(76, '76.jpg', 70),
(77, '77.jpg', 71),
(78, '78.jpg', 72),
(79, '79.jpg', 73),
(80, '80.jpg', 74),
(81, '81.jpg', 75),
(82, '82.jpg', 76),
(83, '83.jpg', 77),
(84, '84.jpg', 78),
(86, '86.jpg', 80),
(87, '87.jpg', 81),
(88, '88.jpg', 82),
(89, '89.jpg', 83),
(90, '90.jpg', 84),
(91, '91.jpg', 85),
(92, '92.jpg', 86),
(93, '93.jpg', 87),
(94, '94.jpg', 88),
(95, '95.jpg', 89),
(96, '96.jpg', 90),
(97, '97.jpg', 91),
(98, '98.jpg', 92),
(99, '99.jpg', 93),
(100, '100.jpg', 94),
(101, '101.jpg', 95),
(102, '102.jpg', 96),
(103, '103.jpg', 97),
(104, '104.jpg', 98),
(105, '105.jpg', 99),
(106, '106.jpg', 100),
(107, '107.jpg', 101),
(108, '108.jpg', 102),
(109, '109.jpg', 103),
(110, '110.jpg', 104),
(111, '111.jpg', 105),
(112, '112.jpg', 106),
(113, '113.jpg', 107),
(114, '114.jpg', 108),
(115, '115.jpg', 109),
(116, '116.jpg', 110),
(117, '117.jpg', 111),
(118, '118.jpg', 112),
(119, '119.jpg', 113),
(120, '120.jpg', 114),
(121, '121.jpg', 115),
(122, '122.jpg', 116),
(123, '123.jpg', 117),
(124, '124.jpg', 118),
(125, '125.jpg', 119),
(126, '126.jpg', 120),
(127, '127.jpg', 121),
(128, '128.jpg', 122),
(129, '129.jpg', 123),
(130, '130.jpg', 124),
(131, '131.jpg', 125),
(132, '132.jpg', 126),
(133, '133.jpg', 127),
(134, '134.jpg', 128),
(135, '135.jpg', 129),
(136, '136.jpg', 130),
(137, '137.jpg', 131),
(138, '138.jpg', 132),
(139, '139.jpg', 133),
(140, '140.jpg', 134),
(141, '141.jpg', 135),
(142, '142.jpg', 136),
(143, '143.jpg', 137),
(144, '144.jpg', 138),
(145, '145.jpg', 139),
(146, '146.jpg', 140),
(147, '147.jpg', 141),
(148, '148.jpg', 142),
(149, '149.jpg', 143),
(150, '150.jpg', 144),
(151, '151.jpg', 145),
(152, '152.jpg', 146),
(153, '153.jpg', 147),
(154, '154.jpg', 148),
(155, '155.jpg', 149),
(156, '156.jpg', 150),
(157, '157.jpg', 151),
(158, '158.jpg', 152),
(159, '159.jpg', 153),
(160, '160.jpg', 154),
(161, '161.jpg', 155),
(162, '162.jpg', 156),
(163, '163.jpg', 157),
(164, '164.jpg', 158),
(165, '165.jpg', 159),
(166, '166.jpg', 160);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product_size`
--

CREATE TABLE `table_product_size` (
  `id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_product_size`
--

INSERT INTO `table_product_size` (`id`, `size_id`, `p_id`) VALUES
(235, 40, 22),
(236, 41, 22),
(237, 26, 160),
(238, 26, 159),
(239, 26, 158),
(240, 26, 157),
(241, 26, 156),
(242, 26, 155),
(243, 26, 154),
(244, 26, 153),
(245, 26, 152),
(246, 26, 151),
(247, 26, 150),
(248, 26, 149),
(249, 26, 148),
(250, 26, 147),
(251, 26, 146),
(252, 26, 145),
(253, 26, 144),
(254, 26, 143),
(255, 29, 142),
(256, 29, 141),
(257, 29, 140),
(258, 29, 139),
(259, 29, 138),
(260, 29, 137),
(261, 29, 136),
(262, 29, 135),
(263, 29, 134),
(264, 2, 133),
(265, 3, 133),
(266, 3, 132),
(267, 4, 132),
(268, 3, 131),
(269, 4, 131),
(270, 3, 130),
(271, 4, 130),
(272, 3, 129),
(273, 4, 129),
(274, 1, 128),
(275, 2, 128),
(276, 3, 127),
(277, 4, 127),
(278, 2, 125),
(279, 3, 125),
(280, 3, 126),
(281, 4, 126),
(282, 12, 124),
(283, 13, 124),
(284, 13, 123),
(285, 14, 123),
(286, 14, 122),
(287, 15, 122),
(288, 11, 121),
(289, 12, 121),
(290, 14, 120),
(291, 15, 120),
(292, 13, 119),
(293, 14, 119),
(294, 13, 118),
(295, 14, 118),
(296, 14, 117),
(297, 15, 117),
(298, 12, 116),
(299, 13, 116),
(300, 11, 115),
(301, 12, 115),
(302, 12, 114),
(303, 13, 114),
(304, 13, 113),
(305, 14, 113),
(306, 4, 112),
(307, 6, 112),
(308, 5, 111),
(309, 6, 111),
(310, 4, 110),
(311, 5, 110),
(312, 4, 109),
(313, 5, 109),
(314, 5, 108),
(315, 6, 108),
(316, 4, 107),
(317, 5, 107),
(318, 5, 106),
(319, 6, 106),
(320, 4, 105),
(321, 5, 105),
(322, 5, 104),
(323, 6, 104),
(324, 26, 103),
(325, 26, 102),
(326, 26, 101),
(327, 26, 100),
(328, 26, 99),
(329, 26, 98),
(330, 26, 97),
(331, 26, 96),
(332, 26, 95),
(333, 18, 94),
(334, 19, 94),
(335, 15, 93),
(336, 16, 93),
(337, 16, 92),
(338, 17, 92),
(339, 16, 91),
(340, 17, 91),
(341, 19, 90),
(342, 20, 90),
(343, 17, 89),
(344, 18, 89),
(345, 16, 88),
(346, 17, 88),
(347, 17, 87),
(348, 18, 87),
(349, 19, 86),
(350, 20, 86),
(351, 5, 85),
(352, 6, 85),
(353, 3, 84),
(354, 5, 84),
(355, 5, 83),
(356, 6, 83),
(357, 3, 82),
(358, 4, 82),
(359, 4, 81),
(360, 6, 81),
(363, 4, 80),
(364, 5, 80),
(367, 3, 78),
(368, 4, 78),
(369, 4, 77),
(370, 6, 77),
(371, 4, 76),
(372, 5, 76),
(373, 29, 75),
(374, 29, 74),
(375, 29, 73),
(376, 34, 72),
(377, 35, 72),
(378, 34, 71),
(379, 36, 71),
(380, 34, 70),
(381, 35, 70),
(382, 29, 69),
(383, 29, 68),
(384, 29, 67),
(385, 29, 66),
(386, 29, 65),
(387, 29, 64),
(388, 27, 63),
(389, 27, 62),
(390, 27, 61),
(391, 29, 60),
(392, 29, 59),
(393, 34, 58),
(394, 35, 58),
(395, 29, 57),
(396, 29, 56),
(397, 29, 55),
(398, 34, 54),
(399, 35, 54),
(400, 36, 53),
(401, 37, 53),
(402, 36, 52),
(403, 37, 52),
(404, 34, 51),
(405, 36, 51),
(406, 34, 50),
(407, 35, 50),
(408, 34, 49),
(409, 35, 49),
(410, 29, 48),
(411, 29, 47),
(412, 29, 46),
(413, 34, 45),
(414, 36, 45),
(417, 34, 44),
(418, 36, 44),
(421, 34, 43),
(422, 35, 43),
(423, 40, 42),
(424, 41, 42),
(425, 40, 41),
(426, 41, 41),
(427, 40, 40),
(428, 41, 40),
(429, 35, 39),
(430, 36, 39),
(431, 35, 38),
(432, 36, 38),
(433, 34, 37),
(434, 35, 37),
(435, 36, 36),
(436, 37, 36),
(437, 35, 35),
(438, 36, 35),
(439, 34, 34),
(440, 36, 34),
(441, 40, 33),
(442, 41, 33),
(443, 37, 32),
(444, 39, 32),
(445, 38, 31),
(446, 39, 31),
(447, 37, 30),
(448, 38, 30),
(449, 34, 29),
(450, 37, 29),
(451, 36, 28),
(452, 37, 28),
(453, 34, 27),
(454, 35, 27),
(455, 35, 26),
(456, 36, 26),
(457, 34, 25),
(458, 35, 25),
(459, 40, 24),
(460, 41, 24),
(461, 34, 23),
(462, 35, 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_province`
--

CREATE TABLE `table_province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `table_province`
--

INSERT INTO `table_province` (`province_id`, `province_name`) VALUES
(1, 'An Giang'),
(2, 'Bà Rịa - Vũng Tàu'),
(3, 'Bắc Giang'),
(4, 'Bắc Kạn'),
(5, 'Bạc Liêu'),
(6, 'Bắc Ninh'),
(7, 'Bến Tre'),
(8, 'Bình Định'),
(9, 'Bình Dương'),
(10, 'Bình Phước'),
(11, 'Bình Thuận'),
(12, 'Cà Mau'),
(13, 'Cần Thơ'),
(14, 'Cao Bằng'),
(15, 'Đà Nẵng'),
(16, 'Đắk Lắk'),
(17, 'Đắk Nông'),
(18, 'Điện Biên'),
(19, 'Đồng Nai'),
(20, 'Đồng Tháp'),
(21, 'Gia Lai'),
(22, 'Hà Giang'),
(23, 'Hà Nam'),
(24, 'Hà Nội'),
(25, 'Hà Tĩnh'),
(26, 'Hải Dương'),
(27, 'Hải Phòng'),
(28, 'Hậu Giang'),
(29, 'Hòa Bình'),
(30, 'Hưng Yên'),
(31, 'Khánh Hòa'),
(32, 'Kiên Giang'),
(33, 'Kon Tum'),
(34, 'Lai Châu'),
(35, 'Lâm Đồng'),
(36, 'Lạng Sơn'),
(37, 'Lào Cai'),
(38, 'Long An'),
(39, 'Nam Định'),
(40, 'Nghệ An'),
(41, 'Ninh Bình'),
(42, 'Ninh Thuận'),
(43, 'Phú Thọ'),
(44, 'Phú Yên'),
(45, 'Quảng Bình'),
(46, 'Quảng Nam'),
(47, 'Quảng Ngãi'),
(48, 'Quảng Ninh'),
(49, 'Quảng Trị'),
(50, 'Sóc Trăng'),
(51, 'Sơn La'),
(52, 'Tây Ninh'),
(53, 'Thái Bình'),
(54, 'Thái Nguyên'),
(55, 'Thanh Hóa'),
(56, 'Thừa Thiên Huế'),
(57, 'Tiền Giang'),
(58, 'TP. Hồ Chí Minh'),
(59, 'Trà Vinh'),
(60, 'Tuyên Quang'),
(61, 'Vĩnh Long'),
(62, 'Vĩnh Phúc'),
(63, 'Yên Bái');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_rating`
--

CREATE TABLE `table_rating` (
  `rt_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_service`
--

CREATE TABLE `table_service` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_service`
--

INSERT INTO `table_service` (`id`, `title`, `content`, `photo`) VALUES
(1, 'Hàng chọn giá hời', '', 'service-1.png'),
(2, 'Mã giảm giá', '', 'service-2.png'),
(3, 'Miễn phí ship', '', 'service-3.png'),
(4, 'GoBuy style giảm 30%', '', 'service-4.png'),
(5, 'Voucher giảm đến 1 tỷ', '', 'service-5.png'),
(6, 'Khung giờ săn sale', '', 'service-6.png'),
(7, 'Hàng quốc tế', '', 'service-7.png'),
(8, 'Nạp thẻ, Dịch vụ & Vé tàu hỏa', '', 'service-8.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_settings`
--

CREATE TABLE `table_settings` (
  `id` int(11) NOT NULL,
  `logo` text NOT NULL,
  `favicon` text NOT NULL,
  `footer_about` text NOT NULL,
  `footer_copyright` text NOT NULL,
  `contact_address` text NOT NULL,
  `contact_email` text NOT NULL,
  `contact_phone` text NOT NULL,
  `contact_map_iframe` text NOT NULL,
  `receive_email` text NOT NULL,
  `receive_email_subject` text NOT NULL,
  `receive_email_thank_you_message` text NOT NULL,
  `forget_password_message` text NOT NULL,
  `total_latest_product_home` int(11) NOT NULL,
  `total_popular_product_home` int(11) NOT NULL,
  `meta_title_home` text NOT NULL,
  `banner_login` text NOT NULL,
  `banner_registration` text NOT NULL,
  `banner_forget_password` text NOT NULL,
  `banner_reset_password` text NOT NULL,
  `banner_search` text NOT NULL,
  `banner_cart` text NOT NULL,
  `banner_checkout` text NOT NULL,
  `banner_product_category` text NOT NULL,
  `cta_title` text NOT NULL,
  `cta_content` text NOT NULL,
  `cta_read_more_text` text NOT NULL,
  `cta_read_more_url` text NOT NULL,
  `cta_photo` text NOT NULL,
  `latest_product_title` text NOT NULL,
  `latest_product_subtitle` text NOT NULL,
  `popular_product_title` text NOT NULL,
  `popular_product_subtitle` text NOT NULL,
  `bank_public_key` text NOT NULL,
  `bank_secret_key` text NOT NULL,
  `bank_detail` text NOT NULL,
  `before_head` text NOT NULL,
  `after_body` text NOT NULL,
  `before_body` text NOT NULL,
  `home_service_on_off` int(11) NOT NULL,
  `home_welcome_on_off` int(11) NOT NULL,
  `home_latest_product_on_off` int(11) NOT NULL,
  `home_popular_product_on_off` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_settings`
--

INSERT INTO `table_settings` (`id`, `logo`, `favicon`, `footer_about`, `footer_copyright`, `contact_address`, `contact_email`, `contact_phone`, `contact_map_iframe`, `receive_email`, `receive_email_subject`, `receive_email_thank_you_message`, `forget_password_message`, `total_latest_product_home`, `total_popular_product_home`, `meta_title_home`, `banner_login`, `banner_registration`, `banner_forget_password`, `banner_reset_password`, `banner_search`, `banner_cart`, `banner_checkout`, `banner_product_category`, `cta_title`, `cta_content`, `cta_read_more_text`, `cta_read_more_url`, `cta_photo`, `latest_product_title`, `latest_product_subtitle`, `popular_product_title`, `popular_product_subtitle`, `bank_public_key`, `bank_secret_key`, `bank_detail`, `before_head`, `after_body`, `before_body`, `home_service_on_off`, `home_welcome_on_off`, `home_latest_product_on_off`, `home_popular_product_on_off`) VALUES
(1, 'logo.png', 'favicon.png', 'Đây là một website bán hàng, đồ án môn học IS207 tại UIT', 'GoBuy - Duck123', 'Thu Duc, TP.HCM', 'taduc0508@gmail.com', '0123456789', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.738228322354!2d106.80321571480056!3d10.870084060477334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527c1c6e8b1b9%3A0x3a8e6e5c6f5e6b8a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjhu41uZyB0aW4g4oCTIMSQSCBRR00gVGjhu6cgUXXhuq1jIEdpYSBUcC5ISQ!5e0!3m2!1svi!2s!4v1616581234567\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 'taduc0508@gmail.com', 'Email messages from GoBuy visitors', 'Cảm ơn bạn đã gửi email. Chúng tôi sẽ liên hệ với bạn sớm.', 'Một liên kết xác nhận đã được gửi đến địa chỉ email của bạn. Bạn sẽ nhận được thông tin đặt lại mật khẩu trong đó.', 6, 8, 'GoBuy', 'banner_login.jpg', 'banner_registration.jpg', 'banner_forget_password.jpg', 'banner_reset_password.jpg', 'banner_search.jpg', 'banner_cart.jpg', 'banner_checkout.jpg', 'banner_product_category.jpg', 'Chào mừng đến với GoBuy', 'GoBuy - nền tảng thương mại điện tử đáng tin cậy! Khám phá hàng ngàn sản phẩm chất lượng với giá tốt nhất, cùng những ưu đãi hấp dẫn mỗi ngày. Mua sắm dễ dàng, thanh toán an toàn, giao hàng nhanh chóng!', 'Xem thêm', '#', 'cta.jpg', 'Sản phẩm mới nhất', 'Danh sách những sản phẩm mới nhất', 'Sẩn phẩm phổ biến', 'Sản phẩm phổ biến dựa trên lựa chọn của khách hàng', 'xxxxxx', 'yyyyyy', 'Bank Name: AAAAAAA\r\nAccount Number: 1234567\r\nBranch Name: AAAAAA', '', '', '', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_shipping_cost`
--

CREATE TABLE `table_shipping_cost` (
  `shipping_cost_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_shipping_cost_all`
--

CREATE TABLE `table_shipping_cost_all` (
  `sca_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_shipping_cost_all`
--

INSERT INTO `table_shipping_cost_all` (`sca_id`, `amount`) VALUES
(1, '100');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_size`
--

CREATE TABLE `table_size` (
  `size_id` int(11) NOT NULL,
  `size_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_size`
--

INSERT INTO `table_size` (`size_id`, `size_name`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, '3XL'),
(8, '31'),
(9, '32'),
(10, '33'),
(11, '34'),
(12, '35'),
(13, '36'),
(14, '37'),
(15, '38'),
(16, '39'),
(17, '40'),
(18, '41'),
(19, '42'),
(20, '43'),
(21, '44'),
(22, '45'),
(23, '46'),
(24, '47'),
(25, '48'),
(26, 'Free Size'),
(27, '1 size cho tất cả'),
(28, '10'),
(29, '12 tháng'),
(30, '2T'),
(31, '3T'),
(32, '4T'),
(33, '5T'),
(34, '6 Năm'),
(35, '7 Năm'),
(36, '8 Năm'),
(37, '10 Năm'),
(38, '12 Năm'),
(39, '14 Năm'),
(40, '256 GB'),
(41, '128 GB'),
(42, '14 Plus'),
(43, '16 Plus'),
(44, '18 Plus'),
(45, '20 Plus'),
(46, '22 Plus'),
(47, '24 Plus');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_slider`
--

CREATE TABLE `table_slider` (
  `id` int(11) NOT NULL,
  `photo` text NOT NULL,
  `heading` text NOT NULL,
  `content` text NOT NULL,
  `button_text` text NOT NULL,
  `button_url` text NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_slider`
--

INSERT INTO `table_slider` (`id`, `photo`, `heading`, `content`, `button_text`, `button_url`, `position`) VALUES
(1, 'slider-1.png', 'Welcome to Shọppe', 'Cửa hàng phụ kiện mới nhất cho nam', 'Xem phụ kiện cho nam', '#', 'Center'),
(2, 'slider-2.jpg', 'Giảm giá 50% cho tất cả sản phẩm', 'Mua nhanh đi không hết bây giờ.', 'Read More', '#', 'Center'),
(3, 'slider-3.png', 'Hỗ trợ 24/7', 'Đội ngũ nhân viên cam kết phục vụ tận tình.', 'Read More', '#', 'Right');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_social`
--

CREATE TABLE `table_social` (
  `social_id` int(11) NOT NULL,
  `social_name` varchar(30) NOT NULL,
  `social_url` text NOT NULL,
  `social_icon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_social`
--

INSERT INTO `table_social` (`social_id`, `social_name`, `social_url`, `social_icon`) VALUES
(1, 'Facebook', 'https://www.facebook.com/#', 'fa fa-facebook'),
(2, 'Twitter', 'https://www.twitter.com/#', 'fa fa-twitter'),
(3, 'YouTube', 'https://www.youtube.com/#', 'fa fa-youtube'),
(4, 'Instagram', 'https://www.instagram.com/#', 'fa fa-instagram');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_top_category`
--

CREATE TABLE `table_top_category` (
  `tcat_id` int(11) NOT NULL,
  `tcat_name` text NOT NULL,
  `show_on_menu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_top_category`
--

INSERT INTO `table_top_category` (`tcat_id`, `tcat_name`, `show_on_menu`) VALUES
(1, 'Nam', 1),
(2, 'Nữ', 1),
(3, 'Trẻ em', 1),
(4, 'Đồ điện tử', 1),
(5, 'Đồ gia dụng', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_user`
--

CREATE TABLE `table_user` (
  `id` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `photo` text NOT NULL,
  `token` text NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `timestamp` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `table_user`
--

INSERT INTO `table_user` (`id`, `full_name`, `email`, `phone`, `password`, `photo`, `token`, `datetime`, `timestamp`, `status`) VALUES
(1, 'admin', 'admin@mail.com', '7777777777', 'd00f5d5217896fb7fd601412cb890830', 'admin-1.png', 'xxxx', '23-2-2025', '25-2-2025', 0),
(2, 'thu', 'ebedangiu2111@gmail.com', '+84774048884', 'fe9e27dd7bf526b57d69d3bd9fac33dc', 'default.jpg', '', '2025-03-26 01:46:19', '1742971579', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `table_color`
--
ALTER TABLE `table_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Chỉ mục cho bảng `table_customer`
--
ALTER TABLE `table_customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Chỉ mục cho bảng `table_customer_message`
--
ALTER TABLE `table_customer_message`
  ADD PRIMARY KEY (`customer_message_id`);

--
-- Chỉ mục cho bảng `table_end_category`
--
ALTER TABLE `table_end_category`
  ADD PRIMARY KEY (`ecat_id`);

--
-- Chỉ mục cho bảng `table_faq`
--
ALTER TABLE `table_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Chỉ mục cho bảng `table_mid_category`
--
ALTER TABLE `table_mid_category`
  ADD PRIMARY KEY (`mcat_id`);

--
-- Chỉ mục cho bảng `table_order`
--
ALTER TABLE `table_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_page`
--
ALTER TABLE `table_page`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_payment`
--
ALTER TABLE `table_payment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_photo`
--
ALTER TABLE `table_photo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product`
--
ALTER TABLE `table_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Chỉ mục cho bảng `table_product_color`
--
ALTER TABLE `table_product_color`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product_photo`
--
ALTER TABLE `table_product_photo`
  ADD PRIMARY KEY (`pp_id`);

--
-- Chỉ mục cho bảng `table_product_size`
--
ALTER TABLE `table_product_size`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_province`
--
ALTER TABLE `table_province`
  ADD PRIMARY KEY (`province_id`);

--
-- Chỉ mục cho bảng `table_rating`
--
ALTER TABLE `table_rating`
  ADD PRIMARY KEY (`rt_id`);

--
-- Chỉ mục cho bảng `table_service`
--
ALTER TABLE `table_service`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_settings`
--
ALTER TABLE `table_settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_shipping_cost`
--
ALTER TABLE `table_shipping_cost`
  ADD PRIMARY KEY (`shipping_cost_id`);

--
-- Chỉ mục cho bảng `table_shipping_cost_all`
--
ALTER TABLE `table_shipping_cost_all`
  ADD PRIMARY KEY (`sca_id`);

--
-- Chỉ mục cho bảng `table_size`
--
ALTER TABLE `table_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Chỉ mục cho bảng `table_slider`
--
ALTER TABLE `table_slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_social`
--
ALTER TABLE `table_social`
  ADD PRIMARY KEY (`social_id`);

--
-- Chỉ mục cho bảng `table_top_category`
--
ALTER TABLE `table_top_category`
  ADD PRIMARY KEY (`tcat_id`);

--
-- Chỉ mục cho bảng `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `table_color`
--
ALTER TABLE `table_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `table_customer`
--
ALTER TABLE `table_customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `table_customer_message`
--
ALTER TABLE `table_customer_message`
  MODIFY `customer_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_end_category`
--
ALTER TABLE `table_end_category`
  MODIFY `ecat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `table_faq`
--
ALTER TABLE `table_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `table_mid_category`
--
ALTER TABLE `table_mid_category`
  MODIFY `mcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `table_order`
--
ALTER TABLE `table_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `table_page`
--
ALTER TABLE `table_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `table_payment`
--
ALTER TABLE `table_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `table_photo`
--
ALTER TABLE `table_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `table_product`
--
ALTER TABLE `table_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT cho bảng `table_product_color`
--
ALTER TABLE `table_product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=542;

--
-- AUTO_INCREMENT cho bảng `table_product_photo`
--
ALTER TABLE `table_product_photo`
  MODIFY `pp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT cho bảng `table_product_size`
--
ALTER TABLE `table_product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT cho bảng `table_rating`
--
ALTER TABLE `table_rating`
  MODIFY `rt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_service`
--
ALTER TABLE `table_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `table_settings`
--
ALTER TABLE `table_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `table_shipping_cost`
--
ALTER TABLE `table_shipping_cost`
  MODIFY `shipping_cost_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_shipping_cost_all`
--
ALTER TABLE `table_shipping_cost_all`
  MODIFY `sca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `table_size`
--
ALTER TABLE `table_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `table_slider`
--
ALTER TABLE `table_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `table_social`
--
ALTER TABLE `table_social`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `table_top_category`
--
ALTER TABLE `table_top_category`
  MODIFY `tcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
