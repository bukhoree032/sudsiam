<!doctype html>
<html lang="th">
<?php session_start(); ?>
<?php include('include/connect.php'); ?>
<?php include('include/headindex.php'); ?>
<?php include('include/navbar.php'); ?>
<link rel="stylesheet" href="styels.css">

<body>
    <?php
    // print_r($_SESSION['cart']);
    $total_quantity = 0;
    $total_price = 0;
    if (isset($_SESSION["cart"])) {
        if (count($_SESSION['cart']) > 0 || isset($_SESSION['cart'])) {

    ?>
            <div class="container">
                <p class="cart-textp">ตะกร้าสินค้า</p>
                <div id="Shopping-cart" class="Shopping-cart-notnull">
                    <div class="table table-item col-8">
                        <div class="card card-item1">
                            <div class="card-header card-header-itme">
                                สินค้าในตะกร้า
                            </div>

                            <div class="card-body">
                                <div class="row dis-n">
                                    <div class="col col-lg-2 text-center font-weight-bold">
                                        <span>สินค้า</span>
                                    </div>

                                    <div class="col col-lg-2 d-none d-lg-block px-0">
                                    </div>

                                    <div class="col col-lg-2 text-center font-weight-bold">
                                        <span>ราคา/ชิ้น</span>
                                    </div>

                                    <div class="col col-lg-3 text-center font-weight-bold">
                                        <span>จำนวน</span>
                                    </div>

                                    <div class="col col-lg-2 text-center font-weight-bold">
                                        <span>ราคารวม</span>
                                    </div>

                                    <!-- <div class="col-12 col-lg-1 text-center font-weight-bold">
                                    </div> -->
                                </div>
                                <hr class="dis-n">

                                <div class="cart-item mb-3" id="cartdata">

                                    <?php
                                    $i = 1;
                                    foreach ($_SESSION['cart']['product_id'] as $key => $val) {
                                        $rowcartproduct = $conn->query("SELECT * FROM product WHERE product_id = ${key}")->fetch(PDO::FETCH_ASSOC);
                                        $makeprice = $val * $rowcartproduct['product_price'];
                                        $total_quantity += $val;
                                        $price = $val * $rowcartproduct['product_price'];
                                        $total_price += $makeprice;
                                        $product_quantity = $rowcartproduct['product_quantity'] - $val;
                                        $_SESSION['product_quantity'] = $product_quantity;
                                        $_SESSION['total_quantity'] = $total_quantity;

                                        $picCart = $conn->query("SELECT * FROM product_pic WHERE product_id = '" . $rowcartproduct['product_id'] . "'");
                                        $picCart->execute();
                                        $rowpicCart = $picCart->fetch(PDO::FETCH_ASSOC);

                                    ?>
                                        <div class="row">
                                            <div class="col col-lg-2 text-center font-weight-bold">
                                                <img src="include/img/<?= $rowpicCart['product_pic_path'] ?>" width="50px" height="50px" alt="">
                                            </div>

                                            <div class="col-4 col-lg-2 d-lg-block px-0 proname-wid">
                                                <span><?= $rowcartproduct['product_name']; ?></span>
                                            </div>

                                            <div class="col col-lg-2 text-center font-weight-bold dis-n">
                                                <span><?= number_format($rowcartproduct['product_price']); ?></span>
                                            </div>
                                            
                                            <div class="d-none dis-not-n col col-lg-2 text-left proprice-wid ml-2">
                                                <span>ราคา <?= number_format($rowcartproduct['product_price']); ?></span>
                                            </div>

                                            <div class="col-sm col-lg-3">
                                                <?php
                                                $sql_array = $conn->prepare("SELECT * FROM product WHERE product_id = '" . $rowcartproduct['product_id'] . "'");
                                                $sql_array->execute();
                                                $row_array = $sql_array->fetchAll(PDO::FETCH_ASSOC);

                                                if (!empty($sql_array)) {
                                                    foreach ($row_array as $key => $value) {
                                                        // echo $row_array[$key]['product_id'];
                                                        // echo $_SESSION['product_id'];
                                                ?>
                                                        <div class="input-group1">
                                                            <?php
                                                            if ($val <= 1) {
                                                            ?>
                                                                <button class="button-minus minus" disabled type="button" style="cursor: default;">
                                                                    -
                                                                </button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button class="button-minus minus" onclick="minuscart('<?php echo $row_array[$key]['product_id'] ?>')" type="button">
                                                                    -
                                                                </button>
                                                            <?php
                                                            }
                                                            ?>
                                                            <input type="text" hidden class="product-quantity quantity-field itemsquantity_<?php echo $row_array[$key]["product_id"] ?>" name="quantity" value="1" size="2">
                                                            <input type="text" class="quantity-field" name="quantity" value="<?= $val ?>" disabled size="2">
                                                            <?php
                                                            if ($rowcartproduct['product_quantity'] <= $val) {
                                                            ?>
                                                                <button class="button-plus" disabled type="button">
                                                                    +
                                                                </button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button class="button-plus" onclick="addcart('<?php echo $row_array[$key]['product_id'] ?>')" type="button">
                                                                    +
                                                                </button>
                                                            <?php
                                                            }
                                                            ?>
                                                            <p class="text-center text-quantity">จำนวนที่เหลือ <?= $rowcartproduct['product_quantity']; ?> ชิ้น</p>
                                                        </div>

                                            </div>

                                           

                                            <div class="d-none dis-not-n col col-lg-2 text-center font-weight-bold ">
                                                <span> ราคารวม <?= number_format($price) ?></span>
                                            </div>

                                            <div class="col col-lg-2 text-center font-weight-bold dis-n">
                                                <span><?= number_format($price) ?></span>
                                            </div>
                                          
                                            <div class="col col-lg-1 text-center font-weight-bold">
                                                <a href="#" data-id="<?= $row_array[$key]['product_id'] ?>" class="adelete"><i class='bx bx-trash trash'></i></i></a>
                                            </div>
                                        </div>
                                <?php
                                                    }
                                                }
                                ?>
                                <hr>
                            <?php } ?>
                                </div>

                                <div class="col text-right">
                                    <button class="btn btn-danger btn_empty" data-id="<?= $rowcartproduct['product_id'] ?>" id="btnEmpty">ลบสินค้าในตะกร้าทั้งหมด</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="table table-item table-sum col-4">
                        <div class="card card-item1">
                            <div class="card-header card-header-itme">
                                ยอดรวมตะกร้าสินค้า

                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <span>ยอดรวมสินค้า <?= $total_quantity ?> ชิ้น</span>
                                    <span class="text-B"><?= number_format($total_price) ?> บาท</span>

                                </div>

                                <div class="col-12">
                                    <hr class="hr-Dotted">
                                </div>

                                <div class="col-12">
                                    <span>ยอดรวมตะกร้าสินค้า</span>
                                    <span class="text-B"><?= number_format($total_price) ?> บาท</span>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-Dotted">
                                </div>

                                <div class="text-right btnComfirm_text">
                                    <?php
                                    if (isset($_SESSION['user_login'])) {
                                    ?>
                                        <a href="comfirm_product.php" class="A_confirmprodut">สั่งซื้อสินค้า</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="login.php" class="A_confirmprodut">สั่งซื้อสินค้า</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="container">
                <p class="cart-textp">ตะกร้าสินค้า</p>

                <div class="Shopping-cart">
                    <div class="row">
                        <div class="col">
                            <div class="text-heading h1"><i class='bx bx-cart'></i></div>
                            <div class="text-heading h1">ไม่มีสินค้าในตะกร้าของคุณ</div>
                            <div class="">
                                <a href="index.php" class="btn-cart">กลับไปซื้อสินค้า</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="container">
            <p class="cart-textp">ตะกร้าสินค้า</p>
            <div class="Shopping-cart">
                <div class="row">
                    <div class="col">
                        <div class="text-heading h1"><i class='bx bx-cart'></i></div>
                        <div class="text-heading h1">ไม่มีสินค้าในตะกร้าของคุณ</div>
                        <div class="">
                            <a href="index.php" class="btn-cart">กลับไปซื้อสินค้า</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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

        $('#btnEmpty').click(function(e) {
            var product_id = $(this).data('id')
            e.preventDefault();
            clearcart(product_id);
        })

        function clearcart(product_id) {
            Swal.fire({
                title: 'คุณแน่ใจใช่ไหม ?',
                text: "คุณจะไม่สามารถย้อนกลับได้นะ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            type: "POST",
                            url: "ajax/action.php?clearcart",
                            data: {
                                product_id: product_id,
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
                                        window.location.reload()
                                    }, 1000)
                                    return false
                                }
                                alerts(data.status, data.msg);
                            }
                        });
                    });
                },
            });
        }
    </script>

    <script>
        function addcart(product_id) {
            let counts = $(".itemsquantity_" + product_id).val();
            if (isNaN(counts)) {
                alerts("error", "ต้องเป็นตัวเลขเท่านั้น");
                $(".itemsquantity_" + product_id).val(1);
                return false
            }

            $.ajax({
                type: "POST",
                url: "ajax/action.php?addcart",
                data: {
                    product_id: product_id,
                    counts: counts,
                },
                success: function(response) {
                    let data;
                    // console.log(response)
                    try {
                        data = JSON.parse(response)
                        // console.log(response);
                    } catch (e) {
                        alerts("error", "เกิดข้อผิดพลาด");
                    }
                    console.log("=>", data)
                    if (data.status == "success") {
                        alerts(data.status, data.msg)
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000)
                        return false
                    }
                    alerts(data.status, data.msg);
                }
            });
        }


        function minuscart(product_id) {

            let counts = $(".itemsquantity_" + product_id).val();
            if (isNaN(counts)) {
                alerts("error", "ต้องเป็นตัวเลขเท่านั้น");
                $(".itemsquantity_" + product_id).val(1);
                return false
            }

            $.ajax({
                type: "POST",
                url: "ajax/action.php?minuscart",
                data: {
                    product_id: product_id,
                    counts: counts,
                },
                success: function(response) {
                    let data;
                    // console.log(response)
                    try {
                        data = JSON.parse(response)
                        // console.log(response);
                    } catch (e) {
                        alerts("success", "ลบสินค้าแล้ว");
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000)
                        return false
                    }
                    console.log("=>", data)
                    if (data.status == "success") {
                        alerts(data.status, data.msg)
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000)
                        return false
                    }
                    alerts(data.status, data.msg);
                }
            });
        }
    </script>

    <script>
        $('.adelete').click(function(e) {
            var product_id = $(this).data('id')
            e.preventDefault();
            deleteitmecart(product_id);
        })

        function deleteitmecart(product_id) {
            Swal.fire({
                title: 'คุณแน่ใจใช่ไหม ?',
                text: "คุณจะไม่สามารถย้อนกลับได้นะ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            type: "POST",
                            url: "ajax/action.php?deleteitmecart",
                            data: {
                                product_id: product_id,
                            },
                            success: function(response) {
                                console.log(response)
                                let data;
                                try {
                                    data = JSON.parse(response)
                                } catch (e) {
                                    alerts("error", "เกิดข้อผิดพลาด");
                                }
                                if (data.status == "success") {
                                    alerts(data.status, data.msg)
                                    setTimeout(() => {
                                        window.location.reload()
                                    }, 1000)
                                    return false
                                }
                                alerts(data.status, data.msg);
                            }
                        });
                    });
                },
            });
        }
    </script>



    <?php include('include/footerindex.php'); ?>
    <?php
    // echo  $_SESSION['user_login'];
    ?>
</body>

</html>