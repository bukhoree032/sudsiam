<?php include('sidebar.php'); ?>

<section class="home-section">

    <div class="home-content">
        <i class='bx bx-menu'></i>
        <?php
        echo date('l' . ' ' . 'd' . ' ' . 'M' . ' ' . 'Y');
        ?>
    </div>



    <div class="body-content mt-4">
        <div class="card">
            <div class="card-header">
                <h3>
                    สินค้าที่สั่งซื้อ
                </h3>
                <span>หมายเลขที่สั่งซื้อ : <?= $_GET['id']; ?></span>
            </div>
            <div class="card-body">
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
                        $total_quantity = 0;
                        $total_price = 0;
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
                                <td><img src="../include/img/<?= $rowpicCart['product_pic_path'] ?>" width="60px" height="60px" alt=""></td>
                                <!-- <td><img src="assets/img/<?= $rowpicCart['product_pic_path'] ?>" width="60px" height="60px" alt=""></td> -->
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
            </div>
        </div>
    </div>


    <?php
    $datahistory = $conn->prepare("SELECT * FROM `record` WHERE `bill_trx` = '" . $_GET['id'] . "' ");
    $datahistory->execute();
    $rowhistory = $datahistory->fetch(PDO::FETCH_ASSOC);

    $user = $conn->prepare("SELECT * FROM users WHERE id = '" . $rowhistory['id'] . "' ");
    $user->execute();
    $rowuser = $user->fetch(PDO::FETCH_ASSOC);

    $address = $conn->prepare("SELECT * FROM usersadress WHERE id = '" . $rowuser['id'] . "'");
    $address->execute();
    $rowaddress = $address->fetch(PDO::FETCH_ASSOC);

    $payment = $conn->prepare("SELECT * FROM payment WHERE bill_trx = '" . $rowhistory['bill_trx'] . "'");
    $payment->execute();
    $rowpayment = $payment->fetch(PDO::FETCH_ASSOC);

    ?>

    <div class="body-content mt-4">

        <div class="card mr-2 card-address">
            <div class="card-header">
                <h3>
                    ข้อมูล ที่จัดส่ง
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <span>ชื่อ-นามสกุล</span><br>
                        <span><?= $rowpayment['pay_name'];?></span>
                    </div>

                    <div class="col-6">
                        <span>เบอร์โทรศัพท์</span><br>
                        <span><?= $rowpayment['pay_Phone'] ?></span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <span>ที่อยู่</span><br>
                        <span><?= $rowaddress['user_adress'] ?></span><br>
                        <span>อำเภอ <?= $rowaddress['user_district'] ?> ตำบล<?= $rowaddress['user_parish'] ?></span><br>
                        <span>จังหวัด <?= $rowaddress['user_province'] ?> <?= $rowaddress['user_postal_code'] ?></span>
                    </div>

                    <div class="col-6">
                        <span>Email</span><br>
                        <span><?= $rowpayment['pay_email'] ?></span>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-12">
                        <h4>หมายเหตุ</h4>
                        <textarea class="form-control" name="note" id="" cols="" rows="5" disabled><?= $rowpayment['pay_note'] ?></textarea>
                    </div>
                </div>

            </div>
        </div>

        <div class="card ml-2">
            <div class="card-header">
                <h3>
                    ข้อมูลของแจ้งการชำระเงิน
                </h3>
                <div class="sub-header-card">
                    <span>วันและเวลาที่ชำระ</span>
                    <span>วันที่ <?= $rowpayment['pay_date'] ?></span>
                    <span>เวลา <?= $rowpayment['pay_time'] ?></span>
                </div>
            </div>
            <div class="card-body">
                <div class="col-12 text-center">
                    <img src="../include/img/<?= $rowpayment['pay_pic'] ?>" width="300px" height="400px" alt="">
                </div>
                <br>
            </div>
        </div>
    </div>

</section>


<br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
    let arrow = document.querySelectorAll(".arrow");

    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {

            let arrowParent = e.target.parentElement.parentElement;
            arrowParent.classList.toggle("showMenu");
        });
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarbtn = document.querySelector(".bx-menu");
    console.log(sidebarbtn);


    sidebarbtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");

    });
</script>



</body>

</html>