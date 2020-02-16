<?php 
require_once __DIR__.'/autoload/autoload.php';
$tongtien = 0;
?>
<?php require_once __DIR__ .'/layouts/header.php';?>
<div class="col-md-9">
    <div class="clearfix"> </div>
    <section class="box-main1">
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Giỏ Hàng Của Bạn:</a> </h3>
        <div class="showitem"> 
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Tên</th>
                        <th>Hình Ảnh</th>
                        <th>Số Lượng</th>
                        <th>Tổng Tiền</th>
                        <th>Action</th>
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
                        ?> 
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td><?php echo $value['name']; ?>
                            <ul>
                                <li>- Giá Gốc: <?php echo numberFormat($number) ?></li>
                                <li>- Giá Giảm: <?php echo numberFormat($priceSale) ?></li>
                                <li><a href="detail-product.php?id=<?php echo $key ?>" title="">( xem chi tiết sản phẩm )</a></li>
                            </ul>
                        </td>
                        <td>
                            <img src="<?php echo uploads()?>product_image/<?php echo $value['avatar']; ?>" style="width: 100px; height: 120px;" alt="">
                        </td>
                        <td><input type="number" name="qty" min="1"  class="qty<?php echo $key?>" value="<?php echo $value['qty']; ?>"></td>
                        <td><?php echo numberFormat($priceG); ?> đ</td>
                        <td>
                            <a class="btn btn-xs btn-info update-cart"  href="#" data-key="<?php echo $key; ?>" title="">Edit</a>
                            <a class="btn btn-xs btn-danger" href="cart-delete.php?id=<?php echo $key;?>" onclick='return xacnhanxoa()'title="">Delete</a>
                        </td>
                    </tr> 
                    <?php $stt++; endforeach; ?>
                    <tr>
                        <?php if ($_SESSION['cart']==null): ?>
                            <td colspan="6" class="text-center" style="font-size: 18px;" > <?php echo "Chưa Có Sản Phẩm Nào Trong Giỏ Hàng!"; ?></td>
                        <?php endif ?>
                        <?php else: ?>
                            <td colspan="6" class="text-center" style="font-size: 18px;" > <?php echo "Chưa Có Sản Phẩm Nào Trong Giỏ Hàng!"; ?></td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
            <div style="display: flex; ">
                <div class="col-md-6 total" >
                    <h4>Tổng Tiền Thành Toán: <?php  echo numberFormat($tongtien); ?> đ</h4>
                    <div>
                        <span>(chưa tính phí vận chuyển)</span>
                    </div>
                </div>

                <div class="col-md-6 option_cart">
                    <div class="col-md-6 text-right">
                        <a class="btn btn-info" href="index.php" title="">Tiếp Tục Mua Hàng</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-info" href="payment.php" title="">Thanh Toán</a>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(".update-cart").click(function(e){
        e.preventDefault();
        let idPro = $(this).data('key');
        let qty = $('.qty'+idPro).val();
// xử lý ajax
$.ajax({
    url: "update-cart.php",
    method: "GET",
    data: {
        idPro: idPro,
        qty: qty,
    },
    success:function(data){
        if (data) {
            alert(data);
            location.href="cart.php";
        }
        else {
            alert('Thất bại!');
        }
    }

});
});
</script>
<?php require_once __DIR__ .'/layouts/footer.php'; ?>

