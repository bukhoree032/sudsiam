<div id="fb-root" class=""></div>
<a href="javascript:void(0);" id="toTop" class="back-to-top" style="display: none; width: 45px !important; height: 45px !important; z-index: 55;">
    <span class="fa-stack" style="font-size: 22px;">
        <i class="fas fa-circle fa-stack-2x" style="color: #2b2a2a;"></i>
        <i class="fas fa-arrow-up fa-stack-1x fa-inverse" style="color: #ffffff;"></i>
    </span>
</a>
<div class="section-container">
    <!-- BoxLoading -->
    <div class="boxLoading" id="boxLoading">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"></circle>
            </svg>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="modal_standard"></div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="modal_popup"></div>
    <div class="disabled-filter"></div>
    <div class="section-body ">
        <div id="section-header" class="sps sps--abv">
            <div class="headerDesktop">
                <nav id="topZone" class="navbar-expand-xl">

                    <div id="top-area">
                        <div id="top-sticky">
                            <div class="container">
                                <div class="row no-gutters justify-content-center">
                                    <div class="collapse topSearchBar">
                                        <div class="topSearchBarInner">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control textStringSearchTopWidget" placeholder="ใส่คำค้นหาของคุณ...">
                                                <div class="input-group-append">
                                                    <button class="btn border-left-0 rounded-right btn-outline-secondary btnSearchTopWidget" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-auto d-lg-inline-flex align-items-center">
                                        <div id="menutop" class="hoverOverlay d-inline-flex">
                                            <div class="collapse navbar-collapse">

                                                <div class="topwidget-menu col-12">
                                                    <ul class="navbar-nav navbar-topmenu public-topmenu">
                                                        <li class="nav-item">
                                                            <a class="nav-link abl1" id="topmenuonpage" data-onhome="home" href="index.php" target="_self">
                                                                HOME </a>
                                                        </li>

                                                        <li class="nav-item ">
                                                            <a class="nav-link abl1" href="index.php" target="_self">
                                                                สินค้าทั้งหมด </a>
                                                        </li>

                                                        <li class="nav-item dropdown ">
                                                            <a class="nav-link abl1" href="#" target="_self" style="position: relative;">
                                                                หมวดหมู่สินค้า <i class="fal fa-chevron-down fa-xs fa-fw arrowCollapse"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <?php
                                                                $sql = "SELECT * FROM product_type order by product_type_sort";
                                                                $query = $conn->prepare($sql);
                                                                $query->execute();
                                                                $result = $query->fetchAll(PDO::FETCH_OBJ);

                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($result as $res) {
                                                                ?>
                                                                        <li>
                                                                            <a class="nav-link dropdown-item abl2" href="producttype.php?type=<?php echo $res->product_type_id; ?>">
                                                                                <?php
                                                                                echo $res->product_type_name;
                                                                                ?>
                                                                            </a>
                                                                        </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </ul>
                                                        </li>

                                                        <li class="nav-item ">
                                                            <a class="nav-link abl1" href="informpayment.php" target="_self">
                                                                แจ้งการชำระเงิน </a>
                                                        </li>
                                                        <li class="nav-item ">
                                                            <a class="nav-link abl1" href="order.php" target="_self">
                                                                ติดตามสถานะการสั่งซื้อ</a>
                                                        </li>


                                                        <li class="nav-item dropdown more " data-width="80">
                                                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="javascript:void(0)">
                                                                เพิ่มเติม <i class="fal fa-chevron-down fa-xs fa-fw arrowCollapse"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="nav-link dropdown-item abl2" href="#" target="_self"> Contact </a></li>
                                                                <li><a class="nav-link dropdown-item abl2" href="#" target="_self"> กำลังมา </a></li>
                                                                <li><a class="nav-link dropdown-item abl2" href="#" target="_self"> กำลังมา </a></li>

                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto col-lg-auto d-lg-inline-flex align-items-center">
                                        <div id="searchtop" class="hoverOverlay d-inline-flex align-middle">

                                            <div rel="nofollow" class="navbar-link aOpenSearchIcon" data-toggle="collapse" data-target=".topSearchBar" role="button" aria-expanded="false" aria-controls="topSearchBar" style="cursor:pointer;">
                                                <i class="far fa-search fa-fw navbar-fa"></i>
                                            </div>
                                            <div class="navbar-link aOpenSearchIcon">

                                            </div>

                                            <?php
                                            $total_quantity = 0;
                                            $total_price = 0;
                                            if (isset($_SESSION['cart'])) {

                                                foreach ($_SESSION['cart']['product_id'] as $key => $val) {
                                                    $rowcartitem = $conn->query("SELECT * FROM product WHERE product_id = ${key}")->fetch(PDO::FETCH_ASSOC);
                                                    $total_quantity += $val;
                                                }
                                                if ($total_quantity == 0) {
                                            ?>
                                                    <span class="cartitem">
                                                        <a href="./cart.php"></a>
                                                    </span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="cartitem">
                                                        <a href="./cart.php"><?= $total_quantity; ?></a>
                                                    </span>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <div class="navbar-link aOpenSearchIcon">
                                                <a href="./cart.php" class="">
                                                    <i class="fas fa-shopping-cart fa-fw navbar-fa2 puIconsCart"></i>
                                                </a>
                                            </div>



                                            <?php
                                            if (isset($_SESSION['user_login'])) {

                                            ?>
                                                <div class="navbar-link aOpenSearchIcon">
                                                    <a href="./profile.php" class="aregiter abl1">ยินดีต้อนรับ</a>
                                                    <a href="#" class="aregiter abl1">|</a>
                                                    <a href="include/logout.php" class="aregiter abl1">ออกระบบ</a>
                                                </div>
                                            <?php } else {
                                            ?>
                                                <div class="navbar-link aOpenSearchIcon">
                                                    <a href="./register.php" class="aregiter abl1">สมัครสมาชิก</a>
                                                    <a href="#" class="aregiter abl1">|</a>
                                                    <a href="./login.php" class="aregiter abl1">เข้าสู่ระบบ</a>
                                                </div>
                                            <?php }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="headerMobile">
                <nav id="topZone" class="navbar-expand-xl airry">
                    <div id="top-area">
                        <div id="top-sticky">
                            <div class="">
                                <div class="sb collapse topSearchBar">
                                    <div class="topSearchBarInner">
                                        <div class="input-group">
                                            <input type="text" class="form-control textStringSearchTopWidget" placeholder="ใส่คำค้นหาของคุณ..." />
                                            <div class="input-group-append">
                                                <button class="btn border-left-0 rounded-right btn-outline-secondary aCloseSearchIcon" data-toggle="collapse" data-target=".topSearchBar" role="button" aria-expanded="false" aria-controls="topSearchBar" type="button">
                                                    <i class="fas fa-search fa-fw navbar-fa" style="font-size: 16px; vertical-align: initial;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col pl-1 col-lg-auto d-lg-inline-flex brandingBox position-relative" style="display: flex;flex-direction: column; justify-content: center; width: 20%;">
                                        <a class="navbar-brand position-absolute" href="index.php" style="display: flex;flex-direction: column; justify-content: center;">
                                            <i class='bx bx-home'></i>
                                        </a>
                                    </div>
                                    <div class="col-12 col-lg d-lg-inline-flex orderingMenu">
                                        <div class="collapse navbar-collapse pb-1" id="navbarNavDropdown">

                                            <div class="topwidget-menu">
                                                <ul class="navbar-nav navbar-topmenu public-topmenu">
                                                    <li class="nav-item">
                                                        <a class="nav-link abl1" id="topmenuonpage" data-onhome="home" href="index.php" target="_self">
                                                            HOME </a>
                                                    </li>

                                                    <li class="nav-item ">
                                                        <a class="nav-link abl1" href="index.php" target="_self">
                                                            สินค้าทั้งหมด </a>
                                                    </li>

                                                    <li class="nav-item ">
                                                        <a class="nav-link abl1" href="informpayment.php" target="_self">
                                                            แจ้งการชำระเงิน </a>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a class="nav-link abl1" href="order.php" target="_self">
                                                            ติดตามสถานะการสั่งซื้อ</a>
                                                    </li>


                                                    <li class="nav-item dropdown more " data-width="80">
                                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="javascript:void(0)">
                                                            เพิ่มเติม <i class="fal fa-chevron-down fa-xs fa-fw arrowCollapse"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="nav-link dropdown-item abl2" href="#" target="_self"> Contact </a></li>
                                                            <li><a class="nav-link dropdown-item abl2" href="#" target="_self"> กำลังมา </a></li>
                                                            <li><a class="nav-link dropdown-item abl2" href="#" target="_self"> กำลังมา </a></li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="d-md-none theme-td-border my-0"></div>
                                            <div class="topwidget-menu">

                                                <ul class="navbar-nav navbar-topmenu">
                                                    <?php
                                                    if (isset($_SESSION['user_login'])) {
                                                    ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="./profile.php">
                                                                ยินดีต้อนรับ </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="include/logout.php">
                                                                ออกระบบ </a>
                                                        </li>
                                                    <?php } else {
                                                    ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="./login.php">
                                                                เข้าสู่ระบบ </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="./register.php">
                                                                สมัครสมาชิก </a>
                                                        </li>
                                                    <?php }
                                                    ?>

                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-auto pr-1 col-lg-auto text-right order-6 d-inline-flex align-items-center">
                                        <div rel="nofollow" class="navbar-link aOpenSearchIcon" data-toggle="collapse" data-target=".topSearchBar" role="button" aria-expanded="false" aria-controls="topSearchBar" style="cursor:pointer;">
                                            <i class="far fa-search fa-fw navbar-fa"></i>
                                        </div>

                                        <?php
                                        $total_quantity = 0;
                                        $total_price = 0;
                                        if (isset($_SESSION['cart'])) {
                                            foreach ($_SESSION['cart']['product_id'] as $key => $val) {
                                                $rowcartitem = $conn->query("SELECT * FROM product WHERE product_id = ${key}")->fetch(PDO::FETCH_ASSOC);
                                                $total_quantity += $val;
                                            }
                                            if ($total_quantity == 0) {
                                        ?>
                                                <span class="cartitem-phone">
                                                    <a href="./cart.php"></a>
                                                </span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="cartitem-phone" style="margin-left: 20px;">
                                                    <a href="./cart.php"><?= $total_quantity; ?></a>
                                                </span>
                                        <?php
                                            }
                                        }
                                        ?>

                                        <a class="navbar-link cart-nav" href="./cart.php">
                                            <span class="fa-layers fa-fw navbar-fa2">
                                                <i class="fas fa-shopping-cart fa-fw navbar-fa2 puIconsCart"></i>
                                            </span>
                                        </a>

                                        <button class="navbar-toggler hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>