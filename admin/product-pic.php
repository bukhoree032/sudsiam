<?php include('sidebar.php'); ?>

<?php

if (!isset($_GET['id'])) {
    echo "<script>window.location='product.php'</script>";
    exit;
} else {
    $chk = $conn->query("SELECT * FROM product WHERE product_id = '" . $_GET['id'] . "' LIMIT 1");
    $chk->execute();
    if ($chk->rowCount() > 0) {
        $rowDataproduct = $chk->fetch(PDO::FETCH_ASSOC);
    } else {
        exit;
        echo "<script>window.location='product.php'</script>";
    }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == "addpic") {
        $image = $_FILES['preimg']['name'];
        // image file directory
        $newname = uniqidReal(20) . basename($image);
        $target = "../include/img/" . $newname;
        move_uploaded_file($_FILES['preimg']['tmp_name'], $target);
        $conn->query("INSERT INTO product_pic (product_id, product_pic_sort, product_pic_path)
        VALUE('" . $_GET['id'] . "', '" . trim($_POST['sorting']) . "', '" . $newname . "')");
        echo "<script>alert('สำเร็จ!');window.location='?id=" . $_GET['id'] . "'</script>";
    }
    if ($_POST['action'] == "deletedata") {
        $chk = $conn->query("DELETE FROM product_pic WHERE product_pic_id = '" . $_POST['id'] . "'");
        if ($chk) {
            echo alert_msg("success", "ok");
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }
}
?>

<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <?php
        echo date('l' . ' ' . 'd' . ' ' . 'M' . ' ' . 'Y');
        ?>
    </div>

    <div class="table-content mt-4">
        <div class="card">
            <div class="card-head pr-2">
                <div class="row">
                    <div class="col-sm-6">
                        <p>( เพิ่ม / ลบ ) รูปสินค้า => <?= $rowDataproduct["product_name"]; ?></p>
                    </div>
                    <div class="col-sm-6 text-right mt-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modelId">เพิ่มรูปภาพ</button>
                    </div>

                </div>
                <div class="card-body">
                    <div class="box-tale">
                        <table class="table" id="dataal">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รูป</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = $conn->prepare("SELECT * FROM product_pic WHERE product_id = '" . $_GET['id'] . "' ORDER BY product_pic_sort ASC");
                                $sql->execute();
                                $row = $sql->fetchAll(PDO::FETCH_OBJ);
                                if ($sql->rowCount() > 0) {
                                    foreach ($row as $res) {
                                ?>
                                        <tr>
                                            <td scope="row"><?php echo $res->product_pic_sort; ?></td>
                                            <td><img src="../include/img/<?php echo $res->product_pic_path; ?>" width="50%"></td>

                                            <td>
                                                <div class="dropdown open">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        เพิ่มเติม
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                                        <button class="dropdown-item" onclick="deletepic('<?php echo $res->product_pic_id; ?>')">ลบ</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr class="text-center">
                                        <td colspan="3">ไม่มีข้อมูล</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เพิ่มรูปสินค้า</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="addpic">
                                <div class="form-group">
                                    <label for="sorting">ลำดับ</label>
                                    <input type="text" required name="sorting" id="sorting" class="form-control" placeholder="เช่น 1.1">
                                </div>
                                <div class="container text-center mb-1">
                                    <img id="showpic" src="https://media.discordapp.net/attachments/701876169334587443/821515777324744754/1024px-No_image_available.png" class="rounded col-sm-12" onclick="document.getElementById('preimg').click();" width="90%" style="cursor: pointer;">
                                </div>
                                <div class="text-center">
                                    <input type="file" class="sr-only" id="preimg" name="preimg" required accept="image/*" onchange="readURL(this);">
                                </div>

                                <center>
                                    <div onclick="$('#preimg').click();" class="mt-2 btn btn-success">อัพโหลดรูปภาพ</div>
                                </center><br>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    <button class="btn btn-success">เพิ่ม</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>

<br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


<script>

    function deletepic(id) {
        $.ajax({
            type: "POST",
            url: "<?= $_SERVER['PHP_SELF'] ?>?id=<?= $_GET['id'] ?>",
            data: {
                action: "deletedata",
                id: id,
            },
            success: function(response) {
                // console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!'
                })
                setTimeout((e) => {
                    window.location = '?id=<?= $_GET['id'] ?>&success'
                }, 1500);
            }
        });
    }
</script>
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

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showpic').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
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