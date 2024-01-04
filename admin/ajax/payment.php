<?php
session_start();
require_once('../../include/connect.php');

if (isset($_POST['action'])) {
    if (!isset($_SESSION['admin_login'])) {
        echo alert_msg("error", "nopermission");
        exit;
    }
    
    if ($_POST['action'] == "getpayment") {
        $chk = $conn->query("SELECT * FROM payment WHERE pay_id = '".$_POST['id']."' LIMIT 1");
        $chk->execute();
        $row = $chk->fetch(PDO::FETCH_ASSOC);
        if ($chk) {
            echo alert_msg("success", array(
                "status"=>$row['pay_status'],
            ));
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }
    
    if ($_POST['action'] == "showpayment") {
        $chk = $conn->query("SELECT * FROM payment WHERE pay_id = '".$_POST['id']."' LIMIT 1");
        $chk->execute();
        $row = $chk->fetch(PDO::FETCH_ASSOC);
        if ($chk) {
            echo alert_msg("success", array(
                "bill_trx"=>$row['bill_trx'],
                "status"=>$row['pay_status'],
            ));
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }
    
    if ($_POST['action'] == "editpayment") {
            $chk = $conn->query("UPDATE payment SET pay_status = '".$_POST['status']."' WHERE pay_id = '".$_POST['id']."'");
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
