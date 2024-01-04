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

    <section class="mb-5" style="height: 510px;">
        <div class="container ">
            <div class="payment-head">
                <span>ติดตามสถานะการสั่งซื้อ</span>
            </div>
            <div class="payment-body">
                <form id="order">
                    <input type="hidden" name="action" value="order">
                    <div class="form-group order-item">
                        <div class="row">
                            <div class="col-10 text-center">
                                <span class="order-text ">ค้นหาด้วยหมายเลขคำสั่งซื้อของคุณ</span>
                            </div>
                            <div class="col-2">
                            </div>

                        </div>
                    </div>
                    <div class="form-group order-item">
                        <div class="row">
                            <div class="col-10 text-center ">
                                <input type="text" name="orderid" id="orderid" class="form-control mb-3 text-center" value="">
                                <span>สามารถตรวจสอบหมายเลขได้จาก <a class="a_payment" href='history.php'>ที่นี้</a></span><br>
                            </div>
                            <div class="col-2">
                            </div>

                        </div>
                    </div>

                    <div class="form-group payment-btn">
                        <div class="row">
                            <div class="col">
                                <button class="btn-payment">
                                    <span> <i class='bx bx-search mr-1'></i>ค้นหาหมายเลขคำสั่งซื้อ</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section><br><br>

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
        $("#order").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            var bill_trx = $('#orderid').val();
            console.log(bill_trx)

            // console.log(data);
            // console.log(datavalid.sorting.length);
            if (datavalid.orderid.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/order.php",
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    // console.log(resp)
                    let res = JSON.parse(resp);
                    if (res.status == "success") {
                        Toast.fire({
                            icon: 'success',
                            title: 'มีรหัสซื้อสินค้าชิ้นนี้!'
                        })
                        setTimeout((e) => {
                            window.location = 'orderchk.php?id='+ bill_trx
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
                        } else if (res.msg == "Notitme") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ไม่มีรหัสคำสั่งซื้อสินค้านี้!',
                            })
                        } else if (res.msg == "status") {
                            Toast.fire({
                                icon: 'error',
                                title: 'กรุณาแจ้งชำระเงินก่อน!',
                            })
                        } else if (res.msg == "empty") {
                            Toast.fire({
                                icon: 'error',
                                title: 'ห้ามปล่อยว่าง!'
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



</body>

</html>