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
<link rel="stylesheet" href="styels.css">

<body class="bg-body">

    <?php
    $user_login = $_SESSION['user_login'];
    $usersql = $conn->prepare("SELECT * FROM users WHERE id = '$user_login'");
    $usersql->execute();
    $resuseruser = $usersql->fetchAll(PDO::FETCH_OBJ);

    foreach ($resuseruser as $resusersql) {

    ?>

        <div class="container profile dis-n">
            <div class="row">
                <div class="headprofile">
                    <i class='bx bx-user-circle'></i>
                    <p> ยินดีต้อนรับ ::. <?php echo $resusersql->firstname . ' ' . $resusersql->lastname; ?></p>
                </div>
                <div class="bodyprofile">
                    <div class="sidebarprofile">
                        <div class="bodyhead">
                            <p class="textprofile">ข้อมูล Profile </p>
                        </div>
                        <div class="subbody">
                            <nav class="navprofile">
                                <ul class="ulbodyprofile">
                                    <a href="profile.php">
                                        <li><i class='bx bx-caret-right-circle'></i> ข้อมูลส่วนตัว</li>
                                    </a>
                                    <a href="memberad.php">
                                        <li><i class='bx bx-caret-right-circle'></i> ที่อยู่จัดส่ง</li>
                                    </a>
                                    <a href="history.php">
                                        <li><i class='bx bx-caret-right-circle'></i> ประวัติการสั่งซื้อ</li>
                                    </a>
                                    <a href="include/logout.php">
                                        <li><i class='bx bx-caret-right-circle'></i> ออกจากระบบ </li>
                                    </a>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <?php
                    $address = $conn->prepare("SELECT * FROM usersadress WHERE id = '" . $_SESSION['user_login'] . "' ");
                    $address->execute();
                    $rowadd = $address->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <?php
                    if ($address->rowCount() == 0) {
                    ?>
                        <div class="address-content">
                            <div class="sub-address-content">

                                <div class="address-groub">
                                    <label for="">ที่อยู่จัดส่ง</label>
                                    <textarea class="textareaadress" class="form-control" disabled></textarea>
                                </div>

                                <div class="address-groub">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">จังหวัด</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="">
                                        </div>

                                        <div class="col">
                                            <label for="">อำเภอ</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="">
                                        </div>

                                        <div class="col">
                                            <label for="">ตำบล</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="">
                                        </div>

                                    </div>

                                </div>

                                <div class="address-groub">
                                    <label for="">รหัสไปรษณีย์</label>
                                    <input type="text" class="form-control" disabled name="" id="" value="">
                                </div>

                                <button type="button" style="margin-top: 10px;" class="btn-profile" data-toggle="modal" data-target="#modelId">
                                    แก้ไขข้อมูล
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title modal-h-text">แก้ไขข้อมูล</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="address-content">
                                            <div class="sub-address-content">
                                                <form id="inputaddress">
                                                    <input type="hidden" name="action" value="inputaddress">
                                                    <div class="address-groub" style="margin-top: -40px;">
                                                        <label for="">ที่อยู่จัดส่ง</label>
                                                        <textarea class="textareaadress form-control" name="user_adress"></textarea>
                                                    </div>

                                                    <div class="address-groub">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">จังหวัด</label>
                                                                <input type="text" class="form-control" name="user_province" id="" value="">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">อำเภอ</label>
                                                                <input type="text" class="form-control" name="user_parish" id="" value="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="address-groub">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">ตำบล</label>
                                                                <input type="text" class="form-control" name="user_district" id="" value="">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">รหัสไปรษณีย์</label>
                                                                <input type="text" class="form-control" name="user_postal_code" id="" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class=" btn-success madal-btn-p">บันทึก</button>
                                        <button type="button" class="madal-btn-p btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="address-content">
                            <div class="sub-address-content">

                                <div class="address-groub">
                                    <label for="">ที่อยู่จัดส่ง</label>
                                    <textarea class="textareaadress" class="form-control" disabled><?= $rowadd['user_adress'] ?></textarea>
                                </div>

                                <div class="address-groub">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">จังหวัด</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="<?= $rowadd['user_province'] ?>">
                                        </div>

                                        <div class="col">
                                            <label for="">อำเภอ</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="<?= $rowadd['user_parish'] ?>">
                                        </div>

                                        <div class="col">
                                            <label for="">ตำบล</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="<?= $rowadd['user_district'] ?>">
                                        </div>

                                    </div>

                                </div>

                                <div class="address-groub">
                                    <label for="">รหัสไปรษณีย์</label>
                                    <input type="text" class="form-control" disabled name="" id="" value="<?= $rowadd['user_postal_code'] ?>">
                                </div>


                                <button type="button" style="margin-top: 10px;" class="btn-profile" data-toggle="modal" data-target="#modelId">
                                    แก้ไขข้อมูล
                                </button>
                            </div>
                        </div>


                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title modal-h-text">แก้ไขข้อมูล</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="address-content">
                                            <div class="sub-address-content">
                                                <form id="updateaddress">
                                                    <input type="hidden" name="action" value="updateaddress">
                                                    <div class="address-groub" style="margin-top: -40px;">
                                                        <label for="">ที่อยู่จัดส่ง</label>
                                                        <textarea class="textareaadress form-control" name="user_adress"> <?= $rowadd['user_adress'] ?></textarea>
                                                    </div>

                                                    <div class="address-groub">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">จังหวัด</label>
                                                                <input type="text" class="form-control" name="user_province" id="" value="<?= $rowadd['user_province'] ?>">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">อำเภอ</label>
                                                                <input type="text" class="form-control" name="user_parish" id="" value="<?= $rowadd['user_parish'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="address-groub">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">ตำบล</label>
                                                                <input type="text" class="form-control" name="user_district" id="" value="<?= $rowadd['user_district'] ?>">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">รหัสไปรษณีย์</label>
                                                                <input type="text" class="form-control" name="user_postal_code" id="" value="<?= $rowadd['user_postal_code'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class=" btn-success madal-btn-p">บันทึก</button>
                                        <button type="button" class="madal-btn-p btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>


        <div class="container profile d-none dis-not-n">
            <div class="row">
                <div class="headprofile">
                    <i class='bx bx-user-circle'></i>
                    <p> ยินดีต้อนรับ ::. <?php echo $resusersql->firstname . ' ' . $resusersql->lastname; ?></p>
                </div>
                <div class="bodyprofile-mobile">
                    <div class="sidebarprofile">
                        <div class="bodyhead">
                            <p class="textprofile">ข้อมูล Profile </p>
                        </div>
                        <div class="subbody">
                            <nav class="navprofile">
                                <ul class="ulbodyprofile">
                                    <a href="profile.php">
                                        <li><i class='bx bx-caret-right-circle'></i> ข้อมูลส่วนตัว</li>
                                    </a>
                                    <a href="memberad.php">
                                        <li><i class='bx bx-caret-right-circle'></i> ที่อยู่จัดส่ง</li>
                                    </a>
                                    <a href="history.php">
                                        <li><i class='bx bx-caret-right-circle'></i> ประวัติการสั่งซื้อ</li>
                                    </a>
                                    <a href="include/logout.php">
                                        <li><i class='bx bx-caret-right-circle'></i> ออกจากระบบ </li>
                                    </a>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="bodyprofile-mobile">
                    <?php
                    $address = $conn->prepare("SELECT * FROM usersadress WHERE id = '" . $_SESSION['user_login'] . "' ");
                    $address->execute();
                    $rowadd = $address->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <?php
                    if ($address->rowCount() == 0) {
                    ?>
                        <div class="address-content">
                            <div class="sub-address-content">

                                <div class="address-groub">
                                    <label for="">ที่อยู่จัดส่ง</label>
                                    <textarea class="textareaadress" class="form-control" disabled></textarea>
                                </div>

                                <div class="address-groub">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">จังหวัด</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="">
                                        </div>

                                        <div class="col">
                                            <label for="">อำเภอ</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="">
                                        </div>

                                        <div class="col">
                                            <label for="">ตำบล</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="">
                                        </div>

                                    </div>

                                </div>

                                <div class="address-groub">
                                    <label for="">รหัสไปรษณีย์</label>
                                    <input type="text" class="form-control" disabled name="" id="" value="">
                                </div>

                                <button type="button" style="margin-top: 10px;" class="btn-profile" data-toggle="modal" data-target="#modelId1">
                                    แก้ไขข้อมูล
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="modelId1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title modal-h-text">แก้ไขข้อมูล</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="address-content">
                                            <div class="sub-address-content">
                                                <form id="inputaddress-phone">
                                                    <input type="hidden" name="action" value="inputaddress-phone">
                                                    <div class="address-groub" style="margin-top: -40px;">
                                                        <label for="">ที่อยู่จัดส่ง</label>
                                                        <textarea class="textareaadress form-control" name="user_adress"></textarea>
                                                    </div>

                                                    <div class="address-groub">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">จังหวัด</label>
                                                                <input type="text" class="form-control" name="user_province" id="" value="">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">อำเภอ</label>
                                                                <input type="text" class="form-control" name="user_parish" id="" value="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="address-groub">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">ตำบล</label>
                                                                <input type="text" class="form-control" name="user_district" id="" value="">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">รหัสไปรษณีย์</label>
                                                                <input type="text" class="form-control" name="user_postal_code" id="" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class=" btn-success madal-btn-p">บันทึก</button>
                                        <button type="button" class="madal-btn-p btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="address-content">
                            <div class="sub-address-content">

                                <div class="address-groub">
                                    <label for="">ที่อยู่จัดส่ง</label>
                                    <textarea class="textareaadress" class="form-control" disabled><?= $rowadd['user_adress'] ?></textarea>
                                </div>

                                <div class="address-groub">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">จังหวัด</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="<?= $rowadd['user_province'] ?>">
                                        </div>

                                        <div class="col">
                                            <label for="">อำเภอ</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="<?= $rowadd['user_parish'] ?>">
                                        </div>

                                        <div class="col">
                                            <label for="">ตำบล</label>
                                            <input type="text" class="form-control" disabled name="" id="" value="<?= $rowadd['user_district'] ?>">
                                        </div>

                                    </div>

                                </div>

                                <div class="address-groub">
                                    <label for="">รหัสไปรษณีย์</label>
                                    <input type="text" class="form-control" disabled name="" id="" value="<?= $rowadd['user_postal_code'] ?>">
                                </div>


                                <button type="button" style="margin-top: 10px;" class="btn-profile" data-toggle="modal" data-target="#qqqq">
                                    แก้ไขข้อมูล
                                </button>
                            </div>
                        </div>


                        <div class="modal fade" id="qqqq" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title modal-h-text">แก้ไขข้อมูล</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="address-content">
                                            <div class="sub-address-content">
                                                <form id="updateaddress-phone">
                                                    <input type="hidden" name="action" value="updateaddress-phone">
                                                    <div class="address-groub" style="margin-top: -40px;">
                                                        <label for="">ที่อยู่จัดส่ง</label>
                                                        <textarea class="textareaadress form-control" name="user_adress"> <?= $rowadd['user_adress'] ?></textarea>
                                                    </div>

                                                    <div class="address-groub">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">จังหวัด</label>
                                                                <input type="text" class="form-control" name="user_province" id="" value="<?= $rowadd['user_province'] ?>">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">อำเภอ</label>
                                                                <input type="text" class="form-control" name="user_parish" id="" value="<?= $rowadd['user_parish'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="address-groub">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">ตำบล</label>
                                                                <input type="text" class="form-control" name="user_district" id="" value="<?= $rowadd['user_district'] ?>">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">รหัสไปรษณีย์</label>
                                                                <input type="text" class="form-control" name="user_postal_code" id="" value="<?= $rowadd['user_postal_code'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class=" btn-success madal-btn-p">บันทึก</button>
                                        <button type="button" class="madal-btn-p btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->



    <?php    } ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <br>
    <?php include('include/footerindex.php'); ?>

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
        $('#inputaddress').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            if (isNaN(datavalid.user_postal_code) || datavalid.user_postal_code < 0) {
                Swal.fire('รหัสไปรษณีย์ เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.user_postal_code.length == "0" || datavalid.user_district.length == "0" || datavalid.user_parish.length == "0" || datavalid.user_province.length == "0" || datavalid.user_adress.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;

            }
            $.ajax({
                type: 'POST',
                url: 'ajax/address.php',
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    // console.log(resp)

                    let res = JSON.parse(resp);
                    console.log(resp);
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

        $('#inputaddress-phone').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            if (isNaN(datavalid.user_postal_code) || datavalid.user_postal_code < 0) {
                Swal.fire('รหัสไปรษณีย์ เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.user_postal_code.length == "0" || datavalid.user_district.length == "0" || datavalid.user_parish.length == "0" || datavalid.user_province.length == "0" || datavalid.user_adress.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;

            }
            $.ajax({
                type: 'POST',
                url: 'ajax/address.php',
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    // console.log(resp)

                    let res = JSON.parse(resp);
                    console.log(resp);
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

    <script>
        $('#updateaddress').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            if (isNaN(datavalid.user_postal_code) || datavalid.user_postal_code < 0) {
                Swal.fire('รหัสไปรษณีย์ เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.user_postal_code.length == "0" || datavalid.user_district.length == "0" || datavalid.user_parish.length == "0" || datavalid.user_province.length == "0" || datavalid.user_adress.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;

            }
            $.ajax({
                type: 'POST',
                url: 'ajax/address.php',
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    // console.log(resp)

                    let res = JSON.parse(resp);
                    console.log(resp);
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

        $('#updateaddress-phone').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            if (isNaN(datavalid.user_postal_code) || datavalid.user_postal_code < 0) {
                Swal.fire('รหัสไปรษณีย์ เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.user_postal_code.length == "0" || datavalid.user_district.length == "0" || datavalid.user_parish.length == "0" || datavalid.user_province.length == "0" || datavalid.user_adress.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;

            }
            $.ajax({
                type: 'POST',
                url: 'ajax/address.php',
                data: data,
                beforeSend: (e) => {
                    wait();
                },
                success: (resp) => {
                    // console.log(resp)

                    let res = JSON.parse(resp);
                    console.log(resp);
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


</body>

</html>