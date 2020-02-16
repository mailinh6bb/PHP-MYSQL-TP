<?php 
$open = "order";
require_once __DIR__.'/../../autoload/autoload.php';
require_once __DIR__ .'/../../layouts/header.php';
$sql = "SELECT transactions.*, user.name as nameuser, user.phone as phoneuser, user.address as addressuser FROM transactions 
LEFT JOIN user ON user.id = transactions.user_id
WHERE user.id = transactions.user_id
";
$transactions = $db -> fetchsql($sql);
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
					<th>Tên Khách Hàng</th>
					<th>Phone</th>
					<th>Địa Chỉ</th>
					<th>Tổng Tiền</th>
					<th>Ghi Chú</th>
					<th>Xử Lý</th>
					<th>Xóa Đơn</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($transactions)): ?>
					<?php $stt = 1; foreach ($transactions as $value):?>
					<tr>
						<td><?php echo $stt; ?></td>
						<td><?php echo $value['nameuser']; ?></td>
						<td><?php echo $value['phoneuser']; ?></td>
						<td><?php echo $value['addressuser']; ?></td>
						<td><?php echo numberFormat($value['amount']) ?> đ</td>
						<td><?php echo $value['note']; ?></td>
						<td>
							<?php if ($value['status'] == 0): ?>
								<a href="action.php?id=<?php echo $value['id'];?>" class="btn btn-danger" title="">Chưa Xử Lý</a>
								<?php else: ?>
									<a href="#" class="btn btn-success" title="">Đã Xử Lý</a>
								<?php endif ?>
							</td>
							<td>
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
