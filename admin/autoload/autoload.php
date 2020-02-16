<?php 
session_start();
require_once __DIR__.'/../../libs/Database.php';
require_once __DIR__.'/../../libs/Function.php';
$db = new Database();
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/public/uploads/');
// $category = $db -> fetchAll('category');
// $sqlnew = " SELECT * FROM product WHERE 1 ORDER BY id DESC LIMIT 3";
// $productnew= $db -> fetchsql($sqlnew);
?>