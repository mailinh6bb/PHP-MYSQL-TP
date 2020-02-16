<?php 
require_once __DIR__.'/../../autoload/autoload.php';
// lấy id
$id = intval(getInput('id'));
// lấy thông tin 
$editID = $db -> fetchID('category', $id);
if (empty($editID)) {
	$_SESSION['error'] = "Danh Mục Không Tồn Tại";
	redirectAdmin('category');
}

// còn check product
$is_product = $db -> fetchOne('product', " category_id = $id ");
if ($is_product == null) {
	$result = $db -> delete('category', $id);
	if ($result > 0) {
		$_SESSION['success'] = "Bạn đã xóa thành công";
		redirectAdmin('category');
	}
	else {
		$_SESSION['error'] = "Xóa không thành công";
		redirectAdmin('category');
	}
}
else {
	$_SESSION['error'] = "Danh Mục Có Sản Phẩm! Bạn Không Thể Xóa!";
	redirectAdmin('category');
}


?>