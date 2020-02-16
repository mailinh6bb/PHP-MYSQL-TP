<?php 
$open = "user";
require_once __DIR__.'/../../autoload/autoload.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$data = [
		'name' => postInput('name'),
		'email' => postInput('email'),
		'password' => md5(postInput('password')),
		'address' => postInput('address'),
		'phone' => postInput('phone'),
		'address' => postInput('address'),
		'info' => postInput('info'),
		'role' => postInput('role'),
	];
	// bắt lỗi input
	$error = [];
	if (postInput('name') == '') {
		$error['name'] = 'Vui lòng nhập đầy đủ tên sản phẩm!';
	}
	if (postInput('email') == '') {
		$error['email'] = 'Vui lòng nhập email!';
	}
	if (postInput('password') == '') {
		$error['password'] = 'Vui lòng nhập mật khẩu!';
	}
	if (postInput('password') != postInput('rePassword')) {
		$error['rePassword'] = 'Mật khẩu không trùng!';
	}

	if (postInput('address') == '') {
		$error['address'] = 'Vui lòng nhập địa chỉ!';
	}
	if (postInput('phone') == '') {
		$error['phone'] = 'Vui lòng nhập số điện thoại!';
	}
	if (postInput('info') == '') {
		$error['info'] = 'Vui lòng nhập thông tin của bạn!';
	}
	if (postInput('role') == '') {
		$error['role'] = 'Vui lòng chọn quyền!';
	}
	// không có lỗi thì mình insert vô database
	if (empty($error)) {
    // kiểm tra tên đã tồn tại và thêm vào db
		if (isset($_FILES['avatar'])) {
			$file_name = date('d-m-Y').'-'.rand(1,100).'-'.$_FILES['avatar']['name'];
			$file_tmp =  $_FILES['avatar']['tmp_name'];
			$file_type = $_FILES['avatar']['type'];
			$file_error =  $_FILES['avatar']['error'];
			if ($file_error == 0) {
				$data['avatar'] = $file_name;
				$path = ROOT."product_image/";
			}
		}
		$issetUser = $db -> fetchOne('user', "email ='".$data['email']."'");
		if (count($issetUser) > 0) {
			$_SESSION['error'] = "User Đã Tồn Tại";
		}
		else {
			$id_insert_user = $db -> insert('user', $data);
			if ($id_insert_user) {
				move_uploaded_file($file_tmp, $path.$file_name);
				$_SESSION['success'] = "Thêm Mới User Thành Công";
				redirectAdmin('user');
			}
			else {
				$_SESSION['error'] = 'Thêm Mới User Không Thành Công';
			}
		}
	}	
}

// $url = $_SERVER['REQUEST_URI'];
// $url = explode('/', $url);
// $name = $url[count($url) -1];
// echo $ok = strpos($name,'add');

?>
<?php require_once __DIR__ .'/../../layouts/header.php'; ?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php echo base_url()?>admin/">Admin</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?php echo modules('user')?>">User</a>
	</li>
	<li class="breadcrumb-item active">Thêm Mới</li>
</ol>
<!-- Page Content -->
<!-- *** Thong Báo lỗi *** -->
<?php  require_once __DIR__.'/../../../partials/notification.php' ?>

<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
	<fieldset>

		<!-- Form Name -->
		<legend>Thêm Mới User</legend>
		
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Tên</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['name'])): ?>
					<p class="text-danger">
						<?php echo $error['name']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập tên" value="<?php if(isset($data)){ echo $data['name']; }?>" class="form-control input-md" type="text" name="name">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Email</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['email'])): ?>
					<p class="text-danger">
						<?php echo $error['email']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập email" value="<?php if(isset($data)){ echo $data['email']; }?>" class="form-control input-md" type="email" name="email">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Mật Khẩu</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['password'])): ?>
					<p class="text-danger">
						<?php echo $error['password']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập số lượng sản phẩm" class="form-control input-md" type="password" name="password">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Nhập Lại Mật Khẩu</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['rePassword'])): ?>
					<p class="text-danger">
						<?php echo $error['rePassword']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập giảm giá" class="form-control input-md" type="password" name="rePassword">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Số Điện Thoại</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['phone'])): ?>
					<p class="text-danger">
						<?php echo $error['phone']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập phone" value="<?php if(isset($data)){ echo $data['phone']; }?>" class="form-control input-md" type="number" name="phone">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Địa Chỉ</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['address'])): ?>
					<p class="text-danger">
						<?php echo $error['address']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<textarea class="form-control" name="address"><?php if(isset($data)){ echo $data['address']; }?></textarea>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Thông Tin</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['info'])): ?>
					<p class="text-danger">
						<?php echo $error['info']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<textarea class="form-control" name="info"><?php if(isset($data)){ echo $data['info']; }?></textarea>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Hình Ảnh</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['avatar'])): ?>
					<p class="text-danger">
						<?php echo $error['avatar']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="file" name="avatar" value="">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Quyền</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['role'])): ?>
					<p class="text-danger">
						<?php echo $error['role']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<select name="role">
					<option value="1">Admin</option>
					<option value="2">AdminCreate</option>
					<option value="3">AdminEdit</option>
					<option value="4">AdminDelete</option>
				</select>
			</div>
		</div>

		<!-- Text Submit-->
		<div class="form-group">
			<div class="col-md-4">
				<input class="form-control btn btn-info" value="Thêm Mới" type="submit">
			</div>
		</div>
	</fieldset>
</form>


<!-- /.container-fluid -->

<!-- Sticky Footer -->
<?php require_once __DIR__.'/../../layouts/footer.php'; ?>