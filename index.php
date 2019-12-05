<?php
include("header.php");

$statement = $pdo->prepare("SELECT * FROM tbl_art");
$statement->execute();
$total_arts = $statement->rowCount();
?>

    <!-- slider_area_start -->
    <div class="slider_area ">
        <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-6 col-md-6">
                        <div class="illastrator_png">
                            <img src="assets/img/banner/edu_ilastration.png" alt="">
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="slider_info">
                            <h3>Sketch <br>
                                Painting <br>
                                Graphics Designss</h3>
                            <a href="my-arts.php" class="boxed_btn">Browse my Arts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- about_area_start -->
    <div class="about_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="single_about_info">
                        <h3>Over <?php echo $total_arts; ?> Arts</h3>
                        <p>Hope you'll love my Arts</p>
                        <a href="mailto:contact@blg.rf.gd" class="boxed_btn">Buy</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- about_area_end -->

<?php
include("footer.php");
?>