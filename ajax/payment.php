<?php
require_once('../include/connect.php');
if (isset($_POST['payment_chk'])) {

    $paymentid = $_POST['paymentid'];
    $totalprice = 0;

    $pay = $conn->prepare("SELECT * FROM record WHERE bill_trx = '$paymentid' ");
    $pay->execute();
    $rowpay = $pay->fetchAll(PDO::FETCH_OBJ);

    foreach ($rowpay as $respay) {

        $user = $conn->prepare("SELECT * FROM users WHERE id = '" . $respay->id . "' ");
        $user->execute();

        $rowuser = $user->fetch(PDO::FETCH_ASSOC);
        $name = $rowuser['firstname'] . ' ' . $rowuser['lastname'];
        $product_id = $respay->product_id;
        $bill_trx = $respay->bill_trx;
        $record_status = $respay->record_status;
        $val = $respay->counts;
        $price = $respay->price;
        $makeprice = $val * $price;
        $totalprice += $makeprice;

        // var_dump($totalprice);
        if ($totalprice > 999) {
            $totalprice;
        } else {
            $totalprice + 60;
        }
    }

    if ($pay->rowCount() > 0) {

        if ($record_status == 'แจ้งการชำระเงินเรียบร้อย') {
            echo 'taken';
        } else {
            echo alert_msg("success", array(
                "price" => $totalprice,
                "price1" => $totalprice,
                "name" => $name,
                "name1" => $name,
                "email" => $rowuser['email'],
                "email1" => $rowuser['email'],
                "phone" => $rowuser['phone'],
                "phone1" => $rowuser['phone'],
            ));
        }
    } else {
        echo 'not_taken';
    }
    exit();
}
