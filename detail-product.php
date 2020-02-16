<?php 
require_once __DIR__.'/autoload/autoload.php';
$idPro = intval(getInput('id'));
// lấy thong tin sản phẩm
$product = $db -> fetchID('product', $idPro);
$cateID = intval($product['category_id']);
$sql = "SELECT * FROM product WHERE category_id = $cateID AND  id != $idPro ORDER BY id DESC LIMIT 4";
$productCate = $db -> fetchsql($sql);
// video liên quan 
$videoPro = $db -> fetchOne('video', " product_id = $idPro ");
?>
<?php require_once __DIR__ .'/layouts/header.php';?>
<div class="col-md-9 bor">


    <section class="box-main1" >
        <div class="col-md-6 text-center">
            <img  src="<?php echo uploads() ?>product_image/<?php echo $product['avatar'];  ?>"class="img-responsive bor" id="imgmain" width="100%" height="370" data-zoom-image="images/16-270x270.png">

          <!--   <ul class="text-center bor clearfix" id="imgdetail">
                <li>
                    <img src="" class="img-responsive pull-left" width="80" height="80">
                </li>
                <li>
                    <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                </li>
                <li>
                    <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                </li>
                <li>
                    <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                </li>

            </ul> -->
        </div>
        <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
         <ul id="right">
            <li><h3> <?php echo $product['name'] ?></h3></li>
            <li><p> Khuyến Mãi: <?php echo $product['sale'] ?> % </p></li>
            <li>
                <p>Giá Gốc: <strike class="sale"><?php echo numberFormat($product['price']); ?> đ</strike> <br> 
                    <b class="price">Giảm Giá: <?php echo formatSale($product['price'], $product['sale']); ?>đ</b>
                </li>
                <li><a href="addcart.php?id=<?php echo $product['id'];?>" class="btn btn-default"> <i class="fa fa-shopping-basket"></i>Thêm Giỏ Hàng</a></li>
            </ul>
        </div>

    </section>
    <div class="col-md-12" id="tabdetail">
        <div class="row">

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Chi Tiết sản phẩm </a></li>
                <li><a data-toggle="tab" href="#menu1">Video </a></li>
                <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3><?php echo $product['description'] ?></h3>
                    <p><?php echo $product['content'] ?></p>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3>Nghệ Sĩ: <i> <?php echo $videoPro['art'] ?> </i></h3>
                    <object width="370" height="300"
                    data="https://www.youtube.com/v/<?php echo $videoPro['link']; ?>">
                </object>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div id="menu3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
      <section class="box-main1">
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Sản Phẩm Liên Quan</a> </h3>
        <?php foreach ($productCate as $item): ?>
            <div class="showitem"> 
                <div class="col-md-3  item-product bor">
                   <a href="detail-product.php?id=<?php echo $item['id'] ?>">
                    <img src="<?php echo uploads()?>product_image/<?php echo $item['avatar'] ?>" class="" width="100%" height="180">
                </a>
                <div class="info-item">
                    <a href="detail-product.php?id=<?php echo $item['id'] ?>"><?php echo $item['name']?></a>
                    <p><strike class="sale"><?php echo numberFormat($item['price']); ?>đ</strike></p>
                    <b class="price"> <?php echo formatSale($item['price'],$item['sale']); ?>đ</b>
                </div>
                <div class="hidenitem">
                    <p><a href="detail-product.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                    <p><a href=""><i class="fa fa-heart"></i></a></p>
                    <p><a href="addcart.php?id=<?php echo $item['id'];?>"><i class="fa fa-shopping-basket"></i></a></p>
                </div>
            </div>
        <?php endforeach ?>
    </section>
</div>
</div>

</div>
<?php require_once __DIR__ .'/layouts/footer.php'; ?>
