<?php 
$open = "user";
require_once __DIR__.'/../../autoload/autoload.php';
// lấy id
$id = intval(getInput('id'));
// lấy thông tin 
$deleteID = $db -> fetchID('user', $id);
if (empty($deleteID)) {
	$_SESSION['error'] = "Sản Phẩm Không Tồn Tại";
	redirectAdmin('user');
}

// còn check user

$result = $db -> delete('user', $id);
if ($result > 0) {
	$_SESSION['success'] = "Bạn đã xóa thành công";
	redirectAdmin('user');
}
else {
	$_SESSION['error'] = "Xóa không thành công";
	redirectAdmin('user');
}

?>