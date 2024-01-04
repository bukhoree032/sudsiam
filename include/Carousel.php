<div id="section-content">
    <div class="carousel_item" style="position: relative; background-color:#ffffff; " data-orderbox="onest">
        <div class="container">
            <div style="padding-top: 0px; padding-bottom: 0px;">
                <div>
                    <div class="Mweslide_8548 owlSliderBoxAdv ">
                        <div class="iconLoadSlider_8548 loader">
                            <svg class="circular" viewBox="25 25 50 50">
                                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
                            </svg>
                        </div>
                        <!-- slider -->
                        <div class="owl-carousel owl-theme owl-carouselhh_8548 ">
                            <!-- start item -->
                            <?php
                            $caro = $conn->prepare("SELECT * FROM carousel order by carousel_pic_sort ASC");
                            $caro->execute();
                            $rowcaro = $caro->fetchAll(PDO::FETCH_OBJ);
                            foreach ($rowcaro as $rescaro) {
                            ?>
                                <div class="item item0">
                                    <!-- auto height -->
                                    <img src="include/img/<?= $rescaro->carousel_pic_path ?>"  height="500px" alt="image" title="image" >

                                </div>
                            <?php } ?>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end background div -->
    <br>