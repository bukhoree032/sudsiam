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
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.dataTables.min.css">

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
                    <div class="history-content">

                        <div class="sub-history-content">
                            <table class="table table-history" id="dataal">
                                <thead>
                                    <tr>
                                        <th scope="col">หมายเลขคำสั่งซื้อ</th>
                                        <th scope="col">สถานะการสั่งซื้อ</th>
                                        <th scope="col">วันที่สั่งซื้อ</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $datahistory = $conn->prepare("SELECT `bill_trx`,`created`,record_status FROM `record` WHERE `id` = '${user_login}' GROUP BY `bill_trx`");
                                    $datahistory->execute();
                                    $rowhistory = $datahistory->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($rowhistory as $reshis) {
                                        $billtrx = $reshis->bill_trx;
                                        $created = $reshis->created;
                                        $record_status = $reshis->record_status;
                                        $total_price = 0;
                                        $total_quantity = 0;
                                    ?>

                                        <tr>
                                            <td><?= $billtrx ?></td>
                                            <?php
                                            if ($record_status == 'ยังไม่ได้แจ้งชำระเงิน') {
                                            ?>
                                                <td class="text-warning"><?= $record_status ?><br>
                                                    <span class="text-danger" style="font-size: 14px;">กรุณาแจ้งชำระภายใน 24 ชม. *</span>
                                                </td>
                                            <?php } else if ($record_status == 'แจ้งการชำระเงินเรียบร้อย') { ?>
                                                <td class="text-success"><?= $record_status ?>
                                                </td>
                                            <?php } else {
                                                echo "<td class='text-danger'> รายการนี้หมดอายุแล้ว </td>";
                                            } ?>
                                            <td><?= $created ?></td>
                                            <td>
                                                <a target="_blank" class="searchcart btn-sm bg-warning" href="historyCart.php?id=<?= $billtrx ?>"><i class='bx bx-search'></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                    <div class="history-content">
                        <div class="sub-history-content">
                            <table class="table table-history table-mobile" id="example">
                                <thead class="mobile-head">
                                    <tr>
                                        <th scope="col">หมายเลขคำสั่งซื้อ</th>
                                        <th scope="col">สถานะการสั่งซื้อ</th>
                                        <th scope="col">วันที่สั่งซื้อ</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $datahistory = $conn->prepare("SELECT `bill_trx`,`created`,record_status FROM `record` WHERE `id` = '${user_login}' GROUP BY `bill_trx`");
                                    $datahistory->execute();
                                    $rowhistory = $datahistory->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($rowhistory as $reshis) {
                                        $billtrx = $reshis->bill_trx;
                                        $created = $reshis->created;
                                        $record_status = $reshis->record_status;
                                        $total_price = 0;
                                        $total_quantity = 0;
                                    ?>

                                        <tr>
                                            <td><?= $billtrx ?></td>
                                            <?php
                                            if ($record_status == 'ยังไม่ได้แจ้งชำระเงิน') {
                                            ?>
                                                <td class="text-warning"><?= $record_status ?></td>
                                            <?php } else if ($record_status == 'แจ้งการชำระเงินเรียบร้อย') { ?>
                                                <td class="text-success"><?= $record_status ?>
                                                </td>
                                            <?php } else {
                                                echo "<td class='text-danger'> รายการนี้หมดอายุแล้ว </td>";
                                            } ?>
                                            <td><?= $created ?></td>
                                            
                                            <td>
                                                <a target="_blank" class="searchcart btn-sm bg-warning" href="historyCart.php?id=<?= $billtrx ?>"><i class='bx bx-search'></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>



    <?php    } ?>

    <br>
    <?php include('include/footerindex.php'); ?>

    <script>
        $(document).ready(function() {
            $('#dataal').DataTable({
                "oLanguage": {
                    "sLengthMenu": "แสดงรายการ _MENU_ รายการ ต่อหน้า",
                    "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                    "sInfo": "จำนวน _START_ ถึง _END_ ใน _TOTAL_ รายการทั้งหมด",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 รายการทั้งหมด",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                    "sSearch": "ค้นหา :",
                    "aaSorting": [
                        [0, 'desc']
                    ],
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "หน้าสุดท้าย"
                    },
                },
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "oLanguage": {
                    "sLengthMenu": "แสดงรายการ _MENU_ รายการ ต่อหน้า",
                    "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                    "sInfo": "จำนวน _START_ ถึง _END_ ใน _TOTAL_ รายการทั้งหมด",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 รายการทั้งหมด",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                    "sSearch": "ค้นหา :",
                    "aaSorting": [
                        [0, 'desc']
                    ],
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "หน้าสุดท้าย"
                    },
                },
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>

</body>

</html>