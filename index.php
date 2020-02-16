<?php 
require_once __DIR__.'/autoload/autoload.php';
$data=[];
foreach ($category as $item) {
    $CateID = intval($item['id']);
    $sqlProduct = "SELECT * FROM product WHERE category_id = $CateID";
    $ProductAll = $db -> fetchsql($sqlProduct);
    $data[$item['name']]= $ProductAll;
}
?>
<?php require_once __DIR__ .'/layouts/header.php';?>

<div class="col-md-9 bor">
    <!-- slide -->
    <?php require_once __DIR__ .'/layouts/slide.php'; ?>
    <!-- end slide -->
    <?php foreach ($data as $key => $value): ?>
        <div class="clearfix"> </div>
        <section class="box-main1">
            <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"><?php echo $key; ?></a> </h3>
            <?php foreach ($value as $item): ?>
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
    <?php endforeach ?>

</div>
<?php require_once __DIR__ .'/layouts/footer.php'; ?>



