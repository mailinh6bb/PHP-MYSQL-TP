<?php 
require_once __DIR__.'/autoload/autoload.php';
$idPro = $_GET['idPro'];
$qty = $_GET['qty'];
$product = $db -> fetchID('product', $idPro);
if ($product['number'] > 0) {
	$_SESSION['cart'][$idPro]['qty'] = $qty;
		$message = "cập nhật giỏ hàng thành công";
}
else {
	$message = "số lượng quá lớn";
}


echo $message; 
?>