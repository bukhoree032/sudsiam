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
                                        <li><i class='bx bx-caret-right-circle'></i> ออกจากระบบ</li>
                                    </a>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="profile-content">
                        <div class="sub-content">
                            <div class="input-profile">
                                <div class="row">
                                    <div class="col">
                                        <span>ชื่อ</span>
                                        <input type="text" class="form-control" value="<?php echo $resusersql->firstname; ?>" disabled>
                                    </div>
                                    <div class="col">
                                        <span>นามสกุล</span>
                                        <input type="text" class="form-control" value="<?php echo $resusersql->lastname; ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="input-profile">
                                <div class="row">
                                    <div class="col">
                                        <span>Email</span>
                                        <input type="text" class="form-control" value="<?php echo $resusersql->email; ?>" disabled>
                                    </div>
                                    <div class="col">
                                        <span>เพศ</span>
                                        <select id="sex" class="form-control sex" disabled>
                                            <option class="form-control" value="none" selected><?= $resusersql->sex; ?></option>
                                            <option class="form-control" value="men">ชาย</option>
                                            <option class="form-control" value="women">หญิง</option>
                                        </select>
                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                            </div>

                            <div class="input-profile">
                                <span>เบอร์โทร</span>
                                <input type="text" class="form-control" value="<?php echo $resusersql->phone; ?>" disabled>
                            </div>

                            <button type="button" class="btn-profile" data-toggle="modal" data-target="#modelId">
                                แก้ไขข้อมูล
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container profile profile-mobile d-none dis-not-n">
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
                                        <li><i class='bx bx-caret-right-circle'></i> ออกจากระบบ</li>
                                    </a>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="bodyprofile-mobile">
                    <div class="profile-content">
                        <div class="sub-content">
                            <div class="input-profile">
                                <div class="row">
                                    <div class="col">
                                        <span>ชื่อ</span>
                                        <input type="text" class="form-control" value="<?php echo $resusersql->firstname; ?>" disabled>
                                    </div>
                                    <div class="col">
                                        <span>นามสกุล</span>
                                        <input type="text" class="form-control" value="<?php echo $resusersql->lastname; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="input-profile">
                                <div class="row">
                                    <div class="col">
                                        <span>Email</span>
                                        <input type="text" class="form-control" value="<?php echo $resusersql->email; ?>" disabled>
                                    </div>
                                    <div class="col">
                                        <span>เพศ</span>
                                        <select id="sex" class="form-control sex" disabled>
                                            <option class="form-control" value="none" selected><?= $resusersql->sex; ?></option>
                                            <option class="form-control" value="men">ชาย</option>
                                            <option class="form-control" value="women">หญิง</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <div class="input-profile">
                                <span>เบอร์โทร</span>
                                <input type="text" class="form-control" value="<?php echo $resusersql->phone; ?>" disabled>
                            </div>
                            <button type="button" class="btn-profile" data-toggle="modal" data-target="#modelId">
                                แก้ไขข้อมูล
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title modal-h-text">แก้ไขข้อมูล</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body madal-b-p">
                        <div class="profile-content">
                            <div class="sub-content">

                                <form id="editprofile">
                                    <input type="hidden" name="action" value="editprofile">
                                    <div class="input-profile" style="margin-top: -50px;">
                                        <span>ชื่อ</span>
                                        <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $resusersql->firstname; ?>">
                                    </div>
                                    <div class="input-profile">
                                        <span>นามสกุล</span>
                                        <input type="text" name="lname" class="form-control" value="<?php echo $resusersql->lastname; ?>">
                                    </div>

                                    <div class="input-profile">
                                        <span>เพศ</span>
                                        <select id="sex" name="sex" class="form-control sex">
                                            <option hidden value="<?php echo $resusersql->sex; ?>" selected><?php echo $resusersql->sex; ?></option>
                                            <option value="ไม่ระบุ">ไม่ระบุ</option>
                                            <option value="ชาย">ชาย</option>
                                            <option value="หญิง">หญิง</option>
                                        </select>
                                    </div>

                                    <div class="input-profile">
                                        <span>เบอร์โทร</span>
                                        <input type="text" name="phone" class="form-control" value="<?php echo $resusersql->phone; ?>">
                                    </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class=" btn-success madal-btn-p">บันทึก</button>
                        <button type="button" class=" btn-secondary madal-btn-p" data-dismiss="modal">ปิด</button>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    <?php    } ?>

    <br>
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
        $("#editprofile").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            // console.log(datavalid.sorting.length);
            if (datavalid.fname.length == "0" || datavalid.lname.length == "0" || datavalid.phone.length == "0" || datavalid.sex.length == "0") {
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

    <?php include('include/footerindex.php'); ?>


</body>

</html>