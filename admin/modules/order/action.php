<?php 
require_once __DIR__.'/../../autoload/autoload.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$resulf = $db -> fetchID("transactions",$id);
	$status = $resulf['status'] == 0 ? 1 : 0;
	$updatestatus = $db -> update("transactions", array("status" => $status), array('id' => $id));
	if ($updatestatus > 0) {
		// kiểm tra đơn hàng và trừ đi số lượng sản phẩm
		$sql = "SELECT orders.product_id, orders.qty  FROM orders
		WHERE orders.transaction_id = $id  ";
		$id_pro_order = $db -> fetchsql($sql);
	}
	// lọc id và số lương trong order
	foreach ($id_pro_order as $value) {
		$id_pro = intval($value['product_id']);
		$product = $db -> fetchID('product', $id_pro);
		$number = $product['number'] - $value['qty'];
		$pay = $product['user_pay']+$value['qty'];
		if ($product['price'] > $value['qty']) {
			$id_update_pro = $db -> update('product', array('number' => $number, 'user_pay' => $pay), array('id' => $id_pro));
			$_SESSION['success'] = "Xử lý đơn hàng thành công";
			redirectAdmin('order');
		}
		else {
			$_SESSION['error'] = "Thất bại! Sản phẩm đã hết hàng!";
			redirectAdmin('order');
		}

	}

}
?>