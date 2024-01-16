<?php
session_start();
require_once "../include/connect.php";


if (isset($_GET['addcart'])) {
    $product_id = $_POST['product_id'];
    $counts = $_POST['counts'];
    // session_destroy();
    // exit;
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // echo($_SESSION['cart']);
    if (isset($_SESSION['cart'])) {
        // echo "here";
        // exit;ห
        if (isset($_SESSION['cart']['product_id'][$product_id])) {
                $rowcartproduct = $conn->query("SELECT * FROM product WHERE product_id = $product_id")->fetch(PDO::FETCH_ASSOC);
                $oldcount = $_SESSION['cart']['product_id'][$product_id];
                $newcount = $counts + $oldcount;
                if($newcount > $rowcartproduct['product_quantity'] ){
                    $newcount = $rowcartproduct['product_quantity'];
                }
                $_SESSION['cart']['product_id'][$product_id] = $newcount;
                echo alert_msg("success", "เพิ่มจำนวนจากเดิม");
        } else {
            $_SESSION['cart']['product_id'][$product_id] = $counts;
            echo alert_msg("success", "เพิ่มรายการแล้ว");
        }

        // print_r($_SESSION['cart']);
    }
}

if (isset($_GET['minuscart'])) {
    $product_id = $_POST['product_id'];
    $counts = $_POST['counts'];

    // session_destroy();
    // exit;
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // echo($_SESSION['cart']);
    if (isset($_SESSION['cart'])) {
        // echo "here";
        // exit;ห
        if (isset($_SESSION['cart']['product_id'][$product_id])) {

            $oldcount = $_SESSION['cart']['product_id'][$product_id];
            $newcount = $oldcount - $counts;
            if ($newcount <= 0) {
                $newcount = 1;
            }
            $_SESSION['cart']['product_id'][$product_id] = $newcount;
            echo alert_msg("success", "ลบจำนวนจากเดิม");
        } else {
            $_SESSION['cart']['product_id'][$product_id] = $counts;
            echo alert_msg("success", "ลบรายการแล้ว");
        }

        // print_r($_SESSION['cart']);
    }
}

if (isset($_GET['clearcart'])) {
    unset($_SESSION['cart']);
    echo alert_msg("success", "เคลียร์ตะกร้าสินค้า");
}

if (isset($_GET['deleteitmecart'])) {
    $product_id = $_POST['product_id'];

    $items_in_cart = count($_SESSION['cart']['product_id']) ; 
    // print_r($items_in_cart) ;
    if($items_in_cart == 1){
        unset($_SESSION['cart']);
        echo alert_msg("success", "ลบสินค้าเรียบร้อย");
    }else{
        unset($_SESSION['cart']['product_id'][$product_id]);
        echo alert_msg("success", "ลบสินค้าเรียบร้อย");
    }
    
}

if (isset($_GET['confirmorder'])) {
    $id = $_SESSION['user_login'];

    if (!isset($_SESSION['cart']['product_id'])) {
        echo alert_msg("error", "ยังไม่มีรายการสินค้า");
        exit;
    } else {
        $total_quantity = 0;
        $total_price = 0;
        $bill_trx = uniqidReal(6);
        $created = date("Y-m-d H:i:s");
        $row = 0;
        
        $sqluser = $conn->query("SELECT * FROM users WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

        foreach ($_SESSION['cart']['product_id'] as $key => $val) {
            $rowcartproduct = $conn->query("SELECT * FROM product WHERE product_id = ${key}")->fetch(PDO::FETCH_ASSOC);
            $makeprice = $val * $rowcartproduct['product_price'];
            $total_quantity += $val;
            $total_price += $makeprice;
            $product_quantity = $rowcartproduct['product_quantity'] - $val;
            $_SESSION['product_quantity'] = $product_quantity;
            
            // ชื่อสินค้า
            $product[$row]['product_name'] = $rowcartproduct['product_name'];
            // ราคาต่อชิ้น
            $product[$row]['product_price'] = $rowcartproduct['product_price'];
            // ราคาหลายชิ้น
            $product[$row]['makeprice'] = $makeprice;
            // จำนวนสินค้า
            $product[$row]['val'] = $val;

            $row ++;
            
            $conn->query("INSERT INTO record(product_id, id, bill_trx, created, counts, price, record_status) VALUES
             ('$key', '$id', '$bill_trx', '$created', '$val', '".$rowcartproduct['product_price']."' , 'ยังไม่ได้แจ้งชำระเงิน') ");

            $conn->query("UPDATE product SET product_quantity = '$product_quantity' WHERE product_id = '" . $rowcartproduct['product_id'] . "' ");
        }


        // line noti
        $url        = 'https://notify-api.line.me/api/notify';
        $token      = 'SgTr0FxoDz4ZzHXVQoSqinpkdfWFjSenJucvFQAWrMY';
        $headers    = [
                        'Content-Type: application/x-www-form-urlencoded',
                        'Authorization: Bearer '.$token
                    ];
        $fields     = 'message=คุณ'.$sqluser['firstname'].' '.$sqluser['lastname'].
                    '
รายการสินค้า
';
                    foreach ($product as $key => $value) {
                        $fields .= 
'  - '.$value['product_name'].' ราคา/หน่วย'.$value['product_price'].'-. จำนวน '.$value['val'].' ชิ้น. รวม'. $value['makeprice'].'-.
' ;
                    }
                    
                    $fields .= '
ยอดรวม '. $total_price.'-.' ;  

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $ch );
        curl_close( $ch );

        // var_dump($result);
        // $result = json_decode($result,TRUE);
        // line noti
        
        unset($_SESSION['cart']);
        echo alert_msg("success", "บันทึกรายการสำเร็จ");
    }
}
