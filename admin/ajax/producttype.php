<?php
session_start();
require_once ('../../include/connect.php');
if (isset($_POST['action'])) {
    if (!isset($_SESSION['admin_login'])) {
        echo alert_msg("error", "nopermission");
        exit;
    }
    if ($_POST['action'] == "addtype") {
        if (!is_numeric($_POST['sorting'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['sorting']) || empty($_POST['typename'])) {
                echo alert_msg("error", "empty");
                exit;
            }
            $chk = $conn->query("INSERT INTO product_type (product_type_sort, product_type_name)
            VALUE('" . trim($_POST['sorting']) . "', '" . trim($_POST['typename']) . "')");
            if ($chk) {
                echo alert_msg("success", "ok");
                exit;
            } else {
                echo alert_msg("error", "wrong");
                exit;
            }
        }
    }

    if ($_POST['action'] == "getdata") {
        $sql = $conn->query("SELECT * FROM product_type WHERE product_type_id = '".$_POST['id']."' LIMIT 1");
        $sql->execute();
        if ($sql) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            echo alert_msg("success", array(
                "sorting"=>$row['product_type_sort'],
                "typename"=>$row['product_type_name'],
            ));
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }

    if ($_POST['action'] == "deletedata") {
        $chk = $conn->query("DELETE FROM product_type WHERE product_type_id = '".$_POST['id']."'");
        if ($chk) {
            echo alert_msg("success", "ok");
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }
    
    if ($_POST['action'] == "edittype") {
        if (!is_numeric($_POST['sorting'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['sorting']) || empty($_POST['typename'])) {
                echo alert_msg("error", "empty");
                exit;
            }
            $chk = $conn->query("UPDATE product_type SET product_type_sort = '".$_POST['sorting']."', 
            product_type_name = '".$_POST['typename']."' 
            WHERE product_type_id = '".$_POST['id']."'");
            if ($chk) {
                echo alert_msg("success", "ok");
                exit;
            } else {
                echo alert_msg("error", "wrong");
                exit;
            }
        }
    }
    exit;
}
