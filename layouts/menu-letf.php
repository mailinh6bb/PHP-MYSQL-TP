  <!-- new product -->
  <div class="box-left box-menu">
    <h3 class="box-title"><i class="fa fa-product-hunt"></i>  Sản phẩm mới </h3>
    <ul>
        <?php if (isset($productnew)): ?>
            <?php foreach ($productnew as $value): ?>

                <li class="clearfix">
                    <a href="detail-product.php?id=<?php echo $value['id']; ?>">
                        <img src="<?php echo uploads()?>product_image/<?php echo $value['avatar'] ?>" style="width: 100px; height: 100px;" class="img-responsive pull-left" width="80" height="80">
                        <div class="info pull-right">
                            <p class="name"><?php echo $value['name']; ?></p ><br>
                            <span class="view"><?php echo number_format($value['price'], 0, ',', '.') ?> đ</span>
                        </div>
                    </a>
                </li>

            <?php endforeach ?>
        <?php endif ?>
    </ul>
</div>
<!-- end new product -->
  <!-- product hot -->
  <div class="box-left box-menu">
    <h3 class="box-title"><i class="fa fa-product-hunt"></i>  Sản Phẩm Bán Chạy </h3>
    <ul>
        <?php if (isset($productnew)): ?>
            <?php foreach ($productnew as $value): ?>

                <li class="clearfix">
                    <a href="detail-product.php?id=<?php echo $value['id']; ?>">
                        <img src="<?php echo uploads()?>product_image/<?php echo $value['avatar'] ?>" style="width: 100px; height: 100px;" class="img-responsive pull-left" width="80" height="80">
                        <div class="info pull-right">
                            <p class="name"><?php echo $value['name']; ?></p ><br>
                            <span class="view"><?php echo number_format($value['price'], 0, ',', '.') ?> đ</span>
                        </div>
                    </a>
                </li>

            <?php endforeach ?>
        <?php endif ?>
    </ul>
</div>
<!-- end product hot -->