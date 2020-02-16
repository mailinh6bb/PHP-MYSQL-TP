<?php 
$open = "category";
require_once __DIR__.'/../../autoload/autoload.php';
require_once __DIR__ .'/../../layouts/header.php';
$category = $db -> fetchAll('category');
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php echo base_url()?>admin/">Admin</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?php echo modules('category')?>">Đơn Hàng</a>
	</li>
	<li class="breadcrumb-item active">Danh Sách</li>
</ol>
<!-- *** Thong Báo lỗi *** -->
<?php require_once __DIR__.'/../../../partials/notification.php';  ?>
<!-- Page Content -->
<button class="btn btn-primary"><a href="add.php" style="color: white;">Thêm Mới</a></button>
<hr>
<div class="container">
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Stt</th>
					<th>Tên</th>
					<th>Slug</th>
					<th>Hiện Thị</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($category)): ?>
					<?php $stt = 1; foreach ($category as $value):?>
					<tr>
						<td><?php echo $stt; ?></td>
						<td><?php echo $value['name']; ?></td>
						<td><?php echo $value['slug']; ?></td>
						<td>
							<a href="action.php?id=<?php echo $value['id']?>" class="btn btn-xs <?php echo $value['home'] == 1 ? 'btn-success' : 'btn-primary'; ?>" title="">
								<?php echo $value['home'] == 1 ? 'Hiện' : 'Không'; ?>
							</a>
						</td>
						<td><?php echo $value['created_at'] ?></td>
						<td>
							<a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $value['id'];?>" title="">Edit</a>
							<a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $value['id'];?>" onclick='return xacnhanxoa()'title="">Delete</a>
						</td>
					</tr>
					<?php $stt++; endforeach; ?>
				<?php endif ?>
			</tbody>
		</table>
		
	</div>
</div>

<!-- /.container-fluid -->

<!-- Sticky Footer -->
<?php require_once __DIR__.'/../../layouts/footer.php'; ?>
