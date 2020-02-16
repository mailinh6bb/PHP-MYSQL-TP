<?php require_once __DIR__.'/autoload/autoload.php';
$idCate = intval(getInput('id'));
$categoryPro = $db -> fetchID('category', $idCate);
// phần trang
if (isset($_GET['page'])) {
    $p = $_GET['page'];
}
else {
    $p = 1;
}

$sqlPro = "SELECT * FROM product WHERE category_id = $idCate";
$total = count($db -> fetchsql($sqlPro));
$productCate = $db -> fetchJones('product', $sqlPro,$total, $p, 8, true);
$sotrang = $productCate['page'];
unset($productCate['page']);
$path = $_SERVER['SCRIPT_NAME'];
?>
<?php require_once __DIR__ .'/layouts/header.php';?>
<div class="col-md-9 bor">
    <div class="clearfix"> </div>
    <section class="box-main1">
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"><?php echo $categoryPro['name']; ?></a> </h3>
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
                    <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                </div>
            </div>
        <?php endforeach ?>
    </section>
    <div class="clearfix"> </div>
    <nav class="text-center" aria-label="Page navigation example">
        <ul class="pagination">
            <?php if ($p > 1): ?>
                <li class="page-item"><a class="page-link" href="<?php echo $path ?>?id=<?php echo $idCate ?>&&page=<?php echo $p-1; ?>">Previous</a></li>
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
                <li class="page-item <?php echo ($i == $p) ? 'active':'' ?>"><a class="page-link"href="<?php echo $path ?>?id=<?php echo $idCate ?>&&page=<?php  echo $i; ?>" ><?php echo $i; ?></a></li>
            <?php endfor?>

            <?php if ($p < $sotrang): ?>
              <li class="page-item"><a class="page-link"  href="<?php echo $path ?>?id=<?php echo $idCate ?>&&page=<?php echo  $p+1; ?>">Next</a></li>
          <?php endif ?>
          
      </ul>
  </nav>
</div>
<?php require_once __DIR__ .'/layouts/footer.php'; ?>