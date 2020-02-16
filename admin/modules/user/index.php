<?php 
$open = "user";
require_once __DIR__.'/../../autoload/autoload.php';
require_once __DIR__ .'/../../layouts/header.php';
$user = $db -> fetchAll('user');
if (isset($_GET['page'])) {
	$p = $_GET['page'];
}
else {
	$p = 1;
}
$sql = "SELECT user.* FROM user ORDER BY id DESC";
$user = $db -> fetchJone('user', $sql, $p, 8, true);
if (isset($user['page'])) {
	$sotrang = $user['page'];
	unset($user['page']);
}
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php echo base_url()?>admin/">Admin</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?php echo modules('user')?>">user</a>
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
					<th>Email</th>
					<th>Địa Chỉ</th>
					<th>Phone</th>
					<th>Quyền</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($user)): ?>
					<?php $stt = 1; foreach ($user as $value):?>
					<tr>
						<td><?php echo $stt; ?></td>
						<td><?php echo $value['name']; ?></td>
						<td><?php echo $value['email']; ?></td>
						<td><?php echo $value['address']; ?></td>
						<td><?php echo $value['phone'] ?></td>
						<td><?php echo $value['role']; ?></td>
						<td>
							<a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $value['id'];?>" title="">Edit</a>
							<a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $value['id'];?>" onclick='return xacnhanxoa()'title="">Delete</a>
						</td>
					</tr>
					<?php $stt++; endforeach; ?>
				<?php endif ?>
			</tbody>
		</table>
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<?php if ($p > 1): ?>
					<li class="page-item"><a class="page-link" href="?page=<?php echo $p-1; ?>">Previous</a></li>
				<?php endif ?>

				<?php 
				for ($i = 1; $i <= $sotrang ; $i++): ?>
					<?php if(isset($_GET['page'])) {
						$p = $_GET['page'];
					}
					else {
						$p = 1;
					}
					?>
					<li class="page-item <?php echo ($i == $p) ? 'active':'' ?>"><a class="page-link"href="?page=<?php echo $i; ?>" ><?php echo $i; ?></a></li>
				<?php endfor?>
				<?php if ($p < $sotrang): ?>
					<li class="page-item"><a class="page-link" href="?page=<?php echo $p+1; ?>">NExt</a></li>
				<?php endif ?>
			</ul>
		</nav>
	</div>
</div>

<!-- /.container-fluid -->

<!-- Sticky Footer -->
<?php require_once __DIR__.'/../../layouts/footer.php'; ?>