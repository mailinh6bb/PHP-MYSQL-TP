<?php 
$open = "product";
require_once __DIR__.'/../../autoload/autoload.php';
require_once __DIR__ .'/../../layouts/header.php';
$product = $db -> fetchAll('product');
if (isset($_GET['page'])) {
	$p = $_GET['page'];
}else {
	$p = 1;
}
$sql = "SELECT product.*, category.name as namecate FROM product LEFT JOIN category on category.id = product.category_id";
$product = $db -> fetchJone('product', $sql, $p, 4, true);
if (isset($product['page'])) {
	$sotrang = $product['page'];
	unset($product['page']);
}
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php echo base_url()?>admin/">Admin</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?php echo modules('product')?>">Sản Phẩm</a>
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
					<th>STT</th>
					<th>Tên</th>
					<th>Hình Ảnh</th>
					<th>Danh Mục</th>
					<th>Số Lượng</th>
					<th>Hiện Thị</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($product)): ?>
					<?php $stt = 1; foreach ($product as $value):?>
					<tr>
						<td><?php echo $stt; ?></td>
						<td><?php echo $value['name']; ?>
						<ul>
							<li>Giá: <?php echo number_format($value['price'],0, ',', '.');  ?> VND</li>
							<li>Sale: <?php echo $value['sale']; ?>%</li>
						</ul>
					</td>
					<td>
						<img src="<?php echo uploads()?>product_image/<?php echo $value['avatar'] ?>" style="width: 50px; height: 50px;" alt="">
					</td>
					<td><?php echo $value['namecate']; ?></td>
					<td><?php echo $value['number']; ?>
					<td>
						<a href="action.php?id=<?php echo $value['id']?>" class="btn btn-xs <?php echo $value['hot'] == 1 ? 'btn-success' : 'btn-primary'; ?>" title="">
							<?php echo $value['hot'] == 1 ? 'Hiện' : 'Không'; ?>
						</a>
						<button type="button" class="btn btn-primary" title="Xem Chi Tiết" data-toggle="modal" data-target="#product<?php echo $value['id'] ?>">
							<i class="fas fa-eye" style="color: white"></i>
						</button>
					</td>
					<td>
						<a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $value['id'];?>" title="">Edit</a>
						<a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $value['id'];?>" onclick='return xacnhanxoa()'title="">Delete</a>
						
					</td>
				</tr>
				<!-- Modal -->
				<div class="modal fade" id="product<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Chi Tiết Sản Phẩm</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<b><?php echo $value['name']; ?></b>
								<div style="margin-top: 10px;">
									<img src="<?php echo base_url()?>public\uploads\product_image\<?php echo $value['avatar'] ?>" style="width: 150px; height: 150px;" alt="">
								</div>
								<div style="margin-top: 10px;">
									<span>Giá: <?php echo $value['price']; ?> VND</span>
									<br>
									<span>Sale: <?php echo $value['sale']; ?> %</span>
									<br>
									<span>Số lượng: <?php echo $value['number']; ?></span>
								</div>
								<div style="margin-top: 10px;">
									<h5>Thông Tin:</h5>
									<i style="font-size: 18px;"><?php echo $value['description']; ?></i>
								</div>
								<div style="margin-top: 10px;">
									<p><?php echo $value['content']; ?></p>
								</div>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
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