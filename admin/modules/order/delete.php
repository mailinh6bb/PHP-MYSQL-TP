<?php 
require_once __DIR__.'/../../autoload/autoload.php';
// lấy id
$id = intval(getInput('id'));
// lấy thông tin 
$deleteID = $db -> fetchID('transactions', $id);
if (empty($deleteID)) {
	$_SESSION['error'] = "Đơn Hàng Không Tồn Tại";
	redirectAdmin('order');
}

// còn check product

$result = $db -> delete('transactions', $id);
if ($result > 0) {
	$_SESSION['success'] = "Bạn đã xóa thành công";
	redirectAdmin('order');
}
else {
	$_SESSION['error'] = "Xóa không thành công";
	redirectAdmin('order');
}

?>