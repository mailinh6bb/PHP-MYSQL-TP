<?php require_once __DIR__.'/autoload/autoload.php'; ?>
<?php $id = intval(getInput('id'));
$product = $db -> fetchID('product', $id);
// Tạo session giỏ hàng
if (!isset($_SESSION['cart'][$id])) {
	$_SESSION['cart'][$id]['name'] = $product['name'];
	$_SESSION['cart'][$id]['avatar'] = $product['avatar'];
	$_SESSION['cart'][$id]['price'] = $product['price'];
	$_SESSION['cart'][$id]['sale'] = $product['sale'];
	$_SESSION['cart'][$id]['qty'] = 1;
}
else{
	$_SESSION['cart'][$id]['qty'] += 1;
}

echo '<script> alert("Thêm Vào Giỏ Hàng Thành Công"); history.back()</script>';
?>