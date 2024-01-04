<!doctype html>
<html lang="th">
<?php session_start(); ?>
<?php include('include/connect.php'); ?>
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

<body class="bg-body">

    <section class="mb-5">
        <div class="container dis-n">
            <?php

            $chkorder = $conn->prepare("SELECT * FROM record WHERE bill_trx = '" . $_GET['id'] . "'");
            $chkorder->execute();
            $roworder = $chkorder->fetch(PDO::FETCH_ASSOC);

            $chkpayment = $conn->prepare("SELECT * FROM payment WHERE bill_trx = '" . $roworder['bill_trx'] . "'");
            $chkpayment->execute();
            $rowpayment = $chkpayment->fetch(PDO::FETCH_ASSOC);

            $chkuser = $conn->prepare("SELECT * FROM users WHERE id = '" . $roworder['id'] . "'");
            $chkuser->execute();
            $rowuser = $chkuser->fetch(PDO::FETCH_ASSOC);

            $chkuserad = $conn->prepare("SELECT * FROM usersadress WHERE id = '" . $roworder['id'] . "'");
            $chkuserad->execute();
            $rowuserad = $chkuserad->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="payment-head">
                <span>ติดตามสถานะการสั่งซื้อ</span>
            </div>
            <div class="payment-body bg-payment">
                <input type="hidden" name="action" value="order">
                <div class="form-group order-item">
                    <div class="row">
                        <div class="col-10 text-center mb-3">
                            <span class="order-text">หมายเลขคำสั่งซื้อ : <?= $rowpayment['bill_trx']; ?> </span><br>

                            <?php
                            if ($rowpayment['pay_status'] == 'รอการยืนยันการสั่งซื้อ') {
                            ?>
                                <span class="order-item1">สถานะ :</span>
                                <span class="order-item1 text-warning"> <?= $rowpayment['pay_status']; ?> </span>
                            <?php } else { ?>
                                <span class="order-item1">สถานะ :</span>
                                <span class="order-item1 text-success"><?= $rowpayment['pay_status']; ?> </span>
                            <?php } ?>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                </div>


                <div class="form-group order-item">
                    <div class="row order-item1 ">
                        <div class="col-6 text-center">
                            <span>วันที่สั่งซื้อสินค้า : <?= $rowpayment['pay_date']; ?> </span>
                        </div>
                        <div class="col-6">
                            <span>เวลาที่สั่งซื้อสินค้า : <?= $rowpayment['pay_time']; ?> </span>
                        </div>
                    </div>
                </div>

                <div class="form-group order-item">
                    <div class="row mt-2 order-item1">


                        <div class="col-6 text-center">
                            <span class="order-span-head">การจัดส่ง </span><br>
                            <span>สถานะจัดส่ง : <?= $rowpayment['pay_ems']; ?> </span><br>

                            <?php
                            if ($rowpayment['pay_id_ems'] == '') {
                                echo 'หมายเลขจัดส่ง : ยังไม่มีการจัดส่ง <br>';
                            } else {
                            ?>
                                <span>หมายเลขจัดส่ง : <?= $rowpayment['pay_id_ems']; ?> </span><br>
                            <?php }  ?>

                            <?php
                            if ($rowpayment['delivery_date'] == '') {
                                echo 'วันที่ส่ง : ยังไม่มีการจัดส่ง <br>';
                            } else {
                            ?>
                                <span>วันที่ส่ง : <?= $rowpayment['delivery_date']; ?> </span><br>
                            <?php }  ?>

                            <?php
                            if ($rowpayment['delivery_time'] == '') {
                                echo 'เวลาที่ส่ง : ยังไม่มีการจัดส่ง <br>';
                            } else {
                            ?>
                                <span>เวลาที่ส่ง : <?= $rowpayment['delivery_time']; ?> </span><br>
                            <?php }  ?>

                        </div>



                        <div class="col-6 text-left">
                            <span class="order-span-head">ที่อยู่จัดส่ง</span><br>
                            <span>นาย : <?= $rowuser['firstname'] . ' ' . $rowuser['lastname'] ?> </span><br>
                            <span>ที่อยู่จัดส่ง : <?= $rowuserad['user_adress']; ?> </span><br>
                            <span>ตำบล<?= $rowuserad['user_district']; ?> อำเภอ<?= $rowuserad['user_parish']; ?> </span><br>
                            <span>จังหวัด<?= $rowuserad['user_province']; ?> <?= $rowuserad['user_postal_code']; ?> </span><br>
                            <span>หมายเลขโทรศัพ : <?= $rowuser['phone']; ?> </span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container dis-not-n d-none">
            <?php

            $chkorder = $conn->prepare("SELECT * FROM record WHERE bill_trx = '" . $_GET['id'] . "'");
            $chkorder->execute();
            $roworder = $chkorder->fetch(PDO::FETCH_ASSOC);

            $chkpayment = $conn->prepare("SELECT * FROM payment WHERE bill_trx = '" . $roworder['bill_trx'] . "'");
            $chkpayment->execute();
            $rowpayment = $chkpayment->fetch(PDO::FETCH_ASSOC);

            $chkuser = $conn->prepare("SELECT * FROM users WHERE id = '" . $roworder['id'] . "'");
            $chkuser->execute();
            $rowuser = $chkuser->fetch(PDO::FETCH_ASSOC);

            $chkuserad = $conn->prepare("SELECT * FROM usersadress WHERE id = '" . $roworder['id'] . "'");
            $chkuserad->execute();
            $rowuserad = $chkuserad->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="payment-head">
                <span>ติดตามสถานะการสั่งซื้อ</span>
            </div>
            <div class="payment-body bg-payment">
                <input type="hidden" name="action" value="order">
                <div class="form-group order-item-mobile">
                    <div class="row">
                        <div class="col-10 text-center mb-3">
                            <span class="order-text">หมายเลขคำสั่งซื้อ <?= $rowpayment['bill_trx']; ?> </span><br>
                            <br>
                            <?php
                            if ($rowpayment['pay_status'] == 'รอการยืนยันการสั่งซื้อ') {
                            ?>
                                <span class="order-item1">สถานะ :</span>
                                <span class="order-item1 text-warning"> <?= $rowpayment['pay_status']; ?> </span>
                            <?php } else { ?>
                                <span class="order-item1">สถานะ :</span>
                                <span class="order-item1 text-success"><?= $rowpayment['pay_status']; ?> </span>
                            <?php } ?>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                </div>


                <div class="form-group order-item-mobile">
                    <div class="row order-item1 ord-date ">
                        <div class="col-12 text-center">
                            <span>วันที่สั่งซื้อสินค้า : <?= $rowpayment['pay_date']; ?></span><br>
                        </div>
                        <div class="col-12 text-center">
                            <span>เวลาที่สั่งซื้อสินค้า : <?= $rowpayment['pay_time']; ?> </span><br>
                        </div>
                    </div>
                </div>

                <div class="form-group order-item-mobile">
                    <div class="row mt-2 order-item1">


                        <div class="col-12 text-left">
                            <span class="order-span-head">การจัดส่ง </span><br>
                            <span>สถานะจัดส่ง : <?= $rowpayment['pay_ems']; ?> </span><br>

                            <?php
                            if ($rowpayment['pay_id_ems'] == '') {
                                echo 'หมายเลขจัดส่ง : ยังไม่มีการจัดส่ง <br>';
                            } else {
                            ?>
                                <span>หมายเลขจัดส่ง : <?= $rowpayment['pay_id_ems']; ?> </span><br>
                            <?php }  ?>

                            <?php
                            if ($rowpayment['delivery_date'] == '') {
                                echo 'วันที่ส่ง : ยังไม่มีการจัดส่ง <br>';
                            } else {
                            ?>
                                <span>วันที่ส่ง : <?= $rowpayment['delivery_date']; ?> </span><br>
                            <?php }  ?>

                            <?php
                            if ($rowpayment['delivery_time'] == '') {
                                echo 'เวลาที่ส่ง : ยังไม่มีการจัดส่ง <br>';
                            } else {
                            ?>
                                <span>เวลาที่ส่ง : <?= $rowpayment['delivery_time']; ?> </span><br>
                            <?php }  ?>

                        </div>



                        <div class="col-12 text-left">
                            <br>
                            <span class="order-span-head">ที่อยู่จัดส่ง</span><br>
                            <span>นาย : <?= $rowuser['firstname'] . ' ' . $rowuser['lastname'] ?> </span><br>
                            <span>ที่อยู่จัดส่ง : <?= $rowuserad['user_adress']; ?> </span><br>
                            <span>ตำบล : <?= $rowuserad['user_district']; ?> อำเภอ <?= $rowuserad['user_parish']; ?> </span><br>
                            <span>จังหวัด :  <?= $rowuserad['user_province']; ?> <?= $rowuserad['user_postal_code']; ?> </span><br>
                            <span>หมายเลขโทรศัพ : <?= $rowuser['phone']; ?> </span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php include('include/footerindex.php'); ?>
    <?php
    // echo  $_SESSION['user_login'];

    ?>

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

    </script>



</body>

</html>