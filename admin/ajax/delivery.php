<?php
session_start();
require_once('../../include/connect.php');

if (isset($_POST['action'])) {
    if (!isset($_SESSION['admin_login'])) {
        echo alert_msg("error", "nopermission");
        exit;
    }

    if ($_POST['action'] == "getdelivery") {
        $chk = $conn->query("SELECT * FROM payment WHERE pay_id = '" . $_POST['id'] . "' LIMIT 1");
        $chk->execute();
        $row = $chk->fetch(PDO::FETCH_ASSOC);
        if ($chk) {
            echo alert_msg("success", array(
                "pay_ems" => $row['pay_ems'],
                "pay_id_ems" => $row['pay_id_ems'],
            ));
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }


    if ($_POST['action'] == "editdelivery") {
        $delivery_date = date('Y-m-d H:i:s');
        $chk = $conn->query("UPDATE payment SET pay_ems = '" . $_POST['pay_ems'] . "', pay_id_ems = '" . $_POST['pay_id_ems'] . "',  delivery_date = '" . $_POST['delivery_date'] . "',
        delivery_time = '" . $_POST['delivery_time'] . "' WHERE pay_id =  '" . $_POST['id'] . "'");
        if ($chk) {
            echo alert_msg("success", "ok");
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }


    exit;
}
