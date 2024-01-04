<?php include('sidebar.php'); ?>

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
                        <p>จัดการ ( เพิ่ม / ลบ ) สินค้า</p>
                    </div>
                    <div class="col-sm-6 text-right mt-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modelId">เพิ่มสินค้า</button>
                    </div>

                </div>
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
                                <th>ราคา</th>
                                <th>สถานะ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = $conn->prepare("SELECT * FROM product ORDER BY product_created ASC");
                            $sql->execute();
                            $rowdata = $sql->fetchAll(PDO::FETCH_OBJ);

                            if ($sql->rowCount() > 0) {
                                foreach ($rowdata as $resdata) {
                                    $sqlpic = $conn->prepare("SELECT * FROM product_pic WHERE product_id = '$resdata->product_id' ");
                                    $sqlpic->execute();
                                    $rowpic = $sqlpic->fetch(PDO::FETCH_ASSOC);
                            ?>

                                    <tr>
                                        <td>
                                            <img src="../include/img/<?= $rowpic['product_pic_path']; ?>" width="50px" height="50px" alt="">

                                        </td>

                                        <td> <?php echo $resdata->product_code; ?> </td>
                                        <td> <?php echo $resdata->product_name; ?> </td>
                                        <td> <?php echo $resdata->product_quantity; ?> </td>
                                        <td> <?php echo $resdata->product_price; ?> </td>
                                        <td> <?php echo $resdata->product_status; ?> </td>
                                        <td>
                                            <div class="dropdown open">
                                                <button class="btn btn-warning dropdown-toggle btn-sm" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    เพิ่มเติม
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                                    <a target="_blank" class="dropdown-item" href="../buyproduct.php?id=<?php echo $resdata->product_id; ?>">ตัวอย่างสินค้า</a>
                                                    <a target="_blank" class="dropdown-item" href="product-pic.php?id=<?php echo $resdata->product_id; ?>">เพิ่มรูปสินค้า</a>
                                                    <button class="dropdown-item" onclick="editproduct('<?php echo $resdata->product_id; ?>')">แก้ไข</button>
                                                    <button class="dropdown-item" onclick="deleteproduct('<?php echo $resdata->product_id; ?>')">ลบ</button>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>


                            <?php     }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="addproduct">
                        <input type="hidden" name="action" value="addproduct">
                        <div class="form-group">
                            <label for="product_code">รหัสสินค้า</label>
                            <input type="text" name="product_code" id="product_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="product_name">ชื่อสินค้า</label>
                            <input type="text" name="product_name" id="product_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="product_type_id">ชนิดของสินค้า</label>
                            <select name="product_type_id" id="product_type_id" class="form-control">
                                <?php
                                $type = $conn->prepare("SELECT * FROM product_type ORDER BY product_type_sort ASC");
                                $type->execute();
                                $row = $type->fetchAll(PDO::FETCH_OBJ);
                                foreach ($row as $res) {
                                ?>
                                    <option value="<?php echo $res->product_type_id; ?>"><?php echo $res->product_type_name; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_price">ราคา</label>
                            <input type="text" name="product_price" id="product_price" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">จำนวน</label>
                            <input type="text" name="product_quantity" id="product_quantity" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="product_detail">รายละเอียดย่อย</label>
                            <input type="text" name="product_detail" id="product_detail" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="product_alldetail">รายละเอียดทั้งหมด</label>
                            <textarea name="product_alldetail" id="product_alldetail" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_status">สถานะสินค้า</label>
                            <select name="product_status" id="product_status" class="form-control">
                                <option value="on">เปิด</option>
                                <option value="off">ซ่อน</option>
                            </select>
                        </div>
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

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขชนิด ( ID = <span id="editid"></span> )</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formeditproduct">
                        <input type="hidden" name="action" value="editproduct">
                        <input type="hidden" name="id" id="inputeditid" value="">
                        <div class="form-group">
                            <label for="product_code">รหัสสินค้า</label>
                            <input type="text" name="product_code" id="editproduct_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="product_name">ชื่อสินค้า</label>
                            <input type="text" name="product_name" id="editproduct_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="product_type_id">ชนิดของสินค้า</label>
                            <select name="product_type_id" id="editproduct_type_id" class="form-control">
                                <?php
                                $type = $conn->query("SELECT * FROM product_type ORDER BY product_type_sort ASC");
                                $type->execute();
                                $rowData = $type->fetchAll(PDO::FETCH_OBJ);
                                foreach ($rowData as $resget) {
                                ?>
                                    <option value="<?php echo $resget->product_type_id; ?>"><?php echo $resget->product_type_name;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_price">ราคา</label>
                            <input type="text" name="product_price" id="editproduct_price" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">จำนวน</label>
                            <input type="text" name="product_quantity" id="editproduct_quantity" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="product_detail">รายละเอียดย่อย</label>
                            <input type="text" name="product_detail" id="editproduct_detail" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="product_alldetail">รายละเอียดทั้งหมด</label>
                            <textarea name="product_alldetail" id="editproduct_alldetail" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_status">สถานะสินค้า</label>
                            <select name="product_status" id="editproduct_status" class="form-control">
                                <option value="on">เปิด</option>
                                <option value="off">ซ่อน</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button class="btn btn-success">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
    function editproduct(id) {
        $("#editid").html(id);
        $.ajax({
            type: "POST",
            url: "ajax/product.php",
            data: {
                action: "getdata",
                id: id,
            },
            success: function(response) {
                // console.log(response);

                let res = JSON.parse(response);
                $("#editproduct_code").val(res.msg.product_code);
                $("#editproduct_name").val(res.msg.product_name);
                $('#editproduct_type_id option[value="' + res.msg.product_type_id + '"]').prop('selected', true);
                $("#editproduct_price").val(res.msg.product_price);
                $("#editproduct_quantity").val(res.msg.product_quantity);
                $("#editproduct_detail").val(res.msg.product_detail);
                $("#editproduct_alldetail").val(res.msg.product_alldetail);
                $('#editproduct_status option[value="' + res.msg.product_status + '"]').prop('selected', true);
                $("#inputeditid").val(id);
                $("#modaledit").modal("show");
            }
        });
    }

    function deleteproduct(id) {
        $.ajax({
            type: "POST",
            url: "ajax/product.php",
            data: {
                action: "deletedata",
                id: id,
            },
            success: function(response) {
                // console.log(response);
                Toast.fire({
                    icon: 'success',
                    title: 'สำเร็จ!'
                })
                setTimeout((e) => {
                    window.location = '?success'
                }, 1500);
            }
        });
    }
    $("#addproduct").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var datavalid = JSON.parse(getFormData($(this)));
        // console.log(data);
        // console.log(datavalid.sorting.length);
        if (isNaN(datavalid.product_price) || datavalid.product_price < 0 || datavalid.product_quantity < 0 || isNaN(datavalid.product_quantity)) {
            Swal.fire('ราคาและจำนวน เฉพาะตัวเลขเท่านั้น!');
            return false;
        }
        if (datavalid.product_price.length == "0" || datavalid.product_price.length == "0" || datavalid.product_detail.length == "0" || datavalid.product_quantity.length == "0") {
            Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
            return false;
        }
        $.ajax({
            type: "POST",
            url: "ajax/product.php",
            data: data,
            beforeSend: (e) => {
                wait();
            },
            success: (resp) => {
                let res = JSON.parse(resp);
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

    $("#formeditproduct").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
      
        var datavalid = JSON.parse(getFormData($(this)));
        // console.log(data);
        // console.log(datavalid.sorting.length);
        if (isNaN(datavalid.product_price) || datavalid.product_price < 0) {
            Swal.fire('ราคา เฉพาะตัวเลขเท่านั้น!');
            return false;
        }
        if (datavalid.product_price.length == "0" || datavalid.product_price.length == "0" || datavalid.product_detail.length == "0") {
            Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "ajax/product.php",
            data: data,
            beforeSend: (e) => {
                wait();
            },
            success: (resp) => {
                let res = JSON.parse(resp);
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