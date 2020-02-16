<?php 
require_once __DIR__.'/autoload/autoload.php';
$tongtien = 0;
if (isset($_SESSION['name'])) {
	$user = $db -> fetchID('user', $_SESSION['name_id']);
	if ($_SESSION['cart'] == NULL) {
		echo '<script> alert("Bạn Chưa Mua Sản Phẩm Nào!"); location.href = "index.php"</script>';
	}
}
else {
	echo '<script> alert("Bạn Chưa Đăng Nhập! Vui lòng Đăng Nhập!"); location.href = "login.php"</script>';
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if ($user['phone'] == null && $user['address'] == null) {
		$_SESSION['error'] = "Thông Tin Của Bạn Chưa Đầy Đủ. Quay lại Thông Tin";
		redirectStyle('info-user.php');
	}
	else {
		$dataTran = [
			'amount' => 	$_SESSION['tongtien'],
			'user_id' => $_SESSION['name_id'],
			'note' => postInput('note'),
		];
		$id_insert_tran = $db -> insert('transactions', $dataTran);
		if ($id_insert_tran > 0) {
			foreach ($_SESSION['cart'] as $key =>  $value){
				$dataOr = [
					'transaction_id' => $id_insert_tran,
					'product_id' => $key,
					'qty' => $value['qty'],
					'price' => $_SESSION['priceSale'],
				];
				$id_insert_or = $db -> insert('orders',$dataOr);
			}
		}
		echo '<script> alert("Thanh Toán Thành Công!"); location.href = "index.php"</script>';
		unset($_SESSION['cart']);
	}
}
?>
<?php require_once __DIR__ .'/layouts/header.php';?>
<div class="col-md-9">
	<div class="clearfix"> </div>
	<section class="box-main1">
		<form action="" method="POST" accept-charset="utf-8">
			<div class="showitem"> 
				<h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Chi Tiết Đơn Hàng</a> </h3>
				<!-- chi tiết đơn hàng -->
				<div style="margin-top: 15px;">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên</th>
								<th>Hình Ảnh</th>
								<th>Số Lượng</th>
								<th>Tổng Tiền</th>
							</tr>
						</thead>
						<tbody>
							<?php if (isset($_SESSION['cart'])): ?>
								<?php $stt = 1; foreach ($_SESSION['cart'] as $key =>  $value):?>
								<?php 
								$number = $value['price'];
								$sale = $value['sale'];
								$priceSale = $number*(100-$sale)/100;
								$priceG = $priceSale*$value['qty'];
								$tongtien += $priceG;
								$_SESSION['tongtien'] = $tongtien;
								$_SESSION['priceSale'] = $priceSale;
								?> 
								<tr>
									<td><?php echo $stt; ?></td>
									<td><?php echo $value['name']; ?></td>
									<td>
										<img src="<?php echo uploads()?>product_image/<?php echo $value['avatar']; ?>" style="width: 100px; height: 120px;" alt="">
									</td>
									<td><?php echo $value['qty']; ?></td>
									<td><?php echo numberFormat($priceG); ?> đ</td>
								</tr>
								<?php $stt++; endforeach; ?>
							<?php endif ?>
							<tr>
								<td colspan="5" rowspan="" headers="">
									<h4 style="color: #ea3a3c">Tổng Tiền Thành Toán: <?php  echo numberFormat($tongtien); ?> đ</h4>
									<a href="cart.php" title="">(xem lại giỏ hàng)</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- end chi tiết đơn hàng -->
				<div class="clearfix"></div>
				<!-- thông tin -->
				<div class="form-group">
					<h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Thông Tin Của Bạn</a> </h3>
					<div style="margin-top: 15px;">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Tên</th>
									<th>Email</th>
									<th>Địa Chỉ</th>
									<th>Số Điện Thoại</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $user['name']; ?></td>
									<td><?php echo $user['email'] ?></td>
									<td><?php echo $user['address']; ?></td>
									<td><?php echo $user['phone']; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- end thông tin -->
				<div class="clearfix"></div>
				<div class="form-group">
					<h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Ghi Chú</a> </h3>
					<textarea class="form-control" rows="5" name="note" placeholder="Nhập ghi chú của bạn!"></textarea>
				</div>
				<div style="display: flex; ">
					<div class="option_cart" style="margin-left: 300px">
						<a class="btn btn-info" href="index.php" title="">Tiếp Tục Mua Hàng</a>
						<input type="submit" class="btn btn-info" name="" value="Thanh Toán">
					</div>
				</div>
			</form>
		</section>
	</div>
	<?php require_once __DIR__ .'/layouts/footer.php'; ?>
