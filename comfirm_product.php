<!doctype html>
<html lang="th">
<?php session_start(); ?>
<?php include('include/connect.php'); ?>
<?php include('include/headindex.php'); ?>
<?php include('include/navbar.php'); ?>
<link rel="stylesheet" href="styels.css">


<body>

    <session>
        <div class="container">
            <div class="headCofirm">
                <div class="data-from">
                    <span>
                        ยืนยันการสั่งซื้อ
                    </span>
                    <i class='bx bx-check'></i>
                </div>
            </div>
        </div>
    </session>

    <session>
        <div class="container">

            <div class="bodyConfirm">
                <div class="row">
                    <div class="col-8 dis-n">
                        <div class="card card-confirm">
                            <div class="card-header card-header-itme">
                                <span class="text-comfirm">
                                    สรุปรายการสั่งซื้อ
                                </span>
                            </div>
                            <div class="card-body">
                                <?php
                                $sqluser = $conn->prepare("SELECT * FROM users WHERE id = '" . $_SESSION['user_login'] . "'");
                                $sqluser->execute();
                                $rowuser = $sqluser->fetch(PDO::FETCH_ASSOC);

                                $sqladdress = $conn->prepare("SELECT * FROM usersadress WHERE id = '" . $rowuser['id'] . "' ");
                                $sqladdress->execute();
                                $rowaddress = $sqladdress->fetch(PDO::FETCH_ASSOC);

                                if ($sqluser->rowCount() == 0 || $sqladdress->rowCount() == 0) {
                                ?>
                                    <form id="addaddress">
                                        <input type="hidden" name="action" value="addaddress">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">ชื่อ</label>
                                                    <input type="text" class="form-control" name="firstname" id="firstname">
                                                </div>
                                                <div class="col">
                                                    <label for="">นามสกุล</label>
                                                    <input type="text" class="form-control" name="lastname" id="lastname">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">ที่อยู่จัดส่ง</label>
                                            <textarea class="textareaadress" name="user_adress" id="user_adress"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">รหัสไปรษณีย์</label>
                                                    <input type="text" class="form-control" name="user_postal_code" id="user_postal_code">
                                                </div>
                                                <div class="col">
                                                    <label for="">หมายเลขโทรศัพท์</label>
                                                    <input type="text" class="form-control" name="phone" id="phone">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">จังหวัด</label>
                                                    <input type="text" class="form-control" name="user_province" id="user_province">
                                                </div>
                                                <div class="col">
                                                    <label for="">อำเภอ</label>
                                                    <input type="text" class="form-control" name="user_district" id="user_district">
                                                </div>
                                                <div class="col">
                                                    <label for="">ตำบล</label>
                                                    <input type="text" class="form-control" name="user_parish" id="user_parish">
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" form-group text-left">
                                            <label class="text-comfirm" for="order_express">วิธีการจัดส่ง</label>
                                            <span class="text-subcomfirm"> (จัดส่งฟรี EMS เมื่อซื้อครบ 999 บาท) </span>
                                            <select name="order_express" id="order_express" class="form-control text-comfirm">
                                                <option value="ไปรษณีย์ไทย" selected>ไปรษณีย์ไทย ราคา 60 บาท</option>
                                                <option value="J&T Express">J&T Express ราคา 60 บาท</option>
                                                <option value="Kerry Express">Kerry Express ราคา 60 บาท</option>
                                                <option value="Flash Express">Flash Express ราคา 60 บาท</option>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn-confirm btn-success">
                                                เพิ่มที่อยู่
                                            </button>
                                        </div>
                                    </form>

                                <?php } else { ?>
                                    <form id="editaddress">
                                        <input type="hidden" name="action" value="editaddress">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">ชื่อ</label>
                                                    <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $rowuser['firstname'] ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="">นามสกุล</label>
                                                    <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $rowuser['lastname']; ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">ที่อยู่จัดส่ง</label>
                                            <textarea name="user_adress" id="user_adress" class="textareaadress"><?= $rowaddress['user_adress'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">รหัสไปรษณีย์</label>
                                                    <input type="text" name="user_postal_code" id="user_postal_code" class="form-control" value="<?= $rowaddress['user_postal_code'] ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="">หมายเลขโทรศัพท์</label>
                                                    <input type="text" name="phone" id="phone" class="form-control" value="<?= $rowuser['phone'] ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">จังหวัด</label>
                                                    <input type="text" name="user_province" id="user_province" class="form-control" value="<?= $rowaddress['user_province'] ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="">อำเภอ</label>
                                                    <input type="text" name="user_district" id="user_district" class="form-control" value="<?= $rowaddress['user_district'] ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="">ตำบล</label>
                                                    <input type="text" name="user_parish" id="user_parish" class="form-control" value="<?= $rowaddress['user_parish'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-left">
                                            <label for="order_express">วิธีการจัดส่ง </label>
                                            <span class="text-subcomfirm">จัดส่งฟรี EMS เมื่อซื้อครบ 999 บาท </span>
                                            <select name="order_express" id="order_express" class="form-control text-comfirm">
                                                <option hidden value="<?= $rowaddress['order_express'] ?>" selected> <?= $rowaddress['order_express'] ?> ราคา 60 บาท</option>
                                                <option value="ไปรษณีย์ไทย">ไปรษณีย์ไทย ราคา 60 บาท</option>
                                                <option value="J&T Express">J&T Express ราคา 60 บาท</option>
                                                <option value="Kerry Express">Kerry Express ราคา 60 บาท</option>
                                                <option value="Flash Express">Flash Express ราคา 60 บาท</option>
                                            </select>
                                        </div>
                                        <span class="text-danger">อย่าลืมตรวจสอบที่อยู่จัดส่งก่อน *</span><br>
                                        <span class="text-danger">อย่าลืมกดบันทึกข้อมูลก่อนสั่งสินค้าทุกครั้ง *</span><br>
                                        <span class="text-danger">สินค้าที่สั่งซื้อไปแล้วจะไม่สามารถเปลี่ยนที่อยู่ทีหลังได้ * </span><br><br>
                                        <div class="text-center">
                                            <button class="btn-confirm btn-success">
                                                บันทึกที่อยู่
                                            </button>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 dis-n">
                        <div class="table table-item col-4">
                            <div class="card card-item1">
                                <div class="card-header card-header-itme">
                                    <span class="text-comfirm">
                                        สรุปรายการสั่งซื้อ
                                    </span>
                                </div>
                                <div class="card-body">

                                    <?php
                                    $total_quantity = 0;
                                    $total_price = 0;
                                    if (isset($_SESSION["cart"])) {
                                        foreach ($_SESSION['cart']['product_id'] as $key => $val) {
                                            $rowcartproduct = $conn->query("SELECT * FROM product WHERE product_id = ${key}")->fetch(PDO::FETCH_ASSOC);
                                            $makeprice = $val * $rowcartproduct['product_price'];
                                            $total_quantity += $val;
                                            $price = $val * $rowcartproduct['product_price'];
                                            $total_price += $makeprice;
                                            $order_express = 60;

                                            $picCart = $conn->query("SELECT * FROM product_pic WHERE product_id = '" . $rowcartproduct['product_id'] . "'");
                                            $picCart->execute();
                                            $rowpicCart = $picCart->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                            <div class="row">
                                                <div class="col-12 col-lg-2 text-center mt-2">
                                                    <img src="include/img/<?= $rowpicCart['product_pic_path'] ?>" width="50px" height="50px" alt="">
                                                </div>
                                                <div class="col-12 col-lg-8 ml-2">
                                                    <span class="text-comfirm"><?= $rowcartproduct['product_name']; ?> </span>
                                                </div>
                                                <div class="col-12 col-lg-12 text-right">
                                                    <span class="text-comfirm"><?= number_format($rowcartproduct['product_price']); ?> บาท </span>
                                                    <span class="text-comfirm">* <?= number_format($val); ?> =</span>
                                                    <span class="text-comfirm"> <?= number_format($price); ?> บาท</span>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php } ?>

                                        <div class="col-12 allprice">
                                            <span class="text-comfirm">ยอดรวมสินค้า <?= $total_quantity ?> ชิ้น</span>
                                            <span class="text-comfirm"><?= number_format($total_price) ?> บาท</span>
                                        </div>

                                        <div class="col-12 allprice">
                                            <span class="text-comfirm">ค่าจัดส่ง</span>
                                            <?php
                                            if ($total_price >= 999) {
                                            ?>
                                                <span class="text-comfirm"> 0 บาท</span>
                                            <?php } else { ?>
                                                <span class="text-comfirm"> 60 บาท</span>
                                            <?php } ?>
                                        </div>
                                        <div class="col-12">
                                            <hr class="hr-Dotted">
                                        </div>
                                        <div class="col-12 allprice">
                                            <span class="text-comfirm">ยอดรวมสุทธิ</span>
                                            <?php
                                            if ($total_price >= 999) {
                                            ?>
                                                <span class="text-comfirm"><?= number_format($total_price) ?> บาท</span>
                                            <?php } else { ?>
                                                <span class="text-comfirm"><?= number_format($total_price + $order_express) ?> บาท</span>
                                            <?php } ?>
                                        </div>

                                        <div class="col-12">
                                            <hr class="hr-Dotted">
                                        </div>

                                        <?php
                                        if ($sqluser->rowCount() == 0 || $sqladdress->rowCount() == 0) {
                                        ?>
                                            <div class="text-center btnComfirm_text">
                                                <p class="A_not_confirmprodut">กรุณาเพิ่ม ที่อยู่จัดส่งก่อน</p>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-right btnComfirm_text">
                                                <a href="#" onclick="confirmorder('<?= $rowcartproduct['product_id'] ?>')" class="A_confirmprodut">สั่งซื้อสินค้า</a>
                                            </div>
                                        <?php } ?>

                                    <?php  } ?>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 d-none dis-not-n">
                        <div class="card card-confirm">
                            <div class="card-header card-header-itme">
                                <span class="text-comfirm">
                                    สรุปรายการสั่งซื้อ
                                </span>
                            </div>
                            <div class="card-body">
                                <?php
                                $sqluser = $conn->prepare("SELECT * FROM users WHERE id = '" . $_SESSION['user_login'] . "'");
                                $sqluser->execute();
                                $rowuser = $sqluser->fetch(PDO::FETCH_ASSOC);

                                $sqladdress = $conn->prepare("SELECT * FROM usersadress WHERE id = '" . $rowuser['id'] . "' ");
                                $sqladdress->execute();
                                $rowaddress = $sqladdress->fetch(PDO::FETCH_ASSOC);

                                if ($sqluser->rowCount() == 0 || $sqladdress->rowCount() == 0) {
                                ?>
                                    <form id="addaddress-mobile">
                                        <input type="hidden" name="action" value="addaddress-mobile">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">ชื่อ</label>
                                                    <input type="text" class="form-control" name="firstname" id="firstname">
                                                </div>
                                                <div class="col">
                                                    <label for="">นามสกุล</label>
                                                    <input type="text" class="form-control" name="lastname" id="lastname">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">ที่อยู่จัดส่ง</label>
                                            <textarea class="textareaadress" name="user_adress" id="user_adress"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">รหัสไปรษณีย์</label>
                                                    <input type="text" class="form-control" name="user_postal_code" id="user_postal_code">
                                                </div>
                                                <div class="col">
                                                    <label for="">หมายเลขโทรศัพท์</label>
                                                    <input type="text" class="form-control" name="phone" id="phone">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">จังหวัด</label>
                                                    <input type="text" class="form-control" name="user_province" id="user_province">
                                                </div>
                                                <div class="col">
                                                    <label for="">อำเภอ</label>
                                                    <input type="text" class="form-control" name="user_district" id="user_district">
                                                </div>
                                                <div class="col">
                                                    <label for="">ตำบล</label>
                                                    <input type="text" class="form-control" name="user_parish" id="user_parish">
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" form-group text-left">
                                            <label class="text-comfirm" for="order_express">วิธีการจัดส่ง</label>
                                            <span class="text-subcomfirm"> (จัดส่งฟรี EMS เมื่อซื้อครบ 999 บาท) </span>
                                            <select name="order_express" id="order_express" class="form-control text-comfirm">
                                                <option value="ไปรษณีย์ไทย" selected>ไปรษณีย์ไทย ราคา 60 บาท</option>
                                                <option value="J&T Express">J&T Express ราคา 60 บาท</option>
                                                <option value="Kerry Express">Kerry Express ราคา 60 บาท</option>
                                                <option value="Flash Express">Flash Express ราคา 60 บาท</option>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn-confirm btn-success">
                                                เพิ่มที่อยู่
                                            </button>
                                        </div>
                                    </form>

                                <?php } else { ?>
                                    <form id="editaddress-mobile">
                                        <input type="hidden" name="action" value="editaddress-mobile">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">ชื่อ</label>
                                                    <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $rowuser['firstname'] ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="">นามสกุล</label>
                                                    <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $rowuser['lastname']; ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">ที่อยู่จัดส่ง</label>
                                            <textarea name="user_adress" id="user_adress" class="textareaadress"><?= $rowaddress['user_adress'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">รหัสไปรษณีย์</label>
                                                    <input type="text" name="user_postal_code" id="user_postal_code" class="form-control" value="<?= $rowaddress['user_postal_code'] ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="">หมายเลขโทรศัพท์</label>
                                                    <input type="text" name="phone" id="phone" class="form-control" value="<?= $rowuser['phone'] ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">จังหวัด</label>
                                                    <input type="text" name="user_province" id="user_province" class="form-control" value="<?= $rowaddress['user_province'] ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="">อำเภอ</label>
                                                    <input type="text" name="user_district" id="user_district" class="form-control" value="<?= $rowaddress['user_district'] ?>">
                                                </div>
                                                <div class="col">
                                                    <label for="">ตำบล</label>
                                                    <input type="text" name="user_parish" id="user_parish" class="form-control" value="<?= $rowaddress['user_parish'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-left">
                                            <label for="order_express">วิธีการจัดส่ง </label>
                                            <span class="text-subcomfirm">จัดส่งฟรี EMS เมื่อซื้อครบ 999 บาท </span>
                                            <select name="order_express" id="order_express" class="form-control text-comfirm">
                                                <option hidden value="<?= $rowaddress['order_express'] ?>" selected> <?= $rowaddress['order_express'] ?> ราคา 60 บาท</option>
                                                <option value="ไปรษณีย์ไทย">ไปรษณีย์ไทย ราคา 60 บาท</option>
                                                <option value="J&T Express">J&T Express ราคา 60 บาท</option>
                                                <option value="Kerry Express">Kerry Express ราคา 60 บาท</option>
                                                <option value="Flash Express">Flash Express ราคา 60 บาท</option>
                                            </select>
                                        </div>
                                        <span class="text-danger">อย่าลืมตรวจสอบที่อยู่จัดส่งก่อน *</span><br>
                                        <span class="text-danger">อย่าลืมกดบันทึกข้อมูลก่อนสั่งสินค้าทุกครั้ง *</span><br>
                                        <span class="text-danger">สินค้าที่สั่งซื้อไปแล้วจะไม่สามารถเปลี่ยนที่อยู่ทีหลังได้ * </span><br><br>
                                        <div class="text-center">
                                            <button class="btn-confirm btn-success">
                                                บันทึกที่อยู่
                                            </button>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-none dis-not-n">
                        <div class="table table-item col-4">
                            <div class="card card-item1">
                                <div class="card-header card-header-itme">
                                    <span class="text-comfirm">
                                        สรุปรายการสั่งซื้อ
                                    </span>
                                </div>
                                <div class="card-body">

                                    <?php
                                    $total_quantity = 0;
                                    $total_price = 0;
                                    if (isset($_SESSION["cart"])) {
                                        foreach ($_SESSION['cart']['product_id'] as $key => $val) {
                                            $rowcartproduct = $conn->query("SELECT * FROM product WHERE product_id = ${key}")->fetch(PDO::FETCH_ASSOC);
                                            $makeprice = $val * $rowcartproduct['product_price'];
                                            $total_quantity += $val;
                                            $price = $val * $rowcartproduct['product_price'];
                                            $total_price += $makeprice;
                                            $order_express = 60;

                                            $picCart = $conn->query("SELECT * FROM product_pic WHERE product_id = '" . $rowcartproduct['product_id'] . "'");
                                            $picCart->execute();
                                            $rowpicCart = $picCart->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                            <div class="row">
                                                <div class="col-12 col-lg-2 text-center mt-2">
                                                    <img src="include/img/<?= $rowpicCart['product_pic_path'] ?>" width="50px" height="50px" alt="">
                                                </div>
                                                <div class="col-12 col-lg-8 ml-2">
                                                    <span class="text-comfirm"><?= $rowcartproduct['product_name']; ?> </span>
                                                </div>
                                                <div class="col-12 col-lg-12 text-right">
                                                    <span class="text-comfirm"><?= number_format($rowcartproduct['product_price']); ?> บาท </span>
                                                    <span class="text-comfirm">* <?= number_format($val); ?> =</span>
                                                    <span class="text-comfirm"> <?= number_format($price); ?> บาท</span>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php } ?>

                                        <div class="col-12 allprice">
                                            <span class="text-comfirm">ยอดรวมสินค้า <?= $total_quantity ?> ชิ้น</span>
                                            <span class="text-comfirm"><?= number_format($total_price) ?> บาท</span>
                                        </div>

                                        <div class="col-12 allprice">
                                            <span class="text-comfirm">ค่าจัดส่ง</span>
                                            <?php
                                            if ($total_price >= 999) {
                                            ?>
                                                <span class="text-comfirm"> 0 บาท</span>
                                            <?php } else { ?>
                                                <span class="text-comfirm"> 60 บาท</span>
                                            <?php } ?>
                                        </div>
                                        <div class="col-12">
                                            <hr class="hr-Dotted">
                                        </div>
                                        <div class="col-12 allprice">
                                            <span class="text-comfirm">ยอดรวมสุทธิ</span>
                                            <?php
                                            if ($total_price >= 999) {
                                            ?>
                                                <span class="text-comfirm"><?= number_format($total_price) ?> บาท</span>
                                            <?php } else { ?>
                                                <span class="text-comfirm"><?= number_format($total_price + $order_express) ?> บาท</span>
                                            <?php } ?>
                                        </div>

                                        <div class="col-12">
                                            <hr class="hr-Dotted">
                                        </div>

                                        <?php
                                        if ($sqluser->rowCount() == 0 || $sqladdress->rowCount() == 0) {
                                        ?>
                                            <div class="text-center btnComfirm_text">
                                                <p class="A_not_confirmprodut">กรุณาเพิ่ม ที่อยู่จัดส่งก่อน</p>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-right btnComfirm_text">
                                                <a href="#" onclick="confirmorder('<?= $rowcartproduct['product_id'] ?>')" class="A_confirmprodut">สั่งซื้อสินค้า</a>
                                            </div>
                                        <?php } ?>

                                    <?php  } ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </session>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            $(".modal").removeAttr("tabindex");
        });
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        function getFormData($form) {
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};
            
            $.map(unindexed_array, function(n, i) {
                indexed_array[n['name']] = n['value'];
            });

            return JSON.stringify(indexed_array);
        }

        function wait() {
            swal.fire({
                html: '<h5>กรุณารอซักครู่...</h5>',
                showConfirmButton: false,
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            // alert();
        });

        function alerts(icon, text) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: icon,
                title: text
            })
        }

        function confirmorder(id) {
            $.ajax({
                type: "POST",
                url: "ajax/action.php?confirmorder",
                data: {
                    id: id,
                },
                success: function(response) {
                    // console.log(response)
                    let data;
                    try {
                        data = JSON.parse(response)
                    } catch (e) {
                        alerts("error", "เกิดข้อผิดพลาด");
                    }
                    if (data.status == "success") {
                        alerts(data.status, data.msg)
                        $("#cartdata").html('');
                        $("#total_quantity").html('0');
                        $("#total_price").html('0');
                        setTimeout(() => {
                            window.location = 'history.php'
                        }, 1000)
                        return false
                    }
                    alerts(data.status, data.msg);
                }
            });
        }
    </script>

    <script>
        $("#addaddress").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            // console.log(data);
            // console.log(datavalid.sorting.length);
            if (isNaN(datavalid.phone) || isNaN(datavalid.user_postal_code)) {
                Swal.fire(' เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.firstname.length == "0" || datavalid.lastname.length == "0" || datavalid.phone.length == "0" || datavalid.user_adress.length == "0" || datavalid.user_province.length == "0" || datavalid.user_postal_code.length == "0" || datavalid.user_district.length == "0" || datavalid.user_parish.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/address.php",
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    let res = JSON.parse(resp);
                    if (res.status == "success") {
                        Toast.fire({
                            icon: 'success',
                            title: 'สำเร็จ!'
                        })
                        setTimeout((e) => {
                            window.location = '?success'
                        }, 1500);
                    } else {
                        if (res.msg == "wrong") {
                            Toast.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!'
                            })
                        } else if (res.msg == "nopermission") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ไม่ได้รับอนุญาต!',
                            })
                        } else if (res.msg == "notnum") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ข้อมูลไม่ถูกต้อง!',
                            })
                        } else if (res.msg == "empty") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ห้ามปล่อยว่าง!',
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!'
                            })
                        }

                        setTimeout((e) => {
                            window.location = '?error'
                        }, 1500);
                    }
                }
            });
        });

        $("#addaddress-mobile").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            // console.log(data);
            // console.log(datavalid.sorting.length);
            if (isNaN(datavalid.phone) || isNaN(datavalid.user_postal_code)) {
                Swal.fire(' เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.firstname.length == "0" || datavalid.lastname.length == "0" || datavalid.phone.length == "0" || datavalid.user_adress.length == "0" || datavalid.user_province.length == "0" || datavalid.user_postal_code.length == "0" || datavalid.user_district.length == "0" || datavalid.user_parish.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/address.php",
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    let res = JSON.parse(resp);
                    if (res.status == "success") {
                        Toast.fire({
                            icon: 'success',
                            title: 'สำเร็จ!'
                        })
                        setTimeout((e) => {
                            window.location = '?success'
                        }, 1500);
                    } else {
                        if (res.msg == "wrong") {
                            Toast.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!'
                            })
                        } else if (res.msg == "nopermission") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ไม่ได้รับอนุญาต!',
                            })
                        } else if (res.msg == "notnum") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ข้อมูลไม่ถูกต้อง!',
                            })
                        } else if (res.msg == "empty") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ห้ามปล่อยว่าง!',
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!'
                            })
                        }

                        setTimeout((e) => {
                            window.location = '?error'
                        }, 1500);
                    }
                }
            });
        });

        $("#editaddress").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            var datavalid = JSON.parse(getFormData($(this)));
            // console.log(data);
            // console.log(datavalid.sorting.length);
            if (isNaN(datavalid.phone) || isNaN(datavalid.user_postal_code)) {
                Swal.fire(' เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.firstname.length == "0" || datavalid.lastname.length == "0" || datavalid.phone.length == "0" || datavalid.user_adress.length == "0" || datavalid.user_province.length == "0" || datavalid.user_postal_code.length == "0" || datavalid.user_district.length == "0" || datavalid.user_parish.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/address.php",
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    let res = JSON.parse(resp);
                    if (res.status == "success") {
                        Toast.fire({
                            icon: 'success',
                            title: 'สำเร็จ!'
                        })
                        setTimeout((e) => {
                            window.location = '?success'
                        }, 1500);
                    } else {
                        if (res.msg == "wrong") {
                            Toast.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!'
                            })
                        } else if (res.msg == "nopermission") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ไม่ได้รับอนุญาต!',
                            })
                        } else if (res.msg == "notnum") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ข้อมูลไม่ถูกต้อง!',
                            })
                        } else if (res.msg == "empty") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ห้ามปล่อยว่าง!',
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!'
                            })
                        }

                        setTimeout((e) => {
                            window.location = '?error'
                        }, 1500);
                    }
                }
            });
        });

        $("#editaddress-mobile").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            var datavalid = JSON.parse(getFormData($(this)));
            // console.log(data);
            // console.log(datavalid.sorting.length);
            if (isNaN(datavalid.phone) || isNaN(datavalid.user_postal_code)) {
                Swal.fire(' เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.firstname.length == "0" || datavalid.lastname.length == "0" || datavalid.phone.length == "0" || datavalid.user_adress.length == "0" || datavalid.user_province.length == "0" || datavalid.user_postal_code.length == "0" || datavalid.user_district.length == "0" || datavalid.user_parish.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/address.php",
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    let res = JSON.parse(resp);
                    if (res.status == "success") {
                        Toast.fire({
                            icon: 'success',
                            title: 'สำเร็จ!'
                        })
                        setTimeout((e) => {
                            window.location = '?success'
                        }, 1500);
                    } else {
                        if (res.msg == "wrong") {
                            Toast.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!'
                            })
                        } else if (res.msg == "nopermission") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ไม่ได้รับอนุญาต!',
                            })
                        } else if (res.msg == "notnum") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ข้อมูลไม่ถูกต้อง!',
                            })
                        } else if (res.msg == "empty") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ห้ามปล่อยว่าง!',
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!'
                            })
                        }

                        setTimeout((e) => {
                            window.location = '?error'
                        }, 1500);
                    }
                }
            });
        });
    </script>

    <?php include('include/footerindex.php'); ?>
    <?php
    // echo  $_SESSION['user_login'];
    ?>
</body>

</html>