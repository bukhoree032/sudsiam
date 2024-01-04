<?php include('sidebar.php'); ?>

<section class="home-section">

    <div class="home-content">
        <i class='bx bx-menu'></i>
        <?php
        echo date('l' . ' ' . 'd' . ' ' . 'M' . ' ' . 'Y');
        ?>
    </div>

    <div class="body-content">

        <div class="box-content box1">
            <?php
            $sqlpayment1 = $conn->prepare("SELECT SUM(pay_price) FROM payment WHERE pay_ems = 'การจัดส่งเรียบร้อย' and pay_status = 'ยืนยันสินค้าเรียบร้อย' ");
            $sqlpayment1->execute();
            $rowpayment1 = $sqlpayment1->fetch(PDO::FETCH_ASSOC);
            ?>
            <h1><?php
                echo number_format($rowpayment1['SUM(pay_price)']) . ' ' . 'บาท';
                ?>
            </h1>
            <p>รายได้ทั้งหมด</p>
        </div>

        <div class="box-content box2">
            <?php
            $sqlpayment1 = $conn->prepare("SELECT * FROM payment WHERE pay_ems = 'ยังไม่มีการจัดส่งสินค้า' and pay_status = 'ยืนยันสินค้าเรียบร้อย' ");
            $sqlpayment1->execute();
            $rowpayment1 = $sqlpayment1->fetchAll(PDO::FETCH_OBJ);
            ?>
            <h1><?php
                echo $sqlpayment1->rowCount() . ' ' . 'ชิ้น';
                ?>
            </h1>
            <p>จำนวนสินค้ารอจัดส่ง</p>
        </div>

        <div class="box-content box3">
            <?php
            $sqlpayment = $conn->prepare("SELECT * FROM payment WHERE pay_status = 'รอการยืนยันการสั่งซื้อ' ");
            $sqlpayment->execute();
            $rowpayment = $sqlpayment->fetchAll(PDO::FETCH_OBJ);
            ?>
            <h1><?php
                echo $sqlpayment->rowCount() . ' ' . 'ชิ้น';
                ?>
            </h1>
            <p>จำนวนรายการสินค้ารออนุมัติ</p>
        </div>

        <div class="box-content box4">
            <?php
            $sqlStock = $conn->prepare("SELECT * FROM product WHERE product_quantity <= 20");
            $sqlStock->execute();
            $rowStock = $sqlStock->fetchAll(PDO::FETCH_OBJ);
            ?>
            <h1><?php
                echo $sqlStock->rowCount() . ' ' . 'ชิ้น';
                ?>
            </h1>
            <p>สินค้าใกล้หมดสต๊อก</p>
        </div>
    </div>
    <br>
    <div class="table-content">
        <div class="card">
            <div class="card-head">
                <p>สินค้าขายดีประจำร้าน (ชิ้น)</p>
            </div>
            <div class="card-body">
                <div class="box-tale">
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
        </div>
        <div class="card ml-2">
            <div class="card-head">
                <p>สินค้าขายดีประจำร้าน</p>
            </div>
            <div class="card-body">
                <div class="box-tale">
                    <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="table-content mt-4">
        <div class="card">
            <div class="card-head">
                <p>สินค้าใกล้หมดสต๊อก</p>
            </div>
            <div class="card-body">
                <div class="box-tale">
                    <table class="table" id="dataal">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $conn->prepare("SELECT * FROM product");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_OBJ);

                            foreach ($row as $res) {
                                // echo $res->product_id;
                                if ($res->product_quantity <= 20) {

                                    $sqlpic = $conn->prepare("SELECT * FROM product_pic WHERE product_id = '$res->product_id'");
                                    $sqlpic->execute();
                                    $rowpic = $sqlpic->fetch(PDO::FETCH_ASSOC);
                            ?>
                                    <tr>
                                        <td>
                                            <img src="../include/img/<?= $rowpic['product_pic_path'] ?>" width="50px" height="50px" alt="">
                                        </td>
                                        <td><?php echo $res->product_code; ?></td>
                                        <td><?php echo $res->product_name; ?></td>
                                        <td><?php echo $res->product_quantity; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</section>
<br>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
    var xValues = [
        <?php
        $sqlproduct = $conn->prepare("SELECT product_id, SUM(counts) AS tot FROM record GROUP BY product_id order by SUM(counts) DESC LIMIT 5");
        $sqlproduct->execute();
        // $rowproduct = $sqlproduct->fetchAll(PDO::FETCH_OBJ);
        $rowproduct = $sqlproduct->fetchAll(PDO::FETCH_OBJ);

        foreach ($rowproduct as $resss) {
            $sqlpro = $conn->prepare("SELECT * FROM product WHERE product_id = $resss->product_id ");
            $sqlpro->execute();
            $rowpro = $sqlpro->fetch(PDO::FETCH_ASSOC);
            // echo $resss->tot . ' ';
            $product_code = $rowpro['product_code'];
            $rowaaa = array("$product_code");

            foreach ($rowaaa as $value) {
        ?>

                "<?= $value; ?>",
        <?php }
        } ?>
    ]
    var yValues = [
        <?php
        foreach ($rowproduct as $resss) {
            // echo $resss->tot . ' ';
            $rowaaa = array("$resss->product_id");
            foreach ($rowaaa as $value) {
        ?> "<?= $resss->tot ?> ",
        <?php }
        }
        ?>

    ];
    var barColors = "#00aba9";



    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "สินค้าขายดีประจำร้าน"
            }
        }
    });
</script>

<script>
    var xValues = [
        <?php
        $sqlproduct = $conn->prepare("SELECT product_id, SUM(counts) AS tot FROM record GROUP BY product_id order by SUM(counts) DESC LIMIT 5");
        $sqlproduct->execute();
        // $rowproduct = $sqlproduct->fetchAll(PDO::FETCH_OBJ);
        $rowproduct = $sqlproduct->fetchAll(PDO::FETCH_OBJ);

        foreach ($rowproduct as $resss) {
            $sqlpro = $conn->prepare("SELECT * FROM product WHERE product_id = $resss->product_id ");
            $sqlpro->execute();
            $rowpro = $sqlpro->fetch(PDO::FETCH_ASSOC);
            // echo $resss->tot . ' ';
            $product_code = $rowpro['product_code'];
            $rowaaa = array("$product_code");

            foreach ($rowaaa as $value) {
        ?>

                "<?= $value; ?>",
        <?php }
        } ?>
    ];

    var yValues = [
        <?php
        foreach ($rowproduct as $resss) {
            // echo $resss->tot . ' ';
            $rowaaa = array("$resss->product_id");
            foreach ($rowaaa as $value) {
        ?> "<?= $resss->tot ?> ",
        <?php }
        }
        ?>
    ];
    var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];

    new Chart("myChart2", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "สินค้าขายดีประจำร้าน"
            }
        }
    });
</script>


<script>
    let arrow = document.querySelectorAll(".arrow");

    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {

            let arrowParent = e.target.parentElement.parentElement;
            arrowParent.classList.toggle("showMenu");
        });
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarbtn = document.querySelector(".bx-menu");
    // console.log(sidebarbtn);


    sidebarbtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");

    });
</script>



</body>

</html>