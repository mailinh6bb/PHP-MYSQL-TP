<?php 
$open = "product";
require_once __DIR__.'/../../autoload/autoload.php';
$id = intval(getInput('id'));
// lấy thông tin 
$editID = $db -> fetchID('product', $id);
$category = $db -> fetchAll('category');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$data = [
		'name' => postInput('name'),
		'slug' => to_slug( postInput('name')),
		'category_id' => postInput('category_id'),
		'price' => postInput('price'),
		'sale' => postInput('sale'),
		'number' => postInput('number'),
		'description' => postInput('description'),
		'content' => postInput('content'),
		'hot' => postInput('hot'),
	];
	// bắt lỗi input
	$error = [];
	if (postInput('name') == '') {
		$error['name'] = 'Vui lòng nhập đầy đủ tên sản phẩm!';
	}
	if (postInput('price') == '') {
		$error['price'] = 'Vui lòng nhập giá!';
	}
	if (postInput('sale') == '') {
		$error['sale'] = 'Vui lòng nhập giảm giá!';
	}
	if (postInput('description') == '') {
		$error['description'] = 'Vui lòng nhập đầy đủ miêu tả!';
	}
	if (postInput('content') == '') {
		$error['content'] = 'Vui lòng nhập đầy đủ nội dung!';
	}
	if (postInput('number') == '') {
		$error['number'] = 'Vui lòng nhập số lượng!';
	}
	// không có lỗi thì mình insert vô database
	if (empty($error)) {
    // kiểm tra tên đã tồn tại và thêm vào db
      	// kiểm tra có đổi ảnh
		if (isset($_FILES['avatar'])) {
			$file_name = date('d-m-Y').'-'.rand(1,100).'-'.$_FILES['avatar']['name'];
			$file_tmp =  $_FILES['avatar']['tmp_name'];
			$file_type = $_FILES['avatar']['type'];
			$file_error =  $_FILES['avatar']['error'];
			if ($file_error == 0) {
				$data['avatar'] = $file_name;
				$path = ROOT."product_image/";
				move_uploaded_file($file_tmp, $path.$file_name);
			}
		}
		// kiểm tra tên
		if ($editID['name'] != $data['name']) {
			$isset = $db -> fetchOne("product", "name ='".$data['name']."'");
			if (count($isset) > 0) {
				$_SESSION['error'] = "Product đã tồn tại";
			}
			else {
				$id_update_pro = $db -> update('product', $data, array('id' => $id));
				if ($id_update_pro) {
					$_SESSION['success'] = "Sửa Sản Phẩm Thành Công";
					redirectAdmin('product');
				}
			}
		}
		else {
			$id_update_pro = $db -> update('product', $data, array('id' => $id));
			if ($id_update_pro > 0) {
				$_SESSION['success'] = "Sửa Sản Phẩm Thành Công";
				redirectAdmin('product');
			}
			else {
				$_SESSION['error'] = 'Sản Phẩm Không Thay Đổi';
				redirectAdmin('product');
			}
		}	
	}
}
?>
<?php require_once __DIR__ .'/../../layouts/header.php'; ?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php echo base_url()?>admin/">Admin</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?php echo modules('product')?>">Sản Phẩm</a>
	</li>
	<li class="breadcrumb-item active">Sửa</li>
</ol>
<!-- Page Content -->
<!-- *** Thong Báo lỗi *** -->
<?php  require_once __DIR__.'/../../../partials/notification.php' ?>

<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
	<fieldset>

		<!-- Form Name -->
		<legend>Thêm Mới Danh Mục</legend>

		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-10 control-label" for="product_id">Tên Sản Phẩm</label>  
			<div class="col-md-10">
				<!-- lỗi -->
				<?php if (isset($error['name'])): ?>
					<p class="text-danger">
						<?php echo $error['name']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập tên sản phẩm" value="<?php if(isset($editID)){ echo $editID['name']; }?>" class="form-control input-md" type="text" name="name">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-10 control-label" for="product_id">Danh Mục</label>  
			<div class="col-md-10">
				<select name="category_id" class="form-control">
					<?php foreach ($category as $value): ?>
						<option 
						<?php if (isset($editID)) {
							if($editID['category_id'] == $value['id']){
								echo 'selected="selected"';
							}
						} ?>
						value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
					<?php endforeach ?>

				</select>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-10 control-label" for="product_id">Giá</label>  
			<div class="col-md-10">
				<!-- lỗi -->
				<?php if (isset($error['price'])): ?>
					<p class="text-danger">
						<?php echo $error['price']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập giá sản phẩm" value="<?php if(isset($editID)){ echo $editID['price']; }?>" class="form-control input-md" type="number" name="price">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-10 control-label" for="product_id">Số Lượng</label>  
			<div class="col-md-10">
				<!-- lỗi -->
				<?php if (isset($error['number'])): ?>
					<p class="text-danger">
						<?php echo $error['number']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập số lượng sản phẩm" value="<?php if(isset($editID)){ echo $editID['number']; }?>" class="form-control input-md" type="number" name="number">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-10 control-label" for="product_id">Giảm Giá</label>  
			<div class="col-md-10">
				<!-- lỗi -->
				<?php if (isset($error['sale'])): ?>
					<p class="text-danger">
						<?php echo $error['sale']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập giảm giá" value="<?php if(isset($editID)){ echo $editID['sale']; }?>" class="form-control input-md" type="number" name="sale">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-10 control-label" for="product_id">Miêu Tả</label>  
			<div class="col-md-10">
				<!-- lỗi -->
				<?php if (isset($error['description'])): ?>
					<p class="text-danger">
						<?php echo $error['description']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<textarea class="form-control" name="description"><?php if(isset($editID)){ echo $editID['description']; }?></textarea>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-10 control-label" for="product_id">Nội Dung</label>  
			<div class="col-md-10">
				<!-- lỗi -->
				<?php if (isset($error['content'])): ?>
					<p class="text-danger">
						<?php echo $error['content']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<textarea class="form-control" name="content"><?php if(isset($editID)){ echo $editID['content']; }?></textarea>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-10 control-label" for="product_id">Hình Ảnh</label>  
			<div class="col-md-10">
				<!-- lỗi -->
				<?php if (isset($error['hot'])): ?>
					<p class="text-danger">
						<?php echo $error['hot']; ?>
					</p>
				<?php endif ?>
				<div class="form-group">
					<img src="<?php echo uploads()?>product_image/<?php echo $editID['avatar']?>" style="width: 150px; height: 150px;" alt="">
					
				</div>
				<!-- end -->
				<input type="file" name="avatar" value="">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<div class="col-md-10">
				<!-- lỗi -->
				<?php if (isset($error['hot'])): ?>
					<p class="text-danger">
						<?php echo $error['hot']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="checkbox" name="hot" value="1">Hiển Thị
			</div>
		</div>
		<!-- Text Submit-->
		<div class="form-group">
			<div class="col-md-3">
				<input class="form-control btn btn-info text-center" value="Sửa" type="submit">
			</div>
		</div>
	</fieldset>
</form>


<!-- /.container-fluid -->

<!-- Sticky Footer -->
<?php require_once __DIR__.'/../../layouts/footer.php'; ?>