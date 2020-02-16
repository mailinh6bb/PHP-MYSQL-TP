<?php 
require_once __DIR__.'/../../autoload/autoload.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$resulf = $db -> fetchID("product",$id);
	$hot = $resulf['hot'] == 0 ? 1 : 0;
	$updateHome = $db -> update("product", array("hot" => $hot), array('id' => $id));
	redirectAdmin('product');
}
?>