-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2025 at 04:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gobuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_admin`
--

CREATE TABLE `table_admin` (
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
-- Dumping data for table `table_admin`
--

INSERT INTO `table_admin` (`id`, `full_name`, `email`, `phone`, `password`, `photo`, `token`, `datetime`, `timestamp`, `status`) VALUES
(1, 'admin', 'admin@mail.com', '7777777777', 'd00f5d5217896fb7fd601412cb890830', 'admin-1.png', 'xxxx', '23-2-2025', '25-2-2025', 0),
(2, 'thu', 'ebedangiu2111@gmail.com', '+84774048884', 'fe9e27dd7bf526b57d69d3bd9fac33dc', 'default.jpg', '', '2025-03-26 01:46:19', '1742971579', 1),
(3, 'thu', 'thupii@gmail.com', '+84774048884', 'c4ca4238a0b923820dcc509a6f75849b', 'default.jpg', '5d393e2a2f8f455f5a42aac1f0f262e7', '2025-03-28 10:33:05', '1743132785', 0),
(4, 'thu', 'thupii2111@gmai.com', '+84 774048884', 'c4ca4238a0b923820dcc509a6f75849b', 'default.jpg', '59b68bb5c6b2cd89190ee8edd5209d42', '2025-03-28 10:33:50', '1743132830', 0),
(5, 'Duc Anh Tran', 'taduc0508@gmail.com', '0344377104', '900150983cd24fb0d6963f7d28e17f72', 'default.jpg', '84e39cd756c73f70b52ba50a71278b15', '2025-03-30 09:16:26', '1743300986', 1),
(6, 'Duc Anh Tran', 'anhduc9b1cva@gmail.com', '0344377104', '900150983cd24fb0d6963f7d28e17f72', 'default.jpg', 'f15eb404154b96a49aa2bc2b36a6759a', '2025-03-30 09:16:40', '1743301000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_color`
--

CREATE TABLE `table_color` (
  `color_id` int(11) NOT NULL,
  `color_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_color`
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
-- Table structure for table `table_customer`
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
-- Dumping data for table `table_customer`
--

INSERT INTO `table_customer` (`cust_id`, `cust_name`, `cust_email`, `cust_phone`, `cust_province`, `cust_district`, `cust_address`, `cust_s_name`, `cust_s_phone`, `cust_s_province`, `cust_s_district`, `cust_s_address`, `cust_password`, `cust_token`, `cust_datetime`, `cust_timestamp`, `cust_status`) VALUES
(1, 'Nguyễn Văn A', 'vana@gmail.com', '0905123456', 1, 'ABC', '123 Đường Lê Lợi', 'Nguyễn Văn A', '0905123456', 29, 'ABC', '123 Đường Lê Lợi', '5f4dcc3b5aa765d61d8327deb882cf99', 'abc123token1', '2025-02-28 10:00:00', '1746031200', 1),
(2, 'Trần Thị B', 'anhduc9b1cva@gmail.com', '0914345678', 2, 'XYZ', '456 Đường Trần Hưng Đạo', 'Trần Thị B', '1234', 11, 'XYZ', 'DEF', '5f4dcc3b5aa765d61d8327deb882cf99', 'xyz456token2', '2025-02-28 10:10:00', '1746031800', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_customer_message`
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
-- Table structure for table `table_end_category`
--

CREATE TABLE `table_end_category` (
  `ecat_id` int(11) NOT NULL,
  `ecat_name` text NOT NULL,
  `mcat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_end_category`
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
-- Table structure for table `table_faq`
--

CREATE TABLE `table_faq` (
  `faq_id` int(11) NOT NULL,
  `faq_title` text NOT NULL,
  `faq_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_faq`
--

INSERT INTO `table_faq` (`faq_id`, `faq_title`, `faq_content`) VALUES
(1, 'Làm thế nào để tìm một sản phẩm?', '<h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><font color=\"#222222\" face=\"opensans, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif\"><span style=\"font-size: 15.7143px;\">Chúng tôi có rất nhiều sản phẩm tuyệt vời để bạn lựa chọn.</span></font></h3><h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><span style=\"font-size: 15.7143px; color: rgb(34, 34, 34); font-family: opensans, \"Helvetica Neue\", Helvetica, Helvetica, Arial, sans-serif;\">Mẹo 1: Nếu bạn đang tìm kiếm một sản phẩm cụ thể, hãy sử dụng hộp tìm kiếm từ khóa nằm ở đầu trang web. Chỉ cần nhập sản phẩm bạn đang tìm và chuẩn bị để ngạc nhiên!</span></h3><h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><font color=\"#222222\" face=\"opensans, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif\"><span style=\"font-size: 15.7143px;\">Mẹo 2: Nếu bạn muốn khám phá danh mục sản phẩm, hãy sử dụng Danh mục cửa hàng trong menu trên cùng và duyệt qua các danh mục yêu thích của bạn, nơi chúng tôi sẽ giới thiệu những sản phẩm tốt nhất trong từng danh mục.</span></font><br><br></h3>\r\n'),
(2, 'Chính sách hoàn trả của bạn là gì?', '<p><span style=\"color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: 14px; text-align: center;\">Bạn có 15 ngày để yêu cầu hoàn tiền sau khi đơn hàng của bạn được giao.</span><br></p>\r\n'),
(3, 'Tôi nhận được sản phẩm bị lỗi/hư hỏng, tôi có thể hoàn tiền không?', '<p>Nếu sản phẩm bạn nhận được bị lỗi hoặc hư hỏng, bạn có thể trả lại sản phẩm trong cùng điều kiện như khi bạn nhận được, với hộp và/hoặc bao bì gốc còn nguyên vẹn. Sau khi chúng tôi nhận được sản phẩm trả lại, chúng tôi sẽ kiểm tra và nếu sản phẩm được xác nhận là bị lỗi hoặc hư hỏng, chúng tôi sẽ xử lý hoàn tiền cùng với bất kỳ khoản phí vận chuyển nào phát sinh.<br></p>\r\n'),
(4, 'Khi nào không thể hoàn trả?', '<p class=\"a  \" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; line-height: 1.6; margin-bottom: 0.714286rem; padding: 0px; font-size: 14px; color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; background-color: rgb(250, 250, 250);\">Có một số trường hợp nhất định mà chúng tôi không thể hỗ trợ hoàn trả:</p><ol style=\"box-sizing: inherit; line-height: 1.6; margin-right: 0px; margin-bottom: 0px; margin-left: 1.25rem; padding: 0px; list-style-position: outside; color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(250, 250, 250);\"><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Yêu cầu hoàn trả được thực hiện sau thời gian quy định là 15 ngày kể từ khi giao hàng.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm đã qua sử dụng, bị hư hỏng hoặc không còn nguyên trạng như khi nhận được.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các danh mục sản phẩm cụ thể như đồ lót, nội y, tất và các sản phẩm quà tặng kèm.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm bị lỗi nhưng thuộc phạm vi bảo hành của nhà sản xuất.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các sản phẩm tiêu hao đã được sử dụng hoặc lắp đặt.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm có số sê-ri bị tẩy xóa hoặc mất.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Bất kỳ mặt hàng nào bị thiếu phụ kiện đi kèm như nhãn giá, tem mác, bao bì gốc, quà tặng kèm.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các sản phẩm dễ vỡ, liên quan đến vệ sinh.</li></ol>\r\n'),
(5, 'Những sản phẩm nào không thể hoàn trả?', '<p>Những sản phẩm không thể hoàn trả bao gồm:</p><p>Các sản phẩm xả kho có ghi rõ chính sách không hoàn trả<br></p><p>Khi trong điều kiện ưu đãi có ghi rõ rằng sản phẩm đó không thể hoàn trả.</p><p>Các sản phẩm thuộc các loại sau:</p><ul><li>Đồ lót</li><li>Nội y</li><li>Tất</li><li>Phần mềm</li><li>Album nhạc</li><li>Sách</li><li>Đồ bơi</li><li>Sản phẩm làm đẹp &amp; nước hoa</li><li>Vớ</li></ul><p>Ngoài ra, các sản phẩm tiêu hao đã sử dụng hoặc lắp đặt cũng không thể hoàn trả. Điều này phù hợp với Luật bảo vệ người tiêu dùng về các sản phẩm không được hoàn trả.<br></p>');

-- --------------------------------------------------------

--
-- Table structure for table `table_mid_category`
--

CREATE TABLE `table_mid_category` (
  `mcat_id` int(11) NOT NULL,
  `mcat_name` text NOT NULL,
  `tcat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_mid_category`
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
-- Table structure for table `table_order`
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
-- Table structure for table `table_page`
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
-- Dumping data for table `table_page`
--

INSERT INTO `table_page` (`id`, `about_title`, `about_content`, `about_banner`, `about_meta_title`, `faq_title`, `faq_banner`, `faq_meta_title`, `contact_title`, `contact_banner`, `contact_meta_title`, `pgallery_title`, `pgallery_banner`, `pgallery_meta_title`) VALUES
(1, 'About Us', 'abcdefghiklm', 'about-banner.jpg', 'About Us', 'FAQ', 'fag-banner.jpg', 'FAQ', 'Liên hệ', 'contact-banner.jpg', 'Liên hệ', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_payment`
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
-- Dumping data for table `table_payment`
--

INSERT INTO `table_payment` (`id`, `customer_id`, `customer_name`, `customer_email`, `payment_date`, `txnid`, `paid_amount`, `card_number`, `card_cvv`, `card_month`, `card_year`, `bank_transaction_info`, `payment_method`, `payment_status`, `shipping_status`, `payment_id`) VALUES
(1, 1, 'Nguyễn Văn A', 'vana@gmail.com', '2025-02-28 11:00:00', 'TXN123456A', 500000.00, '4111111111111111', '123', '02', '2028', 'Bank XYZ - Successful', 'Bank Deposit', 'Completed', 'Pending', 'PAYID123A'),
(2, 2, 'Trần Thị B', 'anhduc9b1cva@gmail.com', '2025-02-28 11:15:00', 'TXN789101B', 750000.00, '5555555555554444', '456', '05', '2029', 'Bank ABC - Successful', 'Bank Deposit', 'Completed', 'Completed', 'PAYID456B');

-- --------------------------------------------------------

--
-- Table structure for table `table_photo`
--

CREATE TABLE `table_photo` (
  `id` int(11) NOT NULL,
  `caption` text NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_photo`
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
-- Table structure for table `table_product`
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
-- Dumping data for table `table_product`
--

INSERT INTO `table_product` (`p_id`, `p_name`, `p_old_price`, `p_current_price`, `p_qty`, `p_featured_photo`, `p_description`, `p_short_description`, `p_feature`, `p_return_policy`, `p_total_order`, `p_is_featured`, `p_is_active`, `ecat_id`) VALUES
(1, 'Bộ PC Gaming', '950', '850', 20, 'product-featured-1.jpg', '<p>Linh kiện máy tính chất lượng cao, đảm bảo hiệu suất mạnh mẽ và độ bền vượt trội. Phù hợp cho cả người dùng phổ thông và game thủ, hỗ trợ nâng cấp hệ thống một cách dễ dàng.</p><p><br></p>', '<p>\"Nâng cấp máy tính của bạn với linh kiện chất lượng cao, giá siêu hấp dẫn!\"</p><div><br></div>', '<p>Hiệu suất ổn định: Đáp ứng nhu cầu từ làm việc, giải trí đến chơi game chuyên nghiệp.</p><p>Tương thích cao: Dễ dàng lắp đặt, phù hợp với nhiều dòng máy.</p><p>Chất liệu bền bỉ: Linh kiện chính hãng, tuổi thọ cao.</p><p>Tiết kiệm năng lượng: Hoạt động hiệu quả, giảm tiêu thụ điện năng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ hộp, phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do lỗi người dùng.</p><div><br></div>', 0, 0, 1, 67),
(2, 'Thiết bị làm mát laptop', '950', '850', 200, 'product-featured-2.jpg', '<p>Linh kiện máy tính chất lượng cao, đảm bảo hiệu suất mạnh mẽ và độ bền vượt trội. Phù hợp cho cả người dùng phổ thông và game thủ, hỗ trợ nâng cấp hệ thống một cách dễ dàng.</p><div><br></div>', '<p>\"Nâng cấp máy tính của bạn với linh kiện chất lượng cao, giá siêu hấp dẫn!\"</p><div><br></div>', '<p>Hiệu suất ổn định: Đáp ứng nhu cầu từ làm việc, giải trí đến chơi game chuyên nghiệp.</p><p>Tương thích cao: Dễ dàng lắp đặt, phù hợp với nhiều dòng máy.</p><p>Chất liệu bền bỉ: Linh kiện chính hãng, tuổi thọ cao.</p><p>Tiết kiệm năng lượng: Hoạt động hiệu quả, giảm tiêu thụ điện năng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ hộp, phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do lỗi người dùng.</p><div><br></div>', 0, 0, 1, 67),
(3, 'Bộ PC Gaming', '950', '850', 35, 'product-featured-3.jpg', '<p>Linh kiện máy tính chất lượng cao, đảm bảo hiệu suất mạnh mẽ và độ bền vượt trội. Phù hợp cho cả người dùng phổ thông và game thủ, hỗ trợ nâng cấp hệ thống một cách dễ dàng.</p><div><br></div>', '<p>\"Nâng cấp máy tính của bạn với linh kiện chất lượng cao, giá siêu hấp dẫn!\"</p><div><br></div>', '<p>Hiệu suất ổn định: Đáp ứng nhu cầu từ làm việc, giải trí đến chơi game chuyên nghiệp.</p><p>Tương thích cao: Dễ dàng lắp đặt, phù hợp với nhiều dòng máy.</p><p>Chất liệu bền bỉ: Linh kiện chính hãng, tuổi thọ cao.</p><p>Tiết kiệm năng lượng: Hoạt động hiệu quả, giảm tiêu thụ điện năng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ hộp, phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do lỗi người dùng.</p><div><br></div>', 0, 0, 1, 67),
(4, 'Bàn phím cơ', '880', '720', 200, 'product-featured-4.jpg', '<p>Linh kiện bàn phím chất lượng cao, phù hợp để nâng cấp hoặc thay thế, giúp trải nghiệm gõ phím mượt mà và bền bỉ hơn. Tương thích với nhiều loại bàn phím cơ và văn phòng.</p><div><br></div>', '<p>\"Linh kiện bàn phím chất lượng cao, bền bỉ, phù hợp nâng cấp hoặc thay thế cho mọi loại bàn phím.\"</p>', '<p>Chất liệu bền bỉ: Nhựa ABS/PBT, kim loại chống gỉ, tuổi thọ cao.</p><p>Tương thích đa dạng: Phù hợp với nhiều loại switch và layout bàn phím.</p><p>Hiệu suất tối ưu: Phản hồi nhanh, độ nhạy cao, nâng cao trải nghiệm gõ phím.</p><p>Dễ dàng thay thế: Thiết kế tiện lợi, hỗ trợ lắp đặt đơn giản.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả với sản phẩm đã qua lắp đặt hoặc hư hỏng do tác động bên ngoài.</p><div><br></div>', 0, 1, 1, 71),
(5, 'Bàn phím bluetooth', '880', '720', 200, 'product-featured-5.jpg', '<p>Linh kiện bàn phím chất lượng cao, phù hợp để nâng cấp hoặc thay thế, giúp trải nghiệm gõ phím mượt mà và bền bỉ hơn. Tương thích với nhiều loại bàn phím cơ và văn phòng.</p><p><br></p>', '<p>\"Linh kiện bàn phím chất lượng cao, bền bỉ, phù hợp nâng cấp hoặc thay thế cho mọi loại bàn phím.\"</p><div><br></div>', '<p>Chất liệu bền bỉ: Nhựa ABS/PBT, kim loại chống gỉ, tuổi thọ cao.</p><p>Tương thích đa dạng: Phù hợp với nhiều loại switch và layout bàn phím.</p><p>Hiệu suất tối ưu: Phản hồi nhanh, độ nhạy cao, nâng cao trải nghiệm gõ phím.</p><p>Dễ dàng thay thế: Thiết kế tiện lợi, hỗ trợ lắp đặt đơn giản.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả với sản phẩm đã qua lắp đặt hoặc hư hỏng do tác động bên ngoài.</p><div><br></div>', 3, 0, 1, 71),
(6, 'Bàn phím bluetooth', '880', '720', 150, 'product-featured-6.jpg', '<p>Linh kiện bàn phím chất lượng cao, phù hợp để nâng cấp hoặc thay thế, giúp trải nghiệm gõ phím mượt mà và bền bỉ hơn. Tương thích với nhiều loại bàn phím cơ và văn phòng.</p><div><br></div>', '<p>\"Linh kiện bàn phím chất lượng cao, bền bỉ, phù hợp nâng cấp hoặc thay thế cho mọi loại bàn phím.\"</p><div><br></div>', '<p>Chất liệu bền bỉ: Nhựa ABS/PBT, kim loại chống gỉ, tuổi thọ cao.</p><p>Tương thích đa dạng: Phù hợp với nhiều loại switch và layout bàn phím.</p><p>Hiệu suất tối ưu: Phản hồi nhanh, độ nhạy cao, nâng cao trải nghiệm gõ phím.</p><p>Dễ dàng thay thế: Thiết kế tiện lợi, hỗ trợ lắp đặt đơn giản.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả với sản phẩm đã qua lắp đặt hoặc hư hỏng do tác động bên ngoài.</p><div><br></div>', 0, 0, 1, 71),
(7, 'Máy in màu', '980', '900', 200, 'product-featured-7.jpg', '<p>Máy in chất lượng cao, tốc độ in nhanh, phù hợp cho văn phòng và gia đình. Thiết kế nhỏ gọn, dễ sử dụng, hỗ trợ in ấn sắc nét và tiết kiệm chi phí.</p><div><br></div>', '<p>\"Máy in chất lượng cao, tốc độ nhanh, tiết kiệm mực - lựa chọn hoàn hảo cho văn phòng hiện đại!\"</p><p><br></p>', '<p>Công nghệ in hiện đại: In laser/ phun màu sắc nét, độ phân giải cao.</p><p>Tốc độ in nhanh: Đáp ứng nhu cầu in ấn số lượng lớn.</p><p>Kết nối linh hoạt: USB, Wi-Fi, in từ điện thoại dễ dàng.</p><p>Tiết kiệm mực: Hiệu suất cao, chi phí in thấp.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp, hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 70),
(8, 'Máy in laser đơn sắc', '980', '900', 200, 'product-featured-8.jpg', '<p>Máy in chất lượng cao, tốc độ in nhanh, phù hợp cho văn phòng và gia đình. Thiết kế nhỏ gọn, dễ sử dụng, hỗ trợ in ấn sắc nét và tiết kiệm chi phí.</p><div><br></div>', '<p>\"Máy in chất lượng cao, tốc độ nhanh, tiết kiệm mực - lựa chọn hoàn hảo cho văn phòng hiện đại!\"</p><p><br></p>', '<p>Công nghệ in hiện đại: In laser/ phun màu sắc nét, độ phân giải cao.</p><p>Tốc độ in nhanh: Đáp ứng nhu cầu in ấn số lượng lớn.</p><p>Kết nối linh hoạt: USB, Wi-Fi, in từ điện thoại dễ dàng.</p><p>Tiết kiệm mực: Hiệu suất cao, chi phí in thấp.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp, hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 70),
(9, 'Máy in màu', '980', '900', 200, 'product-featured-9.jpg', '<p>Máy in chất lượng cao, tốc độ in nhanh, phù hợp cho văn phòng và gia đình. Thiết kế nhỏ gọn, dễ sử dụng, hỗ trợ in ấn sắc nét và tiết kiệm chi phí.</p><div><br></div>', '<p>\"Máy in chất lượng cao, tốc độ nhanh, tiết kiệm mực - lựa chọn hoàn hảo cho văn phòng hiện đại!\"</p><div><br></div>', '<p>Công nghệ in hiện đại: In laser/ phun màu sắc nét, độ phân giải cao.</p><p>Tốc độ in nhanh: Đáp ứng nhu cầu in ấn số lượng lớn.</p><p>Kết nối linh hoạt: USB, Wi-Fi, in từ điện thoại dễ dàng.</p><p>Tiết kiệm mực: Hiệu suất cao, chi phí in thấp.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp, hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 70),
(10, 'Laptop', '850', '799', 250, 'product-featured-10.jpg', '<p>Laptop hiệu năng mạnh mẽ, thiết kế sang trọng, phù hợp cho học tập, làm việc và giải trí. Trang bị công nghệ hiện đại, mang đến trải nghiệm mượt mà, đáp ứng mọi nhu cầu sử dụng.</p><div><br></div>', '<p>\"Laptop hiệu năng cao, thiết kế sang trọng - hoàn hảo cho công việc và giải trí!\"</p><div><br></div>', '<p>Cấu hình mạnh: Vi xử lý tiên tiến, RAM lớn, SSD tốc độ cao.</p><p>Màn hình sắc nét: Độ phân giải Full HD trở lên, hình ảnh sống động.</p><p>Thiết kế hiện đại: Mỏng nhẹ, bền bỉ, dễ dàng mang theo.</p><p>Pin lâu, sạc nhanh: Đáp ứng nhu cầu sử dụng cả ngày.</p><p>Hệ thống tản nhiệt tốt: Hoạt động ổn định, không bị quá nóng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm bị hư hỏng do người dùng hoặc đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 68),
(11, 'Laptop', '850', '799', 150, 'product-featured-11.jpg', '<p>Laptop hiệu năng mạnh mẽ, thiết kế sang trọng, phù hợp cho học tập, làm việc và giải trí. Trang bị công nghệ hiện đại, mang đến trải nghiệm mượt mà, đáp ứng mọi nhu cầu sử dụng.</p><div><br></div>', '<p>\"Laptop hiệu năng cao, thiết kế sang trọng - hoàn hảo cho công việc và giải trí!\"</p><div><br></div>', '<p>Cấu hình mạnh: Vi xử lý tiên tiến, RAM lớn, SSD tốc độ cao.</p><p>Màn hình sắc nét: Độ phân giải Full HD trở lên, hình ảnh sống động.</p><p>Thiết kế hiện đại: Mỏng nhẹ, bền bỉ, dễ dàng mang theo.</p><p>Pin lâu, sạc nhanh: Đáp ứng nhu cầu sử dụng cả ngày.</p><p>Hệ thống tản nhiệt tốt: Hoạt động ổn định, không bị quá nóng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm bị hư hỏng do người dùng hoặc đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 68),
(12, 'Laptop', '850', '799', 200, 'product-featured-12.jpg', '<p>Laptop hiệu năng mạnh mẽ, thiết kế sang trọng, phù hợp cho học tập, làm việc và giải trí. Trang bị công nghệ hiện đại, mang đến trải nghiệm mượt mà, đáp ứng mọi nhu cầu sử dụng.</p><div><br></div>', '<p>\"Laptop hiệu năng cao, thiết kế sang trọng - hoàn hảo cho công việc và giải trí!\"</p><div><br></div>', '<p>Cấu hình mạnh: Vi xử lý tiên tiến, RAM lớn, SSD tốc độ cao.</p><p>Màn hình sắc nét: Độ phân giải Full HD trở lên, hình ảnh sống động.</p><p>Thiết kế hiện đại: Mỏng nhẹ, bền bỉ, dễ dàng mang theo.</p><p>Pin lâu, sạc nhanh: Đáp ứng nhu cầu sử dụng cả ngày.</p><p>Hệ thống tản nhiệt tốt: Hoạt động ổn định, không bị quá nóng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm bị hư hỏng do người dùng hoặc đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 68),
(13, 'Ipad Samsung', '720', '650', 150, 'product-featured-13.jpg', '<p>Máy tính bảng hiệu năng mạnh mẽ, thiết kế mỏng nhẹ, phù hợp cho công việc, giải trí và học tập. Màn hình sắc nét, pin lâu dài, giúp bạn tận hưởng trải nghiệm mượt mà mọi lúc mọi nơi.</p><div><br></div>', '<p>\"Máy tính bảng màn hình sắc nét, hiệu năng mạnh mẽ - đáp ứng mọi nhu cầu giải trí và công việc!\"</p><div><br></div>', '<p>Màn hình chất lượng cao: Hiển thị sắc nét, cảm ứng nhạy.</p><p>Hiệu năng ổn định: Chip xử lý mạnh mẽ, đa nhiệm mượt mà.</p><p>Dung lượng pin lớn: Sử dụng liên tục nhiều giờ liền.</p><p>Thiết kế hiện đại: Mỏng, nhẹ, dễ dàng mang theo.</p><p>Hỗ trợ kết nối: Wi-Fi, 4G/5G (tùy phiên bản), Bluetooth tiện lợi.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hộp.</p><p>Không áp dụng đổi trả với sản phẩm đã kích hoạt bảo hành hoặc bị hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 68),
(14, 'Ipad Samsung', '720', '650', 150, 'product-featured-14.jpg', '<p>Máy tính bảng hiệu năng mạnh mẽ, thiết kế mỏng nhẹ, phù hợp cho công việc, giải trí và học tập. Màn hình sắc nét, pin lâu dài, giúp bạn tận hưởng trải nghiệm mượt mà mọi lúc mọi nơi.</p><div><br></div>', '<p>\"Máy tính bảng màn hình sắc nét, hiệu năng mạnh mẽ - đáp ứng mọi nhu cầu giải trí và công việc!\"</p><div><br></div>', '<p>Màn hình chất lượng cao: Hiển thị sắc nét, cảm ứng nhạy.</p><p>Hiệu năng ổn định: Chip xử lý mạnh mẽ, đa nhiệm mượt mà.</p><p>Dung lượng pin lớn: Sử dụng liên tục nhiều giờ liền.</p><p>Thiết kế hiện đại: Mỏng, nhẹ, dễ dàng mang theo.</p><p>Hỗ trợ kết nối: Wi-Fi, 4G/5G (tùy phiên bản), Bluetooth tiện lợi.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hộp.</p><p>Không áp dụng đổi trả với sản phẩm đã kích hoạt bảo hành hoặc bị hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 68),
(15, 'Ipad Gen 11', '720', '650', 200, 'product-featured-15.jpg', '<p>Máy tính bảng hiệu năng mạnh mẽ, thiết kế mỏng nhẹ, phù hợp cho công việc, giải trí và học tập. Màn hình sắc nét, pin lâu dài, giúp bạn tận hưởng trải nghiệm mượt mà mọi lúc mọi nơi.</p><p><br></p>', '<p>\"Máy tính bảng màn hình sắc nét, hiệu năng mạnh mẽ - đáp ứng mọi nhu cầu giải trí và công việc!\"</p><div><br></div>', '<p>Màn hình chất lượng cao: Hiển thị sắc nét, cảm ứng nhạy.</p><p>Hiệu năng ổn định: Chip xử lý mạnh mẽ, đa nhiệm mượt mà.</p><p>Dung lượng pin lớn: Sử dụng liên tục nhiều giờ liền.</p><p>Thiết kế hiện đại: Mỏng, nhẹ, dễ dàng mang theo.</p><p>Hỗ trợ kết nối: Wi-Fi, 4G/5G (tùy phiên bản), Bluetooth tiện lợi.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hộp.</p><p>Không áp dụng đổi trả với sản phẩm đã kích hoạt bảo hành hoặc bị hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 68),
(16, 'Thiết bị phát WiFi', '500', '450', 200, 'product-featured-16.jpg', '<p>Thiết bị mạng chất lượng cao, giúp kết nối internet ổn định, tốc độ nhanh và bảo mật tối ưu. Phù hợp cho gia đình, văn phòng và doanh nghiệp.</p><div><br></div>', '<p>\"Thiết bị mạng ổn định, tốc độ cao - đảm bảo kết nối mượt mà cho công việc và giải trí!\"</p><div><br></div>', '<p>Tốc độ cao: Hỗ trợ băng thông mạnh, truyền tải dữ liệu mượt mà.</p><p>Kết nối ổn định: Giảm nhiễu, đảm bảo tín hiệu ổn định.</p><p>Dễ dàng cài đặt: Giao diện thân thiện, thiết lập nhanh chóng.</p><p>Bảo mật cao: Mã hóa tiên tiến, bảo vệ dữ liệu người dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và hộp đựng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 72),
(17, 'Thiết bị phát WiFi', '500', '450', 200, 'product-featured-17.jpg', '<p>Thiết bị mạng chất lượng cao, giúp kết nối internet ổn định, tốc độ nhanh và bảo mật tối ưu. Phù hợp cho gia đình, văn phòng và doanh nghiệp.</p><p><br></p>', '<p>\"Thiết bị mạng ổn định, tốc độ cao - đảm bảo kết nối mượt mà cho công việc và giải trí!\"</p>', '<p>Tốc độ cao: Hỗ trợ băng thông mạnh, truyền tải dữ liệu mượt mà.</p><p>Kết nối ổn định: Giảm nhiễu, đảm bảo tín hiệu ổn định.</p><p>Dễ dàng cài đặt: Giao diện thân thiện, thiết lập nhanh chóng.</p><p>Bảo mật cao: Mã hóa tiên tiến, bảo vệ dữ liệu người dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và hộp đựng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 72),
(18, 'Thiết bị phát WiFi', '500', '450', 150, 'product-featured-18.jpg', '<p>Thiết bị mạng chất lượng cao, giúp kết nối internet ổn định, tốc độ nhanh và bảo mật tối ưu. Phù hợp cho gia đình, văn phòng và doanh nghiệp.</p><p><br></p>', '<p>\"Thiết bị mạng ổn định, tốc độ cao - đảm bảo kết nối mượt mà cho công việc và giải trí!\"</p><div><br></div>', '<p>Tốc độ cao: Hỗ trợ băng thông mạnh, truyền tải dữ liệu mượt mà.</p><p>Kết nối ổn định: Giảm nhiễu, đảm bảo tín hiệu ổn định.</p><p>Dễ dàng cài đặt: Giao diện thân thiện, thiết lập nhanh chóng.</p><p>Bảo mật cao: Mã hóa tiên tiến, bảo vệ dữ liệu người dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và hộp đựng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 72),
(19, 'Camera an ninh', '820', '750', 350, 'product-featured-19.jpg', '<p>Thiết bị an ninh và giám sát hiện đại, giúp bảo vệ ngôi nhà, văn phòng và tài sản của bạn 24/7. Công nghệ tiên tiến, hình ảnh sắc nét, dễ dàng lắp đặt và sử dụng.</p><p><br></p>', '<p>\"Thiết bị an ninh và giám sát hiện đại - bảo vệ an toàn cho ngôi nhà và doanh nghiệp của bạn!\"</p><div><br></div>', '<p>Hình ảnh chất lượng cao: Độ phân giải Full HD/4K, hỗ trợ ban đêm.</p><p>Kết nối thông minh: Điều khiển từ xa qua ứng dụng điện thoại.</p><p>Phát hiện chuyển động: Cảnh báo tức thời khi có hoạt động bất thường.</p><p>Lưu trữ linh hoạt: Hỗ trợ thẻ nhớ, lưu trữ đám mây.</p><p>Dễ dàng lắp đặt: Tương thích với nhiều không gian và hệ thống an ninh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do khách hàng.</p><div><br></div>', 0, 0, 1, 63),
(20, 'Camera an ninh', '820', '750', 200, 'product-featured-20.jpg', '<p>Thiết bị an ninh và giám sát hiện đại, giúp bảo vệ ngôi nhà, văn phòng và tài sản của bạn 24/7. Công nghệ tiên tiến, hình ảnh sắc nét, dễ dàng lắp đặt và sử dụng.</p><div><br></div>', '<p>\"Thiết bị an ninh và giám sát hiện đại - bảo vệ an toàn cho ngôi nhà và doanh nghiệp của bạn!\"</p><div><br></div>', '<p>Hình ảnh chất lượng cao: Độ phân giải Full HD/4K, hỗ trợ ban đêm.</p><p>Kết nối thông minh: Điều khiển từ xa qua ứng dụng điện thoại.</p><p>Phát hiện chuyển động: Cảnh báo tức thời khi có hoạt động bất thường.</p><p>Lưu trữ linh hoạt: Hỗ trợ thẻ nhớ, lưu trữ đám mây.</p><p>Dễ dàng lắp đặt: Tương thích với nhiều không gian và hệ thống an ninh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do khách hàng.</p><div><br></div>', 0, 0, 1, 63),
(21, 'Camera an ninh', '820', '750', 200, 'product-featured-21.jpg', '<p>Thiết bị an ninh và giám sát hiện đại, giúp bảo vệ ngôi nhà, văn phòng và tài sản của bạn 24/7. Công nghệ tiên tiến, hình ảnh sắc nét, dễ dàng lắp đặt và sử dụng.</p><p><br></p>', '<p>\"Thiết bị an ninh và giám sát hiện đại - bảo vệ an toàn cho ngôi nhà và doanh nghiệp của bạn!\"</p><div><br></div>', '<p>Hình ảnh chất lượng cao: Độ phân giải Full HD/4K, hỗ trợ ban đêm.</p><p>Kết nối thông minh: Điều khiển từ xa qua ứng dụng điện thoại.</p><p>Phát hiện chuyển động: Cảnh báo tức thời khi có hoạt động bất thường.</p><p>Lưu trữ linh hoạt: Hỗ trợ thẻ nhớ, lưu trữ đám mây.</p><p>Dễ dàng lắp đặt: Tương thích với nhiều không gian và hệ thống an ninh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, đầy đủ phụ kiện và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do khách hàng.</p><div><br></div>', 0, 0, 1, 63),
(22, 'Iphone15', '960', '890', 300, 'product-featured-22.jpg', '<p>Điện thoại thông minh với thiết kế hiện đại, hiệu năng mạnh mẽ và nhiều tính năng thông minh. Phù hợp cho công việc, giải trí và kết nối mọi lúc, mọi nơi.</p><p><br></p>', '<p>\"Điện thoại thiết kế sang trọng, hiệu năng mạnh mẽ - trải nghiệm mượt mà mọi tác vụ!\"</p><div><br></div>', '<p>Màn hình sắc nét: Công nghệ tiên tiến, hiển thị sống động.</p><p>Hiệu năng mạnh mẽ: Bộ vi xử lý cao cấp, đa nhiệm mượt mà.</p><p>Camera chất lượng cao: Chụp ảnh, quay video sắc nét.</p><p>Dung lượng pin lớn: Sử dụng cả ngày dài, sạc nhanh tiện lợi.</p><p>Bảo mật an toàn: Cảm biến vân tay, nhận diện khuôn mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên hộp, phụ kiện đầy đủ và không có dấu hiệu sử dụng.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc sản phẩm đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 61),
(23, 'Samsung Galaxy', '960', '890', 320, 'product-featured-23.jpg', '<p>Điện thoại thông minh với thiết kế hiện đại, hiệu năng mạnh mẽ và nhiều tính năng thông minh. Phù hợp cho công việc, giải trí và kết nối mọi lúc, mọi nơi.</p><p><br></p>', '<p>\"Điện thoại thiết kế sang trọng, hiệu năng mạnh mẽ - trải nghiệm mượt mà mọi tác vụ!\"</p><div><br></div>', '<p>Màn hình sắc nét: Công nghệ tiên tiến, hiển thị sống động.</p><p>Hiệu năng mạnh mẽ: Bộ vi xử lý cao cấp, đa nhiệm mượt mà.</p><p>Camera chất lượng cao: Chụp ảnh, quay video sắc nét.</p><p>Dung lượng pin lớn: Sử dụng cả ngày dài, sạc nhanh tiện lợi.</p><p>Bảo mật an toàn: Cảm biến vân tay, nhận diện khuôn mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên hộp, phụ kiện đầy đủ và không có dấu hiệu sử dụng.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc sản phẩm đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 61),
(24, 'Samsung Galaxy', '960', '890', 150, 'product-featured-24.jpg', '<p>Điện thoại thông minh với thiết kế hiện đại, hiệu năng mạnh mẽ và nhiều tính năng thông minh. Phù hợp cho công việc, giải trí và kết nối mọi lúc, mọi nơi.</p><p><br></p>', '<p>\"Điện thoại thiết kế sang trọng, hiệu năng mạnh mẽ - trải nghiệm mượt mà mọi tác vụ!\"</p><div><br></div>', '<p>Màn hình sắc nét: Công nghệ tiên tiến, hiển thị sống động.</p><p>Hiệu năng mạnh mẽ: Bộ vi xử lý cao cấp, đa nhiệm mượt mà.</p><p>Camera chất lượng cao: Chụp ảnh, quay video sắc nét.</p><p>Dung lượng pin lớn: Sử dụng cả ngày dài, sạc nhanh tiện lợi.</p><p>Bảo mật an toàn: Cảm biến vân tay, nhận diện khuôn mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên hộp, phụ kiện đầy đủ và không có dấu hiệu sử dụng.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc sản phẩm đã kích hoạt bảo hành.</p><div><br></div>', 0, 0, 1, 61),
(25, 'Thiết bị định vị', '650', '580', 150, 'product-featured-25.jpg', '<p>Thiết bị GPS &amp; định vị thông minh, giúp xác định vị trí chính xác, theo dõi hành trình và đảm bảo an toàn cho phương tiện, tài sản hoặc cá nhân. Thiết kế nhỏ gọn, dễ dàng lắp đặt và sử dụng.</p><div><br></div>', '<p>\"Thiết bị GPS định vị chính xác, tín hiệu ổn định - an tâm theo dõi mọi hành trình!\"</p><div><br></div>', '<p>Định vị chính xác: Công nghệ GPS tiên tiến, cập nhật vị trí theo thời gian thực.</p><p>Kết nối đa nền tảng: Hỗ trợ ứng dụng trên điện thoại và máy tính.</p><p>Cảnh báo an toàn: Thiết lập vùng an toàn, cảnh báo khi ra khỏi khu vực giới hạn.</p><p>Pin bền bỉ: Thời lượng pin dài, có thể sạc lại hoặc kết nối nguồn trực tiếp.</p><p>Chống nước, chịu lực: Phù hợp cho nhiều điều kiện môi trường.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả cho sản phẩm đã kích hoạt hoặc bị hư hại do người dùng.</p><div><br></div>', 0, 0, 1, 65),
(26, 'Thiết bị định vị', '650', '580', 230, 'product-featured-26.jpg', '<p>Thiết bị GPS &amp; định vị thông minh, giúp xác định vị trí chính xác, theo dõi hành trình và đảm bảo an toàn cho phương tiện, tài sản hoặc cá nhân. Thiết kế nhỏ gọn, dễ dàng lắp đặt và sử dụng.</p><div><br></div>', '<p>\"Thiết bị GPS định vị chính xác, tín hiệu ổn định - an tâm theo dõi mọi hành trình!\"</p><div><br></div>', '<p>Định vị chính xác: Công nghệ GPS tiên tiến, cập nhật vị trí theo thời gian thực.</p><p>Kết nối đa nền tảng: Hỗ trợ ứng dụng trên điện thoại và máy tính.</p><p>Cảnh báo an toàn: Thiết lập vùng an toàn, cảnh báo khi ra khỏi khu vực giới hạn.</p><p>Pin bền bỉ: Thời lượng pin dài, có thể sạc lại hoặc kết nối nguồn trực tiếp.</p><p>Chống nước, chịu lực: Phù hợp cho nhiều điều kiện môi trường.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả cho sản phẩm đã kích hoạt hoặc bị hư hại do người dùng.</p><div><br></div>', 0, 0, 1, 65),
(27, 'Thiết bị định vị', '650', '580', 150, 'product-featured-27.jpg', '<p>Thiết bị GPS &amp; định vị thông minh, giúp xác định vị trí chính xác, theo dõi hành trình và đảm bảo an toàn cho phương tiện, tài sản hoặc cá nhân. Thiết kế nhỏ gọn, dễ dàng lắp đặt và sử dụng.</p><div><br></div>', '<p>\"Thiết bị GPS định vị chính xác, tín hiệu ổn định - an tâm theo dõi mọi hành trình!\"</p><div><br></div>', '<p>Định vị chính xác: Công nghệ GPS tiên tiến, cập nhật vị trí theo thời gian thực.</p><p>Kết nối đa nền tảng: Hỗ trợ ứng dụng trên điện thoại và máy tính.</p><p>Cảnh báo an toàn: Thiết lập vùng an toàn, cảnh báo khi ra khỏi khu vực giới hạn.</p><p>Pin bền bỉ: Thời lượng pin dài, có thể sạc lại hoặc kết nối nguồn trực tiếp.</p><p>Chống nước, chịu lực: Phù hợp cho nhiều điều kiện môi trường.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và phụ kiện đi kèm.</p><p>Không áp dụng đổi trả cho sản phẩm đã kích hoạt hoặc bị hư hại do người dùng.</p><div><br></div>', 0, 0, 1, 65),
(28, 'Tai nghe bluetooth', '380', '320', 230, 'product-featured-28.jpg', '<p>Tai nghe chất lượng cao với âm thanh sống động, thiết kế hiện đại, mang đến trải nghiệm nghe nhạc, xem phim và đàm thoại tuyệt vời. Phù hợp cho công việc, giải trí và luyện tập thể thao.</p><p><br></p>', '<p>\"Tai nghe âm thanh sống động, kết nối ổn định - tận hưởng trọn vẹn từng giai điệu!\"</p><div><br></div>', '<p>Âm thanh chân thực: Công nghệ âm thanh tiên tiến, bass mạnh mẽ.</p><p>Kết nối ổn định: Hỗ trợ Bluetooth 5.0 / Jack 3.5mm / USB-C (tùy dòng).</p><p>Thoải mái khi sử dụng: Đệm tai êm ái, thiết kế nhẹ, ôm sát tai.</p><p>Pin lâu dài: Thời gian sử dụng lên đến 20 giờ (đối với tai nghe không dây).</p><p>Chống ồn hiệu quả: Lọc tạp âm, nâng cao chất lượng đàm thoại.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm phải nguyên vẹn, đầy đủ hộp và phụ kiện kèm theo.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc hao mòn tự nhiên.</p><div><br></div>', 0, 0, 1, 62),
(29, 'Tai nghe bluetooth', '380', '320', 230, 'product-featured-29.jpg', '<p>Tai nghe chất lượng cao với âm thanh sống động, thiết kế hiện đại, mang đến trải nghiệm nghe nhạc, xem phim và đàm thoại tuyệt vời. Phù hợp cho công việc, giải trí và luyện tập thể thao.</p><div><br></div>', '<p>\"Tai nghe âm thanh sống động, kết nối ổn định - tận hưởng trọn vẹn từng giai điệu!\"</p><div><br></div>', '<p>Âm thanh chân thực: Công nghệ âm thanh tiên tiến, bass mạnh mẽ.</p><p>Kết nối ổn định: Hỗ trợ Bluetooth 5.0 / Jack 3.5mm / USB-C (tùy dòng).</p><p>Thoải mái khi sử dụng: Đệm tai êm ái, thiết kế nhẹ, ôm sát tai.</p><p>Pin lâu dài: Thời gian sử dụng lên đến 20 giờ (đối với tai nghe không dây).</p><p>Chống ồn hiệu quả: Lọc tạp âm, nâng cao chất lượng đàm thoại.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm phải nguyên vẹn, đầy đủ hộp và phụ kiện kèm theo.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc hao mòn tự nhiên.</p><div><br></div>', 0, 0, 1, 62),
(30, 'Tai nghe bluetooth', '380', '320', 150, 'product-featured-30.jpg', '<p>Tai nghe chất lượng cao với âm thanh sống động, thiết kế hiện đại, mang đến trải nghiệm nghe nhạc, xem phim và đàm thoại tuyệt vời. Phù hợp cho công việc, giải trí và luyện tập thể thao.</p><div><br></div>', '<p>\"Tai nghe âm thanh sống động, kết nối ổn định - tận hưởng trọn vẹn từng giai điệu!\"</p><div><br></div>', '<p>Âm thanh chân thực: Công nghệ âm thanh tiên tiến, bass mạnh mẽ.</p><p>Kết nối ổn định: Hỗ trợ Bluetooth 5.0 / Jack 3.5mm / USB-C (tùy dòng).</p><p>Thoải mái khi sử dụng: Đệm tai êm ái, thiết kế nhẹ, ôm sát tai.</p><p>Pin lâu dài: Thời gian sử dụng lên đến 20 giờ (đối với tai nghe không dây).</p><p>Chống ồn hiệu quả: Lọc tạp âm, nâng cao chất lượng đàm thoại.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm phải nguyên vẹn, đầy đủ hộp và phụ kiện kèm theo.</p><p>Không áp dụng đổi trả với lỗi do người dùng hoặc hao mòn tự nhiên.</p><div><br></div>', 0, 0, 1, 62),
(31, 'Micro', '950', '870', 320, 'product-featured-31.jpg', '<p>Thiết bị âm thanh gia đình chất lượng cao, mang đến trải nghiệm âm thanh sống động, chân thực. Thiết kế hiện đại, dễ dàng kết nối và phù hợp với mọi không gian. Lựa chọn hoàn hảo để tận hưởng âm nhạc, phim ảnh và giải trí tại nhà.</p><div><br></div>', '<p>\"Thiết bị âm thanh gia đình chất lượng cao - âm thanh sống động, trải nghiệm giải trí đỉnh cao!\"</p><div><br></div>', '<p>Âm thanh chất lượng cao: Công nghệ tiên tiến, âm bass mạnh mẽ, âm treble trong trẻo.</p><p>Kết nối đa dạng: Hỗ trợ Bluetooth, AUX, USB, HDMI, Optical,...</p><p>Thiết kế sang trọng: Kiểu dáng tinh tế, phù hợp với mọi phong cách nội thất.</p><p>Tiện lợi và dễ sử dụng: Điều khiển từ xa, tích hợp các chế độ âm thanh thông minh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đã qua sử dụng.</p><div><br></div>', 0, 0, 1, 66),
(32, 'Bộ chỉnh âm thanh', '950', '870', 240, 'product-featured-32.jpg', '<p>Thiết bị âm thanh gia đình chất lượng cao, mang đến trải nghiệm âm thanh sống động, chân thực. Thiết kế hiện đại, dễ dàng kết nối và phù hợp với mọi không gian. Lựa chọn hoàn hảo để tận hưởng âm nhạc, phim ảnh và giải trí tại nhà.</p><p><br></p>', '<p>\"Thiết bị âm thanh gia đình chất lượng cao - âm thanh sống động, trải nghiệm giải trí đỉnh cao!\"</p><div><br></div>', '<p>Âm thanh chất lượng cao: Công nghệ tiên tiến, âm bass mạnh mẽ, âm treble trong trẻo.</p><p>Kết nối đa dạng: Hỗ trợ Bluetooth, AUX, USB, HDMI, Optical,...</p><p>Thiết kế sang trọng: Kiểu dáng tinh tế, phù hợp với mọi phong cách nội thất.</p><p>Tiện lợi và dễ sử dụng: Điều khiển từ xa, tích hợp các chế độ âm thanh thông minh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đã qua sử dụng.</p><div><br></div>', 0, 0, 1, 66),
(33, 'Micro ', '950', '870', 200, 'product-featured-33.jpg', '<p>Thiết bị âm thanh gia đình chất lượng cao, mang đến trải nghiệm âm thanh sống động, chân thực. Thiết kế hiện đại, dễ dàng kết nối và phù hợp với mọi không gian. Lựa chọn hoàn hảo để tận hưởng âm nhạc, phim ảnh và giải trí tại nhà.</p><p><br></p>', '<p>\"Thiết bị âm thanh gia đình chất lượng cao - âm thanh sống động, trải nghiệm giải trí đỉnh cao!\"</p><div><br></div>', '<p>Âm thanh chất lượng cao: Công nghệ tiên tiến, âm bass mạnh mẽ, âm treble trong trẻo.</p><p>Kết nối đa dạng: Hỗ trợ Bluetooth, AUX, USB, HDMI, Optical,...</p><p>Thiết kế sang trọng: Kiểu dáng tinh tế, phù hợp với mọi phong cách nội thất.</p><p>Tiện lợi và dễ sử dụng: Điều khiển từ xa, tích hợp các chế độ âm thanh thông minh.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi kỹ thuật từ nhà sản xuất.</p><p>Sản phẩm cần nguyên vẹn, đầy đủ phụ kiện và hóa đơn khi đổi trả.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đã qua sử dụng.</p><div><br></div>', 0, 0, 1, 66),
(34, 'Ti vi', '990', '920', 200, 'product-featured-34.jpg', '<p>Tivi màn hình sắc nét, công nghệ tiên tiến, mang đến trải nghiệm giải trí sống động. Thiết kế hiện đại, phù hợp với mọi không gian sống, từ phòng khách đến phòng ngủ.</p><div><br></div>', '<p>\"Tivi màn hình sắc nét, âm thanh sống động - trải nghiệm giải trí tuyệt vời ngay tại nhà!\"</p><div><br></div>', '<p>Độ phân giải cao: Full HD, 4K, 8K cho hình ảnh chân thực, sắc nét.</p><p>Công nghệ tiên tiến: HDR, OLED, QLED giúp màu sắc sống động, chân thực.</p><p>Âm thanh sống động: Hệ thống loa mạnh mẽ, hỗ trợ Dolby Audio.</p><p>Kết nối đa dạng: HDMI, USB, Wi-Fi, Bluetooth tiện lợi.</p><p>Hệ điều hành thông minh: Android TV, WebOS, Tizen, dễ dàng sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc lỗi do người dùng.</p><div><br></div>', 0, 0, 1, 64),
(35, 'Ti vi LG', '990', '920', 300, 'product-featured-35.jpg', '<p>Tivi màn hình sắc nét, công nghệ tiên tiến, mang đến trải nghiệm giải trí sống động. Thiết kế hiện đại, phù hợp với mọi không gian sống, từ phòng khách đến phòng ngủ.</p><div><br></div>', '<p>\"Tivi màn hình sắc nét, âm thanh sống động - trải nghiệm giải trí tuyệt vời ngay tại nhà!\"</p><div><br></div>', '<p>Độ phân giải cao: Full HD, 4K, 8K cho hình ảnh chân thực, sắc nét.</p><p>Công nghệ tiên tiến: HDR, OLED, QLED giúp màu sắc sống động, chân thực.</p><p>Âm thanh sống động: Hệ thống loa mạnh mẽ, hỗ trợ Dolby Audio.</p><p>Kết nối đa dạng: HDMI, USB, Wi-Fi, Bluetooth tiện lợi.</p><p>Hệ điều hành thông minh: Android TV, WebOS, Tizen, dễ dàng sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc lỗi do người dùng.</p><div><br></div>', 0, 0, 1, 64),
(36, 'Ti Vi LG', '990', '920', 300, 'product-featured-36.jpg', '<p>Tivi màn hình sắc nét, công nghệ tiên tiến, mang đến trải nghiệm giải trí sống động. Thiết kế hiện đại, phù hợp với mọi không gian sống, từ phòng khách đến phòng ngủ.</p><div><br></div>', '<p>\"Tivi màn hình sắc nét, âm thanh sống động - trải nghiệm giải trí tuyệt vời ngay tại nhà!\"</p><div><br></div>', '<p>Độ phân giải cao: Full HD, 4K, 8K cho hình ảnh chân thực, sắc nét.</p><p>Công nghệ tiên tiến: HDR, OLED, QLED giúp màu sắc sống động, chân thực.</p><p>Âm thanh sống động: Hệ thống loa mạnh mẽ, hỗ trợ Dolby Audio.</p><p>Kết nối đa dạng: HDMI, USB, Wi-Fi, Bluetooth tiện lợi.</p><p>Hệ điều hành thông minh: Android TV, WebOS, Tizen, dễ dàng sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần nguyên vẹn, đầy đủ phụ kiện, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc lỗi do người dùng.</p><div><br></div>', 0, 0, 1, 64),
(37, 'Baby Fresh', '600', '540', 120, 'product-featured-37.jpg', '<p>Sản phẩm chăm sóc trẻ em an toàn, tiện lợi, giúp bố mẹ yên tâm chăm sóc bé yêu mỗi ngày. Chất liệu cao cấp, thiết kế thông minh, phù hợp với mọi giai đoạn phát triển của bé.</p><p><br></p>', '<p>\"Thiết bị chăm sóc trẻ em an toàn, tiện lợi - hỗ trợ ba mẹ chăm bé dễ dàng hơn!\"</p><div><br></div>', '<p>An toàn cho bé: Chất liệu không chứa BPA, thân thiện với làn da nhạy cảm.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhu cầu chăm sóc bé hàng ngày.</p><p>Độ bền cao: Chống va đập, dễ vệ sinh và sử dụng lâu dài.</p><p>Đạt tiêu chuẩn chất lượng: Được kiểm định an toàn trước khi đến tay người tiêu dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm đã qua sử dụng hoặc thuộc danh mục vệ sinh cá nhân.</p><div><br></div>', 0, 0, 1, 77),
(38, 'Dầu gội em bé', '600', '540', 240, 'product-featured-38.jpg', '<p>Sản phẩm chăm sóc trẻ em an toàn, tiện lợi, giúp bố mẹ yên tâm chăm sóc bé yêu mỗi ngày. Chất liệu cao cấp, thiết kế thông minh, phù hợp với mọi giai đoạn phát triển của bé.</p><div><br></div>', '<p>\"Thiết bị chăm sóc trẻ em an toàn, tiện lợi - hỗ trợ ba mẹ chăm bé dễ dàng hơn!\"</p><div><br></div>', '<p>An toàn cho bé: Chất liệu không chứa BPA, thân thiện với làn da nhạy cảm.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhu cầu chăm sóc bé hàng ngày.</p><p>Độ bền cao: Chống va đập, dễ vệ sinh và sử dụng lâu dài.</p><p>Đạt tiêu chuẩn chất lượng: Được kiểm định an toàn trước khi đến tay người tiêu dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm đã qua sử dụng hoặc thuộc danh mục vệ sinh cá nhân.</p><div><br></div>', 0, 0, 1, 77),
(39, 'Kem chống hăm', '600', '540', 320, 'product-featured-39.jpg', '<p>Sản phẩm chăm sóc trẻ em an toàn, tiện lợi, giúp bố mẹ yên tâm chăm sóc bé yêu mỗi ngày. Chất liệu cao cấp, thiết kế thông minh, phù hợp với mọi giai đoạn phát triển của bé.</p><p><br></p>', '<p>\"Thiết bị chăm sóc trẻ em an toàn, tiện lợi - hỗ trợ ba mẹ chăm bé dễ dàng hơn!\"</p><div><br></div>', '<p>An toàn cho bé: Chất liệu không chứa BPA, thân thiện với làn da nhạy cảm.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhu cầu chăm sóc bé hàng ngày.</p><p>Độ bền cao: Chống va đập, dễ vệ sinh và sử dụng lâu dài.</p><p>Đạt tiêu chuẩn chất lượng: Được kiểm định an toàn trước khi đến tay người tiêu dùng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm đã qua sử dụng hoặc thuộc danh mục vệ sinh cá nhân.</p><div><br></div>', 0, 0, 1, 77),
(40, 'Giấy vệ sinh', '550', '480', 260, 'product-featured-40.jpg', '<p>Đồ dùng gia đình tiện ích, giúp tối ưu không gian sống và nâng cao chất lượng cuộc sống. Sản phẩm đa dạng, thiết kế hiện đại, phù hợp với mọi phong cách nội thất.</p><div><br></div>', '<p>\"Đồ dùng gia đình tiện ích, bền bỉ - giúp cuộc sống trở nên dễ dàng và thoải mái hơn!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: An toàn, thân thiện với môi trường.</p><p>Thiết kế thông minh: Tối ưu công năng, dễ sử dụng.</p><p>Dễ dàng vệ sinh: Chống bám bẩn, tiện lợi trong quá trình bảo quản.</p><p>Phù hợp nhiều không gian: Từ nhà bếp, phòng khách đến phòng ngủ.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 78),
(41, 'Bột giặt Omo', '550', '480', 300, 'product-featured-41.jpg', '<p>Đồ dùng gia đình tiện ích, giúp tối ưu không gian sống và nâng cao chất lượng cuộc sống. Sản phẩm đa dạng, thiết kế hiện đại, phù hợp với mọi phong cách nội thất.</p><div><br></div>', '<p>\"Đồ dùng gia đình tiện ích, bền bỉ - giúp cuộc sống trở nên dễ dàng và thoải mái hơn!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: An toàn, thân thiện với môi trường.</p><p>Thiết kế thông minh: Tối ưu công năng, dễ sử dụng.</p><p>Dễ dàng vệ sinh: Chống bám bẩn, tiện lợi trong quá trình bảo quản.</p><p>Phù hợp nhiều không gian: Từ nhà bếp, phòng khách đến phòng ngủ.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 78),
(42, 'Thùng rác', '550', '480', 300, 'product-featured-42.jpg', '<p>Đồ dùng gia đình tiện ích, giúp tối ưu không gian sống và nâng cao chất lượng cuộc sống. Sản phẩm đa dạng, thiết kế hiện đại, phù hợp với mọi phong cách nội thất.</p><div><br></div>', '<p>\"Đồ dùng gia đình tiện ích, bền bỉ - giúp cuộc sống trở nên dễ dàng và thoải mái hơn!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: An toàn, thân thiện với môi trường.</p><p>Thiết kế thông minh: Tối ưu công năng, dễ sử dụng.</p><p>Dễ dàng vệ sinh: Chống bám bẩn, tiện lợi trong quá trình bảo quản.</p><p>Phù hợp nhiều không gian: Từ nhà bếp, phòng khách đến phòng ngủ.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 78),
(43, 'Hộp quà', '200', '150', 200, 'product-featured-43.jpg', '<p>Bộ dụng cụ gói quà sang trọng, giúp bạn tạo nên những món quà đẹp mắt và ý nghĩa. Phù hợp cho mọi dịp: sinh nhật, lễ Tết, kỷ niệm... Chất liệu bền đẹp, dễ sử dụng, mang đến trải nghiệm gói quà chuyên nghiệp ngay tại nhà.</p><div><br></div>', '<p>\"Đồ gói quà đẹp mắt, tinh tế - giúp món quà của bạn thêm ý nghĩa và ấn tượng!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Giấy dày dặn, ruy băng mềm mịn, keo dán chắc chắn.</p><p>Thiết kế đa dạng: Họa tiết tinh tế, màu sắc phong phú, phù hợp nhiều phong cách.</p><p>Dễ sử dụng: Phù hợp cho cả người mới bắt đầu và thợ gói quà chuyên nghiệp.</p><p>Thân thiện môi trường: Một số mẫu sử dụng giấy tái chế, bảo vệ môi trường.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc hư hỏng do vận chuyển.</p><p>Sản phẩm đổi trả cần nguyên vẹn, chưa qua sử dụng, giữ nguyên bao bì.</p><p>Không áp dụng đổi trả với các sản phẩm đã sử dụng hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 79),
(44, 'Giấy gói quà', '200', '150', 200, 'product-featured-44.jpg', '<p>Bộ dụng cụ gói quà sang trọng, giúp bạn tạo nên những món quà đẹp mắt và ý nghĩa. Phù hợp cho mọi dịp: sinh nhật, lễ Tết, kỷ niệm... Chất liệu bền đẹp, dễ sử dụng, mang đến trải nghiệm gói quà chuyên nghiệp ngay tại nhà.</p><div><br></div>', '<p>\"Đồ gói quà đẹp mắt, tinh tế - giúp món quà của bạn thêm ý nghĩa và ấn tượng!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Giấy dày dặn, ruy băng mềm mịn, keo dán chắc chắn.</p><p>Thiết kế đa dạng: Họa tiết tinh tế, màu sắc phong phú, phù hợp nhiều phong cách.</p><p>Dễ sử dụng: Phù hợp cho cả người mới bắt đầu và thợ gói quà chuyên nghiệp.</p><p>Thân thiện môi trường: Một số mẫu sử dụng giấy tái chế, bảo vệ môi trường.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc hư hỏng do vận chuyển.</p><p>Sản phẩm đổi trả cần nguyên vẹn, chưa qua sử dụng, giữ nguyên bao bì.</p><p>Không áp dụng đổi trả với các sản phẩm đã sử dụng hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 79),
(45, 'Hộp quà', '200', '150', 320, 'product-featured-45.jpg', '<p>Bộ dụng cụ gói quà sang trọng, giúp bạn tạo nên những món quà đẹp mắt và ý nghĩa. Phù hợp cho mọi dịp: sinh nhật, lễ Tết, kỷ niệm... Chất liệu bền đẹp, dễ sử dụng, mang đến trải nghiệm gói quà chuyên nghiệp ngay tại nhà.</p><div><br></div>', '<p>\"Đồ gói quà đẹp mắt, tinh tế - giúp món quà của bạn thêm ý nghĩa và ấn tượng!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Giấy dày dặn, ruy băng mềm mịn, keo dán chắc chắn.</p><p>Thiết kế đa dạng: Họa tiết tinh tế, màu sắc phong phú, phù hợp nhiều phong cách.</p><p>Dễ sử dụng: Phù hợp cho cả người mới bắt đầu và thợ gói quà chuyên nghiệp.</p><p>Thân thiện môi trường: Một số mẫu sử dụng giấy tái chế, bảo vệ môi trường.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc hư hỏng do vận chuyển.</p><p>Sản phẩm đổi trả cần nguyên vẹn, chưa qua sử dụng, giữ nguyên bao bì.</p><p>Không áp dụng đổi trả với các sản phẩm đã sử dụng hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 79),
(46, 'Nước rửa mắt', '420', '350', 200, 'product-featured-46.jpg', '<p>Bộ sản phẩm chăm sóc mắt giúp nuôi dưỡng, bảo vệ và làm dịu vùng da nhạy cảm quanh mắt. Công thức dịu nhẹ, an toàn, mang lại đôi mắt tươi trẻ và rạng rỡ.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc mắt dịu nhẹ, an toàn - bảo vệ đôi mắt sáng khỏe mỗi ngày!\"</p>', '<p>Dưỡng ẩm chuyên sâu: Giúp giảm khô da, ngăn ngừa nếp nhăn.</p><p>Giảm quầng thâm &amp; bọng mắt: Thành phần thiên nhiên giúp sáng da, thư giãn vùng mắt.</p><p>An toàn, lành tính: Không chứa paraben, hương liệu nhân tạo, phù hợp cho mọi loại da.</p><p>Thẩm thấu nhanh: Kết cấu nhẹ, không gây bết dính.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không hỗ trợ đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 75),
(47, 'Nước rửa mắt', '420', '350', 300, 'product-featured-47.jpg', '<p>Bộ sản phẩm chăm sóc mắt giúp nuôi dưỡng, bảo vệ và làm dịu vùng da nhạy cảm quanh mắt. Công thức dịu nhẹ, an toàn, mang lại đôi mắt tươi trẻ và rạng rỡ.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc mắt dịu nhẹ, an toàn - bảo vệ đôi mắt sáng khỏe mỗi ngày!\"</p><div><br></div>', '<p>Dưỡng ẩm chuyên sâu: Giúp giảm khô da, ngăn ngừa nếp nhăn.</p><p>Giảm quầng thâm &amp; bọng mắt: Thành phần thiên nhiên giúp sáng da, thư giãn vùng mắt.</p><p>An toàn, lành tính: Không chứa paraben, hương liệu nhân tạo, phù hợp cho mọi loại da.</p><p>Thẩm thấu nhanh: Kết cấu nhẹ, không gây bết dính.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không hỗ trợ đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 75),
(48, 'Thuốc nhỏ mắt', '420', '350', 150, 'product-featured-48.jpg', '<p>Bộ sản phẩm chăm sóc mắt giúp nuôi dưỡng, bảo vệ và làm dịu vùng da nhạy cảm quanh mắt. Công thức dịu nhẹ, an toàn, mang lại đôi mắt tươi trẻ và rạng rỡ.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc mắt dịu nhẹ, an toàn - bảo vệ đôi mắt sáng khỏe mỗi ngày!\"</p>', '<p>Dưỡng ẩm chuyên sâu: Giúp giảm khô da, ngăn ngừa nếp nhăn.</p><p>Giảm quầng thâm &amp; bọng mắt: Thành phần thiên nhiên giúp sáng da, thư giãn vùng mắt.</p><p>An toàn, lành tính: Không chứa paraben, hương liệu nhân tạo, phù hợp cho mọi loại da.</p><p>Thẩm thấu nhanh: Kết cấu nhẹ, không gây bết dính.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem, hộp và hóa đơn mua hàng.</p><p>Không hỗ trợ đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 75),
(49, 'Kem đánh răng', '350', '290', 200, 'product-featured-49.jpg', '<p>Bộ sản phẩm chăm sóc răng miệng giúp bảo vệ nướu, ngăn ngừa mảng bám và mang lại hơi thở thơm mát. Công thức an toàn, phù hợp cho mọi lứa tuổi, hỗ trợ chăm sóc răng miệng toàn diện mỗi ngày.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc răng miệng chất lượng - bảo vệ nụ cười khỏe đẹp mỗi ngày!\"</p><div><br></div>', '<p>Làm sạch hiệu quả: Loại bỏ vi khuẩn, mảng bám và ngăn ngừa sâu răng.</p><p>Thành phần an toàn: Không chứa hóa chất gây hại, phù hợp cho răng nhạy cảm.</p><p>Hơi thở thơm mát: Giúp bạn tự tin suốt cả ngày.</p><p>Đa dạng sản phẩm: Kem đánh răng, bàn chải, nước súc miệng, chỉ nha khoa,...</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải còn nguyên tem, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với các sản phẩm khuyến mãi hoặc đã mở nắp.</p><div><br></div>', 0, 0, 1, 74),
(50, 'Nước súc miệng', '350', '290', 320, 'product-featured-50.jpg', '<p>Bộ sản phẩm chăm sóc răng miệng giúp bảo vệ nướu, ngăn ngừa mảng bám và mang lại hơi thở thơm mát. Công thức an toàn, phù hợp cho mọi lứa tuổi, hỗ trợ chăm sóc răng miệng toàn diện mỗi ngày.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc răng miệng chất lượng - bảo vệ nụ cười khỏe đẹp mỗi ngày!\"</p><div><br></div>', '<p>Làm sạch hiệu quả: Loại bỏ vi khuẩn, mảng bám và ngăn ngừa sâu răng.</p><p>Thành phần an toàn: Không chứa hóa chất gây hại, phù hợp cho răng nhạy cảm.</p><p>Hơi thở thơm mát: Giúp bạn tự tin suốt cả ngày.</p><p>Đa dạng sản phẩm: Kem đánh răng, bàn chải, nước súc miệng, chỉ nha khoa,...</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải còn nguyên tem, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với các sản phẩm khuyến mãi hoặc đã mở nắp.</p><div><br></div>', 0, 0, 1, 74),
(51, 'Bàn chải đánh răng', '350', '290', 320, 'product-featured-51.jpg', '<p>Bộ sản phẩm chăm sóc răng miệng giúp bảo vệ nướu, ngăn ngừa mảng bám và mang lại hơi thở thơm mát. Công thức an toàn, phù hợp cho mọi lứa tuổi, hỗ trợ chăm sóc răng miệng toàn diện mỗi ngày.</p><p><br></p>', '<p>\"Sản phẩm chăm sóc răng miệng chất lượng - bảo vệ nụ cười khỏe đẹp mỗi ngày!\"</p><div><br></div>', '<p>Làm sạch hiệu quả: Loại bỏ vi khuẩn, mảng bám và ngăn ngừa sâu răng.</p><p>Thành phần an toàn: Không chứa hóa chất gây hại, phù hợp cho răng nhạy cảm.</p><p>Hơi thở thơm mát: Giúp bạn tự tin suốt cả ngày.</p><p>Đa dạng sản phẩm: Kem đánh răng, bàn chải, nước súc miệng, chỉ nha khoa,...</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải còn nguyên tem, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với các sản phẩm khuyến mãi hoặc đã mở nắp.</p><div><br></div>', 0, 0, 1, 74);
INSERT INTO `table_product` (`p_id`, `p_name`, `p_old_price`, `p_current_price`, `p_qty`, `p_featured_photo`, `p_description`, `p_short_description`, `p_feature`, `p_return_policy`, `p_total_order`, `p_is_featured`, `p_is_active`, `ecat_id`) VALUES
(52, 'Nhiệt kế', '750', '680', 350, 'product-featured-52.jpg', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải còn nguyên tem, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với các sản phẩm khuyến mãi hoặc đã mở nắp.</p><div><br></div>', '<p>&nbsp;\"Thiết bị, dụng cụ y tế chính xác, an toàn - hỗ trợ chăm sóc sức khỏe hiệu quả!\"</p><div><br></div>', '<p>Chất lượng đảm bảo: Sản phẩm đạt tiêu chuẩn an toàn và kiểm định y tế.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhiều nhu cầu khác nhau.</p><p>Độ bền cao: Chất liệu an toàn, đảm bảo sử dụng lâu dài.</p><p>Ứng dụng đa dạng: Dành cho cá nhân, phòng khám, bệnh viện.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng và đầy đủ bao bì, phụ kiện.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc các mặt hàng đặc biệt như kim tiêm, khẩu trang.</p><div><br></div>', 0, 0, 1, 73),
(53, 'Khẩu trang y tế', '750', '680', 150, 'product-featured-53.jpg', '<p>Thiết bị và dụng cụ y tế chất lượng cao, đảm bảo an toàn và hiệu quả trong chăm sóc sức khỏe. Sản phẩm đạt tiêu chuẩn y tế, phù hợp cho cả cá nhân và cơ sở y tế chuyên nghiệp.</p><div><br></div>', '<p>\"Thiết bị, dụng cụ y tế chính xác, an toàn - hỗ trợ chăm sóc sức khỏe hiệu quả!\"</p><div><br></div>', '<p>Chất lượng đảm bảo: Sản phẩm đạt tiêu chuẩn an toàn và kiểm định y tế.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhiều nhu cầu khác nhau.</p><p>Độ bền cao: Chất liệu an toàn, đảm bảo sử dụng lâu dài.</p><p>Ứng dụng đa dạng: Dành cho cá nhân, phòng khám, bệnh viện.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng và đầy đủ bao bì, phụ kiện.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc các mặt hàng đặc biệt như kim tiêm, khẩu trang.</p><div><br></div>', 0, 0, 1, 73),
(54, 'Dụng cụ vệ sinh ', '750', '680', 200, 'product-featured-54.jpg', '<p>Thiết bị và dụng cụ y tế chất lượng cao, đảm bảo an toàn và hiệu quả trong chăm sóc sức khỏe. Sản phẩm đạt tiêu chuẩn y tế, phù hợp cho cả cá nhân và cơ sở y tế chuyên nghiệp.</p><div><br></div>', '<p>\"Thiết bị, dụng cụ y tế chính xác, an toàn - hỗ trợ chăm sóc sức khỏe hiệu quả!\"</p><div><br></div>', '<p>Chất lượng đảm bảo: Sản phẩm đạt tiêu chuẩn an toàn và kiểm định y tế.</p><p>Thiết kế tiện lợi: Dễ sử dụng, phù hợp với nhiều nhu cầu khác nhau.</p><p>Độ bền cao: Chất liệu an toàn, đảm bảo sử dụng lâu dài.</p><p>Ứng dụng đa dạng: Dành cho cá nhân, phòng khám, bệnh viện.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng và đầy đủ bao bì, phụ kiện.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc các mặt hàng đặc biệt như kim tiêm, khẩu trang.</p><div><br></div>', 0, 0, 1, 73),
(55, 'Vitamin tốt cho sức khỏe', '530', '470', 200, 'product-featured-55.jpg', '<p>Vitamin và thực phẩm chức năng hỗ trợ tăng cường sức khỏe, bổ sung dưỡng chất thiết yếu cho cơ thể. Sản phẩm chất lượng cao, an toàn, phù hợp với nhiều đối tượng sử dụng.</p><div><br></div>', '<p>\"Vitamin bổ sung dinh dưỡng, tăng cường sức khỏe - tràn đầy năng lượng mỗi ngày!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Chiết xuất từ nguyên liệu an toàn, không chứa chất bảo quản độc hại.</p><p>Công dụng đa dạng: Hỗ trợ tăng cường miễn dịch, làm đẹp da, cải thiện sức khỏe tổng thể.</p><p>Dễ sử dụng: Dạng viên nang, bột, nước tiện lợi, dễ hấp thu.</p><p>Đạt tiêu chuẩn chất lượng: Chứng nhận an toàn thực phẩm, kiểm định nghiêm ngặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa mở nắp, nguyên tem niêm phong và còn hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc bị hư hỏng do bảo quản sai cách.</p><div><br></div>', 0, 0, 1, 76),
(56, 'Vitamin tốt cho sức khỏe', '530', '470', 320, 'product-featured-56.jpg', '<p>Vitamin và thực phẩm chức năng hỗ trợ tăng cường sức khỏe, bổ sung dưỡng chất thiết yếu cho cơ thể. Sản phẩm chất lượng cao, an toàn, phù hợp với nhiều đối tượng sử dụng.</p><p><br></p>', '<p>\"Vitamin bổ sung dinh dưỡng, tăng cường sức khỏe - tràn đầy năng lượng mỗi ngày!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Chiết xuất từ nguyên liệu an toàn, không chứa chất bảo quản độc hại.</p><p>Công dụng đa dạng: Hỗ trợ tăng cường miễn dịch, làm đẹp da, cải thiện sức khỏe tổng thể.</p><p>Dễ sử dụng: Dạng viên nang, bột, nước tiện lợi, dễ hấp thu.</p><p>Đạt tiêu chuẩn chất lượng: Chứng nhận an toàn thực phẩm, kiểm định nghiêm ngặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa mở nắp, nguyên tem niêm phong và còn hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc bị hư hỏng do bảo quản sai cách.</p><div><br></div>', 0, 0, 1, 76),
(57, 'Vitamin tốt cho sức khỏe', '530', '470', 320, 'product-featured-57.jpg', '<p>Vitamin và thực phẩm chức năng hỗ trợ tăng cường sức khỏe, bổ sung dưỡng chất thiết yếu cho cơ thể. Sản phẩm chất lượng cao, an toàn, phù hợp với nhiều đối tượng sử dụng.</p><p><br></p>', '<p>\"Vitamin bổ sung dinh dưỡng, tăng cường sức khỏe - tràn đầy năng lượng mỗi ngày!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Chiết xuất từ nguyên liệu an toàn, không chứa chất bảo quản độc hại.</p><p>Công dụng đa dạng: Hỗ trợ tăng cường miễn dịch, làm đẹp da, cải thiện sức khỏe tổng thể.</p><p>Dễ sử dụng: Dạng viên nang, bột, nước tiện lợi, dễ hấp thu.</p><p>Đạt tiêu chuẩn chất lượng: Chứng nhận an toàn thực phẩm, kiểm định nghiêm ngặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa mở nắp, nguyên tem niêm phong và còn hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã sử dụng hoặc bị hư hỏng do bảo quản sai cách.</p><div><br></div>', 0, 0, 1, 76),
(58, 'Áo polo nam ngắn tay', '450', '390', 350, 'product-featured-58.jpg', '<p>Áo polo nam cao cấp – thiết kế thanh lịch, chất liệu cotton thoáng mát, thấm hút mồ hôi tốt. Kiểu dáng trẻ trung, dễ phối đồ, phù hợp cho cả đi làm, dạo phố và chơi thể thao.</p><p><br></p>', '<p>&nbsp;\"Áo polo nam thanh lịch, chất liệu thoáng mát - phù hợp mọi hoàn cảnh!\"</p><div><br></div>', '<p>✔ Chất liệu: Cotton cao cấp, co giãn 4 chiều</p><p>✔ Kiểu dáng: Slim fit, cổ bẻ cứng cáp</p><p>✔ Đường may tỉ mỉ, bền đẹp</p><p>✔ Nhiều màu sắc sang trọng, dễ phối đồ</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu.</p><p>🔹 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng.</p><p>🔹 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển).</p><div><br></div>', 0, 0, 1, 23),
(59, 'Áo polo nam ngắn tay', '450', '390', 340, 'product-featured-59.jpg', '<p>Áo polo nam cao cấp – thiết kế thanh lịch, chất liệu cotton thoáng mát, thấm hút mồ hôi tốt. Kiểu dáng trẻ trung, dễ phối đồ, phù hợp cho cả đi làm, dạo phố và chơi thể thao.</p><p><br></p>', '<p>\"Áo polo nam thanh lịch, chất liệu thoáng mát - phù hợp mọi hoàn cảnh!\"</p><div><br></div>', '<p>✔ Chất liệu: Cotton cao cấp, co giãn 4 chiều</p><p>✔ Kiểu dáng: Slim fit, cổ bẻ cứng cáp</p><p>✔ Đường may tỉ mỉ, bền đẹp</p><p>✔ Nhiều màu sắc sang trọng, dễ phối đồ</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu.</p><p>🔹 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng.</p><p>🔹 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển).</p><div><br></div>', 0, 0, 1, 23),
(60, 'Áo polo nam ngắn tay', '450', '390', 350, 'product-featured-60.jpg', '<p>Áo polo nam cao cấp – thiết kế thanh lịch, chất liệu cotton thoáng mát, thấm hút mồ hôi tốt. Kiểu dáng trẻ trung, dễ phối đồ, phù hợp cho cả đi làm, dạo phố và chơi thể thao.</p><p><br></p>', '<p>\"Áo polo nam thanh lịch, chất liệu thoáng mát - phù hợp mọi hoàn cảnh!\"</p><div><br></div>', '<p>✔ Chất liệu: Cotton cao cấp, co giãn 4 chiều</p><p>✔ Kiểu dáng: Slim fit, cổ bẻ cứng cáp</p><p>✔ Đường may tỉ mỉ, bền đẹp</p><p>✔ Nhiều màu sắc sang trọng, dễ phối đồ</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu.</p><p>🔹 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng.</p><p>🔹 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển).</p><div><br></div>', 0, 0, 1, 23),
(61, 'Áo sơ mi dài tay', '600', '520', 200, 'product-featured-61.jpg', '<p>Áo sơ mi công sở nam cao cấp, thiết kế thanh lịch, phù hợp cho môi trường văn phòng và sự kiện quan trọng. Chất liệu vải mềm mại, thoáng khí, thấm hút mồ hôi tốt, mang lại cảm giác thoải mái cả ngày dài. Đường may tỉ mỉ, form dáng chuẩn giúp tôn lên phong thái lịch lãm.</p><div><br></div>', '<p>\"Áo sơ mi công sở nam lịch lãm, chất liệu cao cấp - tự tin mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/Polyester cao cấp, thoáng mát</p><p>✔ Form slim fit/regular fit thời trang, dễ phối đồ</p><p>✔ Màu sắc trang nhã, không phai, bền đẹp theo thời gian</p><p>✔ Cổ áo đứng form, khuy cài chắc chắn</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>Không áp dụng đổi trả với sản phẩm đã giặt hoặc hư hỏng do khách hàng</p><div><br></div>', 0, 0, 1, 22),
(62, 'Áo sơ mi dài tay', '600', '520', 340, 'product-featured-62.jpg', '<p>Áo sơ mi công sở nam cao cấp, thiết kế thanh lịch, phù hợp cho môi trường văn phòng và sự kiện quan trọng. Chất liệu vải mềm mại, thoáng khí, thấm hút mồ hôi tốt, mang lại cảm giác thoải mái cả ngày dài. Đường may tỉ mỉ, form dáng chuẩn giúp tôn lên phong thái lịch lãm.</p><div><br></div>', '<p>\"Áo sơ mi công sở nam lịch lãm, chất liệu cao cấp - tự tin mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/Polyester cao cấp, thoáng mát</p><p>✔ Form slim fit/regular fit thời trang, dễ phối đồ</p><p>✔ Màu sắc trang nhã, không phai, bền đẹp theo thời gian</p><p>✔ Cổ áo đứng form, khuy cài chắc chắn</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>Không áp dụng đổi trả với sản phẩm đã giặt hoặc hư hỏng do khách hàng</p><div><br></div>', 0, 0, 1, 22),
(63, 'Áo sơ mi ngắn tay', '600', '520', 200, 'product-featured-63.jpg', '<p>Áo sơ mi công sở nam cao cấp, thiết kế thanh lịch, phù hợp cho môi trường văn phòng và sự kiện quan trọng. Chất liệu vải mềm mại, thoáng khí, thấm hút mồ hôi tốt, mang lại cảm giác thoải mái cả ngày dài. Đường may tỉ mỉ, form dáng chuẩn giúp tôn lên phong thái lịch lãm.</p><div><br></div>', '<p>\"Áo sơ mi công sở nam lịch lãm, chất liệu cao cấp - tự tin mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/Polyester cao cấp, thoáng mát</p><p>✔ Form slim fit/regular fit thời trang, dễ phối đồ</p><p>✔ Màu sắc trang nhã, không phai, bền đẹp theo thời gian</p><p>✔ Cổ áo đứng form, khuy cài chắc chắn</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>Không áp dụng đổi trả với sản phẩm đã giặt hoặc hư hỏng do khách hàng</p><div><br></div>', 0, 0, 1, 22),
(64, 'Áo thun vải mát ', '350', '280', 350, 'product-featured-64.jpg', '<p>Áo thun nam phong cách trẻ trung, chất liệu cotton mềm mại, thoáng khí, thấm hút mồ hôi tốt. Thiết kế basic dễ phối đồ, phù hợp cho mọi hoàn cảnh từ đi chơi, đi làm đến tập luyện thể thao.</p><div><br></div>', '<p>\"Áo thun nam mềm mại, thoáng mát - phong cách năng động cho mọi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu cotton co giãn, thoáng mát</p><p>✔ Form dáng chuẩn, không bai nhão sau khi giặt</p><p>✔ Đa dạng màu sắc, dễ dàng phối hợp trang phục</p><p>✔ Đường may chắc chắn, bền đẹp theo thời gian</p><div><br></div>', '<p>🔄 Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>🚫 Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc giặt tẩy</p><p>📦 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 20),
(65, 'Áo thun cổ chun mùa hè', '350', '280', 200, 'product-featured-65.jpg', '<p>Áo thun nam phong cách trẻ trung, chất liệu cotton mềm mại, thoáng khí, thấm hút mồ hôi tốt. Thiết kế basic dễ phối đồ, phù hợp cho mọi hoàn cảnh từ đi chơi, đi làm đến tập luyện thể thao.</p><p><br></p>', '<p>&nbsp;\"Áo thun nam mềm mại, thoáng mát - phong cách năng động cho mọi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu cotton co giãn, thoáng mát</p><p>✔ Form dáng chuẩn, không bai nhão sau khi giặt</p><p>✔ Đa dạng màu sắc, dễ dàng phối hợp trang phục</p><p>✔ Đường may chắc chắn, bền đẹp theo thời gian</p><p><br></p>', '<p>🔄 Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>🚫 Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc giặt tẩy</p><p>📦 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 20),
(66, 'Áo thun mùa hè cho nam', '350', '280', 240, 'product-featured-66.jpg', '<p>Áo thun nam phong cách trẻ trung, chất liệu cotton mềm mại, thoáng khí, thấm hút mồ hôi tốt. Thiết kế basic dễ phối đồ, phù hợp cho mọi hoàn cảnh từ đi chơi, đi làm đến tập luyện thể thao.</p><p><br></p>', '<p>\"Áo thun nam mềm mại, thoáng mát - phong cách năng động cho mọi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu cotton co giãn, thoáng mát</p><p>✔ Form dáng chuẩn, không bai nhão sau khi giặt</p><p>✔ Đa dạng màu sắc, dễ dàng phối hợp trang phục</p><p>✔ Đường may chắc chắn, bền đẹp theo thời gian</p><div><br></div>', '<p>🔄 Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>🚫 Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc giặt tẩy</p><p>📦 Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 20),
(67, 'Dép quai ngang thoải mái', '290', '230', 350, 'product-featured-67.jpg', '<p>Dép nam thời trang, thiết kế hiện đại, chất liệu cao cấp, êm ái và bền bỉ. Phù hợp cho cả đi trong nhà và ngoài trời, mang lại cảm giác thoải mái suốt ngày dài.</p><div><br></div>', '<p>\"Dép nam bền đẹp, êm ái - thoải mái di chuyển mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu chống trơn trượt, êm chân</p><p>✔ Kiểu dáng thời thượng, dễ phối đồ</p><p>✔ Đế bền, đàn hồi tốt, thoáng khí</p><p>✔ Đa dạng màu sắc, kích cỡ</p><div><br></div>', '<p>🔹 Đổi trả trong vòng 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất hoặc giao nhầm mẫu/màu/size.</p><p>🔹 Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>🔹 Không hỗ trợ đổi trả do chọn sai kích cỡ hoặc sở thích cá nhân.</p><div><br></div>', 0, 0, 1, 4),
(68, 'Dép quai ngang', '290', '230', 320, 'product-featured-68.jpg', '<p>Dép nam thời trang, thiết kế hiện đại, chất liệu cao cấp, êm ái và bền bỉ. Phù hợp cho cả đi trong nhà và ngoài trời, mang lại cảm giác thoải mái suốt ngày dài.</p><div><br></div>', '<p>\"Dép nam bền đẹp, êm ái - thoải mái di chuyển mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu chống trơn trượt, êm chân</p><p>✔ Kiểu dáng thời thượng, dễ phối đồ</p><p>✔ Đế bền, đàn hồi tốt, thoáng khí</p><p>✔ Đa dạng màu sắc, kích cỡ</p><div><br></div>', '<p>🔹 Đổi trả trong vòng 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất hoặc giao nhầm mẫu/màu/size.</p><p>🔹 Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>🔹 Không hỗ trợ đổi trả do chọn sai kích cỡ hoặc sở thích cá nhân.</p><div><br></div>', 0, 0, 1, 4),
(69, 'Dép quai ngang', '290', '230', 200, 'product-featured-69.jpg', '<p>Dép nam thời trang, thiết kế hiện đại, chất liệu cao cấp, êm ái và bền bỉ. Phù hợp cho cả đi trong nhà và ngoài trời, mang lại cảm giác thoải mái suốt ngày dài.</p><div><br></div>', '<p>\"Dép nam bền đẹp, êm ái - thoải mái di chuyển mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✔ Chất liệu chống trơn trượt, êm chân</p><p>✔ Kiểu dáng thời thượng, dễ phối đồ</p><p>✔ Đế bền, đàn hồi tốt, thoáng khí</p><p>✔ Đa dạng màu sắc, kích cỡ</p><div><br></div>', '<p>🔹 Đổi trả trong vòng 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất hoặc giao nhầm mẫu/màu/size.</p><p>🔹 Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>🔹 Không hỗ trợ đổi trả do chọn sai kích cỡ hoặc sở thích cá nhân.</p><div><br></div>', 0, 0, 1, 4),
(70, 'Giày da bóng cho nam', '820', '750', 320, 'product-featured-70.jpg', '<p>Giày công sở nam cao cấp – thiết kế thanh lịch, chất liệu da thật mềm mại, bền bỉ. Đế cao su chống trượt, êm ái, phù hợp cho môi trường công sở và các dịp quan trọng.</p><div><br></div>', '<p>\"Giày công sở nam sang trọng, bền đẹp - tôn lên vẻ lịch lãm, chuyên nghiệp!\"</p><div><br></div>', '<p>✔ Chất liệu da bò thật, bền đẹp theo thời gian</p><p>✔ Đế cao su chống trơn trượt, ma sát tốt</p><p>✔ Kiểu dáng sang trọng, dễ phối đồ</p><p>✔ Lót giày êm ái, thoáng khí, mang cả ngày không đau chân</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu lỗi từ nhà sản xuất</p><p>🔹 Sản phẩm chưa qua sử dụng, còn nguyên hộp và hóa đơn</p><p>🔹 Hỗ trợ đổi size miễn phí (tùy điều kiện)</p><div><br></div>', 0, 0, 1, 56),
(71, 'Giày da bóng cho nam', '820', '750', 350, 'product-featured-71.jpg', '<p>Giày công sở nam cao cấp – thiết kế thanh lịch, chất liệu da thật mềm mại, bền bỉ. Đế cao su chống trượt, êm ái, phù hợp cho môi trường công sở và các dịp quan trọng.</p><p><br></p>', '<p>&nbsp;\"Giày công sở nam sang trọng, bền đẹp - tôn lên vẻ lịch lãm, chuyên nghiệp!\"</p><div><br></div>', '<p>✔ Chất liệu da bò thật, bền đẹp theo thời gian</p><p>✔ Đế cao su chống trơn trượt, ma sát tốt</p><p>✔ Kiểu dáng sang trọng, dễ phối đồ</p><p>✔ Lót giày êm ái, thoáng khí, mang cả ngày không đau chân</p><div><br></div>', '<p>🔹 Đổi trả trong 7 ngày nếu lỗi từ nhà sản xuất</p><p>🔹 Sản phẩm chưa qua sử dụng, còn nguyên hộp và hóa đơn</p><p>🔹 Hỗ trợ đổi size miễn phí (tùy điều kiện)</p><div><br></div>', 0, 0, 1, 56),
(72, 'Giày da cao cấp cho nam', '820', '750', 350, 'product-featured-72.jpg', '<p>Giày công sở nam cao cấp – thiết kế thanh lịch, chất liệu da thật mềm mại, bền bỉ. Đế cao su chống trượt, êm ái, phù hợp cho môi trường công sở và các dịp quan trọng.</p><div><br></div>', '<p>&nbsp;\"Giày công sở nam sang trọng, bền đẹp - tôn lên vẻ lịch lãm, chuyên nghiệp!\"</p><div><br></div>', '<p>✔ Chất liệu da bò thật, bền đẹp theo thời gian</p><p>✔ Đế cao su chống trơn trượt, ma sát tốt</p><p>✔ Kiểu dáng sang trọng, dễ phối đồ</p><p>✔ Lót giày êm ái, thoáng khí, mang cả ngày không đau chân</p><p><br></p>', '<p>🔹 Đổi trả trong 7 ngày nếu lỗi từ nhà sản xuất</p><p>🔹 Sản phẩm chưa qua sử dụng, còn nguyên hộp và hóa đơn</p><p>🔹 Hỗ trợ đổi size miễn phí (tùy điều kiện)</p><div><br></div>', 0, 0, 1, 56),
(73, 'Sandal đi học cho nam', '590', '520', 340, 'product-featured-73.jpg', '<p>Giày sandal nam thời trang, thiết kế năng động, phù hợp cho cả đi chơi và dạo phố. Chất liệu cao cấp, đế chống trơn trượt, mang lại cảm giác êm ái và thoải mái suốt cả ngày.</p><div><br></div>', '<p>\"Giày nam đơn giản, thoải mái - phù hợp cho mọi hoạt động hằng ngày!\"</p><div><br></div>', '<p>✔ Chất liệu bền bỉ, thoáng khí</p><p>✔ Đế cao su chống trơn, bám đường tốt</p><p>✔ Quai dán chắc chắn, dễ điều chỉnh</p><p>✔ Thiết kế thời trang, phù hợp nhiều phong cách</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem, chưa qua sử dụng</p><p>Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 25),
(74, 'Sandal đi học thoải mái', '590', '520', 320, 'product-featured-74.jpg', '<p>Giày sandal nam thời trang, thiết kế năng động, phù hợp cho cả đi chơi và dạo phố. Chất liệu cao cấp, đế chống trơn trượt, mang lại cảm giác êm ái và thoải mái suốt cả ngày.</p><div><br></div>', '<p>\"Giày nam đơn giản, thoải mái - phù hợp cho mọi hoạt động hằng ngày!\"</p><div><br></div>', '<p>✔ Chất liệu bền bỉ, thoáng khí</p><p>✔ Đế cao su chống trơn, bám đường tốt</p><p>✔ Quai dán chắc chắn, dễ điều chỉnh</p><p>✔ Thiết kế thời trang, phù hợp nhiều phong cách</p><p><br></p>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem, chưa qua sử dụng</p><p>Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 25),
(75, 'Sandal đi học cho nam', '590', '520', 340, 'product-featured-75.jpg', '<p>Giày sandal nam thời trang, thiết kế năng động, phù hợp cho cả đi chơi và dạo phố. Chất liệu cao cấp, đế chống trơn trượt, mang lại cảm giác êm ái và thoải mái suốt cả ngày.</p><p><br></p>', '<p>\"Giày nam đơn giản, thoải mái - phù hợp cho mọi hoạt động hằng ngày!\"</p><div><br></div>', '<p>✔ Chất liệu bền bỉ, thoáng khí</p><p>✔ Đế cao su chống trơn, bám đường tốt</p><p>✔ Quai dán chắc chắn, dễ điều chỉnh</p><p>✔ Thiết kế thời trang, phù hợp nhiều phong cách</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi từ nhà sản xuất</p><p>Sản phẩm phải còn nguyên tem, chưa qua sử dụng</p><p>Hỗ trợ đổi size nếu không vừa (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 25),
(76, 'Nón kết nam lưới', '300', '250', 340, 'product-featured-76.jpg', '<p>Nón kết nam phong cách thời trang, thiết kế trẻ trung, chất liệu cao cấp thoáng khí, mang lại cảm giác thoải mái khi đội. Phù hợp cho cả đi chơi, du lịch, thể thao và sử dụng hằng ngày.</p><p><br></p>', '<p>\"Mũ nam thời trang, phong cách - bảo vệ khỏi nắng, hoàn thiện outfit!\"</p><div><br></div>', '<p>✔ Chất liệu: Vải cotton cao cấp, thoáng khí</p><p>✔ Kiểu dáng: Nón lưỡi trai unisex, dễ phối đồ</p><p>✔ Kích thước: Freesize, có dây điều chỉnh phù hợp với nhiều vòng đầu</p><p>✔ Màu sắc: Đa dạng, phù hợp với nhiều phong cách</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu</p><p>✅ Sản phẩm phải còn nguyên tem mác, không qua sử dụng</p><p>✅ Hỗ trợ đổi sang sản phẩm khác hoặc hoàn tiền theo quy định</p><div><br></div>', 0, 0, 1, 1),
(77, 'Nón kết nam nhiều màu', '300', '250', 350, 'product-featured-77.jpg', '<p>Nón kết nam phong cách thời trang, thiết kế trẻ trung, chất liệu cao cấp thoáng khí, mang lại cảm giác thoải mái khi đội. Phù hợp cho cả đi chơi, du lịch, thể thao và sử dụng hằng ngày.</p><div><br></div>', '<p>\"Mũ nam thời trang, phong cách - bảo vệ khỏi nắng, hoàn thiện outfit!\"</p><div><br></div>', '<p>✔ Chất liệu: Vải cotton cao cấp, thoáng khí</p><p>✔ Kiểu dáng: Nón lưỡi trai unisex, dễ phối đồ</p><p>✔ Kích thước: Freesize, có dây điều chỉnh phù hợp với nhiều vòng đầu</p><p>✔ Màu sắc: Đa dạng, phù hợp với nhiều phong cách</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu</p><p>✅ Sản phẩm phải còn nguyên tem mác, không qua sử dụng</p><p>✅ Hỗ trợ đổi sang sản phẩm khác hoặc hoàn tiền theo quy định</p><div><br></div>', 0, 0, 1, 1),
(78, 'Nón kết nam phong cách', '300', '250', 260, 'product-featured-78.jpg', '<p>Nón kết nam phong cách thời trang, thiết kế trẻ trung, chất liệu cao cấp thoáng khí, mang lại cảm giác thoải mái khi đội. Phù hợp cho cả đi chơi, du lịch, thể thao và sử dụng hằng ngày.</p><div><br></div>', '<p>\"Mũ nam thời trang, phong cách - bảo vệ khỏi nắng, hoàn thiện outfit!\"</p><div><br></div>', '<p>✔ Chất liệu: Vải cotton cao cấp, thoáng khí</p><p>✔ Kiểu dáng: Nón lưỡi trai unisex, dễ phối đồ</p><p>✔ Kích thước: Freesize, có dây điều chỉnh phù hợp với nhiều vòng đầu</p><p>✔ Màu sắc: Đa dạng, phù hợp với nhiều phong cách</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất hoặc giao sai mẫu</p><p>✅ Sản phẩm phải còn nguyên tem mác, không qua sử dụng</p><p>✅ Hỗ trợ đổi sang sản phẩm khác hoặc hoàn tiền theo quy định</p><div><br></div>', 0, 0, 1, 1),
(79, 'Thắt lưng da cao cấp', '350', '270', 350, 'product-featured-79.jpg', '<p>Thắt lưng nam cao cấp, thiết kế sang trọng, chất liệu da thật bền bỉ, khóa hợp kim chống gỉ. Phù hợp với mọi phong cách từ công sở đến dạo phố.</p><div><br></div>', '<p>\"Thắt lưng nam thời trang - Thiết kế nam tính, sang trọng, tôn lên phong cách lịch lãm và đẳng cấp!\"</p>', '<p>✅ Chất liệu da thật mềm mại, bền đẹp theo thời gian</p><p>✅ Khóa tự động/bấm tiện lợi, chắc chắn</p><p>✅ Độ dài điều chỉnh linh hoạt, phù hợp nhiều vòng eo</p><p>✅ Phù hợp với nhiều phong cách thời trang</p><p><br></p>', '<p>✔️ Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>✔️ Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng</p><p>✔️ Hỗ trợ đổi size nếu không vừa (chi phí vận chuyển do khách hàng chịu)</p><div><br></div>', 0, 0, 1, 57),
(80, 'Thắt lưng da cao cấp', '350', '270', 340, 'product-featured-80.jpg', '<p>Thắt lưng nam cao cấp, thiết kế sang trọng, chất liệu da thật bền bỉ, khóa hợp kim chống gỉ. Phù hợp với mọi phong cách từ công sở đến dạo phố.</p><p><br></p>', '<p>\"Thắt lưng nam thời trang - Thiết kế nam tính, sang trọng, tôn lên phong cách lịch lãm và đẳng cấp!\"</p>', '<p>✅ Chất liệu da thật mềm mại, bền đẹp theo thời gian</p><p>✅ Khóa tự động/bấm tiện lợi, chắc chắn</p><p>✅ Độ dài điều chỉnh linh hoạt, phù hợp nhiều vòng eo</p><p>✅ Phù hợp với nhiều phong cách thời trang</p><p><br></p>', '<p>✔️ Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>✔️ Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng</p><p>✔️ Hỗ trợ đổi size nếu không vừa (chi phí vận chuyển do khách hàng chịu)</p><div><br></div>', 0, 0, 1, 57),
(81, 'Thắt lưng da cao cấp', '350', '270', 300, 'product-featured-81.jpg', '<p>Thắt lưng nam cao cấp, thiết kế sang trọng, chất liệu da thật bền bỉ, khóa hợp kim chống gỉ. Phù hợp với mọi phong cách từ công sở đến dạo phố.</p><div><br></div>', '<p>\"Thắt lưng nam thời trang - Thiết kế nam tính, sang trọng, tôn lên phong cách lịch lãm và đẳng cấp!\"</p>', '<p>✅ Chất liệu da thật mềm mại, bền đẹp theo thời gian</p><p>✅ Khóa tự động/bấm tiện lợi, chắc chắn</p><p>✅ Độ dài điều chỉnh linh hoạt, phù hợp nhiều vòng eo</p><p>✅ Phù hợp với nhiều phong cách thời trang</p><div><br></div>', '<p>✔️ Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất</p><p>✔️ Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng</p><p>✔️ Hỗ trợ đổi size nếu không vừa (chi phí vận chuyển do khách hàng chịu)</p><div><br></div>', 0, 0, 1, 57),
(82, 'Túi đeo chéo da cao cấp', '720', '650', 350, 'product-featured-82.jpg', '<p>Túi đeo chéo nam phong cách thời trang, thiết kế nhỏ gọn nhưng rộng rãi, phù hợp để đựng điện thoại, ví, chìa khóa và các vật dụng cá nhân. Chất liệu da PU cao cấp (hoặc vải canvas bền đẹp), chống thấm nhẹ, đường may tỉ mỉ, mang lại vẻ nam tính và tiện dụng cho mọi hoàn cảnh.</p><div><br></div>', '<p>\"Túi nam thời trang, tiện lợi - đồng hành cùng bạn mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✅ Thiết kế thời trang, dễ phối đồ</p><p>✅ Chất liệu bền bỉ, chống thấm nước nhẹ</p><p>✅ Ngăn chứa tiện lợi, khóa kéo chắc chắn</p><p>✅ Dây đeo điều chỉnh linh hoạt, phù hợp mọi dáng người</p><div><br></div>', '<p>Hỗ trợ đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với lý do không ưng ý hoặc sử dụng sai cách.</p><div><br></div>', 0, 0, 1, 59),
(83, 'Túi đeo chéo da cao cấp', '720', '650', 260, 'product-featured-83.jpg', '<p>Túi đeo chéo nam phong cách thời trang, thiết kế nhỏ gọn nhưng rộng rãi, phù hợp để đựng điện thoại, ví, chìa khóa và các vật dụng cá nhân. Chất liệu da PU cao cấp (hoặc vải canvas bền đẹp), chống thấm nhẹ, đường may tỉ mỉ, mang lại vẻ nam tính và tiện dụng cho mọi hoàn cảnh.</p><p><br></p>', '<p>\"Túi nam thời trang, tiện lợi - đồng hành cùng bạn mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✅ Thiết kế thời trang, dễ phối đồ</p><p>✅ Chất liệu bền bỉ, chống thấm nước nhẹ</p><p>✅ Ngăn chứa tiện lợi, khóa kéo chắc chắn</p><p>✅ Dây đeo điều chỉnh linh hoạt, phù hợp mọi dáng người</p><div><br></div>', '<p>Hỗ trợ đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với lý do không ưng ý hoặc sử dụng sai cách.</p><div><br></div>', 0, 0, 1, 59),
(84, 'Túi đeo chéo vải chống thấm nước', '720', '650', 250, 'product-featured-84.jpg', '<p>Túi đeo chéo nam phong cách thời trang, thiết kế nhỏ gọn nhưng rộng rãi, phù hợp để đựng điện thoại, ví, chìa khóa và các vật dụng cá nhân. Chất liệu da PU cao cấp (hoặc vải canvas bền đẹp), chống thấm nhẹ, đường may tỉ mỉ, mang lại vẻ nam tính và tiện dụng cho mọi hoàn cảnh.</p><div><br></div>', '<p>&nbsp;\"Túi nam thời trang, tiện lợi - đồng hành cùng bạn mọi lúc, mọi nơi!\"</p><div><br></div>', '<p>✅ Thiết kế thời trang, dễ phối đồ</p><p>✅ Chất liệu bền bỉ, chống thấm nước nhẹ</p><p>✅ Ngăn chứa tiện lợi, khóa kéo chắc chắn</p><p>✅ Dây đeo điều chỉnh linh hoạt, phù hợp mọi dáng người</p><div><br></div>', '<p>Hỗ trợ đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với lý do không ưng ý hoặc sử dụng sai cách.</p><div><br></div>', 0, 0, 1, 59),
(85, 'Quần jeans rách sành điệu', '650', '570', 320, 'product-featured-85.jpg', '<p>Quần jeans nam thời trang, phong cách hiện đại, phù hợp cho mọi hoàn cảnh. Chất liệu denim cao cấp, co giãn nhẹ, tạo cảm giác thoải mái suốt cả ngày. Thiết kế trẻ trung, form dáng chuẩn, dễ dàng phối đồ.</p><p><br></p>', '<p>\"Quần jeans nam bền đẹp, phong cách - thoải mái cho mọi hoạt động!\"</p><div><br></div>', '<p>✔ Chất liệu denim bền đẹp, không xù, không bai dão</p><p>✔ Form dáng chuẩn, tôn dáng nam giới</p><p>✔ Co giãn nhẹ, thoải mái vận động</p><p>✔ Dễ phối với áo thun, sơ mi, giày thể thao</p><p><br></p>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất hoặc sai mẫu, sai size.</p><p>✅ Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng và giữ hóa đơn mua hàng.</p><p>✅ Không áp dụng đổi trả với sản phẩm đã qua sử dụng, giặt tẩy hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 17),
(86, 'Quần jeans nam loang màu đẹp', '650', '570', 250, 'product-featured-86.jpg', '<p>Quần jeans nam thời trang, phong cách hiện đại, phù hợp cho mọi hoàn cảnh. Chất liệu denim cao cấp, co giãn nhẹ, tạo cảm giác thoải mái suốt cả ngày. Thiết kế trẻ trung, form dáng chuẩn, dễ dàng phối đồ.</p><div><br></div>', '<p>\"Quần jeans nam bền đẹp, phong cách - thoải mái cho mọi hoạt động!\"</p><div><br></div>', '<p>✔ Chất liệu denim bền đẹp, không xù, không bai dão</p><p>✔ Form dáng chuẩn, tôn dáng nam giới</p><p>✔ Co giãn nhẹ, thoải mái vận động</p><p>✔ Dễ phối với áo thun, sơ mi, giày thể thao</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất hoặc sai mẫu, sai size.</p><p>✅ Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng và giữ hóa đơn mua hàng.</p><p>✅ Không áp dụng đổi trả với sản phẩm đã qua sử dụng, giặt tẩy hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 17),
(87, 'Quần jeans nâu tây ống rộng', '650', '570', 340, 'product-featured-87.jpg', '<p>Quần jeans nam thời trang, phong cách hiện đại, phù hợp cho mọi hoàn cảnh. Chất liệu denim cao cấp, co giãn nhẹ, tạo cảm giác thoải mái suốt cả ngày. Thiết kế trẻ trung, form dáng chuẩn, dễ dàng phối đồ.</p><div><br></div>', '<p>\"Quần jeans nam bền đẹp, phong cách - thoải mái cho mọi hoạt động!\"</p><div><br></div>', '<p>✔ Chất liệu denim bền đẹp, không xù, không bai dão</p><p>✔ Form dáng chuẩn, tôn dáng nam giới</p><p>✔ Co giãn nhẹ, thoải mái vận động</p><p>✔ Dễ phối với áo thun, sơ mi, giày thể thao</p><div><br></div>', '<p>✅ Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất hoặc sai mẫu, sai size.</p><p>✅ Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng và giữ hóa đơn mua hàng.</p><p>✅ Không áp dụng đổi trả với sản phẩm đã qua sử dụng, giặt tẩy hoặc hư hỏng do người dùng.</p><div><br></div>', 0, 0, 1, 17),
(88, 'Quần jogger nam chât vải gió cao cấp', '550', '480', 300, 'product-featured-88.jpg', '<p>Quần jogger nam thiết kế năng động, chất liệu cao cấp thoáng khí, co giãn tốt, mang lại sự thoải mái tối đa khi vận động. Phù hợp cho tập luyện, dạo phố hoặc mặc nhà.</p><div><br></div>', '<p>\"Quần jogger nam năng động, thoải mái - hoàn hảo cho tập luyện và dạo phố!\"</p><div><br></div>', '<p>✔ Chất vải mềm mại, co giãn 4 chiều</p><p>✔ Cạp chun linh hoạt, ôm vừa vặn</p><p>✔ Kiểu dáng hiện đại, dễ phối đồ</p><p>✔ Túi tiện lợi, có khóa kéo an toàn</p><div><br></div>', '<p>🔄 Đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc không đúng mô tả</p><p>📦 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>🚚 Hỗ trợ đổi size miễn phí (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 18),
(89, 'Quần Jogger nam kaki', '550', '480', 340, 'product-featured-89.jpg', '<p>Quần jogger nam thiết kế năng động, chất liệu cao cấp thoáng khí, co giãn tốt, mang lại sự thoải mái tối đa khi vận động. Phù hợp cho tập luyện, dạo phố hoặc mặc nhà.</p><div><br></div>', '<p>\"Quần jogger nam năng động, thoải mái - hoàn hảo cho tập luyện và dạo phố!\"</p><div><br></div>', '<p>✔ Chất vải mềm mại, co giãn 4 chiều</p><p>✔ Cạp chun linh hoạt, ôm vừa vặn</p><p>✔ Kiểu dáng hiện đại, dễ phối đồ</p><p>✔ Túi tiện lợi, có khóa kéo an toàn</p><div><br></div>', '<p>🔄 Đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc không đúng mô tả</p><p>📦 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>🚚 Hỗ trợ đổi size miễn phí (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 18),
(90, 'Quần jogger nam chât vải gió cao cấp', '550', '480', 240, 'product-featured-90.jpg', '<p>Quần jogger nam thiết kế năng động, chất liệu cao cấp thoáng khí, co giãn tốt, mang lại sự thoải mái tối đa khi vận động. Phù hợp cho tập luyện, dạo phố hoặc mặc nhà.</p><div><br></div>', '<p>\"Quần jogger nam năng động, thoải mái - hoàn hảo cho tập luyện và dạo phố!\"</p><div><br></div>', '<p>✔ Chất vải mềm mại, co giãn 4 chiều</p><p>✔ Cạp chun linh hoạt, ôm vừa vặn</p><p>✔ Kiểu dáng hiện đại, dễ phối đồ</p><p>✔ Túi tiện lợi, có khóa kéo an toàn</p><div><br></div>', '<p>🔄 Đổi trả trong 7 ngày nếu sản phẩm lỗi hoặc không đúng mô tả</p><p>📦 Sản phẩm phải còn nguyên tem mác, chưa qua sử dụng</p><p>🚚 Hỗ trợ đổi size miễn phí (khách chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 18),
(91, 'Quần short thun thoải mái', '420', '350', 320, 'product-featured-91.jpg', '<p>Quần short nam phong cách thời trang, chất liệu cao cấp, thoáng mát, phù hợp cho cả hoạt động thường ngày và thể thao. Thiết kế năng động, dễ phối đồ, mang lại sự thoải mái tối đa.</p><p><br></p>', '<p>\"Quần short nam thoáng mát, thoải mái - lựa chọn hoàn hảo cho ngày hè!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/jeans/khaki bền đẹp, thấm hút tốt</p><p>✔ Form dáng trẻ trung, dễ kết hợp với áo thun, polo</p><p>✔ Co giãn nhẹ, tạo cảm giác thoải mái khi vận động</p><p>✔ Đường may chắc chắn, bền bỉ theo thời gian</p><div><br></div>', '<p>✅ Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất</p><p>✅ Sản phẩm phải còn nguyên tem, nhãn mác, chưa qua sử dụng</p><p>✅ Hỗ trợ đổi size nếu không vừa (khách hàng chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 19),
(92, 'Quần short thun thoải mái', '420', '350', 200, 'product-featured-92.jpg', '<p>Quần short nam phong cách thời trang, chất liệu cao cấp, thoáng mát, phù hợp cho cả hoạt động thường ngày và thể thao. Thiết kế năng động, dễ phối đồ, mang lại sự thoải mái tối đa.</p><div><br></div>', '<p>\"Quần short nam thoáng mát, thoải mái - lựa chọn hoàn hảo cho ngày hè!\"</p><div><br></div>', '<p>✔ Chất liệu cotton/jeans/khaki bền đẹp, thấm hút tốt</p><p>✔ Form dáng trẻ trung, dễ kết hợp với áo thun, polo</p><p>✔ Co giãn nhẹ, tạo cảm giác thoải mái khi vận động</p><p>✔ Đường may chắc chắn, bền bỉ theo thời gian</p><div><br></div>', '<p>✅ Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất</p><p>✅ Sản phẩm phải còn nguyên tem, nhãn mác, chưa qua sử dụng</p><p>✅ Hỗ trợ đổi size nếu không vừa (khách hàng chịu phí vận chuyển)</p><div><br></div>', 0, 0, 1, 19),
(93, 'Quần jeans short nam ', '420', '350', 350, 'product-featured-93.jpg', '<p>Quần short nam phong cách thời trang, chất liệu cao cấp, thoáng mát, phù hợp cho cả hoạt động thường ngày và thể thao. Thiết kế năng động, dễ phối đồ, mang lại sự thoải mái tối đa.</p><div><br></div>', '<p>\"Quần short nam thoáng mát, thoải mái - lựa chọn hoàn hảo cho ngày hè!\"</p>', '<p>✔ Chất liệu cotton/jeans/khaki bền đẹp, thấm hút tốt</p><p>✔ Form dáng trẻ trung, dễ kết hợp với áo thun, polo</p><p>✔ Co giãn nhẹ, tạo cảm giác thoải mái khi vận động</p><p>✔ Đường may chắc chắn, bền bỉ theo thời gian</p><div><br></div>', '<p>✅ Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất</p><p>✅ Sản phẩm phải còn nguyên tem, nhãn mác, chưa qua sử dụng</p><p>✅ Hỗ trợ đổi size nếu không vừa (khách hàng chịu phí vận chuyển)</p><div><br></div>', 0, 1, 1, 19),
(94, 'Dép Hello Kitty', '290', '230', 300, 'product-featured-94.jpg', '<p>Dép nữ thời trang, thiết kế thanh lịch và thoải mái, phù hợp cho mọi phong cách. Chất liệu cao cấp, bền đẹp, mang đến cảm giác êm ái khi sử dụng. Dễ dàng phối hợp với nhiều trang phục, thích hợp cho đi chơi, dạo phố hay sử dụng hàng ngày.</p><p><br></p>', '<p>\"Dép nữ thời trang, êm ái - thoải mái bước đi mỗi ngày!\"</p>', '<p>✔ Chất liệu: [Cao su mềm/Da tổng hợp/Vải cao cấp]</p><p>✔ Kiểu dáng: [Dép bệt/Dép quai hậu/Dép xỏ ngón]</p><p>✔ Đế chống trơn trượt, êm ái, không gây đau chân</p><p>✔ Nhiều màu sắc thời trang, dễ dàng phối đồ</p><div><br></div>', '<p>Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><p>Khách hàng chịu phí vận chuyển khi đổi trả nếu không phải lỗi từ nhà sản xuất.</p><div><br></div>', 0, 0, 1, 12),
(95, 'Dép quai ngang nữ', '290', '230', 320, 'product-featured-95.jpg', '<p>Dép nữ thời trang, thiết kế thanh lịch và thoải mái, phù hợp cho mọi phong cách. Chất liệu cao cấp, bền đẹp, mang đến cảm giác êm ái khi sử dụng. Dễ dàng phối hợp với nhiều trang phục, thích hợp cho đi chơi, dạo phố hay sử dụng hàng ngày.</p><div><br></div>', '<p>\"Dép nữ thời trang, êm ái - thoải mái bước đi mỗi ngày!\"</p><div><br></div>', '<p>✔ Chất liệu: [Cao su mềm/Da tổng hợp/Vải cao cấp]</p><p>✔ Kiểu dáng: [Dép bệt/Dép quai hậu/Dép xỏ ngón]</p><p>✔ Đế chống trơn trượt, êm ái, không gây đau chân</p><p>✔ Nhiều màu sắc thời trang, dễ dàng phối đồ</p><div><br></div>', '<p>Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><p>Khách hàng chịu phí vận chuyển khi đổi trả nếu không phải lỗi từ nhà sản xuất.</p><div><br></div>', 0, 0, 1, 12),
(96, 'Dép quai ngang nữ', '290', '230', 340, 'product-featured-96.jpg', '<p>Dép nữ thời trang, thiết kế thanh lịch và thoải mái, phù hợp cho mọi phong cách. Chất liệu cao cấp, bền đẹp, mang đến cảm giác êm ái khi sử dụng. Dễ dàng phối hợp với nhiều trang phục, thích hợp cho đi chơi, dạo phố hay sử dụng hàng ngày.</p><div><br></div>', '<p>\"Dép nữ thời trang, êm ái - thoải mái bước đi mỗi ngày!\"</p>', '<p>✔ Chất liệu: [Cao su mềm/Da tổng hợp/Vải cao cấp]</p><p>✔ Kiểu dáng: [Dép bệt/Dép quai hậu/Dép xỏ ngón]</p><p>✔ Đế chống trơn trượt, êm ái, không gây đau chân</p><p>✔ Nhiều màu sắc thời trang, dễ dàng phối đồ</p><div><br></div>', '<p>Đổi trả trong vòng 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng.</p><p>Không áp dụng đổi trả với sản phẩm đã qua sử dụng hoặc hư hỏng do người dùng.</p><p>Khách hàng chịu phí vận chuyển khi đổi trả nếu không phải lỗi từ nhà sản xuất.</p><div><br></div>', 0, 0, 1, 12),
(97, 'Giày cao gót đơn giản, cổ điển', '820', '750', 340, 'product-featured-97.jpg', '<p>Giày cao gót nữ thanh lịch, tôn dáng và phù hợp cho mọi dịp – từ công sở đến dạ tiệc. Thiết kế tinh tế, chất liệu bền đẹp, mang lại cảm giác thoải mái và tự tin khi sải bước.</p><div><br></div>', '<p>\"Giày cao gót thanh lịch, tôn dáng - bước đi tự tin, cuốn hút mọi ánh nhìn!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp theo thời gian.</p><p>Thiết kế thời trang: Đa dạng kiểu dáng, màu sắc sang trọng, dễ phối đồ.</p><p>Chiều cao gót: Từ 3cm - 10cm, phù hợp với nhu cầu sử dụng.</p><p>Đế chống trượt: An toàn, chắc chắn khi di chuyển.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 50),
(98, 'Giày cao gót đi tiệc lấp lánh', '820', '750', 340, 'product-featured-98.jpg', '<p>Giày cao gót nữ thanh lịch, tôn dáng và phù hợp cho mọi dịp – từ công sở đến dạ tiệc. Thiết kế tinh tế, chất liệu bền đẹp, mang lại cảm giác thoải mái và tự tin khi sải bước.</p><div><br></div>', '<p>\"Giày cao gót thanh lịch, tôn dáng - bước đi tự tin, cuốn hút mọi ánh nhìn!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp theo thời gian.</p><p>Thiết kế thời trang: Đa dạng kiểu dáng, màu sắc sang trọng, dễ phối đồ.</p><p>Chiều cao gót: Từ 3cm - 10cm, phù hợp với nhu cầu sử dụng.</p><p>Đế chống trượt: An toàn, chắc chắn khi di chuyển.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 50),
(99, 'Giày cao gót đi tiệc bóng loáng', '820', '750', 350, 'product-featured-99.jpg', '<p>Giày cao gót nữ thanh lịch, tôn dáng và phù hợp cho mọi dịp – từ công sở đến dạ tiệc. Thiết kế tinh tế, chất liệu bền đẹp, mang lại cảm giác thoải mái và tự tin khi sải bước.</p><div><br></div>', '<p>&nbsp;\"Giày cao gót thanh lịch, tôn dáng - bước đi tự tin, cuốn hút mọi ánh nhìn!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp theo thời gian.</p><p>Thiết kế thời trang: Đa dạng kiểu dáng, màu sắc sang trọng, dễ phối đồ.</p><p>Chiều cao gót: Từ 3cm - 10cm, phù hợp với nhu cầu sử dụng.</p><p>Đế chống trượt: An toàn, chắc chắn khi di chuyển.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 50),
(100, 'Sandal nữ đi học', '750', '680', 300, 'product-featured-100.jpg', '<p>Giày quai hậu nữ thanh lịch, nhẹ nhàng và tiện lợi, phù hợp cho cả đi làm, dạo phố hay dự tiệc. Thiết kế tinh tế với quai hậu cố định giúp ôm chân chắc chắn, mang lại cảm giác thoải mái và tự tin khi di chuyển.</p><div><br></div>', '<p>\"Giày quai hậu thanh lịch, thoải mái - tôn lên vẻ duyên dáng cho mọi bước chân!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp, thoáng khí.</p><p>Thiết kế sang trọng: Quai hậu cố định, giúp bước đi chắc chắn, không lo tuột.</p><p>Chiều cao gót đa dạng: Từ 3cm - 7cm, phù hợp với mọi nhu cầu.</p><p>Đế chống trượt: An toàn, tạo độ bám tốt trên nhiều bề mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 54),
(101, 'Sandal nữ đi chơi', '750', '680', 200, 'product-featured-101.jpg', '<p>Giày quai hậu nữ thanh lịch, nhẹ nhàng và tiện lợi, phù hợp cho cả đi làm, dạo phố hay dự tiệc. Thiết kế tinh tế với quai hậu cố định giúp ôm chân chắc chắn, mang lại cảm giác thoải mái và tự tin khi di chuyển.</p><div><br></div>', '<p>\"Giày quai hậu thanh lịch, thoải mái - tôn lên vẻ duyên dáng cho mọi bước chân!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp, thoáng khí.</p><p>Thiết kế sang trọng: Quai hậu cố định, giúp bước đi chắc chắn, không lo tuột.</p><p>Chiều cao gót đa dạng: Từ 3cm - 7cm, phù hợp với mọi nhu cầu.</p><p>Đế chống trượt: An toàn, tạo độ bám tốt trên nhiều bề mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 54),
(102, 'Sandal nữ đi chơi', '750', '680', 340, 'product-featured-102.jpg', '<p>Giày quai hậu nữ thanh lịch, nhẹ nhàng và tiện lợi, phù hợp cho cả đi làm, dạo phố hay dự tiệc. Thiết kế tinh tế với quai hậu cố định giúp ôm chân chắc chắn, mang lại cảm giác thoải mái và tự tin khi di chuyển.</p><div><br></div>', '<p>\"Giày quai hậu thanh lịch, thoải mái - tôn lên vẻ duyên dáng cho mọi bước chân!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Da tổng hợp/mềm mại, bền đẹp, thoáng khí.</p><p>Thiết kế sang trọng: Quai hậu cố định, giúp bước đi chắc chắn, không lo tuột.</p><p>Chiều cao gót đa dạng: Từ 3cm - 7cm, phù hợp với mọi nhu cầu.</p><p>Đế chống trượt: An toàn, tạo độ bám tốt trên nhiều bề mặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 54),
(103, 'Dép crocs nhựa nữ', '520', '450', 320, 'product-featured-103.jpg', '<p>Ủng Crocs nữ nhẹ nhàng, tiện lợi, phù hợp cho mọi hoạt động ngoài trời. Thiết kế chống nước, thoáng khí giúp đôi chân luôn khô ráo và thoải mái cả ngày dài.</p><div><br></div>', '<p>\"Ủng nữ chống trơn, bền đẹp - bảo vệ đôi chân trong mọi điều kiện thời tiết!\"</p><div><br></div>', '<p>Chất liệu Croslite™: Nhẹ, bền, dễ vệ sinh.</p><p>Chống thấm nước: Hoàn hảo cho ngày mưa hay môi trường ẩm ướt.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Kiểu dáng năng động: Phù hợp cho đi chơi, du lịch, làm vườn…</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hộp đựng.</p><p>Không áp dụng đổi trả cho sản phẩm giảm giá hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 53),
(104, 'Dép crocs nhựa nữ', '520', '450', 350, 'product-featured-104.jpg', '<p>Ủng Crocs nữ nhẹ nhàng, tiện lợi, phù hợp cho mọi hoạt động ngoài trời. Thiết kế chống nước, thoáng khí giúp đôi chân luôn khô ráo và thoải mái cả ngày dài.</p><div><br></div>', '<p>\"Ủng nữ chống trơn, bền đẹp - bảo vệ đôi chân trong mọi điều kiện thời tiết!\"</p><div><br></div>', '<p>Chất liệu Croslite™: Nhẹ, bền, dễ vệ sinh.</p><p>Chống thấm nước: Hoàn hảo cho ngày mưa hay môi trường ẩm ướt.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Kiểu dáng năng động: Phù hợp cho đi chơi, du lịch, làm vườn…</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hộp đựng.</p><p>Không áp dụng đổi trả cho sản phẩm giảm giá hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 53),
(105, 'Dép crocs nhựa nữ', '520', '450', 340, 'product-featured-105.jpg', '<p>Ủng Crocs nữ nhẹ nhàng, tiện lợi, phù hợp cho mọi hoạt động ngoài trời. Thiết kế chống nước, thoáng khí giúp đôi chân luôn khô ráo và thoải mái cả ngày dài.</p><p><br></p>', '<p>\"Ủng nữ chống trơn, bền đẹp - bảo vệ đôi chân trong mọi điều kiện thời tiết!\"</p><div><br></div>', '<p>Chất liệu Croslite™: Nhẹ, bền, dễ vệ sinh.</p><p>Chống thấm nước: Hoàn hảo cho ngày mưa hay môi trường ẩm ướt.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Kiểu dáng năng động: Phù hợp cho đi chơi, du lịch, làm vườn…</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hộp đựng.</p><p>Không áp dụng đổi trả cho sản phẩm giảm giá hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 53),
(106, 'Hoodie Zip Thêu', '590', '520', 350, 'product-featured-106.jpg', '<p>Áo hoodie nữ phong cách trẻ trung, năng động, phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, giữ ấm tốt, mang lại cảm giác thoải mái và dễ chịu khi mặc.</p><div><br></div>', '<p>\"Áo hoodie nữ mềm mại, ấm áp - phong cách trẻ trung, năng động!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton/ nỉ dày dặn, co giãn tốt, thoáng khí.</p><p>Kiểu dáng thời trang: Form rộng, dễ phối đồ, phù hợp với nhiều phong cách.</p><p>Thiết kế tiện lợi: Có nón, túi trước, bo gấu giúp giữ ấm tốt hơn.</p><p>Màu sắc đa dạng: Dễ dàng lựa chọn theo sở thích cá nhân.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 1, 1, 14),
(107, 'Hoodie Zip Thêu', '590', '520', 300, 'product-featured-107.jpg', '<p>Áo hoodie nữ phong cách trẻ trung, năng động, phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, giữ ấm tốt, mang lại cảm giác thoải mái và dễ chịu khi mặc.</p><div><br></div>', '<p>&nbsp;\"Áo hoodie nữ mềm mại, ấm áp - phong cách trẻ trung, năng động!\"</p>', '<p>Chất liệu cao cấp: Cotton/ nỉ dày dặn, co giãn tốt, thoáng khí.</p><p>Kiểu dáng thời trang: Form rộng, dễ phối đồ, phù hợp với nhiều phong cách.</p><p>Thiết kế tiện lợi: Có nón, túi trước, bo gấu giúp giữ ấm tốt hơn.</p><p>Màu sắc đa dạng: Dễ dàng lựa chọn theo sở thích cá nhân.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 14);
INSERT INTO `table_product` (`p_id`, `p_name`, `p_old_price`, `p_current_price`, `p_qty`, `p_featured_photo`, `p_description`, `p_short_description`, `p_feature`, `p_return_policy`, `p_total_order`, `p_is_featured`, `p_is_active`, `ecat_id`) VALUES
(108, 'Hoodie Zip Thêu', '590', '520', 350, 'product-featured-108.jpg', '<p>Áo hoodie nữ phong cách trẻ trung, năng động, phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, giữ ấm tốt, mang lại cảm giác thoải mái và dễ chịu khi mặc.</p><p><br></p>', '<p>\"Áo hoodie nữ mềm mại, ấm áp - phong cách trẻ trung, năng động!\"</p>', '<p>Chất liệu cao cấp: Cotton/ nỉ dày dặn, co giãn tốt, thoáng khí.</p><p>Kiểu dáng thời trang: Form rộng, dễ phối đồ, phù hợp với nhiều phong cách.</p><p>Thiết kế tiện lợi: Có nón, túi trước, bo gấu giúp giữ ấm tốt hơn.</p><p>Màu sắc đa dạng: Dễ dàng lựa chọn theo sở thích cá nhân.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 14),
(109, 'Đầm dài', '820', '750', 340, 'product-featured-109.jpg', '<p>Đầm nữ thanh lịch, tôn dáng, phù hợp cho nhiều dịp như đi làm, dạo phố hay dự tiệc. Chất liệu cao cấp, thoáng mát, mang đến sự thoải mái và tự tin cho người mặc.</p><div><br></div>', '<p>\"Đầm nữ duyên dáng, thanh lịch - tôn lên vẻ đẹp quyến rũ, sang trọng!\"</p><div><br></div>', '<p>Chất liệu mềm mại: Vải cao cấp, thấm hút tốt, tạo cảm giác dễ chịu.</p><p>Thiết kế hiện đại: Đa dạng kiểu dáng từ ôm body, suông đến xòe nữ tính.</p><p>Màu sắc thanh lịch: Dễ dàng phối đồ, phù hợp nhiều phong cách.</p><p>Đường may tinh tế: Tôn dáng, bền đẹp theo thời gian.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, hóa đơn và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 32),
(110, 'Đầm xòe trễ vai', '820', '750', 250, 'product-featured-110.jpg', '<p>Đầm nữ thanh lịch, tôn dáng, phù hợp cho nhiều dịp như đi làm, dạo phố hay dự tiệc. Chất liệu cao cấp, thoáng mát, mang đến sự thoải mái và tự tin cho người mặc.</p><div><br></div>', '<p>&nbsp;\"Đầm nữ duyên dáng, thanh lịch - tôn lên vẻ đẹp quyến rũ, sang trọng!\"</p><div><br></div>', '<p>Chất liệu mềm mại: Vải cao cấp, thấm hút tốt, tạo cảm giác dễ chịu.</p><p>Thiết kế hiện đại: Đa dạng kiểu dáng từ ôm body, suông đến xòe nữ tính.</p><p>Màu sắc thanh lịch: Dễ dàng phối đồ, phù hợp nhiều phong cách.</p><p>Đường may tinh tế: Tôn dáng, bền đẹp theo thời gian.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, hóa đơn và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 32),
(111, 'Đầm dự tiệc cưới, hỏi,...', '820', '750', 300, 'product-featured-111.jpg', '<p>Đầm nữ thanh lịch, tôn dáng, phù hợp cho nhiều dịp như đi làm, dạo phố hay dự tiệc. Chất liệu cao cấp, thoáng mát, mang đến sự thoải mái và tự tin cho người mặc.</p><div><br></div>', '<p>\"Đầm nữ duyên dáng, thanh lịch - tôn lên vẻ đẹp quyến rũ, sang trọng!\"</p><div><br></div>', '<p>Chất liệu mềm mại: Vải cao cấp, thấm hút tốt, tạo cảm giác dễ chịu.</p><p>Thiết kế hiện đại: Đa dạng kiểu dáng từ ôm body, suông đến xòe nữ tính.</p><p>Màu sắc thanh lịch: Dễ dàng phối đồ, phù hợp nhiều phong cách.</p><p>Đường may tinh tế: Tôn dáng, bền đẹp theo thời gian.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, hóa đơn và bao bì.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 32),
(112, 'Quần jeans ống rộng nữ', '650', '570', 350, 'product-featured-112.jpg', '<p>Quần jeans nữ thời trang, thiết kế trẻ trung, tôn dáng và dễ phối đồ. Chất liệu denim cao cấp mang lại cảm giác thoải mái, phù hợp cho mọi hoạt động hàng ngày.</p><div><br></div>', '<p>\"Quần jeans nữ thời trang, tôn dáng - thoải mái, phù hợp mọi phong cách!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: Denim co giãn nhẹ, thoáng khí, giữ form tốt.</p><p>Kiểu dáng đa dạng: Skinny, ống rộng, baggy… phù hợp với nhiều phong cách.</p><p>Màu sắc thời thượng: Xanh denim, đen, trắng, dễ kết hợp trang phục.</p><p>Dễ dàng bảo quản: Giặt máy thoải mái, không xù lông, không phai màu.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, nhãn mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 16),
(113, 'Quần jeans ống rộng nữ', '650', '570', 300, 'product-featured-113.jpg', '<p>Quần jeans nữ thời trang, thiết kế trẻ trung, tôn dáng và dễ phối đồ. Chất liệu denim cao cấp mang lại cảm giác thoải mái, phù hợp cho mọi hoạt động hàng ngày.</p><div><br></div>', '<p>\"Quần jeans nữ thời trang, tôn dáng - thoải mái, phù hợp mọi phong cách!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: Denim co giãn nhẹ, thoáng khí, giữ form tốt.</p><p>Kiểu dáng đa dạng: Skinny, ống rộng, baggy… phù hợp với nhiều phong cách.</p><p>Màu sắc thời thượng: Xanh denim, đen, trắng, dễ kết hợp trang phục.</p><p>Dễ dàng bảo quản: Giặt máy thoải mái, không xù lông, không phai màu.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, nhãn mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 1, 1, 16),
(114, 'Quần jeans ống rộng nữ', '650', '570', 340, 'product-featured-114.jpg', '<p>Quần jeans nữ thời trang, thiết kế trẻ trung, tôn dáng và dễ phối đồ. Chất liệu denim cao cấp mang lại cảm giác thoải mái, phù hợp cho mọi hoạt động hàng ngày.</p><div><br></div>', '<p>\"Quần jeans nữ thời trang, tôn dáng - thoải mái, phù hợp mọi phong cách!\"</p><div><br></div>', '<p>Chất liệu bền đẹp: Denim co giãn nhẹ, thoáng khí, giữ form tốt.</p><p>Kiểu dáng đa dạng: Skinny, ống rộng, baggy… phù hợp với nhiều phong cách.</p><p>Màu sắc thời thượng: Xanh denim, đen, trắng, dễ kết hợp trang phục.</p><p>Dễ dàng bảo quản: Giặt máy thoải mái, không xù lông, không phai màu.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tag, nhãn mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 16),
(115, 'Mặt nạ dưỡng ẩm', '550', '480', 340, 'product-featured-115.jpg', '<p>Bộ sản phẩm chăm sóc da nữ giúp nuôi dưỡng làn da khỏe mạnh, rạng rỡ. Công thức dịu nhẹ, an toàn, phù hợp với nhiều loại da, cung cấp độ ẩm và dưỡng chất cần thiết cho làn da mềm mịn, tươi trẻ.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc da dịu nhẹ, nuôi dưỡng sâu - cho làn da khỏe đẹp rạng rỡ!\"</p><div><br></div>', '<p>Thành phần an toàn: Chiết xuất thiên nhiên, không chứa hóa chất độc hại.</p><p>Dưỡng ẩm &amp; tái tạo da: Cung cấp độ ẩm, giúp da mịn màng, căng bóng.</p><p>Phù hợp nhiều loại da: Da dầu, da khô, da nhạy cảm,…</p><p>Hấp thụ nhanh: Không gây bết dính, dễ dàng thẩm thấu vào da.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải chưa qua sử dụng, còn nguyên tem niêm phong và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 40),
(116, 'Mặt nạ BNBG', '550', '480', 320, 'product-featured-116.jpg', '<p>Bộ sản phẩm chăm sóc da nữ giúp nuôi dưỡng làn da khỏe mạnh, rạng rỡ. Công thức dịu nhẹ, an toàn, phù hợp với nhiều loại da, cung cấp độ ẩm và dưỡng chất cần thiết cho làn da mềm mịn, tươi trẻ.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc da dịu nhẹ, nuôi dưỡng sâu - cho làn da khỏe đẹp rạng rỡ!\"</p><div><br></div>', '<p>Thành phần an toàn: Chiết xuất thiên nhiên, không chứa hóa chất độc hại.</p><p>Dưỡng ẩm &amp; tái tạo da: Cung cấp độ ẩm, giúp da mịn màng, căng bóng.</p><p>Phù hợp nhiều loại da: Da dầu, da khô, da nhạy cảm,…</p><p>Hấp thụ nhanh: Không gây bết dính, dễ dàng thẩm thấu vào da.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải chưa qua sử dụng, còn nguyên tem niêm phong và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 40),
(117, 'Mặt nạ thạch Luvum', '550', '480', 340, 'product-featured-117.jpg', '<p>Bộ sản phẩm chăm sóc da nữ giúp nuôi dưỡng làn da khỏe mạnh, rạng rỡ. Công thức dịu nhẹ, an toàn, phù hợp với nhiều loại da, cung cấp độ ẩm và dưỡng chất cần thiết cho làn da mềm mịn, tươi trẻ.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc da dịu nhẹ, nuôi dưỡng sâu - cho làn da khỏe đẹp rạng rỡ!\"</p><div><br></div>', '<p>Thành phần an toàn: Chiết xuất thiên nhiên, không chứa hóa chất độc hại.</p><p>Dưỡng ẩm &amp; tái tạo da: Cung cấp độ ẩm, giúp da mịn màng, căng bóng.</p><p>Phù hợp nhiều loại da: Da dầu, da khô, da nhạy cảm,…</p><p>Hấp thụ nhanh: Không gây bết dính, dễ dàng thẩm thấu vào da.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm đổi trả phải chưa qua sử dụng, còn nguyên tem niêm phong và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 40),
(118, 'Nước dưỡng tóc tinh dầu bưởi', '490', '420', 340, 'product-featured-118.jpg', '<p>Bộ sản phẩm chăm sóc tóc nữ giúp nuôi dưỡng tóc chắc khỏe, mềm mượt và bồng bềnh. Công thức dịu nhẹ, phù hợp với mọi loại tóc, giúp phục hồi hư tổn và mang lại mái tóc suôn mượt tự nhiên.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc tóc chuyên sâu - nuôi dưỡng mái tóc suôn mượt, chắc khỏe!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Dưỡng chất từ dầu argan, keratin, collagen,...</p><p>Phù hợp mọi loại tóc: Tóc khô, dầu, hư tổn, nhuộm, uốn.</p><p>Cấp ẩm &amp; phục hồi: Giúp tóc mềm mượt, chắc khỏe từ gốc đến ngọn.</p><p>Không chứa hóa chất gây hại: Không sulfate, paraben, an toàn khi sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm chưa qua sử dụng, còn nguyên tem, bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 41),
(119, 'Nước dưỡng tóc Double Rich', '490', '420', 300, 'product-featured-119.jpg', '<p>Bộ sản phẩm chăm sóc tóc nữ giúp nuôi dưỡng tóc chắc khỏe, mềm mượt và bồng bềnh. Công thức dịu nhẹ, phù hợp với mọi loại tóc, giúp phục hồi hư tổn và mang lại mái tóc suôn mượt tự nhiên.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc tóc chuyên sâu - nuôi dưỡng mái tóc suôn mượt, chắc khỏe!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Dưỡng chất từ dầu argan, keratin, collagen,...</p><p>Phù hợp mọi loại tóc: Tóc khô, dầu, hư tổn, nhuộm, uốn.</p><p>Cấp ẩm &amp; phục hồi: Giúp tóc mềm mượt, chắc khỏe từ gốc đến ngọn.</p><p>Không chứa hóa chất gây hại: Không sulfate, paraben, an toàn khi sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm chưa qua sử dụng, còn nguyên tem, bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 41),
(120, 'Dầu dưỡng tóc', '490', '420', 340, 'product-featured-120.jpg', '<p>Bộ sản phẩm chăm sóc tóc nữ giúp nuôi dưỡng tóc chắc khỏe, mềm mượt và bồng bềnh. Công thức dịu nhẹ, phù hợp với mọi loại tóc, giúp phục hồi hư tổn và mang lại mái tóc suôn mượt tự nhiên.</p><div><br></div>', '<p>\"Sản phẩm chăm sóc tóc chuyên sâu - nuôi dưỡng mái tóc suôn mượt, chắc khỏe!\"</p><div><br></div>', '<p>Thành phần tự nhiên: Dưỡng chất từ dầu argan, keratin, collagen,...</p><p>Phù hợp mọi loại tóc: Tóc khô, dầu, hư tổn, nhuộm, uốn.</p><p>Cấp ẩm &amp; phục hồi: Giúp tóc mềm mượt, chắc khỏe từ gốc đến ngọn.</p><p>Không chứa hóa chất gây hại: Không sulfate, paraben, an toàn khi sử dụng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm chưa qua sử dụng, còn nguyên tem, bao bì và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 41),
(121, 'Nước hoa nữ ngọt ngào', '820', '750', 250, 'product-featured-121.jpg', '<p>Nước hoa nữ cao cấp với hương thơm quyến rũ, thanh lịch và bền lâu, giúp bạn tự tin tỏa sáng trong mọi khoảnh khắc. Thích hợp cho công sở, hẹn hò hay những buổi tiệc sang trọng.</p><div><br></div>', '<p>\"Nước hoa quyến rũ, lưu hương lâu - khẳng định phong cách riêng của bạn!\"</p><div><br></div>', '<p>Hương thơm đa dạng: Từ ngọt ngào, tươi mát đến sang trọng, quyến rũ.</p><p>Lưu hương lâu: Giữ mùi từ 6 - 12 giờ tùy dòng nước hoa.</p><p>Dung tích linh hoạt: Có nhiều lựa chọn phù hợp với nhu cầu.</p><p>Thương hiệu uy tín: Cam kết chính hãng, đảm bảo chất lượng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng, đầy đủ hộp và tem niêm phong.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 39),
(122, 'Lilith and Eve Black Opium Eau de Perfume', '820', '750', 300, 'product-featured-122.jpg', '<p>Nước hoa nữ cao cấp với hương thơm quyến rũ, thanh lịch và bền lâu, giúp bạn tự tin tỏa sáng trong mọi khoảnh khắc. Thích hợp cho công sở, hẹn hò hay những buổi tiệc sang trọng.</p><p><br></p>', '<p>\"Nước hoa quyến rũ, lưu hương lâu - khẳng định phong cách riêng của bạn!\"</p><div><br></div>', '<p>Hương thơm đa dạng: Từ ngọt ngào, tươi mát đến sang trọng, quyến rũ.</p><p>Lưu hương lâu: Giữ mùi từ 6 - 12 giờ tùy dòng nước hoa.</p><p>Dung tích linh hoạt: Có nhiều lựa chọn phù hợp với nhu cầu.</p><p>Thương hiệu uy tín: Cam kết chính hãng, đảm bảo chất lượng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng, đầy đủ hộp và tem niêm phong.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 39),
(123, 'Nước hoa nữ ngọt ngào', '820', '750', 320, 'product-featured-123.jpg', '<p>Nước hoa nữ cao cấp với hương thơm quyến rũ, thanh lịch và bền lâu, giúp bạn tự tin tỏa sáng trong mọi khoảnh khắc. Thích hợp cho công sở, hẹn hò hay những buổi tiệc sang trọng.</p><div><br></div>', '<p>\"Nước hoa quyến rũ, lưu hương lâu - khẳng định phong cách riêng của bạn!\"</p><div><br></div>', '<p>Hương thơm đa dạng: Từ ngọt ngào, tươi mát đến sang trọng, quyến rũ.</p><p>Lưu hương lâu: Giữ mùi từ 6 - 12 giờ tùy dòng nước hoa.</p><p>Dung tích linh hoạt: Có nhiều lựa chọn phù hợp với nhu cầu.</p><p>Thương hiệu uy tín: Cam kết chính hãng, đảm bảo chất lượng.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng, đầy đủ hộp và tem niêm phong.</p><p>Không áp dụng đổi trả với sản phẩm đã mở nắp hoặc dùng thử.</p><div><br></div>', 0, 0, 1, 39),
(124, 'Ủng đi mưa bé gái', '420', '350', 340, 'product-featured-124.jpg', '<p>Giày bé gái dễ thương, thoải mái và an toàn cho bé khi vận động. Thiết kế đa dạng, phù hợp cho đi học, đi chơi hay dự tiệc. Chất liệu mềm mại, nâng niu từng bước chân.</p><div><br></div>', '<p>\"Giày bé gái đáng yêu, êm ái - nâng niu từng bước chân của bé!\"</p>', '<p>Chất liệu an toàn: Vải/da mềm, thoáng khí, không gây kích ứng da.</p><p>Thiết kế đáng yêu: Màu sắc tươi sáng, họa tiết xinh xắn, phù hợp với nhiều độ tuổi.</p><p>Đế chống trượt: Giúp bé di chuyển an toàn, hạn chế trơn trượt.</p><p>Dễ mang, dễ tháo: Quai dán hoặc chun co giãn tiện lợi cho bé.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 29),
(125, 'Giày búp bê bé gái', '420', '350', 350, 'product-featured-125.jpg', '<p>Giày bé gái dễ thương, thoải mái và an toàn cho bé khi vận động. Thiết kế đa dạng, phù hợp cho đi học, đi chơi hay dự tiệc. Chất liệu mềm mại, nâng niu từng bước chân.</p><p><br></p>', '<p>\"Giày bé gái đáng yêu, êm ái - nâng niu từng bước chân của bé!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải/da mềm, thoáng khí, không gây kích ứng da.</p><p>Thiết kế đáng yêu: Màu sắc tươi sáng, họa tiết xinh xắn, phù hợp với nhiều độ tuổi.</p><p>Đế chống trượt: Giúp bé di chuyển an toàn, hạn chế trơn trượt.</p><p>Dễ mang, dễ tháo: Quai dán hoặc chun co giãn tiện lợi cho bé.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 29),
(126, 'Giày búp bê bé gái', '420', '350', 340, 'product-featured-126.jpg', '<p>Giày bé gái dễ thương, thoải mái và an toàn cho bé khi vận động. Thiết kế đa dạng, phù hợp cho đi học, đi chơi hay dự tiệc. Chất liệu mềm mại, nâng niu từng bước chân.</p><p><br></p>', '<p>\"Giày bé gái đáng yêu, êm ái - nâng niu từng bước chân của bé!\"</p>', '<p>Chất liệu an toàn: Vải/da mềm, thoáng khí, không gây kích ứng da.</p><p>Thiết kế đáng yêu: Màu sắc tươi sáng, họa tiết xinh xắn, phù hợp với nhiều độ tuổi.</p><p>Đế chống trượt: Giúp bé di chuyển an toàn, hạn chế trơn trượt.</p><p>Dễ mang, dễ tháo: Quai dán hoặc chun co giãn tiện lợi cho bé.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 29),
(127, 'Sandal cho bé trai', '420', '350', 320, 'product-featured-127.jpg', '<p>Giày bé trai năng động, thoải mái và bền bỉ, phù hợp cho mọi hoạt động hàng ngày. Thiết kế thời trang, chất liệu an toàn, giúp bé thoải mái vui chơi và vận động cả ngày.</p><div><br></div>', '<p>\"Giày bé trai năng động, bền đẹp - thoải mái cho bé vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Thoáng khí, êm ái, bảo vệ đôi chân bé.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Thiết kế tiện lợi: Dễ mang vào và tháo ra, phù hợp cho bé tự đi giày.</p><p>Mẫu mã đa dạng: Nhiều màu sắc, họa tiết ngộ nghĩnh, phù hợp mọi lứa tuổi.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 28),
(128, 'Giày thể thao bé trai', '420', '350', 260, 'product-featured-128.jpg', '<p>Giày bé trai năng động, thoải mái và bền bỉ, phù hợp cho mọi hoạt động hàng ngày. Thiết kế thời trang, chất liệu an toàn, giúp bé thoải mái vui chơi và vận động cả ngày.</p><div><br></div>', '<p>\"Giày bé trai năng động, bền đẹp - thoải mái cho bé vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Thoáng khí, êm ái, bảo vệ đôi chân bé.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Thiết kế tiện lợi: Dễ mang vào và tháo ra, phù hợp cho bé tự đi giày.</p><p>Mẫu mã đa dạng: Nhiều màu sắc, họa tiết ngộ nghĩnh, phù hợp mọi lứa tuổi.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 28),
(129, 'Sandal cho bé trai', '420', '350', 300, 'product-featured-129.jpg', '<p>Giày bé trai năng động, thoải mái và bền bỉ, phù hợp cho mọi hoạt động hàng ngày. Thiết kế thời trang, chất liệu an toàn, giúp bé thoải mái vui chơi và vận động cả ngày.</p><div><br></div>', '<p>\"Giày bé trai năng động, bền đẹp - thoải mái cho bé vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Thoáng khí, êm ái, bảo vệ đôi chân bé.</p><p>Đế chống trượt: Đảm bảo an toàn khi di chuyển.</p><p>Thiết kế tiện lợi: Dễ mang vào và tháo ra, phù hợp cho bé tự đi giày.</p><p>Mẫu mã đa dạng: Nhiều màu sắc, họa tiết ngộ nghĩnh, phù hợp mọi lứa tuổi.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên hộp và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc đặt hàng theo yêu cầu.</p><div><br></div>', 0, 0, 1, 28),
(130, 'Nón tai bèo bé gái', '300', '250', 300, 'product-featured-130.jpg', '<p>Nón bé gái xinh xắn, bảo vệ bé khỏi nắng và gió, đồng thời tạo điểm nhấn dễ thương cho trang phục. Thiết kế nhẹ nhàng, thoáng khí, phù hợp cho mọi hoạt động ngoài trời.</p><p><br></p>', '<p>\"Nón bé gái xinh xắn, bảo vệ khỏi nắng - cho bé thêm đáng yêu, phong cách!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải cotton/mềm mại, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đáng yêu: Nhiều mẫu mã, màu sắc tươi sáng, phù hợp với bé gái.</p><p>Thoáng mát, dễ chịu: Đội lâu không gây bí bách hay khó chịu.</p><p>Dây cột/chun co giãn: Giúp nón cố định, không bị rơi khi bé vận động.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tem mác, hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc mua theo chương trình khuyến mãi đặc biệt.</p><div><br></div>', 0, 0, 1, 31),
(131, 'Nón kết cho bé gái', '300', '250', 320, 'product-featured-131.jpg', '<p>Nón bé gái xinh xắn, bảo vệ bé khỏi nắng và gió, đồng thời tạo điểm nhấn dễ thương cho trang phục. Thiết kế nhẹ nhàng, thoáng khí, phù hợp cho mọi hoạt động ngoài trời.</p><div><br></div>', '<p>\"Nón bé gái xinh xắn, bảo vệ khỏi nắng - cho bé thêm đáng yêu, phong cách!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải cotton/mềm mại, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đáng yêu: Nhiều mẫu mã, màu sắc tươi sáng, phù hợp với bé gái.</p><p>Thoáng mát, dễ chịu: Đội lâu không gây bí bách hay khó chịu.</p><p>Dây cột/chun co giãn: Giúp nón cố định, không bị rơi khi bé vận động.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tem mác, hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc mua theo chương trình khuyến mãi đặc biệt.</p><div><br></div>', 0, 0, 1, 31),
(132, 'Nón tai bèo bé gái', '300', '250', 350, 'product-featured-132.jpg', '<p>Nón bé gái xinh xắn, bảo vệ bé khỏi nắng và gió, đồng thời tạo điểm nhấn dễ thương cho trang phục. Thiết kế nhẹ nhàng, thoáng khí, phù hợp cho mọi hoạt động ngoài trời.</p><div><br></div>', '<p>&nbsp;\"Nón bé gái xinh xắn, bảo vệ khỏi nắng - cho bé thêm đáng yêu, phong cách!\"</p><div><br></div>', '<p>Chất liệu an toàn: Vải cotton/mềm mại, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đáng yêu: Nhiều mẫu mã, màu sắc tươi sáng, phù hợp với bé gái.</p><p>Thoáng mát, dễ chịu: Đội lâu không gây bí bách hay khó chịu.</p><p>Dây cột/chun co giãn: Giúp nón cố định, không bị rơi khi bé vận động.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm cần chưa qua sử dụng, còn nguyên tem mác, hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm giảm giá hoặc mua theo chương trình khuyến mãi đặc biệt.</p><div><br></div>', 0, 0, 1, 31),
(133, 'Nón kết cho bé trai', '300', '250', 320, 'product-featured-133.jpg', '<p>Nón bé trai thiết kế năng động, thoáng mát, giúp bảo vệ bé khỏi nắng và bụi. Chất liệu mềm mại, an toàn cho làn da nhạy cảm, phù hợp cho mọi hoạt động ngoài trời.</p><div><br></div>', '<p>\"Nón bé trai cá tính, bảo vệ khỏi nắng - cho bé thêm phong cách, năng động, thoải mái mọi lúc!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng khí, thấm hút mồ hôi tốt.</p><p>Thiết kế thời trang: Kiểu dáng đa dạng, họa tiết đáng yêu, dễ phối đồ.</p><p>Dễ điều chỉnh: Quai dán hoặc nút cài phù hợp với nhiều độ tuổi.</p><p>Bảo vệ tối ưu: Chắn nắng hiệu quả, giúp bé vui chơi thoải mái.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 30),
(134, 'Nón tai bèo bé trai', '300', '250', 350, 'product-featured-134.jpg', '<p>Nón bé trai thiết kế năng động, thoáng mát, giúp bảo vệ bé khỏi nắng và bụi. Chất liệu mềm mại, an toàn cho làn da nhạy cảm, phù hợp cho mọi hoạt động ngoài trời.</p><div><br></div>', '<p>\"Nón bé trai cá tính, bảo vệ khỏi nắng - cho bé thêm phong cách, năng động, thoải mái mọi lúc!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng khí, thấm hút mồ hôi tốt.</p><p>Thiết kế thời trang: Kiểu dáng đa dạng, họa tiết đáng yêu, dễ phối đồ.</p><p>Dễ điều chỉnh: Quai dán hoặc nút cài phù hợp với nhiều độ tuổi.</p><p>Bảo vệ tối ưu: Chắn nắng hiệu quả, giúp bé vui chơi thoải mái.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 30),
(135, 'Nón len bé trai', '300', '250', 320, 'product-featured-135.jpg', '<p>Nón bé trai thiết kế năng động, thoáng mát, giúp bảo vệ bé khỏi nắng và bụi. Chất liệu mềm mại, an toàn cho làn da nhạy cảm, phù hợp cho mọi hoạt động ngoài trời.</p><p><br></p>', '<p>&nbsp;\"Nón bé trai cá tính, bảo vệ khỏi nắng - cho bé thêm phong cách, năng động, thoải mái mọi lúc!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng khí, thấm hút mồ hôi tốt.</p><p>Thiết kế thời trang: Kiểu dáng đa dạng, họa tiết đáng yêu, dễ phối đồ.</p><p>Dễ điều chỉnh: Quai dán hoặc nút cài phù hợp với nhiều độ tuổi.</p><p>Bảo vệ tối ưu: Chắn nắng hiệu quả, giúp bé vui chơi thoải mái.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm lỗi do nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn nguyên tem mác và hóa đơn.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt theo yêu cầu.</p><div><br></div>', 0, 0, 1, 30),
(136, 'Đồ bộ tay dài cho bé gái', '300', '250', 350, 'product-featured-136.jpg', '<p>Quần áo bé gái với thiết kế đáng yêu, chất liệu mềm mại, an toàn cho làn da nhạy cảm. Đa dạng mẫu mã, màu sắc tươi sáng, phù hợp cho mọi hoạt động hằng ngày hay các dịp đặc biệt.</p><p><br></p>', '<p>\"Trang phục bé gái dễ thương - Quần áo bé gái xinh xắn, thoáng mát, cho bé thêm đáng yêu và thoải mái suốt ngày dài!\"</p><div><br></div>', '<p>Chất liệu an toàn: Cotton, thun co giãn, vải lanh thoáng mát.</p><p>Thiết kế dễ thương: Kiểu dáng hiện đại, họa tiết sinh động.</p><p>Thoải mái vận động: Form dáng vừa vặn, không gây khó chịu khi bé chơi đùa.</p><p>Dễ giặt, nhanh khô: Bền màu, không xù lông sau nhiều lần giặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt may theo yêu cầu.</p><div><br></div>', 1, 1, 1, 27),
(137, 'Đồ bộ bé gái ba lỗ quần đùi', '300', '250', 340, 'product-featured-137.jpg', '<p>Quần áo bé gái với thiết kế đáng yêu, chất liệu mềm mại, an toàn cho làn da nhạy cảm. Đa dạng mẫu mã, màu sắc tươi sáng, phù hợp cho mọi hoạt động hằng ngày hay các dịp đặc biệt.</p><div><br></div>', '<p>\"Trang phục bé gái dễ thương - Quần áo bé gái xinh xắn, thoáng mát, cho bé thêm đáng yêu và thoải mái suốt ngày dài!\"</p><div><br></div>', '<p>Chất liệu an toàn: Cotton, thun co giãn, vải lanh thoáng mát.</p><p>Thiết kế dễ thương: Kiểu dáng hiện đại, họa tiết sinh động.</p><p>Thoải mái vận động: Form dáng vừa vặn, không gây khó chịu khi bé chơi đùa.</p><p>Dễ giặt, nhanh khô: Bền màu, không xù lông sau nhiều lần giặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 27),
(138, 'Đồ bộ bé gái ba lỗ quần đùi', '300', '250', 260, 'product-featured-138.jpg', '<p>Quần áo bé gái với thiết kế đáng yêu, chất liệu mềm mại, an toàn cho làn da nhạy cảm. Đa dạng mẫu mã, màu sắc tươi sáng, phù hợp cho mọi hoạt động hằng ngày hay các dịp đặc biệt.</p><div><br></div>', '<p>\"Trang phục bé gái dễ thương - Quần áo bé gái xinh xắn, thoáng mát, cho bé thêm đáng yêu và thoải mái suốt ngày dài!\"</p><div><br></div>', '<p>Chất liệu an toàn: Cotton, thun co giãn, vải lanh thoáng mát.</p><p>Thiết kế dễ thương: Kiểu dáng hiện đại, họa tiết sinh động.</p><p>Thoải mái vận động: Form dáng vừa vặn, không gây khó chịu khi bé chơi đùa.</p><p>Dễ giặt, nhanh khô: Bền màu, không xù lông sau nhiều lần giặt.</p><div><br></div>', '<p>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm bị lỗi do nhà sản xuất.</p><p>Sản phẩm đổi trả cần chưa qua sử dụng, còn nguyên tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với các sản phẩm giảm giá hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 27),
(139, 'Bộ quần áo cộc tay bé trai', '300', '250', 350, 'product-featured-139.jpg', '<p>Quần áo bé trai thoải mái, năng động, thiết kế đáng yêu phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, an toàn cho làn da nhạy cảm của bé, giúp bé luôn dễ chịu và vui chơi thoải mái.</p><div><br></div>', '<p>\"Trang phục bé trai năng động - Quần áo bé trai cá tính, thoải mái, cho bé tự tin khám phá và vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng mát, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đa dạng: Từ năng động đến lịch sự, phù hợp đi học, đi chơi.</p><p>Đường may chắc chắn: Bền đẹp, không gây kích ứng da.</p><p>Dễ giặt, nhanh khô: Giữ form dáng tốt sau nhiều lần giặt.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 26),
(140, 'Bộ quần áo cộc tay bé trai', '300', '250', 300, 'product-featured-140.jpg', '<p>Quần áo bé trai thoải mái, năng động, thiết kế đáng yêu phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, an toàn cho làn da nhạy cảm của bé, giúp bé luôn dễ chịu và vui chơi thoải mái.</p><div><br></div>', '<p>\"Trang phục bé trai năng động - Quần áo bé trai cá tính, thoải mái, cho bé tự tin khám phá và vui chơi cả ngày!\"</p><div><br></div>', '<p>Chất liệu cao cấp: Cotton thoáng mát, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đa dạng: Từ năng động đến lịch sự, phù hợp đi học, đi chơi.</p><p>Đường may chắc chắn: Bền đẹp, không gây kích ứng da.</p><p>Dễ giặt, nhanh khô: Giữ form dáng tốt sau nhiều lần giặt.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 26),
(141, 'Bộ đồ bé trai sát nách mùa hè', '300', '250', 340, 'product-featured-141.jpg', '<p>Quần áo bé trai thoải mái, năng động, thiết kế đáng yêu phù hợp cho mọi hoạt động hàng ngày. Chất liệu mềm mại, an toàn cho làn da nhạy cảm của bé, giúp bé luôn dễ chịu và vui chơi thoải mái.</p><div><br></div>', '<p>\"Trang phục bé trai năng động - Quần áo bé trai cá tính, thoải mái, cho bé tự tin khám phá và vui chơi cả ngày!\"</p>', '<p>Chất liệu cao cấp: Cotton thoáng mát, thấm hút mồ hôi tốt.</p><p>Kiểu dáng đa dạng: Từ năng động đến lịch sự, phù hợp đi học, đi chơi.</p><p>Đường may chắc chắn: Bền đẹp, không gây kích ứng da.</p><p>Dễ giặt, nhanh khô: Giữ form dáng tốt sau nhiều lần giặt.</p><div><br></div>', '<p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi từ nhà sản xuất.</p><p>Sản phẩm phải chưa qua sử dụng, còn tem mác và hóa đơn mua hàng.</p><p>Không áp dụng đổi trả với sản phẩm khuyến mãi hoặc đặt may theo yêu cầu.</p><div><br></div>', 0, 0, 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `table_product_color`
--

CREATE TABLE `table_product_color` (
  `id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_product_color`
--

INSERT INTO `table_product_color` (`id`, `color_id`, `p_id`) VALUES
(1, 1, 1),
(2, 6, 1),
(3, 2, 2),
(4, 5, 2),
(5, 5, 3),
(6, 6, 3),
(9, 5, 5),
(10, 6, 5),
(11, 5, 6),
(12, 7, 6),
(13, 5, 7),
(14, 6, 7),
(15, 5, 8),
(16, 5, 9),
(17, 6, 9),
(18, 6, 12),
(19, 5, 13),
(20, 5, 14),
(21, 6, 16),
(22, 5, 18),
(23, 6, 17),
(24, 5, 21),
(25, 2, 22),
(26, 9, 22),
(27, 4, 23),
(28, 4, 24),
(29, 5, 24),
(30, 6, 25),
(31, 5, 26),
(32, 6, 26),
(33, 5, 27),
(34, 6, 27),
(37, 5, 28),
(38, 6, 28),
(39, 4, 29),
(40, 7, 29),
(41, 6, 30),
(42, 7, 30),
(43, 5, 31),
(44, 5, 32),
(45, 5, 33),
(46, 5, 34),
(47, 5, 35),
(48, 5, 36),
(49, 2, 37),
(50, 6, 37),
(51, 2, 38),
(52, 4, 38),
(53, 6, 40),
(54, 2, 41),
(55, 9, 41),
(56, 4, 42),
(57, 6, 42),
(58, 5, 43),
(59, 1, 44),
(60, 4, 44),
(61, 2, 45),
(62, 9, 45),
(63, 3, 46),
(64, 9, 46),
(65, 2, 47),
(66, 3, 47),
(67, 2, 48),
(68, 6, 48),
(69, 6, 49),
(70, 2, 50),
(71, 3, 51),
(72, 9, 51),
(73, 6, 52),
(74, 2, 53),
(75, 6, 53),
(76, 4, 54),
(77, 1, 55),
(78, 6, 55),
(81, 6, 56),
(82, 9, 56),
(83, 2, 57),
(84, 6, 57),
(85, 5, 58),
(86, 6, 58),
(87, 2, 59),
(88, 5, 59),
(89, 5, 60),
(90, 6, 60),
(91, 2, 61),
(92, 2, 62),
(93, 6, 62),
(94, 5, 63),
(95, 6, 63),
(96, 5, 64),
(97, 6, 64),
(98, 6, 65),
(99, 5, 66),
(100, 10, 66),
(101, 5, 67),
(102, 5, 68),
(103, 6, 68),
(104, 1, 69),
(105, 5, 69),
(106, 5, 71),
(107, 10, 71),
(108, 5, 70),
(109, 10, 70),
(110, 5, 72),
(111, 5, 73),
(112, 6, 74),
(113, 2, 75),
(114, 5, 75),
(115, 5, 76),
(116, 4, 77),
(117, 6, 77),
(118, 5, 78),
(119, 5, 79),
(120, 10, 79),
(121, 4, 80),
(122, 6, 80),
(123, 5, 81),
(124, 6, 81),
(125, 10, 82),
(126, 5, 83),
(127, 5, 84),
(128, 2, 85),
(129, 2, 86),
(130, 5, 86),
(131, 2, 87),
(132, 10, 87),
(133, 5, 88),
(134, 6, 88),
(135, 4, 89),
(136, 6, 89),
(137, 2, 90),
(138, 5, 90),
(139, 2, 91),
(140, 6, 91),
(141, 2, 92),
(142, 4, 92),
(144, 9, 94),
(145, 10, 94),
(146, 5, 95),
(147, 6, 95),
(148, 5, 96),
(149, 6, 96),
(150, 5, 97),
(151, 6, 97),
(152, 4, 98),
(153, 6, 98),
(154, 6, 99),
(155, 5, 100),
(156, 6, 100),
(157, 5, 101),
(158, 6, 101),
(159, 6, 102),
(160, 9, 102),
(161, 6, 103),
(162, 9, 103),
(163, 2, 104),
(164, 9, 104),
(165, 5, 105),
(166, 6, 105),
(169, 6, 107),
(170, 5, 108),
(171, 6, 108),
(172, 9, 109),
(173, 9, 110),
(174, 5, 111),
(175, 6, 111),
(176, 2, 112),
(178, 2, 114),
(179, 6, 114),
(180, 3, 115),
(181, 2, 116),
(182, 3, 116),
(183, 4, 117),
(184, 7, 117),
(185, 3, 118),
(186, 4, 119),
(187, 9, 119),
(188, 4, 120),
(189, 6, 121),
(190, 9, 121),
(191, 7, 122),
(192, 1, 123),
(193, 6, 123),
(194, 6, 124),
(195, 6, 125),
(196, 10, 125),
(197, 3, 126),
(198, 6, 126),
(199, 5, 127),
(200, 2, 128),
(201, 3, 128),
(202, 3, 129),
(203, 4, 129),
(204, 9, 130),
(205, 6, 131),
(206, 7, 131),
(207, 6, 132),
(210, 6, 133),
(211, 10, 133),
(212, 6, 134),
(213, 6, 135),
(214, 10, 135),
(217, 6, 137),
(218, 9, 137),
(219, 2, 138),
(220, 9, 138),
(221, 6, 139),
(222, 10, 139),
(223, 2, 140),
(224, 5, 140),
(227, 3, 141),
(228, 5, 141),
(229, 10, 113),
(230, 2, 106),
(231, 5, 106),
(232, 2, 93),
(235, 2, 4),
(236, 6, 4),
(237, 6, 136),
(238, 9, 136);

-- --------------------------------------------------------

--
-- Table structure for table `table_product_photo`
--

CREATE TABLE `table_product_photo` (
  `pp_id` int(11) NOT NULL,
  `photo` text NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_product_photo`
--

INSERT INTO `table_product_photo` (`pp_id`, `photo`, `p_id`) VALUES
(1, '1.jpg', 1),
(2, '2.jpg', 2),
(3, '3.jpg', 3),
(4, '4.jpg', 4),
(5, '5.jpg', 5),
(6, '6.jpg', 6),
(7, '7.jpg', 7),
(8, '8.jpg', 8),
(9, '9.jpg', 9),
(10, '10.jpg', 10),
(11, '11.jpg', 11),
(12, '12.jpg', 12),
(13, '13.jpg', 13),
(14, '14.jpg', 14),
(15, '15.jpg', 15),
(16, '16.jpg', 16),
(17, '17.jpg', 17),
(18, '18.jpg', 18),
(19, '19.jpg', 19),
(20, '20.jpg', 20),
(21, '21.jpg', 21),
(22, '22.jpg', 22),
(23, '23.jpg', 23),
(24, '24.jpg', 24),
(25, '25.jpg', 25),
(26, '26.jpg', 26),
(27, '27.jpg', 27),
(28, '28.jpg', 28),
(29, '29.jpg', 29),
(30, '30.jpg', 30),
(31, '31.jpg', 31),
(32, '32.jpg', 32),
(33, '33.jpg', 33),
(34, '34.jpg', 34),
(35, '35.jpg', 35),
(36, '36.jpg', 36),
(37, '37.jpg', 37),
(38, '38.jpg', 38),
(39, '39.jpg', 39),
(40, '40.jpg', 40),
(41, '41.jpg', 41),
(42, '42.jpg', 42),
(43, '43.jpg', 43),
(44, '44.jpg', 44),
(45, '45.jpg', 45),
(46, '46.jpg', 46),
(47, '47.jpg', 47),
(48, '48.jpg', 48),
(49, '49.jpg', 49),
(50, '50.jpg', 50),
(51, '51.jpg', 51),
(52, '52.jpg', 52),
(53, '53.jpg', 53),
(54, '54.jpg', 54),
(55, '55.jpg', 55),
(56, '56.jpg', 56),
(57, '57.jpg', 57),
(58, '58.jpg', 58),
(59, '59.jpg', 59),
(60, '60.jpg', 60),
(61, '61.jpg', 61),
(62, '62.jpg', 62),
(63, '63.jpg', 63),
(64, '64.jpg', 64),
(65, '65.jpg', 65),
(66, '66.jpg', 66),
(67, '67.jpg', 67),
(68, '68.jpg', 68),
(69, '69.jpg', 69),
(70, '70.jpg', 70),
(71, '71.jpg', 71),
(72, '72.jpg', 72),
(73, '73.jpg', 73),
(74, '74.jpg', 74),
(75, '75.jpg', 75),
(76, '76.jpg', 76),
(77, '77.jpg', 77),
(78, '78.jpg', 78),
(79, '79.jpg', 79),
(80, '80.jpg', 80),
(81, '81.jpg', 81),
(82, '82.jpg', 82),
(83, '83.jpg', 83),
(84, '84.jpg', 84),
(85, '85.jpg', 85),
(86, '86.jpg', 86),
(87, '87.jpg', 87),
(88, '88.jpg', 88),
(89, '89.jpg', 89),
(90, '90.jpg', 90),
(91, '91.jpg', 91),
(92, '92.jpg', 92),
(93, '93.jpg', 93),
(94, '94.jpg', 94),
(95, '95.jpg', 95),
(96, '96.jpg', 96),
(97, '97.jpg', 97),
(98, '98.jpg', 98),
(99, '99.jpg', 99),
(100, '100.jpg', 100),
(101, '101.jpg', 101),
(102, '102.jpg', 102),
(103, '103.jpg', 103),
(104, '104.jpg', 104),
(105, '105.jpg', 105),
(106, '106.jpg', 106),
(107, '107.jpg', 107),
(108, '108.jpg', 108),
(109, '109.jpg', 109),
(110, '110.jpg', 110),
(111, '111.jpg', 111),
(112, '112.jpg', 112),
(113, '113.jpg', 113),
(114, '114.jpg', 114),
(115, '115.jpg', 115),
(116, '116.jpg', 116),
(117, '117.jpg', 117),
(118, '118.jpg', 118),
(119, '119.jpg', 119),
(120, '120.jpg', 120),
(121, '121.jpg', 121),
(122, '122.jpg', 122),
(123, '123.jpg', 123),
(124, '124.jpg', 124),
(125, '125.jpg', 125),
(126, '126.jpg', 126),
(127, '127.jpg', 127),
(128, '128.jpg', 128),
(129, '129.jpg', 129),
(130, '130.jpg', 130),
(131, '131.jpg', 131),
(132, '132.jpg', 132),
(133, '133.jpg', 133),
(134, '134.jpg', 134),
(135, '135.jpg', 135),
(136, '136.jpg', 136),
(137, '137.jpg', 137),
(138, '138.jpg', 138),
(139, '139.jpg', 139),
(140, '140.jpg', 140),
(141, '141.jpg', 141);

-- --------------------------------------------------------

--
-- Table structure for table `table_product_size`
--

CREATE TABLE `table_product_size` (
  `id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_product_size`
--

INSERT INTO `table_product_size` (`id`, `size_id`, `p_id`) VALUES
(1, 40, 1),
(2, 41, 1),
(3, 29, 2),
(4, 40, 3),
(5, 41, 3),
(7, 29, 5),
(8, 29, 6),
(9, 34, 7),
(10, 35, 7),
(11, 35, 8),
(12, 36, 8),
(13, 34, 9),
(14, 35, 9),
(15, 40, 10),
(16, 41, 10),
(17, 40, 11),
(18, 41, 11),
(19, 40, 12),
(20, 41, 12),
(21, 40, 13),
(22, 41, 13),
(23, 40, 14),
(24, 41, 14),
(25, 40, 15),
(26, 41, 15),
(27, 29, 16),
(29, 29, 18),
(30, 29, 17),
(31, 29, 19),
(32, 34, 20),
(33, 29, 21),
(34, 40, 22),
(35, 41, 22),
(36, 40, 23),
(37, 41, 23),
(38, 40, 24),
(39, 41, 24),
(40, 29, 25),
(41, 29, 26),
(42, 29, 27),
(44, 34, 28),
(45, 35, 29),
(46, 34, 30),
(47, 38, 31),
(48, 34, 32),
(49, 34, 33),
(50, 36, 34),
(51, 37, 35),
(52, 36, 36),
(53, 29, 37),
(54, 29, 38),
(55, 29, 39),
(56, 34, 40),
(57, 29, 41),
(58, 26, 42),
(59, 26, 43),
(60, 26, 44),
(61, 26, 45),
(62, 29, 46),
(63, 29, 47),
(64, 29, 48),
(65, 29, 49),
(66, 29, 50),
(67, 34, 51),
(68, 35, 51),
(69, 36, 52),
(70, 37, 52),
(71, 26, 53),
(72, 26, 54),
(73, 29, 55),
(75, 29, 56),
(76, 29, 57),
(77, 4, 58),
(78, 5, 58),
(79, 3, 59),
(80, 4, 59),
(81, 5, 60),
(82, 6, 60),
(83, 4, 61),
(84, 5, 61),
(85, 5, 62),
(86, 6, 62),
(87, 3, 63),
(88, 4, 63),
(89, 4, 64),
(90, 5, 64),
(91, 3, 65),
(92, 4, 65),
(93, 4, 66),
(94, 5, 66),
(95, 18, 67),
(96, 19, 67),
(97, 17, 68),
(98, 18, 68),
(99, 19, 69),
(100, 20, 69),
(103, 19, 71),
(104, 20, 71),
(105, 18, 70),
(106, 19, 70),
(107, 16, 72),
(108, 17, 72),
(109, 17, 73),
(110, 18, 73),
(111, 18, 74),
(112, 19, 74),
(113, 16, 75),
(114, 17, 75),
(115, 26, 76),
(116, 26, 77),
(117, 26, 78),
(118, 26, 79),
(119, 26, 80),
(120, 26, 81),
(121, 26, 82),
(122, 26, 83),
(123, 26, 84),
(124, 4, 85),
(125, 5, 85),
(126, 3, 86),
(127, 4, 86),
(128, 5, 87),
(129, 6, 87),
(130, 4, 88),
(131, 5, 88),
(132, 3, 89),
(133, 4, 89),
(134, 5, 90),
(135, 6, 90),
(136, 3, 91),
(137, 4, 91),
(138, 4, 92),
(139, 5, 92),
(142, 12, 94),
(143, 13, 94),
(144, 11, 95),
(145, 12, 95),
(146, 14, 96),
(147, 15, 96),
(148, 12, 97),
(149, 13, 97),
(150, 11, 98),
(151, 12, 98),
(152, 13, 99),
(153, 14, 99),
(154, 11, 100),
(155, 12, 100),
(156, 11, 101),
(157, 12, 101),
(158, 14, 102),
(159, 15, 102),
(160, 12, 103),
(161, 13, 103),
(162, 13, 104),
(163, 14, 104),
(164, 12, 105),
(165, 13, 105),
(168, 3, 107),
(169, 4, 107),
(170, 2, 108),
(171, 3, 108),
(172, 2, 109),
(173, 3, 109),
(174, 3, 110),
(175, 4, 110),
(176, 1, 111),
(177, 2, 111),
(178, 2, 112),
(179, 3, 112),
(182, 3, 114),
(183, 4, 114),
(184, 29, 115),
(185, 29, 116),
(186, 29, 117),
(187, 29, 118),
(188, 29, 119),
(189, 29, 120),
(190, 34, 121),
(191, 35, 122),
(192, 34, 123),
(193, 26, 124),
(194, 26, 125),
(195, 26, 126),
(196, 26, 127),
(197, 26, 128),
(198, 26, 129),
(199, 26, 130),
(200, 26, 131),
(201, 26, 132),
(203, 26, 133),
(204, 26, 134),
(205, 26, 135),
(207, 26, 137),
(208, 26, 138),
(209, 26, 139),
(210, 26, 140),
(212, 1, 141),
(213, 2, 141),
(214, 3, 141),
(215, 4, 141),
(216, 5, 141),
(217, 6, 141),
(218, 7, 141),
(219, 26, 141),
(220, 3, 113),
(221, 4, 113),
(222, 3, 106),
(223, 4, 106),
(224, 5, 93),
(225, 6, 93),
(227, 29, 4),
(228, 26, 136);

-- --------------------------------------------------------

--
-- Table structure for table `table_province`
--

CREATE TABLE `table_province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_province`
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
-- Table structure for table `table_rating`
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
-- Table structure for table `table_service`
--

CREATE TABLE `table_service` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_service`
--

INSERT INTO `table_service` (`id`, `title`, `content`, `photo`) VALUES
(1, 'Hàng chọn giá hời', '', 'service-1.jpg'),
(2, 'Mã giảm giá', '', 'service-2.jpg'),
(3, 'Miễn phí ship', '', 'service-3.jpg'),
(4, 'GoBuy style giảm 30%', '', 'service-4.jpg'),
(5, 'Voucher giảm đến 1 tỷ', '', 'service-5.jpg'),
(6, 'Khung giờ săn sale', '', 'service-6.jpg'),
(7, 'Hàng quốc tế', '', 'service-7.jpg'),
(8, 'Nạp thẻ, Dịch vụ & Vé tàu hỏa', '', 'service-8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `table_settings`
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
  `total_latest_product` int(11) NOT NULL,
  `total_popular_product` int(11) NOT NULL,
  `total_featured_product` int(11) NOT NULL,
  `meta_title` text NOT NULL,
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
  `service_on_off` int(11) NOT NULL,
  `latest_product_on_off` int(11) NOT NULL,
  `popular_product_on_off` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_settings`
--

INSERT INTO `table_settings` (`id`, `logo`, `favicon`, `footer_about`, `footer_copyright`, `contact_address`, `contact_email`, `contact_phone`, `contact_map_iframe`, `receive_email`, `receive_email_subject`, `receive_email_thank_you_message`, `forget_password_message`, `total_latest_product`, `total_popular_product`, `total_featured_product` ,`meta_title`, `banner_login`, `banner_registration`, `banner_forget_password`, `banner_reset_password`, `banner_search`, `banner_cart`, `banner_checkout`, `banner_product_category`, `cta_title`, `cta_content`, `cta_read_more_text`, `cta_read_more_url`, `cta_photo`, `latest_product_title`, `latest_product_subtitle`, `popular_product_title`, `popular_product_subtitle`, `bank_public_key`, `bank_secret_key`, `bank_detail`, `before_head`, `after_body`, `before_body`, `service_on_off`, `latest_product_on_off`, `popular_product_on_off`) VALUES
(1, 'logo.png', 'favicon.png', 'Đây là một website bán hàng, đồ án môn học IS207 tại UIT', 'GoBuy - Duck123', 'Thu Duc, TP.HCM', 'taduc0508@gmail.com', '0123456789', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.738228322354!2d106.80321571480056!3d10.870084060477334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527c1c6e8b1b9%3A0x3a8e6e5c6f5e6b8a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjhu41uZyB0aW4g4oCTIMSQSCBRR00gVGjhu6cgUXXhuq1jIEdpYSBUcC5ISQ!5e0!3m2!1svi!2s!4v1616581234567\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 'taduc0508@gmail.com', 'Email messages from GoBuy visitors', 'Cảm ơn bạn đã gửi email. Chúng tôi sẽ liên hệ với bạn sớm.', 'Một liên kết xác nhận đã được gửi đến địa chỉ email của bạn. Bạn sẽ nhận được thông tin đặt lại mật khẩu trong đó.', 6, 8, 6, 'GoBuy', 'banner_login.jpg', 'banner_registration.jpg', 'banner_forget_password.jpg', 'banner_reset_password.jpg', 'banner_search.jpg', 'banner_cart.jpg', 'banner_checkout.jpg', 'banner_product_category.jpg', 'Chào mừng đến với GoBuy', 'GoBuy - nền tảng thương mại điện tử đáng tin cậy! Khám phá hàng ngàn sản phẩm chất lượng với giá tốt nhất, cùng những ưu đãi hấp dẫn mỗi ngày. Mua sắm dễ dàng, thanh toán an toàn, giao hàng nhanh chóng!', 'Xem thêm', '#', 'cta.jpg', 'Sản phẩm mới nhất', 'Danh sách những sản phẩm mới nhất', 'Sẩn phẩm nổi bật', 'Sản phẩm nổi bật dựa trên lựa chọn của khách hàng', 'xxxxxx', 'yyyyyy', 'Bank Name: AAAAAAA\r\nAccount Number: 1234567\r\nBranch Name: AAAAAA', '', '', '',1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_shipping_cost`
--

CREATE TABLE `table_shipping_cost` (
  `shipping_cost_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `table_shipping_cost_all`
--

CREATE TABLE `table_shipping_cost_all` (
  `sca_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_shipping_cost_all`
--

INSERT INTO `table_shipping_cost_all` (`sca_id`, `amount`) VALUES
(1, '100');

-- --------------------------------------------------------

--
-- Table structure for table `table_size`
--

CREATE TABLE `table_size` (
  `size_id` int(11) NOT NULL,
  `size_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_size`
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
(28, '1080x800'),
(29, '720x500'),
(30, '2T'),
(31, '3T'),
(32, '4T'),
(33, '5T'),
(34, '24 inch'),
(35, '32 inch'),
(36, '40 inch'),
(37, '43 inch'),
(38, '50 inch '),
(39, '55 inch'),
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
-- Table structure for table `table_slider`
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
-- Dumping data for table `table_slider`
--

INSERT INTO `table_slider` (`id`, `photo`, `heading`, `content`, `button_text`, `button_url`, `position`) VALUES
(1, 'slider-1.png', 'Welcome to Shọppe', 'Cửa hàng phụ kiện mới nhất cho nam', 'Xem phụ kiện cho nam', '#', 'Center'),
(2, 'slider-2.jpg', 'Giảm giá 50% cho tất cả sản phẩm', 'Mua nhanh đi không hết bây giờ.', 'Read More', '#', 'Center'),
(3, 'slider-3.png', 'Hỗ trợ 24/7', 'Đội ngũ nhân viên cam kết phục vụ tận tình.', 'Read More', '#', 'Right');

-- --------------------------------------------------------

--
-- Table structure for table `table_social`
--

CREATE TABLE `table_social` (
  `social_id` int(11) NOT NULL,
  `social_name` varchar(30) NOT NULL,
  `social_url` text NOT NULL,
  `social_icon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_social`
--

INSERT INTO `table_social` (`social_id`, `social_name`, `social_url`, `social_icon`) VALUES
(1, 'Facebook', 'https://www.facebook.com/#', 'fa fa-facebook'),
(2, 'Twitter', 'https://www.twitter.com/#', 'fa fa-twitter'),
(3, 'YouTube', 'https://www.youtube.com/#', 'fa fa-youtube'),
(4, 'Instagram', 'https://www.instagram.com/#', 'fa fa-instagram');

-- --------------------------------------------------------

--
-- Table structure for table `table_top_category`
--

CREATE TABLE `table_top_category` (
  `tcat_id` int(11) NOT NULL,
  `tcat_name` text NOT NULL,
  `show_on_menu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_top_category`
--

INSERT INTO `table_top_category` (`tcat_id`, `tcat_name`, `show_on_menu`) VALUES
(1, 'Nam', 1),
(2, 'Nữ', 1),
(3, 'Trẻ em', 1),
(4, 'Đồ điện tử', 1),
(5, 'Đồ gia dụng', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_admin`
--
ALTER TABLE `table_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_color`
--
ALTER TABLE `table_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `table_customer`
--
ALTER TABLE `table_customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `table_customer_message`
--
ALTER TABLE `table_customer_message`
  ADD PRIMARY KEY (`customer_message_id`);

--
-- Indexes for table `table_end_category`
--
ALTER TABLE `table_end_category`
  ADD PRIMARY KEY (`ecat_id`);

--
-- Indexes for table `table_faq`
--
ALTER TABLE `table_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `table_mid_category`
--
ALTER TABLE `table_mid_category`
  ADD PRIMARY KEY (`mcat_id`);

--
-- Indexes for table `table_order`
--
ALTER TABLE `table_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_page`
--
ALTER TABLE `table_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_payment`
--
ALTER TABLE `table_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_photo`
--
ALTER TABLE `table_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_product`
--
ALTER TABLE `table_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `table_product_color`
--
ALTER TABLE `table_product_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_product_photo`
--
ALTER TABLE `table_product_photo`
  ADD PRIMARY KEY (`pp_id`);

--
-- Indexes for table `table_product_size`
--
ALTER TABLE `table_product_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_province`
--
ALTER TABLE `table_province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `table_rating`
--
ALTER TABLE `table_rating`
  ADD PRIMARY KEY (`rt_id`);

--
-- Indexes for table `table_service`
--
ALTER TABLE `table_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_settings`
--
ALTER TABLE `table_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_shipping_cost`
--
ALTER TABLE `table_shipping_cost`
  ADD PRIMARY KEY (`shipping_cost_id`);

--
-- Indexes for table `table_shipping_cost_all`
--
ALTER TABLE `table_shipping_cost_all`
  ADD PRIMARY KEY (`sca_id`);

--
-- Indexes for table `table_size`
--
ALTER TABLE `table_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `table_slider`
--
ALTER TABLE `table_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_social`
--
ALTER TABLE `table_social`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `table_top_category`
--
ALTER TABLE `table_top_category`
  ADD PRIMARY KEY (`tcat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_admin`
--
ALTER TABLE `table_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `table_color`
--
ALTER TABLE `table_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `table_customer`
--
ALTER TABLE `table_customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `table_customer_message`
--
ALTER TABLE `table_customer_message`
  MODIFY `customer_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_end_category`
--
ALTER TABLE `table_end_category`
  MODIFY `ecat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `table_faq`
--
ALTER TABLE `table_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_mid_category`
--
ALTER TABLE `table_mid_category`
  MODIFY `mcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `table_order`
--
ALTER TABLE `table_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `table_page`
--
ALTER TABLE `table_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_payment`
--
ALTER TABLE `table_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table_photo`
--
ALTER TABLE `table_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `table_product`
--
ALTER TABLE `table_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `table_product_color`
--
ALTER TABLE `table_product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `table_product_photo`
--
ALTER TABLE `table_product_photo`
  MODIFY `pp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `table_product_size`
--
ALTER TABLE `table_product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `table_rating`
--
ALTER TABLE `table_rating`
  MODIFY `rt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_service`
--
ALTER TABLE `table_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `table_settings`
--
ALTER TABLE `table_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_shipping_cost`
--
ALTER TABLE `table_shipping_cost`
  MODIFY `shipping_cost_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_shipping_cost_all`
--
ALTER TABLE `table_shipping_cost_all`
  MODIFY `sca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_size`
--
ALTER TABLE `table_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `table_slider`
--
ALTER TABLE `table_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `table_social`
--
ALTER TABLE `table_social`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_top_category`
--
ALTER TABLE `table_top_category`
  MODIFY `tcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
