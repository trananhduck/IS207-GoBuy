<?php
// Bật hiển thị lỗi
ini_set('error_reporting', E_ALL);

// Thiết lập múi giờ Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Tên máy chủ
$dbhost = 'localhost';

// Tên cơ sở dữ liệu
$dbname = 'gobuy';

// Tên người dùng cơ sở dữ liệu
$dbuser = 'root';

// Mật khẩu cơ sở dữ liệu
$dbpass = '';

// Định nghĩa đường dẫn gốc
define("BASE_URL", "");

// Định nghĩa đường dẫn quản trị
define("ADMIN_URL", BASE_URL . "admin" . "/");

try {
	// Kết nối cơ sở dữ liệu bằng PDO
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
	// Xử lý lỗi kết nối
	echo "Lỗi kết nối: " . $exception->getMessage();
}
