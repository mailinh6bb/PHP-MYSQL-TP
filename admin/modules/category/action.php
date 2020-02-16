<?php 
require_once __DIR__.'/../../autoload/autoload.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$resulf = $db -> fetchID("category",$id);
	$home = $resulf['home'] == 0 ? 1 : 0;
	$updateHome = $db -> update("category", array("home" => $home), array('id' => $id));
	redirectAdmin('category');
}
?>