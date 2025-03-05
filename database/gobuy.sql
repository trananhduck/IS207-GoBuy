SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";
SET NAMES utf8mb4;

-- Database: gobuy

-- Lần lượt tạo các bảng và thêm dữ liệu mẫu
CREATE TABLE table_color (
  color_id int(11) NOT NULL,
  color_name TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

CREATE TABLE table_country (
  country_id int(11) NOT NULL,
  country_name varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE table_customer (
  cust_id int(11) NOT NULL,
  cust_name varchar(100) NOT NULL,
  cust_cname varchar(100) NOT NULL,
  cust_email varchar(100) NOT NULL,
  cust_phone varchar(50) NOT NULL,
  cust_country int(11) NOT NULL,
  cust_address text NOT NULL,
  cust_city varchar(100) NOT NULL,
  cust_zip varchar(30) NOT NULL,
  cust_b_name varchar(100) NOT NULL,
  cust_b_cname varchar(100) NOT NULL,
  cust_b_phone varchar(50) NOT NULL,
  cust_b_country int(11) NOT NULL,
  cust_b_address text NOT NULL,
  cust_b_city varchar(100) NOT NULL,
  cust_b_zip varchar(30) NOT NULL,
  cust_s_name varchar(100) NOT NULL,
  cust_s_cname varchar(100) NOT NULL,
  cust_s_phone varchar(50) NOT NULL,
  cust_s_country int(11) NOT NULL,
  cust_s_address text NOT NULL,
  cust_s_city varchar(100) NOT NULL,
  cust_s_zip varchar(30) NOT NULL,
  cust_password varchar(100) NOT NULL,
  cust_token TEXT NOT NULL,
  cust_datetime varchar(100) NOT NULL,
  cust_timestamp varchar(100) NOT NULL,
  cust_status int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_customer (cust_id, cust_name, cust_cname, cust_email, cust_phone, cust_country, cust_address, cust_city, cust_zip, cust_b_name, cust_b_cname, cust_b_phone, cust_b_country, cust_b_address, cust_b_city, cust_b_zip, cust_s_name, cust_s_cname, cust_s_phone, cust_s_country, cust_s_address, cust_s_city, cust_s_zip, cust_password, cust_token, cust_datetime, cust_timestamp, cust_status) VALUES
(1, 'Nguyễn Văn A', 'Công ty ABC', 'vana@gmail.com', '0905123456', 84, '123 Đường Lê Lợi', 'Hà Nội', '100000', 'Nguyễn Văn A', 'Công ty ABC', '0905123456', 84, '123 Đường Lê Lợi', 'Hà Nội', '100000', 'Nguyễn Văn A', 'Công ty ABC', '0905123456', 84, '123 Đường Lê Lợi', 'Hà Nội', '100000', '5f4dcc3b5aa765d61d8327deb882cf99', 'abc123token1', '2025-02-28 10:00:00', '1746031200', 1),
(2, 'Trần Thị B', 'Công ty XYZ', 'thib@gmail.com', '0914345678', 84, '456 Đường Trần Hưng Đạo', 'TP. Hồ Chí Minh', '700000', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'xyz456token2', '2025-02-28 10:10:00', '1746031800', 1),
(3, 'Lê Văn C', 'none', 'levan@gmail.com', '0923456789', 84, '789 Đường Nguyễn Huệ', 'Đà Nẵng', '550000', 'Lê Văn C', 'none', '0923456789', 84, '789 Đường Nguyễn Huệ', 'Đà Nẵng', '550000', 'Lê Văn C', 'none', '0923456789', 84, '789 Đường Nguyễn Huệ', 'Đà Nẵng', '550000', '5f4dcc3b5aa765d61d8327deb882cf99', 'token789', '2025-02-28 10:20:00', '1746032400', 1),
(4, 'Phạm Minh D', 'Công ty DEF', 'minhd@gmail.com', '0934567890', 84, '234 Đường Hoàng Diệu', 'Cần Thơ', '900000', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'token456', '2025-02-28 10:30:00', '1746033000', 1),
(5, 'Hoàng Ngọc E', 'none', 'ngoc.e@gmail.com', '0945678901', 84, '567 Đường Phan Chu Trinh', 'Huế', '530000', 'Hoàng Ngọc E', 'none', '0945678901', 84, '567 Đường Phan Chu Trinh', 'Huế', '530000', 'Hoàng Ngọc E', 'none', '0945678901', 84, '567 Đường Phan Chu Trinh', 'Huế', '530000', '5f4dcc3b5aa765d61d8327deb882cf99', 'token123', '2025-02-28 10:40:00', '1746033600', 1),
(6, 'Đặng Quốc F', 'Công ty GHI', 'quocf@gmail.com', '0956789012', 84, '890 Đường Lý Thường Kiệt', 'Hải Phòng', '180000', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'ghi789token', '2025-02-28 10:50:00', '1746034200', 1),
(7, 'Bùi Thanh G', 'none', 'thanhg@gmail.com', '0967890123', 84, '321 Đường Hai Bà Trưng', 'Nha Trang', '650000', 'Bùi Thanh G', 'none', '0967890123', 84, '321 Đường Hai Bà Trưng', 'Nha Trang', '650000', 'Bùi Thanh G', 'none', '0967890123', 84, '321 Đường Hai Bà Trưng', 'Nha Trang', '650000', '5f4dcc3b5aa765d61d8327deb882cf99', 'token456ghi', '2025-02-28 11:00:00', '1746034800', 1),
(8, 'Ngô Hà H', 'Công ty JKL', 'hahang@gmail.com', '0978901234', 84, '123 Đường Nguyễn Trãi', 'Bình Dương', '750000', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'jkl789token', '2025-02-28 11:10:00', '1746035400', 1),
(9, 'Võ Anh I', 'none', 'voanh@gmail.com', '0989012345', 84, '456 Đường Nguyễn Văn Linh', 'Hà Nội', '100000', 'Võ Anh I', 'none', '0989012345', 84, '456 Đường Nguyễn Văn Linh', 'Hà Nội', '100000', 'Võ Anh I', 'none', '0989012345', 84, '456 Đường Nguyễn Văn Linh', 'Hà Nội', '100000', '5f4dcc3b5aa765d61d8327deb882cf99', 'token654321', '2025-02-28 11:20:00', '1746036000', 1),
(10, 'Phan Đức K', 'Công ty MNO', 'duck@gmail.com', '0990123456', 84, '789 Đường Trường Chinh', 'TP. Hồ Chí Minh', '700000', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'token987mno', '2025-02-28 11:30:00', '1746036600', 1);



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
(16, 'Quần', 😎,
(17, 'Quần jeans', 😎,
(18, 'Quần jogger', 😎,
(19, 'Quần short', 😎,
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




CREATE TABLE table_page (
  id int(11) NOT NULL,
  about_title TEXT NOT NULL,
  about_content text NOT NULL,
  about_banner TEXT NOT NULL,
  about_meta_title TEXT NOT NULL,
  about_meta_keyword text NOT NULL,
  about_meta_description text NOT NULL,
  faq_title TEXT NOT NULL,
  faq_banner TEXT NOT NULL,
  faq_meta_title TEXT NOT NULL,
  faq_meta_keyword text NOT NULL,
  faq_meta_description text NOT NULL,
  blog_title TEXT NOT NULL,
  blog_banner TEXT NOT NULL,
  blog_meta_title TEXT NOT NULL,
  blog_meta_keyword text NOT NULL,
  blog_meta_description text NOT NULL,
  contact_title TEXT NOT NULL,
  contact_banner TEXT NOT NULL,
  contact_meta_title TEXT NOT NULL,
  contact_meta_keyword text NOT NULL,
  contact_meta_description text NOT NULL,
  pgallery_title TEXT NOT NULL,
  pgallery_banner TEXT NOT NULL,
  pgallery_meta_title TEXT NOT NULL,
  pgallery_meta_keyword text NOT NULL,
  pgallery_meta_description text NOT NULL,
  vgallery_title TEXT NOT NULL,
  vgallery_banner TEXT NOT NULL,
  vgallery_meta_title TEXT NOT NULL,
  vgallery_meta_keyword text NOT NULL,
  vgallery_meta_description text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_page (id, about_title, about_content, about_banner, about_meta_title, about_meta_keyword, about_meta_description, faq_title, faq_banner, faq_meta_title, faq_meta_keyword, faq_meta_description, blog_title, blog_banner, blog_meta_title, blog_meta_keyword, blog_meta_description, contact_title, contact_banner, contact_meta_title, contact_meta_keyword, contact_meta_description, pgallery_title, pgallery_banner, pgallery_meta_title, pgallery_meta_keyword, pgallery_meta_description, vgallery_title, vgallery_banner, vgallery_meta_title, vgallery_meta_keyword, vgallery_meta_description) VALUES
(1, 'About Us', 'abcdefghiklm', '', '', '','','','','','','','', '', '', '','','','','','','','','', '', '','','','','','','');


CREATE TABLE table_payment (
  id int(11) NOT NULL,
  customer_id int(11) NOT NULL,
  customer_name TEXT NOT NULL,
  customer_email TEXT NOT NULL,
  payment_date varchar(50) NOT NULL,
  txnid TEXT NOT NULL,
  paid_amount int(11) NOT NULL,
  card_number varchar(50) NOT NULL,
  card_cvv varchar(10) NOT NULL,
  card_month varchar(10) NOT NULL,
  card_year varchar(10) NOT NULL,
  bank_transaction_info text NOT NULL,
  payment_method varchar(20) NOT NULL,
  payment_status varchar(25) NOT NULL,
  shipping_status varchar(20) NOT NULL,
  payment_id TEXT NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
(7, 'Item7','20','10', 100,'product-featured-77.jpg','description','short description','features-list','Return policy', 5, 0, 1, 18),
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
(18, 'Item18','20','10', 100,'product-featured-1818.jpg','description','short description','features-list','Return policy', 5, 1, 1, 73),
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
(15, '15.jpg', 😎,
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
(5, 'Voucher giảm đến 1 tỷ', '', 'serivce-5.png'),
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
  contact_fax TEXT NOT NULL,
  contact_map_iframe text NOT NULL,
  receive_email TEXT NOT NULL,
  receive_email_subject TEXT NOT NULL,
  receive_email_thank_you_message text NOT NULL,
  forget_password_message text NOT NULL,
  total_recent_post_footer int(10) NOT NULL,
  total_popular_post_footer int(10) NOT NULL,
  total_recent_post_sidebar int(11) NOT NULL,
  total_popular_post_sidebar int(11) NOT NULL,
  total_featured_product_home int(11) NOT NULL,
  total_latest_product_home int(11) NOT NULL,
  total_popular_product_home int(11) NOT NULL,
  meta_title_home text NOT NULL,
  meta_keyword_home text NOT NULL,
  meta_description_home text NOT NULL,
  banner_login TEXT NOT NULL,
  banner_registration TEXT NOT NULL,
  banner_forget_password TEXT NOT NULL,
  banner_reset_password TEXT NOT NULL,
  banner_search TEXT NOT NULL,
  banner_cart TEXT NOT NULL,
  banner_checkout TEXT NOT NULL,
  banner_product_category TEXT NOT NULL,
  banner_blog TEXT NOT NULL,
  cta_title TEXT NOT NULL,
  cta_content text NOT NULL,
  cta_read_more_text TEXT NOT NULL,
  cta_read_more_url TEXT NOT NULL,
  cta_photo TEXT NOT NULL,
  featured_product_title TEXT NOT NULL,
  featured_product_subtitle TEXT NOT NULL,
  latest_product_title TEXT NOT NULL,
  latest_product_subtitle TEXT NOT NULL,
  popular_product_title TEXT NOT NULL,
  popular_product_subtitle TEXT NOT NULL,
  testimonial_title TEXT NOT NULL,
  testimonial_subtitle TEXT NOT NULL,
  testimonial_photo TEXT NOT NULL,
  blog_title TEXT NOT NULL,
  blog_subtitle TEXT NOT NULL,
  newsletter_text text NOT NULL,
  bank_public_key TEXT NOT NULL,
  bank_secret_key TEXT NOT NULL,
  bank_detail text NOT NULL,
  before_head text NOT NULL,
  after_body text NOT NULL,
  before_body text NOT NULL,
  home_service_on_off int(11) NOT NULL,
  home_welcome_on_off int(11) NOT NULL,
  home_featured_product_on_off int(11) NOT NULL,
  home_latest_product_on_off int(11) NOT NULL,
  home_popular_product_on_off int(11) NOT NULL,
  home_testimonial_on_off int(11) NOT NULL,
  home_blog_on_off int(11) NOT NULL,
  newsletter_on_off int(11) NOT NULL,
  ads_above_welcome_on_off int(1) NOT NULL,
  ads_above_featured_product_on_off int(1) NOT NULL,
  ads_above_latest_product_on_off int(1) NOT NULL,
  ads_above_popular_product_on_off int(1) NOT NULL,
  ads_above_testimonial_on_off int(1) NOT NULL,
  ads_category_sidebar_on_off int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_settings 
(id, logo, favicon, footer_about, footer_copyright, contact_address, contact_email, contact_phone, contact_fax, contact_map_iframe, receive_email, receive_email_subject, receive_email_thank_you_message, forget_password_message, total_recent_post_footer, total_popular_post_footer, total_recent_post_sidebar, total_popular_post_sidebar, total_featured_product_home, total_latest_product_home, total_popular_product_home, meta_title_home, meta_keyword_home, meta_description_home, banner_login, banner_registration, banner_forget_password, banner_reset_password, banner_search, banner_cart, banner_checkout, banner_product_category, banner_blog, cta_title, cta_content, cta_read_more_text, cta_read_more_url, cta_photo, featured_product_title, featured_product_subtitle, latest_product_title, latest_product_subtitle, popular_product_title, popular_product_subtitle, testimonial_title, testimonial_subtitle, testimonial_photo, blog_title, blog_subtitle, newsletter_text, bank_public_key, bank_secret_key, bank_detail, before_head, after_body, before_body, home_service_on_off, home_welcome_on_off, home_featured_product_on_off, home_latest_product_on_off, home_popular_product_on_off, home_testimonial_on_off, home_blog_on_off, newsletter_on_off, ads_above_welcome_on_off, ads_above_featured_product_on_off, ads_above_latest_product_on_off, ads_above_popular_product_on_off, ads_above_testimonial_on_off, ads_category_sidebar_on_off) 
VALUES
(1, 'logo.png', 'favicon.png', 
'<p>Đây là một website bán hàng, đồ án môn học IS207 tại UIT</p>', 
'GoBuy - Duck123', 
'Thu Duc, TP.HCM', 
'abc123@gmail.com', '0123456789', '', 

'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.738228322354!2d106.80321571480056!3d10.870084060477334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527c1c6e8b1b9%3A0x3a8e6e5c6f5e6b8a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjhu41uZyB0aW4g4oCTIMSQSCBRR00gVGjhu6cgUXXhuq1jIEdpYSBUcC5ISQ!5e0!3m2!1svi!2s!4v1616581234567" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>', 

'abc123@gmail.com', 
'Tin nhắn email từ khách truy cập GoBuy', 
'Cảm ơn bạn đã gửi email. Chúng tôi sẽ liên hệ với bạn sớm.', 
'Một liên kết xác nhận đã được gửi đến địa chỉ email của bạn. Bạn sẽ nhận được thông tin đặt lại mật khẩu trong đó.', 

4, 4, 5, 5, 5, 6, 8, 
'GoBuy', 
'online fashion store, garments shop, online garments', 
'GoBuy project with mysql database', 

'banner_login.jpg', 'banner_registration.jpg', 'banner_forget_password.jpg', 'banner_reset_password.jpg', 'banner_search.jpg', 'banner_cart.jpg', 'banner_checkout.jpg', 'banner_product_category.jpg', 'banner_blog.jpg', 

'Chào mừng đến với GoBuy', 
'GoBuy - nền tảng thương mại điện tử đáng tin cậy! Khám phá hàng ngàn sản phẩm chất lượng với giá tốt nhất, cùng những ưu đãi hấp dẫn mỗi ngày. Mua sắm dễ dàng, thanh toán an toàn, giao hàng nhanh chóng!', 
'Xem thêm', '#', 'cta.jpg', 

'Sản phẩm nổi bật', 'Top sản phẩm nổi bật', 
'Sản phẩm mới nhất', 'Danh sách những sản phẩm mới nhất', 
'Sẩn phẩm phổ biến', 'Sản phẩm phổ biến dựa trên lựa chọn của khách hàng', 

'Đánh giá từ khách hàng', 'Xem khách hàng nói gì về chúng tôi', 'testimonial.jpg', 
'Blog mới nhất', 'Xem tất cả bài viết và tin tức mới nhất của chúng tôi bên dưới', 
'Đăng ký nhận thông báo để nhận các khuyến mãi và giảm giá mới nhất', 

'xxxxxx', 'yyyyyy', 
'Bank Name: AAAAAAA\r\nAccount Number: 1234567\r\nBranch Name: AAAAAA', '', '', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);



CREATE TABLE table_shipping_cost (
  shipping_cost_id int(11) NOT NULL,
  country_id int(11) NOT NULL,
  amount varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;





CREATE TABLE table_shipping_cost_all (
  sca_id int(11) NOT NULL,
  amount varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO table_shipping_cost_all (sca_id, amount) VALUES
(1, '100');



CREATE TABLE table_size (
  size_id int(11) NOT NULL,
  size_name TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



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



CREATE TABLE table_admin (
  id int(10) NOT NULL,
  full_name varchar(100) NOT NULL,
  email TEXT NOT NULL,
  phone varchar(100) NOT NULL,
  password TEXT NOT NULL,
  photo TEXT NOT NULL,
  role varchar(30) NOT NULL,
  status varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



INSERT INTO table_admin (id, full_name, email, phone, password, photo, role, status) VALUES
(1, 'admin', 'admin@mail.com', '7777777777', 'd00f5d5217896fb7fd601412cb890830', 'admin-1.png', 'Admin', 'Active');


CREATE TABLE table_video (
  id int(11) NOT NULL,
  title TEXT NOT NULL,
  iframe_code text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


INSERT INTO table_video (id, title, iframe_code) VALUES
(1, 'Video 1', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/watch?v=xWj-adZemk4" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>');

-- Thêm các khóa chính

ALTER TABLE table_color
  ADD PRIMARY KEY (color_id);

ALTER TABLE table_country
  ADD PRIMARY KEY (country_id);


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

ALTER TABLE table_payment
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

ALTER TABLE table_shipping_cost_all
  ADD PRIMARY KEY (sca_id);

ALTER TABLE table_size
  ADD PRIMARY KEY (size_id);

ALTER TABLE table_slider
  ADD PRIMARY KEY (id);

ALTER TABLE table_social
  ADD PRIMARY KEY (social_id);

ALTER TABLE table_top_category
  ADD PRIMARY KEY (tcat_id);

ALTER TABLE table_admin
  ADD PRIMARY KEY (id);

ALTER TABLE table_video
  ADD PRIMARY KEY (id);

-- Tự động tăng ID (AUTO_INCREMENT) cho các bảng khi thêm các đối tượng


ALTER TABLE table_color
  MODIFY color_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;


ALTER TABLE table_customer
  MODIFY cust_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE table_customer_message
  MODIFY customer_message_id int(11) NOT NULL;

ALTER TABLE table_end_category
  MODIFY ecat_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

ALTER TABLE table_faq
  MODIFY faq_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE table_mid_category
  MODIFY mcat_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE table_order
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

ALTER TABLE table_shipping_cost_all
  MODIFY sca_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE table_size
  MODIFY size_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE table_slider
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE table_social
  MODIFY social_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE table_top_category
  MODIFY tcat_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE table_admin
  MODIFY id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE table_video
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;