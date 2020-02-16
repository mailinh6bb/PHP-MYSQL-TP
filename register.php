<?php 
require_once __DIR__.'/autoload/autoload.php';
if (isset($_SESSION['name'])) {
	echo '<script> alert("Bạn đã đăng nhập! Quay lại trang chủ !"); location.href = "index.php"</script>';
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$data = [
		'name' => postInput('name'),
		'email' => postInput('email'),
		'password' => postInput('password'),
	];

	// bắt lỗi input
	$error = [];
	if ($data['name'] == '') {
		$error['name'] = 'Vui lòng nhập đầy đủ tên sản phẩm!';
	}
	if ($data['email'] == '') {
		$error['email'] = 'Vui lòng nhập email!';
	}
	if ($data['password'] == '') {
		$error['password'] = 'Vui lòng nhập mật khẩu!';
	}
	if ($data['password'] != postInput('rePassword')) {
		$error['rePassword'] = 'Mật khẩu không trùng!';
	}
	// không có lỗi thì mình insert vô database
	if (empty($error)) {
		$issetUser = $db -> fetchOne('user', "email ='".$data['email']."'");
		if ($issetUser != NULL) {
			$_SESSION['error'] = "User Đã Tồn Tại";
		}
		else {
			$data['password'] = md5($data['password']);
			$id_insert_user = $db -> insert('user', $data);
			if ($id_insert_user) {
				$_SESSION['success'] = "Thêm Mới User Thành Công";
				redirectStyle('login.php');
			}
			else {
				$_SESSION['error'] = 'Thêm Mới User Không Thành Công';
			}
		}
	}	
}
?>
<?php require_once __DIR__ .'/layouts/header.php';?>
<div class="col-md-9 bor">
	<h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Đăng Ký</a> </h3>
	<!-- *** Thong Báo lỗi *** -->
	<?php  require_once __DIR__.'/partials/notification.php' ?>
	<div class="showitem"> 
		<form action="" method="POST">
			<div class="form-group">
				<label for="name">Họ Tên</label>
				<!-- lỗi -->
				<?php if (isset($error['name'])): ?>
					<p class="text-danger">
						<?php echo $error['name']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="text" name="name" class="form-control" value="<?php if(isset($data)){ echo $data['name']; }?>" id="name" placeholder="vui lòng nhập họ tên">
			</div>
			<div class="form-group">
				<label for="email">Địa Chỉ Email</label>
				<!-- lỗi -->
				<?php if (isset($error['email'])): ?>
					<p class="text-danger">
						<?php echo $error['email']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="email" name="email" class="form-control" value="<?php if(isset($data)){ echo $data['email']; }?>" id="email" placeholder="vui lòng nhập email">
			</div>
			<div class="form-group">
				<label for="password">Mật Khẩu</label>
				<!-- lỗi -->
				<?php if (isset($error['password'])): ?>
					<p class="text-danger">
						<?php echo $error['password']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="password" name="password" class="form-control" id="password" placeholder="vui lòng nhập mật khẩu">
			</div>
			<div class="form-group">
				<label for="rePassword">Nhập Lại Mật Khẩu</label>
				<!-- lỗi -->
				<?php if (isset($error['rePassword'])): ?>
					<p class="text-danger">
						<?php echo $error['rePassword']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="password" name="rePassword" class="form-control" id="rePassword" placeholder="vui lòng nhập lại mật khẩu">
			</div>
			<div class="form-group col-md-4 col-md-offset-4">
				<input type="submit" class="form-control btn btn-info" id="submit" value="Đăng Ký">
			</div>
		</form>
	</div>
</div>
<?php require_once __DIR__ .'/layouts/footer.php'; ?>
