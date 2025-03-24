SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";
SET NAMES utf8mb4;

-- Database: gobuy

-- Lần lượt tạo các bảng và thêm dữ liệu mẫu
CREATE TABLE table_color (
  color_id int(11) NOT NULL,
  color_name TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_color (color_id, color_name) VALUES
(1, 'Đỏ'),
(2, 'Xanh dương'),
(3, 'Xanh lá'),
(4, 'Vàng'),
(5, 'Cam'),
(6, 'Tím'),
(7, 'Hồng'),
(8, 'Nâu'),
(9, 'Xám'),
(10, 'Đen');


CREATE TABLE table_province (
  province_id int(11) NOT NULL,
  province_name varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



INSERT INTO table_province (province_id, province_name) VALUES
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

CREATE TABLE table_customer (
  cust_id int(11) NOT NULL,
  cust_name varchar(100) NOT NULL,
  cust_email varchar(100) NOT NULL,
  cust_phone varchar(50) NOT NULL,
  cust_province int(11) NOT NULL,
  cust_district varchar(100) NOT NULL,
  cust_address text NOT NULL,
  cust_s_name varchar(100) NOT NULL,
  cust_s_phone varchar(50) NOT NULL,
  cust_s_province int(11) NOT NULL,
  cust_s_district varchar(100) NOT NULL,
  cust_s_address text NOT NULL,
  cust_password varchar(100) NOT NULL,
  cust_token TEXT NOT NULL,
  cust_datetime varchar(100) NOT NULL,
  cust_timestamp varchar(100) NOT NULL,
  cust_status int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_customer (
    cust_id, cust_name, cust_email, cust_phone, 
    cust_province, cust_district, cust_address, 
    cust_s_name, cust_s_phone, cust_s_province, cust_s_district, cust_s_address, 
    cust_password, cust_token, cust_datetime, cust_timestamp, cust_status
) VALUES
(1, 'Nguyễn Văn A', 'vana@gmail.com', '0905123456', 
    1, 'ABC', '123 Đường Lê Lợi', 
    'Nguyễn Văn A', '0905123456', 29, 'ABC', '123 Đường Lê Lợi', 
    '5f4dcc3b5aa765d61d8327deb882cf99', 'abc123token1', '2025-02-28 10:00:00', '1746031200', 1),

(2, 'Trần Thị B', 'anhduc9b1cva@gmail.com', '0914345678', 
    2, 'XYZ', '456 Đường Trần Hưng Đạo', 
    'Trần Thị B', '1234', 11, 'XYZ', 'DEF', 
    '5f4dcc3b5aa765d61d8327deb882cf99', 'xyz456token2', '2025-02-28 10:10:00', '1746031800', 1);


CREATE TABLE table_customer_message (
  customer_message_id int(11) NOT NULL,
  subject TEXT NOT NULL,
  message text NOT NULL,
  order_detail text NOT NULL,
  cust_id int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE table_end_category (
  ecat_id int(11) NOT NULL,
  ecat_name TEXT NOT NULL,
  mcat_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



INSERT INTO table_end_category (ecat_id, ecat_name, mcat_id) VALUES
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

CREATE TABLE table_faq (
  faq_id int(11) NOT NULL,
  faq_title TEXT NOT NULL,
  faq_content text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_faq (faq_id, faq_title, faq_content) VALUES
(1, 'Làm thế nào để tìm một sản phẩm?', '<h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><font color=\"#222222\" face=\"opensans, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif\"><span style=\"font-size: 15.7143px;\">Chúng tôi có rất nhiều sản phẩm tuyệt vời để bạn lựa chọn.</span></font></h3><h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><span style=\"font-size: 15.7143px; color: rgb(34, 34, 34); font-family: opensans, \"Helvetica Neue\", Helvetica, Helvetica, Arial, sans-serif;\">Mẹo 1: Nếu bạn đang tìm kiếm một sản phẩm cụ thể, hãy sử dụng hộp tìm kiếm từ khóa nằm ở đầu trang web. Chỉ cần nhập sản phẩm bạn đang tìm và chuẩn bị để ngạc nhiên!</span></h3><h3 class=\"checkout-complete-box font-bold txt16\" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; margin: 0.2rem 0px 0.5rem; padding: 0px; line-height: 1.4; background-color: rgb(250, 250, 250);\"><font color=\"#222222\" face=\"opensans, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif\"><span style=\"font-size: 15.7143px;\">Mẹo 2: Nếu bạn muốn khám phá danh mục sản phẩm, hãy sử dụng Danh mục cửa hàng trong menu trên cùng và duyệt qua các danh mục yêu thích của bạn, nơi chúng tôi sẽ giới thiệu những sản phẩm tốt nhất trong từng danh mục.</span></font><br><br></h3>\r\n'),
(2, 'Chính sách hoàn trả của bạn là gì?', '<p><span style=\"color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: 14px; text-align: center;\">Bạn có 15 ngày để yêu cầu hoàn tiền sau khi đơn hàng của bạn được giao.</span><br></p>\r\n'),
(3, 'Tôi nhận được sản phẩm bị lỗi/hư hỏng, tôi có thể hoàn tiền không?', '<p>Nếu sản phẩm bạn nhận được bị lỗi hoặc hư hỏng, bạn có thể trả lại sản phẩm trong cùng điều kiện như khi bạn nhận được, với hộp và/hoặc bao bì gốc còn nguyên vẹn. Sau khi chúng tôi nhận được sản phẩm trả lại, chúng tôi sẽ kiểm tra và nếu sản phẩm được xác nhận là bị lỗi hoặc hư hỏng, chúng tôi sẽ xử lý hoàn tiền cùng với bất kỳ khoản phí vận chuyển nào phát sinh.<br></p>\r\n'),
(4, 'Khi nào không thể hoàn trả?', '<p class=\"a  \" style=\"box-sizing: inherit; text-rendering: optimizeLegibility; line-height: 1.6; margin-bottom: 0.714286rem; padding: 0px; font-size: 14px; color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; background-color: rgb(250, 250, 250);\">Có một số trường hợp nhất định mà chúng tôi không thể hỗ trợ hoàn trả:</p><ol style=\"box-sizing: inherit; line-height: 1.6; margin-right: 0px; margin-bottom: 0px; margin-left: 1.25rem; padding: 0px; list-style-position: outside; color: rgb(10, 10, 10); font-family: opensans, &quot;Helvetica Neue&quot;, Helvetica, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(250, 250, 250);\"><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Yêu cầu hoàn trả được thực hiện sau thời gian quy định là 15 ngày kể từ khi giao hàng.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm đã qua sử dụng, bị hư hỏng hoặc không còn nguyên trạng như khi nhận được.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các danh mục sản phẩm cụ thể như đồ lót, nội y, tất và các sản phẩm quà tặng kèm.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm bị lỗi nhưng thuộc phạm vi bảo hành của nhà sản xuất.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các sản phẩm tiêu hao đã được sử dụng hoặc lắp đặt.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Sản phẩm có số sê-ri bị tẩy xóa hoặc mất.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Bất kỳ mặt hàng nào bị thiếu phụ kiện đi kèm như nhãn giá, tem mác, bao bì gốc, quà tặng kèm.</li><li style=\"box-sizing: inherit; margin: 0px; padding: 0px; font-size: inherit;\">Các sản phẩm dễ vỡ, liên quan đến vệ sinh.</li></ol>\r\n'),
(5, 'Những sản phẩm nào không thể hoàn trả?', '<p>Những sản phẩm không thể hoàn trả bao gồm:</p><p>Các sản phẩm xả kho có ghi rõ chính sách không hoàn trả<br></p><p>Khi trong điều kiện ưu đãi có ghi rõ rằng sản phẩm đó không thể hoàn trả.</p><p>Các sản phẩm thuộc các loại sau:</p><ul><li>Đồ lót</li><li>Nội y</li><li>Tất</li><li>Phần mềm</li><li>Album nhạc</li><li>Sách</li><li>Đồ bơi</li><li>Sản phẩm làm đẹp &amp; nước hoa</li><li>Vớ</li></ul><p>Ngoài ra, các sản phẩm tiêu hao đã sử dụng hoặc lắp đặt cũng không thể hoàn trả. Điều này phù hợp với Luật bảo vệ người tiêu dùng về các sản phẩm không được hoàn trả.<br></p>');


CREATE TABLE table_mid_category (
  mcat_id int(11) NOT NULL,
  mcat_name TEXT NOT NULL,
  tcat_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



INSERT INTO table_mid_category (mcat_id, mcat_name, tcat_id) VALUES
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

CREATE TABLE table_order (
  id int(11) NOT NULL,
  product_id int(11) NOT NULL,
  product_name TEXT NOT NULL,
  size varchar(100) NOT NULL,
  color varchar(100) NOT NULL,
  quantity varchar(50) NOT NULL,
  unit_price varchar(50) NOT NULL,
  payment_id TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_order (id, product_id, product_name, size, color, quantity, unit_price, payment_id) VALUES
(1, 1, 'Item 1', 'XL', 'Gray','19', '20', '1'),
(2, 2, 'Item 2', 'XL', 'Gray','19', '20', '2');

CREATE TABLE table_page (
  id int(11) NOT NULL,
  about_title TEXT NOT NULL,
  about_content text NOT NULL,
  about_banner TEXT NOT NULL,
  about_meta_title TEXT NOT NULL,
  faq_title TEXT NOT NULL,
  faq_banner TEXT NOT NULL,
  faq_meta_title TEXT NOT NULL,
  contact_title TEXT NOT NULL,
  contact_banner TEXT NOT NULL,
  contact_meta_title TEXT NOT NULL,
  pgallery_title TEXT NOT NULL,
  pgallery_banner TEXT NOT NULL,
  pgallery_meta_title TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_page (id, about_title, about_content, about_banner, 
about_meta_title, faq_title, faq_banner, faq_meta_title, 
contact_title, contact_banner, contact_meta_title, pgallery_title, 
pgallery_banner, pgallery_meta_title) 
VALUES  
(1, 'About Us', 'abcdefghiklm', 'about-banner.jpg',
'About Us', 'FAQ', 'fag-banner.jpg', 'FAQ', 
'Liên hệ', 'contact-banner.jpg', 'Liên hệ', '', 
'', '');


CREATE TABLE table_payment (
  id INT(11) NOT NULL AUTO_INCREMENT,
  customer_id INT(11) NOT NULL,
  customer_name VARCHAR(255) NOT NULL,
  customer_email VARCHAR(255) NOT NULL,
  payment_date DATETIME NOT NULL,
  txnid VARCHAR(255) NOT NULL,
  paid_amount DECIMAL(10,2) NOT NULL,
  card_number VARCHAR(50) NOT NULL,
  card_cvv VARCHAR(10) NOT NULL,
  card_month VARCHAR(10) NOT NULL,
  card_year VARCHAR(10) NOT NULL,
  bank_transaction_info TEXT NOT NULL,
  payment_method VARCHAR(20) NOT NULL,
  payment_status VARCHAR(25) NOT NULL COLLATE utf8mb4_general_ci,
  shipping_status VARCHAR(20) NOT NULL COLLATE utf8mb4_general_ci,
  payment_id VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO table_payment (
    customer_id, customer_name, customer_email, payment_date, txnid, 
    paid_amount, card_number, card_cvv, card_month, card_year, 
    bank_transaction_info, payment_method, payment_status, shipping_status, payment_id
) VALUES
(1, 'Nguyễn Văn A', 'vana@gmail.com', '2025-02-28 11:00:00', 'TXN123456A', 
    500000.00, '4111111111111111', '123', '02', '2028', 
    'Bank XYZ - Successful', 'Bank Deposit', 'Completed', 'Pending', 'PAYID123A'),

(2, 'Trần Thị B', 'anhduc9b1cva@gmail.com', '2025-02-28 11:15:00', 'TXN789101B', 
    750000.00, '5555555555554444', '456', '05', '2029', 
    'Bank ABC - Successful', 'Bank Deposit', 'Completed', 'Completed', 'PAYID456B'),
(3, 'Tran Anh Duc', 'taduc0508@gmail.com', '2025-02-22 14:25:00', 'TXN123567',
570, '432225252525', '432', '06', '2030', 'Thanh toán đơn hàng OUF3HV', 'Bank Deposit', 'Completed', 'Pending', 'PAYID456C');



CREATE TABLE table_photo (
  id int(11) NOT NULL,
  caption TEXT NOT NULL,
  photo TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_photo (id, caption, photo) VALUES
(1, 'Photo 1', 'photo-1.jpg'),
(2, 'Photo 2', 'photo-2.jpg'),
(3, 'Photo 3', 'photo-3.jpg'),
(4, 'Photo 4', 'photo-4.jpg'),
(5, 'Photo 5', 'photo-5.jpg'),
(6, 'Photo 6', 'photo-6.jpg');


CREATE TABLE table_product (
  p_id int(11) NOT NULL,
  p_name TEXT NOT NULL,
  p_old_price varchar(10) NOT NULL,
  p_current_price varchar(10) NOT NULL,
  p_qty int(10) NOT NULL,
  p_featured_photo TEXT NOT NULL,
  p_description text NOT NULL,
  p_short_description text NOT NULL,
  p_feature text NOT NULL,
  p_return_policy text NOT NULL,
  p_total_view int(11) NOT NULL,
  p_is_featured int(1) NOT NULL,
  p_is_active int(1) NOT NULL,
  ecat_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_product (p_id, p_name, p_old_price, p_current_price, p_qty, p_featured_photo, p_description, p_short_description, p_feature, p_return_policy, p_total_view, p_is_featured, p_is_active, ecat_id) VALUES
(1, 'Item1','20','10', 100,'product-featured-1.jpg','description','short description','features-list','Return policy', 5, 0, 1, 21),
(2, 'Item2','20','10', 100,'product-featured-2.jpg','description','short description','features-list','Return policy', 5, 1, 1, 32),
(3, 'Item3','20','10', 100,'product-featured-3.jpg','description','short description','features-list','Return policy', 5, 0, 1, 25),
(4, 'Item4','20','10', 100,'product-featured-4.jpg','description','short description','features-list','Return policy', 5, 1, 1, 3),
(5, 'Item5','20','10', 100,'product-featured-5.jpg','description','short description','features-list','Return policy', 5, 0, 1, 26),
(6, 'Item6','20','10', 100,'product-featured-6.jpg','description','short description','features-list','Return policy', 5, 0, 1, 21),
(7, 'Item7','20','10', 100,'product-featured-7.jpg','description','short description','features-list','Return policy', 5, 0, 1, 18),
(8, 'Item8','20','10', 100,'product-featured-8.jpg','description','short description','features-list','Return policy', 5, 0, 1, 14),
(9, 'Item9','20','10', 100,'product-featured-9.jpg','description','short description','features-list','Return policy', 5, 0, 1, 14),
(10, 'Item10','20','10', 100,'product-featured-10.jpg','description','short description','features-list','Return policy', 5, 0, 1, 60),
(11, 'Item11','20','10', 100,'product-featured-11.jpg','description','short description','features-list','Return policy', 5, 0, 1, 42),
(12, 'Item12','20','10', 100,'product-featured-12.jpg','description','short description','features-list','Return policy', 5, 0, 1, 71),
(13, 'Item13','20','10', 100,'product-featured-13.jpg','description','short description','features-list','Return policy', 5, 1, 1, 62),
(14, 'Item14','20','10', 100,'product-featured-14.jpg','description','short description','features-list','Return policy', 5, 1, 1, 20),
(15, 'Item15','20','10', 100,'product-featured-15.jpg','description','short description','features-list','Return policy', 5, 1, 1, 32),
(16, 'Item16','20','10', 100,'product-featured-16.jpg','description','short description','features-list','Return policy', 5, 1, 1, 15),
(17, 'Item17','20','10', 100,'product-featured-17.jpg','description','short description','features-list','Return policy', 5, 1, 1, 61),
(18, 'Item18','20','10', 100,'product-featured-18.jpg','description','short description','features-list','Return policy', 5, 1, 1, 73),
(19, 'Item19','20','10', 100,'product-featured-19.jpg','description','short description','features-list','Return policy', 5, 0, 1, 21),
(20, 'Item20','20','10', 100,'product-featured-20.jpg','description','short description','features-list','Return policy', 5, 1, 1, 32);
CREATE TABLE table_product_color (
  id int(11) NOT NULL,
  color_id int(11) NOT NULL,
  p_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

CREATE TABLE table_product_photo (
  pp_id int(11) NOT NULL,
  photo TEXT NOT NULL,
  p_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_product_photo (pp_id, photo, p_id) VALUES
(1, '1.jpg', 1),
(2, '2.jpg', 1),
(3, '3.jpg', 2),
(4, '4.jpg', 2),
(5, '5.jpg', 3),
(6, '6.jpg', 3),
(7, '7.jpg', 4),
(8, '8.jpg', 4),
(9, '9.jpg', 5),
(10, '10.jpg', 5),
(11, '11.jpg', 6),
(12, '12.jpg', 6),
(13, '13.jpg', 7),
(14, '14.jpg', 7),
(15, '15.jpg', 8),
(16, '16.jpg', 9),
(17, '17.jpg', 10),
(18, '18.jpg', 10),
(19, '19.jpg', 11),
(20, '20.jpg', 12),
(21, '21.jpg', 13),
(22, '22.jpg', 14),
(23, '23.jpg', 15),
(24, '24.jpg', 16),
(25, '25.jpg', 16),
(26, '26.jpg', 18),
(27, '27.jpg', 20);


CREATE TABLE table_product_size (
  id int(11) NOT NULL,
  size_id int(11) NOT NULL,
  p_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


CREATE TABLE table_rating (
  rt_id int(11) NOT NULL,
  p_id int(11) NOT NULL,
  cust_id int(11) NOT NULL,
  comment text NOT NULL,
  rating int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



CREATE TABLE table_service (
  id int(11) NOT NULL,
  title TEXT NOT NULL,
  content text NOT NULL,
  photo TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_service (id, title, content, photo) VALUES
(1, 'Hàng chọn giá hời', '', 'service-1.png'),
(2, 'Mã giảm giá', '', 'service-2.png'),
(3, 'Miễn phí ship', '', 'service-3.png'),
(4, 'GoBuy style giảm 30%', '', 'service-4.png'),
(5, 'Voucher giảm đến 1 tỷ', '', 'service-5.png'),
(6, 'Khung giờ săn sale', '', 'service-6.png'),
(7, 'Hàng quốc tế', '', 'service-7.png'),
(8, 'Nạp thẻ, Dịch vụ & Vé tàu hỏa', '', 'service-8.png');


CREATE TABLE table_settings (
  id int(11) NOT NULL,
  logo TEXT NOT NULL,
  favicon TEXT NOT NULL,
  footer_about text NOT NULL,

  footer_copyright text NOT NULL,
  contact_address text NOT NULL,
  contact_email TEXT NOT NULL,
  contact_phone TEXT NOT NULL,

  contact_map_iframe text NOT NULL,
  receive_email TEXT NOT NULL,
  receive_email_subject TEXT NOT NULL,
  receive_email_thank_you_message text NOT NULL,

  forget_password_message text NOT NULL,
  total_latest_product_home int(11) NOT NULL,
  total_popular_product_home int(11) NOT NULL,
  meta_title_home TEXT NOT NULL,
  
  banner_login TEXT NOT NULL,
  banner_registration TEXT NOT NULL,
  banner_forget_password TEXT NOT NULL,
  banner_reset_password TEXT NOT NULL,
  
  banner_search TEXT NOT NULL,
  banner_cart TEXT NOT NULL,
  banner_checkout TEXT NOT NULL,
  banner_product_category TEXT NOT NULL,
  
  cta_title TEXT NOT NULL,
  cta_content text NOT NULL,
  
  cta_read_more_text TEXT NOT NULL,
  cta_read_more_url TEXT NOT NULL,
  cta_photo TEXT NOT NULL,
  latest_product_title TEXT NOT NULL,

  latest_product_subtitle TEXT NOT NULL,
  popular_product_title TEXT NOT NULL,
  popular_product_subtitle TEXT NOT NULL,
  bank_public_key TEXT NOT NULL,
  
  bank_secret_key TEXT NOT NULL,
  bank_detail text NOT NULL,
  before_head text NOT NULL,
  after_body text NOT NULL,
  
  before_body text NOT NULL,
  home_service_on_off int(11) NOT NULL,
  home_welcome_on_off int(11) NOT NULL,
  home_latest_product_on_off int(11) NOT NULL,
  home_popular_product_on_off int(11) NOT NULL) 
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_settings 
(id, logo, favicon, footer_about, 
footer_copyright, contact_address, contact_email, contact_phone, 
contact_map_iframe, receive_email, receive_email_subject, receive_email_thank_you_message, 
forget_password_message, total_latest_product_home, total_popular_product_home, meta_title_home, 
banner_login, banner_registration, banner_forget_password, banner_reset_password, 
banner_search, banner_cart, banner_checkout, banner_product_category, 
cta_title, cta_content, 
cta_read_more_text, cta_read_more_url, cta_photo, latest_product_title, 
latest_product_subtitle, popular_product_title, popular_product_subtitle, bank_public_key, 
bank_secret_key, bank_detail, before_head, after_body, 
before_body, home_service_on_off, home_welcome_on_off, home_latest_product_on_off, 
home_popular_product_on_off) 
VALUES
(1, 'logo.png', 'favicon.png', 'Đây là một website bán hàng, đồ án môn học IS207 tại UIT', 
'GoBuy - Duck123', 'Thu Duc, TP.HCM', 'taduc0508@gmail.com', '0123456789',
'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.738228322354!2d106.80321571480056!3d10.870084060477334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527c1c6e8b1b9%3A0x3a8e6e5c6f5e6b8a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjhu41uZyB0aW4g4oCTIMSQSCBRR00gVGjhu6cgUXXhuq1jIEdpYSBUcC5ISQ!5e0!3m2!1svi!2s!4v1616581234567" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>', 'taduc0508@gmail.com', 'Email messages from GoBuy visitors', 'Cảm ơn bạn đã gửi email. Chúng tôi sẽ liên hệ với bạn sớm.', 
'Một liên kết xác nhận đã được gửi đến địa chỉ email của bạn. Bạn sẽ nhận được thông tin đặt lại mật khẩu trong đó.', 6, 8, 'GoBuy', 
'banner_login.jpg', 'banner_registration.jpg', 'banner_forget_password.jpg', 'banner_reset_password.jpg', 
'banner_search.jpg', 'banner_cart.jpg', 'banner_checkout.jpg', 'banner_product_category.jpg', 
'Chào mừng đến với GoBuy', 'GoBuy - nền tảng thương mại điện tử đáng tin cậy! Khám phá hàng ngàn sản phẩm chất lượng với giá tốt nhất, cùng những ưu đãi hấp dẫn mỗi ngày. Mua sắm dễ dàng, thanh toán an toàn, giao hàng nhanh chóng!', 
'Xem thêm', '#', 'cta.jpg', 'Sản phẩm mới nhất', 
'Danh sách những sản phẩm mới nhất', 'Sẩn phẩm phổ biến', 'Sản phẩm phổ biến dựa trên lựa chọn của khách hàng', 'xxxxxx', 
'yyyyyy', 'Bank Name: AAAAAAA\r\nAccount Number: 1234567\r\nBranch Name: AAAAAA', '', '', 
'', 1, 1, 1, 1);


CREATE TABLE table_shipping_cost (
  shipping_cost_id int(11) NOT NULL,
  province_id int(11) NOT NULL,
  amount varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_shipping_cost (shipping_cost_id, province_id, amount) VALUES
(1, 1, '500'),
(2, 2, '450'),
(3, 3, '600'),
(4, 4, '550'),
(5, 5, '700'),
(6, 6, '600'),
(7, 7, '620'),
(8, 8, '530'),
(9, 9, '590'),
(10, 10, '750');

CREATE TABLE table_size (
  size_id int(11) NOT NULL,
  size_name TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_size (size_id, size_name) VALUES
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

CREATE TABLE table_slider (
  id int(11) NOT NULL,
  photo TEXT NOT NULL,
  heading TEXT NOT NULL,
  content text NOT NULL,
  button_text TEXT NOT NULL,
  button_url TEXT NOT NULL,
  position TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



INSERT INTO table_slider (id, photo, heading, content, button_text, button_url, position) VALUES
(1, 'slider-1.png', 'Welcome to Shọppe', 'Cửa hàng phụ kiện mới nhất cho nam', 'Xem phụ kiện cho nam', '#', 'Center'),
(2, 'slider-2.jpg', 'Giảm giá 50% cho tất cả sản phẩm', 'Mua nhanh đi không hết bây giờ.', 'Read More', '#', 'Center'),
(3, 'slider-3.png', 'Hỗ trợ 24/7', 'Đội ngũ nhân viên cam kết phục vụ tận tình.', 'Read More', '#', 'Right');



CREATE TABLE table_social (
  social_id int(11) NOT NULL,
  social_name varchar(30) NOT NULL,
  social_url TEXT NOT NULL,
  social_icon varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_social (social_id, social_name, social_url, social_icon) VALUES
(1, 'Facebook', 'https://www.facebook.com/#', 'fa fa-facebook'),
(2, 'Twitter', 'https://www.twitter.com/#', 'fa fa-twitter'),
(3, 'YouTube', 'https://www.youtube.com/#', 'fa fa-youtube'),
(4, 'Instagram', 'https://www.instagram.com/#', 'fa fa-instagram');



CREATE TABLE table_top_category (
  tcat_id int(11) NOT NULL,
  tcat_name TEXT NOT NULL,
  show_on_menu int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



INSERT INTO table_top_category (tcat_id, tcat_name, show_on_menu) VALUES
(1, 'Nam', 1),
(2, 'Nữ', 1),
(3, 'Trẻ em', 1),
(4, 'Đồ điện tử', 1),
(5, 'Đồ gia dụng', 1);



CREATE TABLE table_user (
  id int(10) NOT NULL,
  full_name varchar(100) NOT NULL,
  email TEXT NOT NULL,
  phone varchar(100) NOT NULL,
  password TEXT NOT NULL,
  photo TEXT NOT NULL,
  token TEXT NOT NULL,
  datetime varchar(100) NOT NULL,
  timestamp varchar(100) NOT NULL,
  status int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_user (id, full_name, email, phone, password, photo, token, datetime, timestamp,`status`) 
VALUES
(1, 'admin', 'admin@mail.com', '7777777777', 'd00f5d5217896fb7fd601412cb890830', 'admin-1.png', 'xxxx', '23-2-2025', '25-2-2025', 'Active');

-- Thêm các khóa chính

ALTER TABLE table_color
  ADD PRIMARY KEY (color_id);

ALTER TABLE table_province
  ADD PRIMARY KEY (province_id);


ALTER TABLE table_customer
  ADD PRIMARY KEY (cust_id);


ALTER TABLE table_customer_message
  ADD PRIMARY KEY (customer_message_id);


ALTER TABLE table_end_category
  ADD PRIMARY KEY (ecat_id);


ALTER TABLE table_faq
  ADD PRIMARY KEY (faq_id);

ALTER TABLE table_mid_category
  ADD PRIMARY KEY (mcat_id);

ALTER TABLE table_order
  ADD PRIMARY KEY (id);

ALTER TABLE table_page
  ADD PRIMARY KEY (id);

ALTER TABLE table_photo
  ADD PRIMARY KEY (id);

ALTER TABLE table_product
  ADD PRIMARY KEY (p_id);

ALTER TABLE table_product_color
  ADD PRIMARY KEY (id);


ALTER TABLE table_product_photo
  ADD PRIMARY KEY (pp_id);


ALTER TABLE table_product_size
  ADD PRIMARY KEY (id);

ALTER TABLE table_rating
  ADD PRIMARY KEY (rt_id);

ALTER TABLE table_service
  ADD PRIMARY KEY (id);

ALTER TABLE table_settings
  ADD PRIMARY KEY (id);

ALTER TABLE table_shipping_cost
  ADD PRIMARY KEY (shipping_cost_id);

ALTER TABLE table_size
  ADD PRIMARY KEY (size_id);

ALTER TABLE table_slider
  ADD PRIMARY KEY (id);

ALTER TABLE table_social
  ADD PRIMARY KEY (social_id);

ALTER TABLE table_top_category
  ADD PRIMARY KEY (tcat_id);

ALTER TABLE table_user
  ADD PRIMARY KEY (id);


-- Tự động tăng ID (AUTO_INCREMENT) cho các bảng khi thêm các đối tượng


ALTER TABLE table_color
  MODIFY color_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;


ALTER TABLE table_customer
  MODIFY cust_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE table_customer_message
  MODIFY customer_message_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE table_end_category
  MODIFY ecat_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

ALTER TABLE table_faq
  MODIFY faq_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE table_mid_category
  MODIFY mcat_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE table_order
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE table_page
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE table_payment
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE table_photo
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE table_product
  MODIFY p_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE table_product_color
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE table_product_photo
  MODIFY pp_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE table_product_size
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE table_rating
  MODIFY rt_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE table_service
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE table_settings
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE table_shipping_cost
  MODIFY shipping_cost_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE table_size
  MODIFY size_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE table_slider
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE table_social
  MODIFY social_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE table_top_category
  MODIFY tcat_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE table_user
  MODIFY id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;