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
                <p>จัดการสินค้ารอจัดส่ง</p>
            </div>
            <div class="card-body">
                <div class="box-tale">
                    <table class="table" id="dataal">
                        <thead>
                            <tr>
                                <th>หมายเลขสั่งซื้อ</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>วันที่จัดส่ง</th>
                                <th>เวลาที่จัดส่ง</th>
                                <th>หมายเลขจัดส่ง</th>
                                <th>สถานะ</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $conn->prepare("SELECT * FROM payment WHERE pay_status ='ยืนยันสินค้าเรียบร้อย' order by pay_date ASC");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_OBJ);
                            if ($sql->rowCount() > 0) {
                                foreach ($row as $res) {
                            ?>
                                    <tr>
                                        <td><?php echo $res->bill_trx; ?></td>
                                        <td><?php echo $res->pay_name; ?></td>
                                        <td><?php echo $res->delivery_date; ?></td>
                                        <td><?php echo $res->delivery_time; ?></td>
                                        <td><?php echo $res->pay_id_ems; ?></td>
                                        <?php if ($res->pay_ems == 'ยังไม่มีการจัดส่งสินค้า') {
                                        ?>
                                            <td class="text-warning"><?php echo $res->pay_ems; ?></td>
                                        <?php } else { ?>
                                            <td class="text-success"><?php echo $res->pay_ems; ?></td>
                                        <?php } ?>
                                        <td>
                                            <button class="btn btn-warning" onclick="editdelivery('<?php echo $res->pay_id; ?>')">แก้ไข</button>
                                        </td>
                                    </tr>
                            <?php     }
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มหมายเลขจัดส่ง ( ID = <span id="editid"></span> )</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="formeditdelivery">
                            <input type="hidden" name="action" value="editdelivery">
                            <input type="hidden" name="id" id="inputeditid">
                            <div class="form-group">
                                <label for="pay_ems">แก้ไขสถานะ</label>
                                <select name="pay_ems" id="pay_ems" class="form-control">
                                    <option value="ยังไม่มีการจัดส่งสินค้า">ยังไม่มีการจัดส่งสินค้า</option>
                                    <option value="การจัดส่งเรียบร้อย">การจัดส่งเรียบร้อย</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pay_id_ems">เพิ่มหมายเลขจัดส่ง</label>
                                <input type="text" name="pay_id_ems" id="pay_id_ems" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">วันที่จัดส่ง</label>
                                <input type="date" name="delivery_date" id="delivery_date" class="form-control" required value="">
                            </div>

                            <div class="form-group">
                                <label for="">เวลาจัดส่ง</label>
                                <input type="time" name="delivery_time" id="delivery_time" class="form-control" required value="">
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
    function editdelivery(id) {
        $("#editid").html(id);
        $.ajax({
            type: "POST",
            url: "ajax/delivery.php",
            data: {
                action: "getdelivery",
                id: id,
            },
            success: function(response) {
                // console.log(response);
                let res = JSON.parse(response);
                $('#pay_ems option[value="' + res.msg.status + '"]').prop('selected', true);
                $("#pay_id_ems").val(res.msg.pay_id_ems);
                $("#delivery_date").val(res.msg.delivery_date);
                $("#delivery_time").val(res.msg.delivery_time);
                $("#inputeditid").val(id);
                $("#modaledit").modal("show");
            }
        });
    }

    $("#formeditdelivery").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var datavalid = JSON.parse(getFormData($(this)));
        // console.log(data);
        // console.log(datavalid.sorting.length);

        $.ajax({
            type: "POST",
            url: "ajax/delivery.php",
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