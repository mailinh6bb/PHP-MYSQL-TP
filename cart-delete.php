<?php 
require_once __DIR__.'/autoload/autoload.php';
if (isset($_SESSION['cart'])) {
	$id = intval(getInput('id'));
	unset($_SESSION['cart'][$id]);
	redirectStyle('cart.php');
}
?>