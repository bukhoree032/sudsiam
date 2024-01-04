<?php
session_start();
require_once('../../include/connect.php');

if (isset($_POST['action'])) {
    if (!isset($_SESSION['admin_login'])) {
        echo alert_msg("error", "nopermission");
        exit;
    }
    
    if ($_POST['action'] == "getuser") {
        $chk = $conn->query("SELECT * FROM users WHERE id = '".$_POST['id']."' LIMIT 1");
        $chk->execute();
        $row = $chk->fetch(PDO::FETCH_ASSOC);
        if ($chk) {
            echo alert_msg("success", array(
                "status"=>$row['status'],
                "urole"=>$row['urole'],
            ));
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }
    if ($_POST['action'] == "deleteuser") {
        $chk = $conn->query("DELETE FROM users WHERE id  = '".$_POST['id']."'");
        if ($chk) {
            echo alert_msg("success", "ok");
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }
    if ($_POST['action'] == "edituser") {
            $chk = $conn->query("UPDATE users SET status = '".$_POST['status']."' , urole = '".$_POST['urole']."' WHERE id = '".$_POST['id']."'");
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
