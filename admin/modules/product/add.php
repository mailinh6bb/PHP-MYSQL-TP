<?php 
$open = "product";
require_once __DIR__.'/../../autoload/autoload.php';
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
		if (isset($_FILES['avatar'])) {
			$file_name = date('d-m-Y').'-'.rand(1,100).'-'.$_FILES['avatar']['name'];
			$file_tmp =  $_FILES['avatar']['tmp_name'];
			$file_type = $_FILES['avatar']['type'];
			$file_error =  $_FILES['avatar']['error'];
			if ($file_error == 0) {
				$data['avatar'] = $file_name;
				$path = ROOT."product_image/";
			}
			$issetPro = $db -> fetchOne('product', "name ='".$data['name']."'");
			if (count($issetPro) > 0) {
				$_SESSION['error'] = "Sản Phẩm Đã Tồn Tại";
			}
			else {
				$id_insert_product = $db -> insert('product', $data);
				if ($id_insert_product) {
					move_uploaded_file($file_tmp, $path.$file_name);
					$_SESSION['success'] = "Thêm Mới Sản Phẩm Thành Công";
					redirectAdmin('product');
				}
				else {
					$_SESSION['error'] = 'Thêm Mới Sản Phẩm Không Thành Công';
				}
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
	<li class="breadcrumb-item active">Thêm Mới</li>
</ol>
<!-- Page Content -->
<!-- *** Thong Báo lỗi *** -->
<?php  require_once __DIR__.'/../../../partials/notification.php' ?>

<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
	<fieldset>

		<!-- Form Name -->
		<legend>Thêm Mới Sản Phẩm</legend>

		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Tên Sản Phẩm</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['name'])): ?>
					<p class="text-danger">
						<?php echo $error['name']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập tên sản phẩm" value="<?php if(isset($data)){ echo $data['name']; }?>" class="form-control input-md" type="text" name="name">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Danh Mục</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['name'])): ?>
					<p class="text-danger">
						<?php echo $error['name']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<select name="category_id" class="form-control">
					<?php foreach ($category as $value): ?>
						<option 
						<?php if (isset($data)) {
							if($data['category_id'] == $value['id']){
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
			<label class="col-md-4 control-label" for="product_id">Giá</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['price'])): ?>
					<p class="text-danger">
						<?php echo $error['price']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập giá sản phẩm" value="<?php if(isset($data)){ echo $data['price']; }?>" class="form-control input-md" type="number" name="price">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Số Lượng</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['number'])): ?>
					<p class="text-danger">
						<?php echo $error['number']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập số lượng sản phẩm" value="<?php if(isset($data)){ echo $data['number']; }?>" class="form-control input-md" type="number" name="number">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Giảm Giá</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['sale'])): ?>
					<p class="text-danger">
						<?php echo $error['sale']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập giảm giá" value="<?php if(isset($data)){ echo $data['sale']; }?>" class="form-control input-md" type="number" name="sale">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Miêu Tả</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['description'])): ?>
					<p class="text-danger">
						<?php echo $error['description']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<textarea class="form-control" name="description"><?php if(isset($data)){ echo $data['description']; }?></textarea>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Nội Dung</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['content'])): ?>
					<p class="text-danger">
						<?php echo $error['content']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<textarea class="form-control" name="content"><?php if(isset($data)){ echo $data['content']; }?></textarea>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Hình Ảnh</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['hot'])): ?>
					<p class="text-danger">
						<?php echo $error['hot']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input type="file" name="avatar" value="">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<div class="col-md-4">
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
			<div class="col-md-4">
				<input class="form-control btn btn-info" value="Thêm Mới" type="submit">
			</div>
		</div>
	</fieldset>
</form>


<!-- /.container-fluid -->

<!-- Sticky Footer -->
<?php require_once __DIR__.'/../../layouts/footer.php'; ?>