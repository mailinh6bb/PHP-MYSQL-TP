<?php 
require_once __DIR__.'/autoload/autoload.php';
if (isset($_SESSION['name'])) {
	unset($_SESSION['name']);
	unset($_SESSION['id']);
	redirectStyle('index.php');
}
?>