<?php 
$open = "category";
require_once __DIR__.'/../../autoload/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$data = [
		'name' => postInput('name'),
		'slug' => to_slug( postInput('name')),
	];
	$error = [];
	if (postInput('name') == '') {
		$error['name'] = 'Vui lòng nhập đầy đủ tên danh mục!';
	}
	// không có lỗi thì mình insert vô database
	if (empty($error)) {
    // kiểm tra tên đã tồn tại và thêm vào db
		$issetCate = $db -> fetchOne('category', "name ='".$data['name']."'");
		if (count($issetCate) > 0) {
			$_SESSION['error'] = "Danh Mục Đã Tồn Tại";
		}
		else {
			$id_insert_cate = $db -> insert('category', $data);
			if ($id_insert_cate) {
				$_SESSION['success'] = "Thêm Mới Danh Mục Thành Công";
				redirectAdmin('category');
			}
			else {
				$_SESSION['error'] = 'Thêm Mới Danh Mục Không Thành Công';
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
		<a href="<?php echo modules('category')?>">Danh Mục</a>
	</li>
	<li class="breadcrumb-item active">Thêm Mới</li>
</ol>
<!-- Page Content -->
<!-- *** Thong Báo lỗi *** -->
<?php  require_once __DIR__.'/../../../partials/notification.php' ?>; 

<form class="form-horizontal" method="POST" action="">
	<fieldset>

		<!-- Form Name -->
		<legend>Thêm Mới Danh Mục</legend>

		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="product_id">Tên Danh Mục</label>  
			<div class="col-md-4">
				<!-- lỗi -->
				<?php if (isset($error['name'])): ?>
					<p class="text-danger">
						<?php echo $error['name']; ?>
					</p>
				<?php endif ?>
				<!-- end -->
				<input placeholder="Vui lòng nhập tên danh mục" class="form-control input-md" type="text" name="name">
			</div>
		</div>
		<!-- Text input-->
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