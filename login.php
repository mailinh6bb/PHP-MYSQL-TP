<?php 
require_once __DIR__.'/autoload/autoload.php';
$error = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$data = [
		'email' => postInput('email'),
		'password' => md5(postInput('password')),
	];
	// bắt lỗi input
	if (postInput('email') == '') {
		$error['email'] = 'Vui lòng nhập email!';
	}
	if (postInput('password') == '') {
		$error['password'] = 'Vui lòng nhập mật khẩu!';
	}
	// không có lỗi thì mình insert vô database
	if (empty($error)) {
		$email = $data['email'];
		$password = $data['password'];
		$sql = "SELECT * FROM user WHERE email = '$email'  AND password = '$password'";
		$issetUser = $db -> fetchsql($sql);
		if ($issetUser != NULL) {
			foreach ($issetUser as $value) {
				if ($value['email']) {
					$_SESSION['name'] = $value['name'];
					$_SESSION['name_id'] = $value['id'];
					redirectStyle('index.php'); 
				}
				else {
					$_SESSION['error'] = 'Đăng Nhập Không Thành Công';
				}
			}
			
		}
		else {
			$_SESSION['error'] = 'Tài khoản hoặc mật khẩu của bạn không đúng!';
		}
	}	
}
?>
<?php require_once __DIR__ .'/layouts/header.php';?>
<div class="col-md-9 bor">
	<h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Đăng Nhập</a> </h3>
	<!-- *** Thong Báo lỗi *** -->
	<?php  require_once __DIR__.'/partials/notification.php' ?>
	<div class="showitem"> 
		<form action="" method="POST">
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
				<span><a href="register.php">Bạn chưa có tài khoản! Click vô đây để đăng lý </a></span>
			</div>
			<div class="form-group col-md-4 col-md-offset-4">
				<input type="submit" class="form-control btn btn-info" id="submit" value="Đăng Nhập">
			</div>
		</form>
		
	</div>
</div>
<?php require_once __DIR__ .'/layouts/footer.php'; ?>
