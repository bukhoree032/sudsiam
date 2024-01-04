<?php
session_start();
require_once('../../include/connect.php');

if (isset($_POST['action'])) {
    if (!isset($_SESSION['admin_login'])) {
        echo alert_msg("error", "nopermission");
        exit;
    }
    if ($_POST['action'] == "addproduct") {

        $product_code = $_POST['product_code'];
        $product_name = $_POST['product_name'];
        $product_detail = $_POST['product_detail'];
        $product_alldetail = $_POST['product_alldetail'];
        $product_price = $_POST['product_price'];
        $product_status = $_POST['product_status'];
        $product_type_id = $_POST['product_type_id'];
        $product_created = date('Y-m-d H:i:s');
        $product_editdate = date('Y-m-d H:i:s');
        $product_quantity = $_POST['product_quantity'];

        if (!is_numeric($_POST['product_price']) || !is_numeric($_POST['product_quantity'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['product_name']) || empty($_POST['product_detail']) || empty($_POST['product_status'])) {
                echo alert_msg("error", "empty");
                exit;
            }
            $chk = $conn->prepare("INSERT INTO product (product_code, product_name, product_detail, product_alldetail, product_price, product_status, product_type_id, product_created, product_editdate, product_quantity)
            VALUE(:product_code, :product_name ,:product_detail, :product_alldetail,:product_price, :product_status, :product_type_id, :product_created, :product_editdate, :product_quantity );");

            $chk->bindParam(":product_code", $product_code, PDO::PARAM_STR);
            $chk->bindParam(":product_name",  $product_name, PDO::PARAM_STR);
            $chk->bindParam(":product_detail", $product_detail, PDO::PARAM_STR);
            $chk->bindValue(":product_alldetail", $product_alldetail, PDO::PARAM_STR);
            $chk->bindParam(":product_price", $product_price, PDO::PARAM_INT);
            $chk->bindParam(":product_status", $product_status, PDO::PARAM_STR);
            $chk->bindParam(":product_type_id", $product_type_id, PDO::PARAM_LOB);
            $chk->bindParam(":product_created", $product_created);
            $chk->bindParam(":product_editdate", $product_editdate);
            $chk->bindParam(":product_quantity", $product_quantity, PDO::PARAM_INT);
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
    if ($_POST['action'] == "deletedata") {
        $chk = $conn->query("DELETE FROM product WHERE product_id = '" . $_POST['id'] . "'");
        $conn->query("DELETE FROM product_pic WHERE product_id = '" . $_POST['id'] . "'");
        if ($chk) {
            echo alert_msg("success", "ok");
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }
    if ($_POST['action'] == "getdata") {
        $sql = $conn->query("SELECT * FROM product WHERE product_id = '" . $_POST['id'] . "' LIMIT 1");
        $sql->execute();

        if ($sql) {
            $rowdata = $sql->fetch(PDO::FETCH_ASSOC);
            echo alert_msg("success", array(
                "product_code" => $rowdata['product_code'],
                "product_name" => $rowdata['product_name'],
                "product_detail" => $rowdata['product_detail'],
                "product_alldetail" => $rowdata['product_alldetail'],
                "product_price" => $rowdata['product_price'],
                "product_quantity" => $rowdata['product_quantity'],
                "product_status" => $rowdata['product_status'],
                "product_type_id" => $rowdata['product_type_id'],
            ));
            exit;
        } else {
            echo alert_msg("error", "wrong");
            exit;
        }
    }

    if ($_POST['action'] == "editproduct") {
        if (!is_numeric($_POST['product_price'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['product_name']) || empty($_POST['product_detail']) || empty($_POST['product_status'])) {
                echo alert_msg("error", "empty");
                exit;
            }

            $chk = $conn->query("UPDATE product SET product_code = '" . trim($_POST['product_code']) . "', 
            product_name = '" . $_POST['product_name'] . "', 
            product_detail = '" . $_POST['product_detail'] . "', 
            product_alldetail = '" . $_POST['product_alldetail'] . "', 
            product_price = '" .$_POST['product_price'] . "', 
            product_status = '" . $_POST['product_status'] . "', 
            product_type_id = '" . $_POST['product_type_id'] . "', 
            product_quantity = '" . $_POST['product_quantity'] . "', 
            product_editdate = '". date('Y-m-d H:i:s') ."' WHERE product_id = '".$_POST['id']."'");

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
