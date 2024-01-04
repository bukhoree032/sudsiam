<?php session_start(); ?>

<!doctype html>
<html lang="th">

<?php include('include/connect.php'); ?>
<?php include('include/headindex.php'); ?>
<?php include('include/navbar.php'); ?>
<link rel="stylesheet" href="styels.css">

<body>

    <?php include('include/Carousel.php'); ?>
    <div style="position: relative; background-color:#ffffff; ">
    <a id="product-26585" class="targethash" style="display: block;position: relative; visibility: hidden;"></a>
    <div class="container mb-5">

        <div style="padding-top: 40px; padding-bottom: 40px;">
            <div>

                <div class="productList1" id="productList1_26585">
                    <div class="productWidget">
                        <div class="row ">

                            <?php
                            $sqlpro = $conn->prepare("SELECT * FROM product WHERE product_type_id = '".$_GET['type']."'");
                            $sqlpro->execute();
                            $resultpro = $sqlpro->fetchAll(PDO::FETCH_OBJ);
                            if ($sqlpro->rowCount() > 0) {
                                foreach ($resultpro as $res) {
                                    $_SESSION['product_id'] = $res->product_id;
                                    if ($res->product_status == 'on') {


                            ?>
                                        <div class="item col-6 col-md-6 col-lg-3 mobileProductList1">
                                            <div class="itemInner rounded" style="display: flex; overflow: hidden; width: 100%;">
                                                <div class="thumbnail border rounded">
                                                    <div class="productImage rounded-top">
                                                        <a href="buyproduct.php?id=<?php echo $res->product_id; ?>" class="awrap-img">

                                                            <?php

                                                            $getFimg = "SELECT * FROM product_pic WHERE product_id = $res->product_id ORDER BY product_pic_sort ASC LIMIT 1";
                                                            $queryFimg = $conn->prepare($getFimg);
                                                            $queryFimg->execute();
                                                            $resultFimg = $queryFimg->fetchAll(PDO::FETCH_OBJ);
                                                            foreach ($resultFimg as $resFimg) {
                                                            ?>
                                                                <img class="lazy mx-auto" src="https://webbuilder1.makewebeasy.com/images/lazy_default.png" data-src="include/img/<?= $resFimg->product_pic_path; ?>">

                                                        </a>
                                                    <?php
                                                            }
                                                    ?>
                                                    </div>
                                                    <div class="productCaption">
                                                        <div class="productName">
                                                            <a href="buyproduct.php?id=<?php echo $res->product_id; ?>" class="awrap-img">
                                                                <h3 class="h3-hover"><?php echo $res->product_name; ?></h3>
                                                            </a>
                                                        </div>
                                                        <div class="productIntro">
                                                            <p class="protext"><?php echo $res->product_detail; ?></p>
                                                        </div>

                                                        <div class="productPrice">

                                                            <?php
                                                            if ($res->product_quantity == 0) {
                                                            ?>
                                                                <div class="ff-price fs-price fc-price">
                                                                    <span class="SpePrice protext-out">สินค้าหมด</span>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="ff-price fs-price fc-price">
                                                                    <span class="SpePrice protext"><?php echo "฿ " . $res->product_price; ?></span>
                                                                </div>
                                                            <?php } ?>

                                                        </div>
                                                        <div class="productAction">
                                                            <div class="productAddToCart">
                                                                <?php
                                                                $sql_array = $conn->prepare("SELECT * FROM product WHERE product_id = '" . $_SESSION['product_id'] . "'");
                                                                $sql_array->execute();
                                                                $row_array = $sql_array->fetchAll(PDO::FETCH_ASSOC);

                                                                if (!empty($sql_array)) {
                                                                    foreach ($row_array as $key => $value) {
                                                                        // echo $row_array[$key]['product_id'];
                                                                        // echo $_SESSION['product_id'];
                                                                ?>
                                                                        <input type="text" hidden class="product-quantity itemsquantity_<?php echo $row_array[$key]["product_id"] ?>" name="quantity" value="1" size="2">
                                                                        <?php
                                                                        if ($res->product_quantity == 0) {
                                                                        ?>
                                                                            <button class="btnProductCart btn btn-style protext" disabled type="button">
                                                                                <i class="fas fa-shopping-cart"></i>
                                                                                เพิ่มเข้าตะกร้าสินค้า
                                                                            </button>
                                                                        <?php } else { ?>
                                                                            <button class="btnProductCart btn btn-style protext" onclick="addcart('<?php echo $row_array[$key]['product_id'] ?>')" type="button">
                                                                                <i class="fas fa-shopping-cart"></i>
                                                                                เพิ่มเข้าตะกร้าสินค้า
                                                                            </button>
                                                                        <?php } ?>

                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                            <?php
                                    }
                                }
                            } else {
                                echo "<div class='container text-center' style='padding: 7rem 0;'>
                                <h4 class='pronot' style='text-transform: uppercase;color: grey;'>ขณะนี้ยังไม่มีสินค้า</h4>
                            </div>";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
</body>

</html>