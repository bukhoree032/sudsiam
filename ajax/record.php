<?php
require_once('../include/connect.php');


if (isset($_POST['action'])) {

    if ($_POST['action'] == "addpayment") {

        $paymentid = $_POST['paymentid'];
        $pay_name = $_POST['name'];
        $pay_email = $_POST['email'];
        $pay_Phone = $_POST['phone'];
        $pay_price = $_POST['price'];
        $pay_date = $_POST['date'];
        $pay_time = $_POST['time'];
        $image = $_FILES['image']['name'];
        $pay_note = $_POST['note'];

        if (!is_numeric($_POST['price'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['paymentid'])) {
                echo alert_msg("error", "empty");
                exit;
            }

            $chkstatus = $conn->prepare("SELECT * FROM record WHERE bill_trx = '$paymentid' ");
            $chkstatus->execute();
            $rowstatus = $chkstatus->fetch(PDO::FETCH_ASSOC);
            $record_status = $rowstatus['record_status'];

            if ($record_status == 'แจ้งการชำระเงินเรียบร้อย') {
                echo alert_msg("error", "status");
                exit;
            } else {

                // image file directory
                $newname = uniqidReal(20) . basename($image);
                $target = "../include/img/" . $newname;
                move_uploaded_file($_FILES['preimg']['tmp_name'], $target);
                $chk = $conn->prepare("INSERT INTO payment (pay_name, pay_email, pay_Phone, pay_price, pay_date, pay_time, pay_note, pay_pic, bill_trx, pay_ems, pay_status)
            VALUE(:pay_name, :pay_email ,:pay_Phone, :pay_price, :pay_date, :pay_time, :pay_note, '$newname', :bill_trx, 'ยังไม่มีการจัดส่งสินค้า', 'รอการยืนยันการสั่งซื้อ');");

                $chk1 = $conn->query("UPDATE record SET record_status = 'แจ้งการชำระเงินเรียบร้อย'
            WHERE bill_trx = '$paymentid'");

                $chk->bindParam(":pay_name", $pay_name, PDO::PARAM_STR);
                $chk->bindParam(":pay_email",  $pay_email, PDO::PARAM_STR);
                $chk->bindParam(":pay_Phone", $pay_Phone, PDO::PARAM_STR);
                $chk->bindValue(":pay_price", $pay_price, PDO::PARAM_INT);
                $chk->bindParam(":pay_date", $pay_date, PDO::PARAM_STR);
                $chk->bindParam(":pay_time", $pay_time, PDO::PARAM_STR);
                $chk->bindParam(":pay_note", $pay_note, PDO::PARAM_STR);
                // $chk->bindParam(":pay_pic", $pay_pic, PDO::PARAM_STR);
                $chk->bindParam(":bill_trx", $paymentid, PDO::PARAM_STR);
                $chk->execute();

                if ($chk) {
                    echo alert_msg("success", "ok");
                    exit;
                } else {
                    echo alert_msg("error", "wrong");
                    exit;
                }
            }
        }
    }
    exit;
}
