<?php 
session_start();
require_once __DIR__.'/../libs/Database.php';
require_once __DIR__.'/../libs/Function.php';
$db = new Database();
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/public/uploads/');
$sql = "SELECT * FROM category WHERE home = 1 ORDER BY id DESC ";
$category = $db -> fetchsql($sql);
$sqlnew = " SELECT * FROM product WHERE 1 ORDER BY id DESC LIMIT 3";
$productnew= $db -> fetchsql($sqlnew);
?>