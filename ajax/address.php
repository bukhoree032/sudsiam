<?php
session_start();
require_once('../include/connect.php');

if (isset($_POST['action'])) {
    if (!isset($_SESSION['user_login'])) {
        echo alert_msg("error", "nopermission");
        exit;
    }
    if ($_POST['action'] == "addaddress") {
        $id = $_SESSION['user_login'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $user_adress = $_POST['user_adress'];
        $user_province = $_POST['user_province'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_district = $_POST['user_district'];
        $user_parish = $_POST['user_parish'];

        if (!is_numeric($_POST['phone']) || !is_numeric($_POST['user_postal_code'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['user_adress']) || empty($_POST['user_province']) || empty($_POST['user_district']) || empty($_POST['user_parish'])) {
                echo alert_msg("error", "empty");
                exit;
            }
            $chk = $conn->prepare("INSERT INTO usersadress (id, user_adress, user_province, user_postal_code, user_district, user_parish)
            VALUE(:id, :user_adress, :user_province, :user_postal_code, :user_district, :user_parish);");
            $chk->bindParam(":id", $id, PDO::PARAM_INT);
            $chk->bindParam(":user_adress",  $user_adress, PDO::PARAM_STR);
            $chk->bindParam(":user_province", $user_province, PDO::PARAM_STR);
            $chk->bindParam(":user_postal_code", $user_postal_code, PDO::PARAM_INT);
            $chk->bindValue(":user_district", $user_district, PDO::PARAM_STR);
            $chk->bindParam(":user_parish", $user_parish, PDO::PARAM_STR);
            $chk->execute();

            $chk1 = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, phone = :phone WHERE id = :id");
            $chk1->bindParam(":id", $id, PDO::PARAM_INT);
            $chk1->bindParam(":firstname", $firstname, PDO::PARAM_STR);
            $chk1->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $chk1->bindParam(":phone", $phone, PDO::PARAM_STR);
            $chk1->execute();

            if ($chk && $chk1) {
                echo alert_msg("success", "ok");
                exit;
            } else {
                echo alert_msg("error", "wrong");
                exit;
            }
        }
    }

    if ($_POST['action'] == "addaddress-mobile") {
        $id = $_SESSION['user_login'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $user_adress = $_POST['user_adress'];
        $user_province = $_POST['user_province'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_district = $_POST['user_district'];
        $user_parish = $_POST['user_parish'];

        if (!is_numeric($_POST['phone']) || !is_numeric($_POST['user_postal_code'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['user_adress']) || empty($_POST['user_province']) || empty($_POST['user_district']) || empty($_POST['user_parish'])) {
                echo alert_msg("error", "empty");
                exit;
            }
            $chk = $conn->prepare("INSERT INTO usersadress (id, user_adress, user_province, user_postal_code, user_district, user_parish)
            VALUE(:id, :user_adress, :user_province, :user_postal_code, :user_district, :user_parish);");
            $chk->bindParam(":id", $id, PDO::PARAM_INT);
            $chk->bindParam(":user_adress",  $user_adress, PDO::PARAM_STR);
            $chk->bindParam(":user_province", $user_province, PDO::PARAM_STR);
            $chk->bindParam(":user_postal_code", $user_postal_code, PDO::PARAM_INT);
            $chk->bindValue(":user_district", $user_district, PDO::PARAM_STR);
            $chk->bindParam(":user_parish", $user_parish, PDO::PARAM_STR);
            $chk->execute();

            $chk1 = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, phone = :phone WHERE id = :id");
            $chk1->bindParam(":id", $id, PDO::PARAM_INT);
            $chk1->bindParam(":firstname", $firstname, PDO::PARAM_STR);
            $chk1->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $chk1->bindParam(":phone", $phone, PDO::PARAM_STR);
            $chk1->execute();

            if ($chk && $chk1) {
                echo alert_msg("success", "ok");
                exit;
            } else {
                echo alert_msg("error", "wrong");
                exit;
            }
        }
    }

    if ($_POST['action'] == "editaddress") {
        $id = $_SESSION['user_login'];
        if (!is_numeric($_POST['phone']) || !is_numeric($_POST['user_postal_code'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['user_adress']) || empty($_POST['user_province']) || empty($_POST['user_district']) || empty($_POST['user_parish'])) {
                echo alert_msg("error", "empty");
                exit;
            }

            $chk = $conn->query("UPDATE usersadress SET user_adress = '" . trim($_POST['user_adress']) . "', 
            user_province = '" . $_POST['user_province'] . "', 
            user_postal_code = '" . $_POST['user_postal_code'] . "', 
            user_district = '" . $_POST['user_district'] . "', 
            user_parish = '" . $_POST['user_parish'] . "',
            order_express = '" . $_POST['order_express'] . "'
            WHERE id = '$id'");

            $chk1 = $conn->query("UPDATE users SET firstname = '" . trim($_POST['firstname']) . "', 
            lastname = '" . $_POST['lastname'] . "', 
            phone = '" . $_POST['phone'] . "'
            WHERE id = '$id'");

            if ($chk && $chk1) {
                echo alert_msg("success", "ok");
                exit;
            } else {
                echo alert_msg("error", "wrong");
                exit;
            }
        }
    }
    
    if ($_POST['action'] == "editaddress-mobile") {
        $id = $_SESSION['user_login'];
        if (!is_numeric($_POST['phone']) || !is_numeric($_POST['user_postal_code'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['user_adress']) || empty($_POST['user_province']) || empty($_POST['user_district']) || empty($_POST['user_parish'])) {
                echo alert_msg("error", "empty");
                exit;
            }

            $chk = $conn->query("UPDATE usersadress SET user_adress = '" . trim($_POST['user_adress']) . "', 
            user_province = '" . $_POST['user_province'] . "', 
            user_postal_code = '" . $_POST['user_postal_code'] . "', 
            user_district = '" . $_POST['user_district'] . "', 
            user_parish = '" . $_POST['user_parish'] . "',
            order_express = '" . $_POST['order_express'] . "'
            WHERE id = '$id'");

            $chk1 = $conn->query("UPDATE users SET firstname = '" . trim($_POST['firstname']) . "', 
            lastname = '" . $_POST['lastname'] . "', 
            phone = '" . $_POST['phone'] . "'
            WHERE id = '$id'");

            if ($chk && $chk1) {
                echo alert_msg("success", "ok");
                exit;
            } else {
                echo alert_msg("error", "wrong");
                exit;
            }
        }
    }

    if ($_POST['action'] == "editprofile") {

        $id = $_SESSION['user_login'];
        // var_dump($_POST);
        if (!is_numeric($_POST['phone'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['phone']) || empty($_POST['sex'])) {
                echo alert_msg("error", "empty");
                exit;
            }
    
            $chk = $conn->query("UPDATE users SET firstname = '" . trim($_POST['fname']) . "', 
            lastname = '" . $_POST['lname'] . "', 
            phone = '" . $_POST['phone'] . "', 
            sex = '" . $_POST['sex'] . "'
            WHERE id = '$id'");
    
            if ($chk) {
                echo alert_msg("success", "ok");
                exit;
            } else {
                echo alert_msg("error", "wrong");
                exit;
            }
        }
    }

    if ($_POST['action'] == "inputaddress") {
        $id = $_SESSION['user_login'];
        $user_adress = $_POST['user_adress'];
        $user_province = $_POST['user_province'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_district = $_POST['user_district'];
        $user_parish = $_POST['user_parish'];

        if (!is_numeric($_POST['user_postal_code'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['user_adress']) || empty($_POST['user_province']) || empty($_POST['user_district']) || empty($_POST['user_parish'])) {
                echo alert_msg("error", "empty");
                exit;
            }
            $chk = $conn->prepare("INSERT INTO usersadress (id, user_adress, user_province, user_postal_code, user_district, user_parish ,order_express)
            VALUE(:id, :user_adress, :user_province, :user_postal_code, :user_district, :user_parish, 'ไปรษณีย์ไทย');");
            $chk->bindParam(":id", $id, PDO::PARAM_INT);
            $chk->bindParam(":user_adress",  $user_adress, PDO::PARAM_STR);
            $chk->bindParam(":user_province", $user_province, PDO::PARAM_STR);
            $chk->bindParam(":user_postal_code", $user_postal_code, PDO::PARAM_INT);
            $chk->bindValue(":user_district", $user_district, PDO::PARAM_STR);
            $chk->bindParam(":user_parish", $user_parish, PDO::PARAM_STR);
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
    
    if ($_POST['action'] == "inputaddress-phone") {
        $id = $_SESSION['user_login'];
        $user_adress = $_POST['user_adress'];
        $user_province = $_POST['user_province'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_district = $_POST['user_district'];
        $user_parish = $_POST['user_parish'];

        if (!is_numeric($_POST['user_postal_code'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['user_adress']) || empty($_POST['user_province']) || empty($_POST['user_district']) || empty($_POST['user_parish'])) {
                echo alert_msg("error", "empty");
                exit;
            }
            $chk = $conn->prepare("INSERT INTO usersadress (id, user_adress, user_province, user_postal_code, user_district, user_parish ,order_express)
            VALUE(:id, :user_adress, :user_province, :user_postal_code, :user_district, :user_parish, 'ไปรษณีย์ไทย');");
            $chk->bindParam(":id", $id, PDO::PARAM_INT);
            $chk->bindParam(":user_adress",  $user_adress, PDO::PARAM_STR);
            $chk->bindParam(":user_province", $user_province, PDO::PARAM_STR);
            $chk->bindParam(":user_postal_code", $user_postal_code, PDO::PARAM_INT);
            $chk->bindValue(":user_district", $user_district, PDO::PARAM_STR);
            $chk->bindParam(":user_parish", $user_parish, PDO::PARAM_STR);
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

    if ($_POST['action'] == "updateaddress") {
        $id = $_SESSION['user_login'];
        if (!is_numeric($_POST['user_postal_code'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['user_adress']) || empty($_POST['user_province']) || empty($_POST['user_district']) || empty($_POST['user_parish'])) {
                echo alert_msg("error", "empty");
                exit;
            }

            $chk = $conn->query("UPDATE usersadress SET user_adress = '" . trim($_POST['user_adress']) . "', 
            user_province = '" . $_POST['user_province'] . "', 
            user_postal_code = '" . $_POST['user_postal_code'] . "', 
            user_district = '" . $_POST['user_district'] . "', 
            user_parish = '" . $_POST['user_parish'] . "'
            WHERE id = '$id'");

            if ($chk) {
                echo alert_msg("success", "ok");
                exit;
            } else {
                echo alert_msg("error", "wrong");
                exit;
            }
        }
    }

    if ($_POST['action'] == "updateaddress-phone") {
        $id = $_SESSION['user_login'];
        if (!is_numeric($_POST['user_postal_code'])) {
            echo alert_msg("error", "notnum");
            exit;
        } else {
            if (empty($_POST['user_adress']) || empty($_POST['user_province']) || empty($_POST['user_district']) || empty($_POST['user_parish'])) {
                echo alert_msg("error", "empty");
                exit;
            }

            $chk = $conn->query("UPDATE usersadress SET user_adress = '" . trim($_POST['user_adress']) . "', 
            user_province = '" . $_POST['user_province'] . "', 
            user_postal_code = '" . $_POST['user_postal_code'] . "', 
            user_district = '" . $_POST['user_district'] . "', 
            user_parish = '" . $_POST['user_parish'] . "'
            WHERE id = '$id'");

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
