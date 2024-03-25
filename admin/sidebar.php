<?php
session_start();
include('../include/connect.php')
?>
<!doctype html>
<html lang="th">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/sw_custom.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="styles.css">

<body>
    <div class="sidebar">
        <div class="logo-detil">

            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo-name">
                RedHoure
            </span>
        </div>
        <ul class="nav-linked">
            <li>
                <a href="index.php">
                    <i class='bx bx-home'></i>
                    <span class="link-named">
                        หน้าหลัก
                    </span>
                </a>

                <ul class="sub-menu blank">
                    <li><a class="link-named" href="index.php">หน้าหลัก</a></li>
                </ul>

            </li>

            <p class="manage">การจัดการข้อมูล</p>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bxl-product-hunt'></i>
                        <span class="link-named">
                            จัดการสินค้า
                        </span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-named" href="#">จัดการสินค้า</a></li>
                    <li><a href="product_type.php">จัดการชนิดของสินค้า</a></li>
                    <li><a href="product.php">(เพิ่ม/ลบ) รายการสินค้า</a></li>

                </ul>
            </li>

            <li>
                <a href="useredit.php">
                    <i class='bx bxs-user-circle'></i>
                    <span class="link-named">
                        จัดการสมาชิก
                    </span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-named" href="useredit.php">จัดการสมาชิก</a></li>
                </ul>
            </li>

            <p class="manage">การจัดการหน้าเว็บไซต์</p>
            <li>
                <a href="Carousel.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="link-named">
                        ตกแต่งหน้าเว็บไซต์
                    </span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-named" href="Carousel.php">ตกแต่งหน้าเว็บไซต์</a></li>
                </ul>
            </li>


            <p class="manage">รายงาน</p>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bx-copy-alt'></i>
                        <span class="link-named">
                            ติดตามสถานะ
                        </span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-named" href="#">ติดตามสถานะ</a></li>
                    <li><a href="pending.php">จัดการอนุมัติสินค้า</a></li>
                    <li><a href="delivery.php">จัดการจัดส่งสินค้า</a></li>
                </ul>
            </li>

            <li>

                <?php
                if (isset($_SESSION['admin_login'])) {

                    $sql = $conn->prepare("SELECT * FROM users WHERE id = '" . $_SESSION["admin_login"] . "' LIMIT 1");
                    $sql->execute();
                    $row = $sql->fetch(PDO::FETCH_ASSOC);

                    if ($sql->rowCount() == 0) {
                        echo "<script>window.location='../index.php'</script>";
                        exit;
                    }

                    if ($row['urole'] != 'admin') {
                        echo "<script>window.location='../index.php'</script>";
                        exit;
                    }
                } else {
                    echo "<script>window.location='../index.php'</script>";
                    exit;
                }
                ?>


                <div class="profile-details">
                    <div class="profile-content">
                        <img src="https://media-cdn.tripadvisor.com/media/photo-s/15/a4/9b/77/legacy-hotel-at-img-academy.jpg" alt="profile">
                    </div>
                    <div class="name-job">

                        <div class="profile-name"><?php echo $row['firstname']; ?></div>
                        <div class="job"><?php echo $row['urole']; ?></div>
                    </div>
                    <a href="../include/logout.php"> <i class="bx bx-log-out"></i></a>
                </div>
            </li>
        </ul>
    </div>