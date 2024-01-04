<!doctype html>
<html lang="th">
<?php session_start(); ?>
<?php include('include/connect.php'); ?>
<?php include('include/headindex.php'); ?>
<?php include('include/navbar.php'); ?>
<link rel="stylesheet" href="styels.css">
<body>
    <?php include('include/Carousel.php'); ?>
    <?php include('product.php'); ?>
    <?php include('include/footerindex.php'); ?>
    <?php
        // echo  $_SESSION['user_login'];
        
    ?>
    
</body>

</html>