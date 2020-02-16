<?php 
$open = "product";
require_once __DIR__.'/../../autoload/autoload.php';
// lấy id
$id = intval(getInput('id'));
// lấy thông tin 
$deleteID = $db -> fetchID('product', $id);
if (empty($deleteID)) {
	$_SESSION['error'] = "Sản Phẩm Không Tồn Tại";
	redirectAdmin('product');
}

// còn check product

$result = $db -> delete('product', $id);
if ($result > 0) {
	$_SESSION['success'] = "Bạn đã xóa thành công";
	redirectAdmin('product');
}
else {
	$_SESSION['error'] = "Xóa không thành công";
	redirectAdmin('product');
}

?>