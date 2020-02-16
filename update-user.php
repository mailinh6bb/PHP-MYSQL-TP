<?php 
require_once __DIR__.'/autoload/autoload.php';
if (isset($_SESSION['name'])) {
	$user = $db -> fetchID('user', $_SESSION['name_id']);
}
else{
	$_SESSION['error'] = "Bạn chưa đăng nhập!";
	redirectStyle('login.php');
}
$data = [
	'name' => postInput('name'),
	'email' => postInput('email'),
	'password' => postInput('password'),
	'address' => postInput('address'),
	'info' => postInput('info'),
	'phone' => postInput('phone'),
];
$error = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// bắt lỗi input
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
	if ($data['phone'] == '') {
		$error['phone'] = 'Vui lòng nhập số điện thoại!';
	}
	if ($data['address'] == '') {
		$error['address'] = 'Vui lòng nhập địa chỉ!';
	}
	if ($data['info'] == '') {
		$error['info'] = 'Vui lòng nhập thông tin!';
	}
	// không có lỗi thì mình insert vô database
	if (empty($error)) {
		$data['password'] = md5(postInput('password'));
    // kiểm tra tên đã tồn tại và thêm vào db
		if (isset($_FILES['avatar'])) {
			$file_name = date('d-m-Y').'-'.rand(1,100).'-'.$_FILES['avatar']['name'];
			$file_tmp =  $_FILES['avatar']['tmp_name'];
			$file_type = $_FILES['avatar']['type'];
			$file_error =  $_FILES['avatar']['error'];
			if ($file_error == 0) {
				$data['avatar'] = $file_name;
				$path = ROOT."user_avatar/";
				move_uploaded_file($file_tmp, $path.$file_name);
			}
		}
		// kiểm tra tên
		if ($user['email'] != $data['email']) {
			$isset = $db -> fetchOne("user", "email ='".$data['email']."'");
			if (count($isset) > 0) {
				$_SESSION['error'] = "User đã tồn tại";
			}
			else {
				$id_update_pro = $db -> update('user', $data, array('id' => $_SESSION['name_id']));
				if ($id_update_pro) {
					$_SESSION['success'] = "Sửa User Thành Công";
					redirectStyle('index.php');
				}
			}
		}
		else {
			$id_update_pro = $db -> update('user', $data, array('id' => $_SESSION['name_id']));
			if ($id_update_pro > 0) {
				$_SESSION['success'] = "Sửa User Thành Công";
				redirectStyle('index.php');
			}
			else {
				$_SESSION['error'] = 'User Không Thay Đổi';
				redirectStyle('index.php');
			}
		}	
	}
}	
?>
<?php require_once __DIR__ .'/layouts/header.php';?>
<div class="col-md-9 bor">
	<h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Cập Nhật Thông Tin</a> </h3>
	<!-- *** Thong Báo lỗi *** -->
	<?php  require_once __DIR__.'/partials/notification.php' ?>
	<div class="showitem"> 
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name">Họ Tên</label>
				<!-- lỗi -->
				<?php if (isset($error['name'])): ?>
					<p class="text-danger">
						<?php echo $error['name']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="text" name="name" class="form-control" value="<?php if(isset($user)){ echo $user['name']; };?>" id="name" placeholder="vui lòng nhập họ tên">
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
				<input type="email" name="email" class="form-control" value="<?php if(isset($user)){ echo $user['email']; }?>" id="email" placeholder="vui lòng nhập email">
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
			<!-- Text input-->
			<div class="form-group">
				<label  for="phone">Số Điện Thoại</label>  

				<!-- lỗi -->
				<?php if (isset($error['phone'])): ?>
					<p class="text-danger">
						<?php echo $error['phone']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập phone" value="<?php if(isset($user)){ echo $user['phone']; }?>" class="form-control input-md" type="number" name="phone">
			</div>
			<!-- Text input-->
			<div class="form-group">
				<label  for="address">Địa Chỉ</label>  

				<!-- lỗi -->
				<?php if (isset($error['address'])): ?>
					<p class="text-danger">
						<?php echo $error['address']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<textarea class="form-control" name="address"><?php if(isset($user)){ echo $user['address']; }?></textarea>
			</div>
			<!-- Text input-->
			<div class="form-group">
				<label for="info">Thông Tin</label>  

				<!-- lỗi -->
				<?php if (isset($error['info'])): ?>
					<p class="text-danger">
						<?php echo $error['info']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<textarea class="form-control" name="info"><?php if(isset($user)){ echo $user['info']; }?></textarea>
			</div>
			<!-- Text input-->
			<div class="form-group">
				<label for="avatar">Hình Ảnh</label>  
				<!-- lỗi -->
				<?php if (isset($error['avatar'])): ?>
					<p class="text-danger">
						<?php echo $error['avatar']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="file" name="avatar" value="">
			</div>

			<div class="form-group col-md-4 col-md-offset-4">
				<input type="submit" class="form-control btn btn-info" id="submit" value="Đăng Ký">
			</div>
		</form>
	</div>
</div>
<?php require_once __DIR__ .'/layouts/footer.php'; ?>
