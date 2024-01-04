<!doctype html>
<html lang="th">
<?php session_start(); ?>
<?php include('include/connect.php'); ?>

<?php include('include/headindex.php'); ?>
<?php include('include/navbar.php'); ?>


<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="styels.css">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="bg-body">

    <section>
        <div class="container">
            <div class="payment-head">
                <span>แจ้งการชำระเงิน</span>
            </div>
            <div class="payment-body">
                <form id="addpayment" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="addpayment">
                    <div class="form-group payment-item">
                        <div class="row">
                            <div class="col-7">
                                <label for="">เลขที่ใบสั่งซื้อ</label>
                                <input type="text" name="paymentid" id="paymentid" class="form-control" value="">
                                <span>สามารถตรวจสอบหมายเลขได้จาก <a class="a_payment" href='history.php'>ที่นี้</a></span><br>
                                <span1></span1>
                            </div>
                            <div class="col-5">
                            </div>

                        </div>
                    </div>

                    <div class="form-group payment-item">
                        <div class="row">
                            <div class="col-5">
                                <label for="">ชื่อ</label>
                                <input type="text" id="name" name="name" class="form-control" value="" hidden>
                                <input type="text" name="name1" id="name1" class="form-control" value="" disabled>
                            </div>
                            <div class="col-5">
                                <label for="">อีเมล</label>
                                <input type="text" name="email" id="email" class="form-control" value="" hidden>
                                <input type="text" name="email1" id="email1" class="form-control" value="" disabled>
                            </div>

                        </div>
                    </div>

                    <div class="form-group payment-item">
                        <div class="row">
                            <div class="col-5">
                                <label for="">เบอร์โทรศัพท์</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="" hidden>
                                <input type="text" name="phone1" id="phone1" class="form-control" value="" disabled>
                            </div>
                            <div class="col-5">
                                <label for="">จำนวนเงิน</label>
                                <input type="text" name="price" id="price" class="form-control" value="" hidden>
                                <input type="text" name="price1" id="price1" class="form-control" value="" disabled>
                            </div>

                        </div>
                    </div>

                    <div class="form-group payment-item">
                        <div class="row">
                            <div class="col-6">
                                <label for="">วิธีการชำระเงิน</label>
                                <input type="text" name="" id="" class="form-control" value="ผ่านทางธนาคาร" disabled>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                    </div>

                    <div class="form-group payment-item">
                        <div class="row">
                            <div class="col-10">
                                <div class="box-bank">
                                    <span>ธนาคาร xxxxxx</span><br>
                                    <span>เลขที่บัญชี xxx-xxxxxx-x ชื่อบัญชี xxxxxx xxxxxx </span>
                                </div>
                            </div>
                            <div class="col-2">

                            </div>
                        </div>
                    </div>


                    <div class="form-group payment-item">
                        <div class="row">
                            <div class="col-5">
                                <label for="">วันที่ชำระ</label>
                                <input type="date" name="date" id="" class="form-control" value="">
                            </div>
                            <div class="col-5">
                                <label for="">เวลาชำระ</label>
                                <input type="time" name="time" id="" class="form-control" value="">
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group payment-item">
                        <div class="row">
                            <div class="col-10">
                                <label for="">หลักฐานการชำระเงิน</label>
                                <img id="showpic" src="" class="rounded col-sm-12" onclick="document.getElementById('preimg').click();" width="100%" style="cursor: pointer;">
                                <input type="file" class="sr-only" id="preimg" name="preimg" required accept="image/*" onchange="readURL(this);"><br>
                                <div onclick="$('#preimg').click();" class="mt-2 btn btn-info">อัพโหลดรูปภาพ</div>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group payment-item">
                        <div class="row">
                            <div class="col-10">
                                <label for="">หมายเหตุ</label>
                                <textarea class="form-control" name="note" id="" cols="" rows="3"></textarea>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group payment-btn">
                        <div class="row">
                            <div class="col btn-error">
                                <span class="text-danger">อย่าลืมตรวจสอบข้อมูลก่อน *</span><br>
                                <span class="text-danger">สินค้าที่แจ้งชำระไปแล้วจะไม่สามารถเปลี่ยนข้อมูลได้ทีหลังได้ * </span><br><br>
                                <button class="btn-payment" id="btnpay">
                                    <i class='bx bx-check'></i> แจ้งการชำระเงิน
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

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

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showpic').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        var paymentid = false;

        $('#paymentid').on('blur', function() {
            var paymentid = $('#paymentid').val();
            if (paymentid == '') {
                payment_state = false;
                return;
            }
            $.ajax({
                url: 'ajax/payment.php',
                type: 'POST',
                data: {
                    'payment_chk': 1,
                    'paymentid': paymentid
                },
                success: function(response) {
                    // console.log(response)
                    if (response == "not_taken") {
                        payment_state = true;
                        $('#paymentid').parent().removeClass();
                        $('#paymentid').parent().addClass('col - 7' + ' ' + 'form_error');
                        $('#paymentid').siblings("span").text("ไม่พบข้อมูลใบสั่งซื้อ กรุณาตรวจสอบความถูกต้องอีกครั้ง");
                        $('#paymentid').siblings("span1").html("สามารถตรวจสอบหมายเลขได้จาก <a href='history.php'>ที่นี้</a>");
                    } else if (response == "taken") {
                        $('#paymentid').parent().removeClass();
                        $('#paymentid').parent().addClass('col - 7' + ' ' + 'form_error');
                        $('#paymentid').siblings("span").text("รหัสการสั่งซื้อชิ้นนี้ทำการแจ้งชำระเงินแล้ว! ");
                        $('#paymentid').siblings("span1").html("สามารถตรวจสอบสถานะสินค้าได้จาก <a href='order.php'>ที่นี้</a>");
                    } else {
                        let res = JSON.parse(response);
                        payment_state = false;
                        $('#paymentid').parent().removeClass();
                        $('#paymentid').parent().addClass('col - 7' + ' ' + 'form_success');
                        $('#paymentid').siblings("span").text("มีรหัสนี้อยู่ในระบบ");
                        $('#paymentid').siblings("span1").text(" ");

                        $("#price").val(res.msg.price);
                        $("#price1").val(res.msg.price1);

                        $("#name").val(res.msg.name);
                        $("#name1").val(res.msg.name1);

                        $("#email").val(res.msg.email);
                        $("#email1").val(res.msg.email1);

                        $("#phone").val(res.msg.phone);
                        $("#phone1").val(res.msg.phone1);
                    }
                }
            })
        });
    </script>

    <script>
        $("#addpayment").submit(function(e) {
            e.preventDefault();
            // var data = $(this).serialize();
            // var datavalid = JSON.parse(getFormData($(this)));
            var form = $("#addpayment")[0]
            var formdata = new FormData(form)
            var inputfile = $("#preimg")[0].files[0]
            formdata.append('image', inputfile)
            $.ajax({
                type: "POST",
                url: "ajax/record.php",
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    // console.log("success");
                    console.log(resp);
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
                        } else if (res.msg == "status") {
                            Toast.fire({
                                icon: 'error',
                                title: 'สินค้านี้ชำระเงินแล้ว!',
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
                },
            });
        });
    </script>

</body>

</html>