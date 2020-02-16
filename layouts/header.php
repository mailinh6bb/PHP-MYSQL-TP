
<!DOCTYPE html>
<html>
<head>
	<title>Shop Bán Đàn</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/front-end/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/front-end/css/bootstrap.min.css">

	<script  src="<?php echo base_url() ?>public/front-end/js/jquery-3.2.1.min.js"></script>
	<script  src="<?php echo base_url() ?>public/front-end/js/bootstrap.min.js"></script>
	<!---->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/front-end/css/slick.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/front-end/css/slick-theme.css"/>
	<!--slide-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/front-end/css/style.css">

</head>
<body>
	<div id="wrapper">
		<!---->
		<!--HEADER-->
		<div id="header">
			<div id="header-top">
				<div class="container">
					<div class="row clearfix">
						<div class="col-md-6" id="header-text">
							<a>Mai Linh</a><b>Âm Thầm làm việc Rồi thành công sẽ đến!</b>
						</div>
						<div class="col-md-6">
							<nav id="header-nav-top">
								<ul class="list-inline pull-right" id="headermenu">
									<?php if (isset($_SESSION['name'])): ?>
										<li>
											<a href="cart.php"><i class="fa fa-user"> </i> <?php echo $_SESSION['name'] ?> <i class="fa fa-caret-down"></i></a>
											<ul id="header-submenu">
												<li><a href="update-user.php?id=<?php echo $_SESSION['name_id']; ?>">Sửa Tài Khoản</a></li>
												<li><a href="cart.php">Giỏ Hàng</a></li>
												<li><a href="logout.php">Thoát</a></li>
											</ul>
										</li>
										<?php else : ?>
											<li>
												<a href="login.php"><i class="fa fa-unlock"></i> Đăng Nhập </a>
											</li>
											<li>
												<a href="register.php"><i class="fa fa-unlock"></i> Đăng Ký</a>
											</li>

										<?php endif ?>

										<li>
											<a href="info-user.php" ><i class="fa fa-share-square-o"></i>Thông Tin Của Bạn </a>
										</li>


									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row" id="header-main">
						<div class="col-md-5">
							<form action="" class="form-inline">
								<div class="form-group">
									<input type="text" name="keywork" placeholder=" input keywork" class="form-control">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</form>
						</div>
						<div class="col-md-4">
							<a href="">
								<img src="<?php echo base_url() ?>public/front-end/images/logo-default.png">
							</a>
						</div>
						<div class="col-md-3" id="header-right">
							<div class="pull-right">
								<div class="pull-left">
									<i class="glyphicon glyphicon-phone-alt"></i>
								</div>
								<div class="pull-right">
									<p id="hotline">HOTLINE</p>
									<p>0865565716</p>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!--END HEADER-->


			<!--MENUNAV-->
			<div id="menunav">
				<div class="container">
					<nav>
						<div class="home pull-left">
							<a href="index.php">Trang chủ</a>
						</div>
						<!--menu main-->
						<ul id="menu-main">
							<?php foreach ($category as $value): ?>
								<li>
									<a href="product.php?id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a>
								</li>
							<?php endforeach ?>
							<li>
								<a href="blog.php">Blog</a>
							</li>
							<li>
								<a href="video.php">Video HD</a>
							</li>
							<li>
								<a href="contact.php">Liên Hệ</a>
							</li>
						</ul>
						<!-- end menu main-->

						<!--Shopping-->
						<ul class="pull-right" id="main-shopping">
							<li>
								<a href="cart.php"><i class="fa fa-shopping-basket"></i> Giỏ Hàng </a>
							</li>
						</ul>
						<!--end Shopping-->
					</nav>
				</div>
			</div>
			<!--ENDMENUNAV-->

			<div id="maincontent">
				<div class="container">
					<div class="col-md-3  fixside" >
						<div class="box-left box-menu" >
							<h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
							<ul>
								<?php foreach ($category as $value): ?>
									<li>
										<a href="product.php?id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a>
									</li>
								<?php endforeach ?>

							</ul>
						</div>
						<!-- menu-letf -->
						<?php require_once __DIR__ .'/menu-letf.php'; ?>
						<!-- end menu-letf -->
					</div>