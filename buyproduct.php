<!doctype html>
<html lang="th">
<?php session_start(); ?>
<?php include('include/connect.php'); ?>
<?php include('include/headindex.php'); ?>
<?php include('include/navbar.php'); ?>
<link rel="stylesheet" href="styels.css">


<body>

    <?php
    $product_id = $_GET['id'];

    $product = $conn->prepare("SELECT * FROM product WHERE product_id = '$product_id'");
    $product->execute();
    $rowPro = $product->fetch(PDO::FETCH_ASSOC);
    $product_name = $rowPro['product_name'];
    ?>

    <section class="buy-head">
        <div class="container product-container">
            <div class="link-product">
                <a href="index.php">หน้าแรก</a> /
                <a href="index.php">สินค้าทั้งหมด</a> /
                <?php
                $product_type = $conn->prepare("SELECT * FROM product_type WHERE product_type_id = '" . $rowPro['product_type_id'] . "' ");
                $product_type->execute();
                $rowType = $product_type->fetch(PDO::FETCH_ASSOC);

                $product_type_name = $rowType['product_type_name'];
                ?>
                <a href="producttype.php?type=<?= $rowType['product_type_id'] ?>"><?= $rowType['product_type_name'] ?></a> /
                <a href="buyproduct.php?id=<?= $rowPro['product_id'] ?>"><?= $rowPro['product_name'] ?></a>
            </div>

            <div class="item-product">
                <div class="row product-pic">
                    <div class="col-6" class="pic-product">
                        <?php
                        $product_pic = $conn->prepare("SELECT * FROM product_pic WHERE product_id = '$product_id' ORDER BY product_pic_sort ASC LIMIT 1");
                        $product_pic->execute();
                        $rowPic = $product_pic->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <img id="previewhere" src="include/img/<?= $rowPic['product_pic_path']; ?>" width="550px" height="550px" alt="">

                        <div class="prepic-product dis-n">
                            <?php
                            $product_prepic = $conn->prepare("SELECT * FROM product_pic WHERE product_id = '$product_id' ORDER BY product_pic_sort ASC");
                            $product_prepic->execute();
                            $rowPrepic = $product_prepic->fetchAll(PDO::FETCH_OBJ);

                            foreach ($rowPrepic as $resPre) {
                            ?>
                                <img src="include/img/<?= $resPre->product_pic_path; ?>" onclick="previewimg($(this).attr('src'));" style="cursor:pointer;box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;" width="50px" height="50px">
                            <?php
                            }
                            ?>
                        </div>

                    </div>

                    <div class="prepic-product1 dis-not-n d-none">
                        <?php
                        $product_prepic = $conn->prepare("SELECT * FROM product_pic WHERE product_id = '$product_id' ORDER BY product_pic_sort ASC");
                        $product_prepic->execute();
                        $rowPrepic = $product_prepic->fetchAll(PDO::FETCH_OBJ);

                        foreach ($rowPrepic as $resPre) {
                        ?>
                            <img src="include/img/<?= $resPre->product_pic_path; ?>" onclick="previewimg($(this).attr('src'));" style="cursor:pointer;box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;" width="50px" height="50px">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-6 dis-n">

                        <span class="text-head-productname"><?= $rowPro['product_name'] ?></span><br><br>
                        <span class="text-head-productsub-span"><?= $rowPro['product_detail'] ?></span><br><br>
                        <hr>
                        <span class="text-head-product-span">ราคา <?= number_format($rowPro['product_price']) ?> บาท </span><br>
                        <hr>
                        <div class="row">
                            <div class="col-7">
                                <?php
                                $sql_array = $conn->prepare("SELECT * FROM product WHERE product_id = '$product_id'");
                                $sql_array->execute();
                                $row_array = $sql_array->fetchAll(PDO::FETCH_ASSOC);

                                if (!empty($sql_array)) {
                                    foreach ($row_array as $key => $value) {
                                ?>
                                        <input type="text" hidden class="product-quantity itemsquantity_<?php echo $row_array[$key]["product_id"] ?>" name="quantity" value="1" size="2">

                                        <?php
                                        if ($rowPro['product_quantity'] == 0) {
                                        ?>
                                            <button class="btn-buy-product-close btn-danger" disabled>

                                                สินค้าหมด
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn-buy-product" onclick="addcart('<?php echo $row_array[$key]['product_id'] ?>')">
                                                <i class="fas fa-shopping-cart mr-2"></i>
                                                เพิ่มเข้าตะกร้าสินค้า
                                            </button>
                                        <?php } ?>


                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-5">
                                <button class="btn-messenger-product">messenger</button><br>
                            </div>
                        </div>

                    </div>


                    <div class="col-12 d-none detail-moblie dis-not-n">
                        <br>
                        <span class="text-head-productname"><?= $rowPro['product_name'] ?></span><br>
                        <span class="text-head-productsub-span"><?= $rowPro['product_detail'] ?></span><br>
                        <hr>
                        <span class="text-head-product-span">ราคา <?= number_format($rowPro['product_price']) ?> บาท </span><br>
                        <hr>
                        <div class="row">
                            <div class="col-7">
                                <?php
                                $sql_array = $conn->prepare("SELECT * FROM product WHERE product_id = '$product_id'");
                                $sql_array->execute();
                                $row_array = $sql_array->fetchAll(PDO::FETCH_ASSOC);

                                if (!empty($sql_array)) {
                                    foreach ($row_array as $key => $value) {
                                ?>
                                        <input type="text" hidden class="product-quantity itemsquantity_<?php echo $row_array[$key]["product_id"] ?>" name="quantity" value="1" size="2">
                                        <?php
                                        if ($rowPro['product_quantity'] == 0) {
                                        ?>
                                            <button class="btn-buy-product-close btn-danger" disabled>

                                                สินค้าหมด
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn-buy-product" onclick="addcart('<?php echo $row_array[$key]['product_id'] ?>')">
                                                <i class="fas fa-shopping-cart mr-2"></i>
                                                เพิ่มเข้าตะกร้าสินค้า
                                            </button>
                                        <?php } ?>

                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-5">
                                <button class="btn-messenger-product">messenger</button><br>
                            </div>
                        </div>

                    </div>



                </div>
            </div>

        </div>
    </section>

    <section class="buy-body dis-n">
        <div class="container">
            <div class="head-sub-body">
                <div class="row body-item">

                    <div class="col-2 item1">
                        <p>รายละเอียดสินค้า</p>
                    </div>

                    <div class="col-10 item2">

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 item3">
                        <?= $rowPro['product_alldetail'] ?><br><br>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="buy-body d-none dis-not-n">
        <div class="container">
            <div class="head-sub-body">
                <div class="row body-item">

                    <div class="col-4 item1">
                        <p>รายละเอียดสินค้า</p>
                    </div>
                    <div class="col-8 item2">

                    </div>
                </div>
                <div class="row alldetail-text">
                    <div class="col-12 item3">
                        <?= $rowPro['product_alldetail'] ?><br><br>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // set title
        document.title = "<?= $product_name ?> - <?= $product_type_name ?>";

        function previewimg(img) {
            $("#previewhere").attr("src", img);
        }
    </script>

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
    </script>

    <?php include('include/footerindex.php'); ?>
    <?php
    // echo  $_SESSION['user_login'];
    ?>
</body>

</html>