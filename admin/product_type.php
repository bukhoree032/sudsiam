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
                            <p>จัดการชนิดสินค้า</p>
                        </div>
                        <div class="col-sm-6 text-right mt-3">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modelId">เพิ่มชนิดสินค้า</button>
                        </div>

                    </div>

                </div>

                <div class="card-body">
                    <div class="box-tale">
                        <table class="table" id="dataal">
                            <thead>
                                <tr>
                                    <th>sorting</th>
                                    <th>เพิ่มชนิดสินค้า</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (isset($_SESSION['admin_login'])) {

                                    $sql = $conn->prepare("SELECT * FROM product_type ORDER BY product_type_sort ASC");
                                    $sql->execute();
                                    $row = $sql->fetchAll(PDO::FETCH_OBJ);

                                    if (!isset($_SESSION["admin_login"])) {
                                        echo "<script>window.location='../index.php'</script>";
                                        exit;
                                    } else {

                                        if ($sql->rowCount() > 0) {
                                            foreach ($row as $res) {
                                ?>
                                                <tr>
                                                    <td><?php echo $res->product_type_sort; ?></td>
                                                    <td><?php echo $res->product_type_name; ?></td>
                                                    <td>
                                                        <div class="dropdown open">
                                                            <button class="btn btn-warning dropdown-toggle btn-sm" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                เพิ่มเติม
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                                                <button class="dropdown-item" onclick="edittype('<?php echo $res->product_type_id; ?>')">แก้ไข</button>
                                                                <button class="dropdown-item" onclick="deletetype('<?php echo $res->product_type_id; ?>')">ลบ</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                <?php
                                            }
                                        } else {
                                        //     echo "<div class='container text-center' style='padding: 7rem 0;'>
                                        //     <h4 class='pronot' style='text-transform: uppercase;color: grey;'>ขณะนี้ยังไม่มีชนิดสินค้า</h4>
                                        // </div>";
                                        }
                                    }
                                } else {
                                    echo "<script>window.location='../index.php'</script>";
                                    exit;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มชนิดสินค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="addtype">
                            <input type="hidden" name="action" value="addtype">
                            <div class="form-group">
                                <label for="sorting">ลำดับ</label>
                                <input type="text" name="sorting" id="sorting" class="form-control" placeholder="เช่น 1.1">
                            </div>
                            <div class="form-group">
                                <label for="typename">ชื่อชนิด</label>
                                <input type="text" name="typename" id="typename" class="form-control" placeholder="">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-success">เพิ่ม</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขชนิด ( ID = <span id="editid"></span> )</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="formedittype">
                            <input type="hidden" name="action" value="edittype">
                            <input type="hidden" name="id" id="inputeditid">
                            <div class="form-group">
                                <label for="sorting">ลำดับ</label>
                                <input type="text" name="sorting" id="editsorting" class="form-control" placeholder="เช่น 1.1">
                            </div>
                            <div class="form-group">
                                <label for="typename">ชื่อชนิด</label>
                                <input type="text" name="typename" id="edittypename" class="form-control" placeholder="">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-success">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        function edittype(id) {
            $("#editid").html(id);
            $.ajax({
                type: "POST",
                url: "ajax/producttype.php",
                data: {
                    action: "getdata",
                    id: id,
                },
                success: function(response) {
                    // console.log(response);
                    let res = JSON.parse(response);
                    $("#editsorting").val(res.msg.sorting);
                    $("#edittypename").val(res.msg.typename);
                    $("#inputeditid").val(id);
                    $("#modaledit").modal("show");
                }
            });
        }

        function deletetype(id) {
            $.ajax({
                type: "POST",
                url: "ajax/producttype.php",
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
        $("#addtype").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            // console.log(data);
            // console.log(datavalid.sorting.length);
            if (isNaN(datavalid.sorting) || datavalid.sorting < 0) {
                Swal.fire('ลำดับต้องเฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.sorting.length == "0" || datavalid.typename.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/producttype.php",
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


        $("#formedittype").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var datavalid = JSON.parse(getFormData($(this)));
            // console.log(data);
            // console.log(datavalid.sorting.length);
            if (isNaN(datavalid.sorting) || datavalid.sorting < 0) {
                Swal.fire('เฉพาะตัวเลขเท่านั้น!');
                return false;
            }
            if (datavalid.sorting.length == "0" || datavalid.typename.length == "0") {
                Swal.fire('กรุณากรอกข้อมูลให้ครบทุกช่อง!');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/producttype.php",
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