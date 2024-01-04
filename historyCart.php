<!doctype html>
<html lang="th">
<?php session_start(); ?>
<?php include('include/connect.php'); ?>
<?php
if (!isset($_SESSION['user_login'])) {
    header("Location: login.php");
    exit;
}
?>
<?php include('include/headindex.php'); ?>
<?php include('include/navbar.php'); ?>

<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="styels.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>




    <?php
    $datahistory = $conn->prepare("SELECT * FROM `record` WHERE `bill_trx` = '" . $_GET['id'] . "' ");
    $datahistory->execute();
    $rowhistory = $datahistory->fetchAll(PDO::FETCH_OBJ);

    foreach ($rowhistory as $reshistory) {

        $user = $conn->prepare("SELECT * FROM users WHERE id = '$reshistory->id'");
        $user->execute();
        $rowuser = $user->fetch(PDO::FETCH_ASSOC);

        $address = $conn->prepare("SELECT * FROM usersadress WHERE id = '" . $rowuser['id'] . "'");
        $address->execute();
        $rowaddress = $address->fetch(PDO::FETCH_ASSOC);

    }

    ?>

        <div class="container profile dis-n">
            <div class="row">

                <div class="headprofile">
                    <i class='bx bx-user-circle'></i>
                    <p> ยินดีต้อนรับ ::. <?php echo $rowuser['firstname'] . ' ' . $rowuser['lastname']; ?></p>
                </div>
                <div class="bodyhistory">
                    <div class="histoy">
                        <div class="flex-item1">
                            <span>สถานะการสั่งซื้อ</span>
                        </div>
                        <hr>
                        <div class="flex-item2">
                            <span>หมายเลขคำสั่งซื้อ : <?= $_GET['id'] ?></span>
                            <span>วันที่สั่งซื้อ : <?= $reshistory->created ?> </span>
                        </div>
                        <hr>

                        <div class="flex-item3">
                            <span class="item-h1">ข้อมูลจัดส่ง</span>
                            <span>ชื่อผู้รับ : <?= $rowuser['firstname'] . ' ' . $rowuser['lastname']; ?></span>
                            <span>ที่อยู่ : <?= $rowaddress['user_adress'] ?> ตำบล<?= $rowaddress['user_parish'] ?> อำเภอ<?= $rowaddress['user_district'] ?></span>
                            <span>จังหวัด<?= $rowaddress['user_province'] . ' ' . $rowaddress['user_postal_code'] ?></span>
                            <span>เบอร์โทรศัพท์ : <?= $rowuser['phone'] ?></span>
                            <span>อีเมล : <?= $rowuser['email'] ?></span>
                        </div>

                        <div class="flex-item4">
                            <span class="item-h1">ข้อมูลออกใบเสร็จ</span>
                            <span>ชื่อผู้รับ : <?= $rowuser['firstname'] . ' ' . $rowuser['lastname']; ?></span>
                            <span>ที่อยู่ : <?= $rowaddress['user_adress'] ?> ตำบล<?= $rowaddress['user_parish'] ?> อำเภอ<?= $rowaddress['user_district'] ?></span>
                            <span>จังหวัด<?= $rowaddress['user_province'] . ' ' . $rowaddress['user_postal_code'] ?></span>
                            <span>เบอร์โทรศัพท์ : <?= $rowuser['phone'] ?></span>
                            <span>อีเมล : <?= $rowuser['email'] ?></span>
                        </div>
                        <div class="claer">
                        </div>
                        <table class="table histable">
                            <thead>
                                <tr>
                                    <th>สินค้า</th>
                                    <th></th>
                                    <th>ราคา/หน่วย</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $databilltrx = $conn->prepare("SELECT * FROM `record` WHERE `bill_trx` = '" . $_GET['id'] . "' ");
                                $databilltrx->execute();
                                $rowdatabill = $databilltrx->fetchAll(PDO::FETCH_OBJ);
                                foreach ($rowdatabill as $resdata) {
                                    $product_id = $resdata->product_id;
                                    $record_status = $resdata->record_status;
                                    $val = $resdata->counts;
                                    $rowcartproduct = $conn->prepare("SELECT * FROM product WHERE product_id = '${product_id}'");
                                    $rowcartproduct->execute();
                                    $rowcart = $rowcartproduct->fetch(PDO::FETCH_ASSOC);
                                    $makeprice = $val * $rowcart['product_price'];
                                    $total_quantity += $val;
                                    $total_price += $makeprice;

                                    $picCart = $conn->query("SELECT * FROM product_pic WHERE product_id = '${product_id}'");
                                    $picCart->execute();
                                    $rowpicCart = $picCart->fetch(PDO::FETCH_ASSOC);
                                ?>
                                    <tr>
                                        <td><img src="include/img/<?= $rowpicCart['product_pic_path'] ?>" width="50px" height="50px" alt=""></td>
                                        <td><?= $rowcart['product_name'] ?></td>
                                        <td><?= number_format($rowcart['product_price']) . ' ' . 'บาท' ?></td>
                                        <td><?= $val ?></td>
                                        <td><?= number_format($makeprice) . ' ' . 'บาท' ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td></td>
                                    <td class="text-center">ยอดรวม</td>
                                    <?php
                                    if ($total_price >= 999) {
                                    ?>
                                        <td colspan="2">ค่าจัดส่งสินค้าฟรี</td>
                                        <td><?= number_format($total_price) . ' ' . 'บาท' ?></td>
                                    <?php } else {  ?>
                                        <td colspan="2">ค่าจัดส่งสินค้า + 60 บาท</td>
                                        <td><?= number_format($total_price + 60) . ' ' . 'บาท' ?></td>
                                    <?php } ?>
                                   
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-6 sub-hisCart">
                                <span>วิธีการชำระเงิน</span>
                                <span>โอนเงินผ่านบัญชีธนาคาร</span>
                                <span>ธนาคาร xxxxxx</span>
                                <span>เลขที่บัญชี xxx-xxxxxx-x ชื่อบัญชี xxxxxx xxxxxx </span>

                            </div>
                            <div class="col-6 sub-hisCart">
                                <span>วิธีการจัดส่ง</span>
                                <span><?= $rowaddress['order_express'] ?> - จัดส่งฟรี EMS เมื่อซื้อครบ 999 บาท</span>
                                <span>(ระยะเวลาขนส่ง 1-3 วัน)</span>
                            </div>
                        </div>
                        <hr>

                    </div>

                </div>
            </div>
        </div>

        <div class="container profile-mobile d-none dis-not-n">
            <div class="row">

                <div class="headprofile">
                    <i class='bx bx-user-circle'></i>
                    <p> ยินดีต้อนรับ ::. <?php echo $rowuser['firstname'] . ' ' . $rowuser['lastname']; ?></p>
                </div>
                <div class="bodyhistory">
                    <div class="histoy">
                        <div class="flex-item1">
                            <span>สถานะการสั่งซื้อ</span>
                        </div>
                        <hr>
                        <div class="col flex-item2">
                            <span>หมายเลขคำสั่งซื้อ : <?= $_GET['id'] ?></span>
                            <span>วันที่สั่งซื้อ : <?= $reshistory->created ?> </span>
                        </div>
                        <hr>

                        <div class="col flex-item3">
                            <span class="item-h1">ข้อมูลจัดส่ง</span>
                            <span>ชื่อผู้รับ : <?= $rowuser['firstname'] . ' ' . $rowuser['lastname']; ?></span>
                            <span>ที่อยู่ : <?= $rowaddress['user_adress'] ?> ตำบล<?= $rowaddress['user_parish'] ?> อำเภอ<?= $rowaddress['user_district'] ?></span>
                            <span>จังหวัด<?= $rowaddress['user_province'] . ' ' . $rowaddress['user_postal_code'] ?></span>
                            <span>เบอร์โทรศัพท์ : <?= $rowuser['phone'] ?></span>
                            <span>อีเมล : <?= $rowuser['email'] ?></span>
                        </div>

                        <div class="col flex-item4">
                            <span class="item-h1">ข้อมูลออกใบเสร็จ</span>
                            <span>ชื่อผู้รับ : <?= $rowuser['firstname'] . ' ' . $rowuser['lastname']; ?></span>
                            <span>ที่อยู่ : <?= $rowaddress['user_adress'] ?> ตำบล<?= $rowaddress['user_parish'] ?> อำเภอ<?= $rowaddress['user_district'] ?></span>
                            <span>จังหวัด<?= $rowaddress['user_province'] . ' ' . $rowaddress['user_postal_code'] ?></span>
                            <span>เบอร์โทรศัพท์ : <?= $rowuser['phone'] ?></span>
                            <span>อีเมล : <?= $rowuser['email'] ?></span>
                        </div>
                        <table class="table histable-mobile">
                            <thead>
                                <tr>
                                    <th>สินค้า</th>
                                    <th></th>
                                    <th>ราคา/หน่วย</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $databilltrx = $conn->prepare("SELECT * FROM `record` WHERE `bill_trx` = '" . $_GET['id'] . "' ");
                                $databilltrx->execute();
                                $rowdatabill = $databilltrx->fetchAll(PDO::FETCH_OBJ);
                                foreach ($rowdatabill as $resdata) {
                                    $product_id = $resdata->product_id;
                                    $record_status = $resdata->record_status;
                                    $val = $resdata->counts;
                                    $rowcartproduct = $conn->prepare("SELECT * FROM product WHERE product_id = '${product_id}'");
                                    $rowcartproduct->execute();
                                    $rowcart = $rowcartproduct->fetch(PDO::FETCH_ASSOC);

                                    $picCart = $conn->query("SELECT * FROM product_pic WHERE product_id = '${product_id}'");
                                    $picCart->execute();
                                    $rowpicCart = $picCart->fetch(PDO::FETCH_ASSOC);
                                ?>
                                    <tr>
                                        <td><img src="include/img/<?= $rowpicCart['product_pic_path'] ?>" width="50px" height="50px" alt=""></td>
                                        <td><?= $rowcart['product_name'] ?></td>
                                        <td><?= number_format($rowcart['product_price']) . ' ' . 'บาท' ?></td>
                                        <td><?= $val ?></td>
                                        <td><?= number_format($makeprice) . ' ' . 'บาท' ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="text-center">ยอดรวม</td>
                                    <?php
                                    if ($total_price >= 999) {
                                    ?>
                                        <td colspan="2">ค่าจัดส่งสินค้าฟรี</td>
                                        <td><?= number_format($total_price) . ' ' . 'บาท' ?></td>
                                    <?php } else {  ?>
                                        <td colspan="2">ค่าจัดส่งสินค้า + 60 บาท</td>
                                        <td><?= number_format($total_price + 60) . ' ' . 'บาท' ?></td>
                                    <?php } ?>
                                   
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row his-mobile">
                            <div class="col-12 sub-hisCart">
                                <span>วิธีการชำระเงิน</span>
                                <span>โอนเงินผ่านบัญชีธนาคาร</span>
                                <span>ธนาคาร xxxxxx</span>
                                <span>เลขที่บัญชี xxx-xxxxxx-x </span>
                                <span>ชื่อบัญชี xxxxxx xxxxxx </span>

                            </div>
                            <div class="col-12 sub-hisCart">
                                <span>วิธีการจัดส่ง</span>
                                <span><?= $rowaddress['order_express'] ?></span>
                                <span>จัดส่งฟรี EMS เมื่อซื้อครบ 999 บาท</span>
                                <span>(ระยะเวลาขนส่ง 1-3 วัน)</span>
                            </div>
                        </div>
                        <hr>

                    </div>

                </div>
            </div>
        </div>


    <?php
    ?>

    <br>
    <?php include('include/footerindex.php'); ?>



</body>

</html>