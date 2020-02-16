<?php 
if (!isset($_SESSION['name'])) {
 header("location:".base_url()."admin/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Trang Admin</title>

  <!-- custom fonts for this template-->
  <link href="<?php echo base_url() ?>public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- page level plugin css-->
  <link href="<?php echo base_url() ?>public/admin/vendor/datatables/datatables.bootstrap4.css" rel="stylesheet">

  <!-- custom styles for this template-->
  <link href="<?php echo base_url() ?>public/admin/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="#"><h1>Trang Quản Trị</h1></a>  
    <!-- navbar -->
    <ul class="navbar-nav ml-auto ml-md-6">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <h3>Chào Admin: <span><?php echo $_SESSION['name'] ?></span><i class="fas fa-user-circle fa-fw"></i></h3> 
       </a>
       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userdropdown">
        <a class="dropdown-item" href="#">settings</a>
        <a class="dropdown-item" href="#">activity log</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php">logout</a>
      </div>
    </li>
  </ul>
</nav>

<div id="wrapper">

  <!-- sidebar -->
  <ul class="sidebar navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url()?>admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tùy Chọn</span>
      </a>
    </li>
    <li class="nav-item">
      <a class ="<?php echo (isset($open) && $open == 'category' ? 'active' : 'nav-link'); ?>" href="<?php echo modules('category')?>">
        <i class="fas fa-list"></i>
        <span>Danh Mục</span></a>
      </li>
      <li class="nav-item">
        <a class ="<?php echo (isset($open) && $open == 'product' ? 'active' : 'nav-link'); ?>" href="<?php echo modules('product')?>">
          <i class="fab fa-product-hunt"></i>
          <span>Sản Phẩm</span></a>
        </li>
        <li class="nav-item">
          <a class ="<?php echo (isset($open) && $open == 'user' ? 'active' : 'nav-link'); ?>" href="<?php echo modules('user')?>">
            <i class="fas fa-user"></i>
            <span>User</span></a>
          </li>
          <li class="nav-item">
            <a class ="<?php echo (isset($open) && $open == 'order' ? 'active' : 'nav-link'); ?>" href="<?php echo modules('order')?>">
              <i class="fas fa-user"></i>
              <span>Đơn Hàng</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="<?php echo base_url()?>index.php"  aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Về Trang Web</span>
              </a>
            </ul>
            <div id="content-wrapper">
              <div class="container-fluid">