<?php
// Hàm lấy phần mở rộng của tệp tin được tải lên
function get_ext($pdo, $fname)
{
	// Lấy tên tệp tin gốc
	$up_filename = $_FILES[$fname]["name"];

	// Tách phần tên tệp tin (loại bỏ phần mở rộng)
	$file_basename = substr($up_filename, 0, strripos($up_filename, '.'));

	// Tách phần mở rộng của tệp tin
	$file_ext = substr($up_filename, strripos($up_filename, '.'));

	return $file_ext;
}

// Hàm kiểm tra phần mở rộng của tệp tin có hợp lệ không
function ext_check($pdo, $allowed_ext, $my_ext)
{
	// Tạo một mảng chứa danh sách phần mở rộng được phép
	$arr1 = array();
	$arr1 = explode("|", $allowed_ext);
	$count_arr1 = count($arr1);

	// Thêm dấu chấm (.) trước mỗi phần mở rộng để so sánh
	for ($i = 0; $i < $count_arr1; $i++) {
		$arr1[$i] = '.' . $arr1[$i];
	}

	// Kiểm tra xem phần mở rộng của tệp có nằm trong danh sách cho phép không
	$stat = 0;
	for ($i = 0; $i < $count_arr1; $i++) {
		if ($my_ext == $arr1[$i]) {
			$stat = 1;
			break;
		}
	}

	// Trả về kết quả kiểm tra
	return $stat == 1 ? true : false;
}

// Hàm lấy ID tự động tăng tiếp theo của một bảng trong database
function get_ai_id($pdo, $tbl_name)
{
	// Truy vấn để lấy thông tin về trạng thái của bảng
	$statement = $pdo->prepare("SHOW TABLE STATUS LIKE '$tbl_name'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);

	// Lấy giá trị Auto Increment tiếp theo
	foreach ($result as $row) {
		$next_id = $row['Auto_increment'];
	}

	return $next_id;
}