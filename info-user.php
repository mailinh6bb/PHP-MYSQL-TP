<?php 
require_once __DIR__.'/autoload/autoload.php';
$idUser = $_SESSION['name_id'];
$sql = "SELECT user.*, transactions.amount as price FROM user 
LEFT JOIN transactions on user.id = transactions.user_id
WHERE user.id = $idUser
";
$infoUser = $db -> fetchsql($sql);
$data = [];
$data['price'] = 0;
foreach ($infoUser as  $value) {
  $data['avatar'] = $value['avatar'];
  $data['price'] += $value['price'];
  $data['address'] = $value['address'];
  $data['phone'] = $value['phone'];
  $data['email'] = $value['email'];
}
?>
<?php require_once __DIR__ .'/layouts/header.php';?>
<div class="col-md-9">
    <div class="clearfix"> </div>
    <section class="box-main1">
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Thông Tin Của Bạn</a> </h3>
        <div class="showitem"> 
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Hình Ảnh</th>
                        <th>Phone</th>
                        <th>Địa Chỉ</th>
                        <th>Email</th>
                        <th>Đơn Hàng Đã Mua</th>
                        <th>Tổng Tiền Mua</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($infoUser)): ?>
                        <tr>
                            <td> <?php echo $_SESSION['name']; ?></td>
                            <td>
                                <img src="<?php echo uploads()?>user_avatar/<?php echo $data['avatar']; ?>" style="width: 50px; height: 50px;" alt="">
                            </td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['address']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <?php if ($data['price'] == 0): ?>
                                <td><p>bạn chưa mua sản phầm nào!</p></td>
                                <?php else: ?>
                                    <td><?php echo count($infoUser) ?></td>
                                <?php endif ?>

                                <td><?php echo numberFormat($data['price']); ?> đ</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <div>
                    <div>
                        <a class="btn btn-info" href="update-user.php" title="">Chỉnh Sửa Thông Tin</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require_once __DIR__ .'/layouts/footer.php'; ?>