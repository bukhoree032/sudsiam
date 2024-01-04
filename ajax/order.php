<?php
session_start();
require_once('../include/connect.php');

if (isset($_POST['action'])) {
    if ($_POST['action'] == "order") {

        $bill_trx = $_POST['orderid'];

        $chkstatus = $conn->prepare("SELECT * FROM record WHERE bill_trx = '$bill_trx' ");
        $chkstatus->execute();
        $rowstatus = $chkstatus->fetch(PDO::FETCH_ASSOC);

        // var_dump($rowstatus);
        if ($rowstatus) {

            if ($bill_trx != null) {

                $record_status = $rowstatus['record_status'];

                if ($record_status == 'ยังไม่ได้แจ้งชำระเงิน') {
                    echo alert_msg("error", "status");
                    exit;
                } else {
                    $order = $conn->prepare("SELECT * FROM record WHERE bill_trx = '$bill_trx' ");
                    $order->execute();
                    $roworder = $order->fetchAll(PDO::FETCH_OBJ);

                    if ($order->rowCount() > 0) {
                        echo alert_msg("success", array(
                            "bill_trx" => $bill_trx,
                        ));
                    } else {
                        echo alert_msg("error", "Notitme");
                        exit;
                    }
                }
                
            } else {
                echo alert_msg("error", "Notitme");
            }
        } else {
            echo alert_msg("error", "Notitme");
        }
    }
}
