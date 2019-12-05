<?php
include("header.php");
?>
		<div class="bradcam_area breadcam_bg overlay2">
            <h3>My Arts</h3>
        </div>

	<div class="popular_courses plus_padding">
        <div class="container">
        	<div class="row">
                <div class="col-xl-12">
                    <div class="course_nav">
                        <nav>
                            <ul class="nav" id="myTab" role="tablist">
                       
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">All</a>
                                </li>
                        <?php
						$statement = $pdo->prepare("SELECT * FROM tbl_art_category WHERE status=? ORDER BY art_cat_id DESC");
						$statement->execute(array('Active'));
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
						foreach ($result as $row) 
						{
						?>
                                <li class="nav-item">
                                    <a class="nav-link" id="<?php echo $row['art_cat_name'].'-tab'; ?>" data-toggle="tab" href="<?php echo '#'.$row['art_cat_name']; ?>" role="tab"
                                        aria-controls="design" aria-selected="false"><?php echo $row['art_cat_name']; ?></a>
                                </li>
                            <?php }?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
        <div class="all_courses">
            <div class="container">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                            <?php

                            $statement1 = $pdo->prepare("SELECT * FROM tbl_art");
							$statement1->execute(array('s'));
							$result2 = $statement1->fetchAll();
							foreach ($result2 as $row2) 
							{
								?>
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                        <div class="single_courses">
                                            <div class="thumb">
                                                <a href="<?php echo BASE_URL; ?>assets/uploads/<?php echo $row2['art_path']; ?>" class="img-pop-up">
											<div class="single-gallery-image" style="background: url(<?php echo BASE_URL; ?>assets/uploads/<?php echo $row2['art_path']; ?>);">
												
											</div>
												</a>
                                            </div>
                                            <div class="courses_info">
                                                <span><?php echo $row2['art_name']; ?></span>
                                                <div class="star_prise d-flex justify-content-between">
                                                    <div class="prise">
                                                        <span class="active_prise"><?php echo '<b>'.$row2['currency'].' '.$row2['art_price'].'</b>'; ?></span>
                                                    <a href="#test-form" class="login popup-with-form">
                                    				<button>Buy</button>
                                					</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                    </div>
                    <div class="tab-pane fade" id="<?php echo $row['art_cat_name']; ?>" role="tabpanel" aria-labelledby="<?php echo $row['art_cat_name'].'-tab'; ?>">
                            <div class="row">
                            	<?php

							$statement1 = $pdo->prepare("SELECT * FROM tbl_art WHERE art_cat_id=? ORDER BY art_id DESC");
							$statement1->execute(array($row['art_cat_id']));
							$result1 = $statement1->fetchAll();
							foreach ($result1 as $row1) 
							{
								?>
                                    <div class="col-xl-4 col-lg-4 col-md-6  col-md-6">
                                        <div class="single_courses">
                                            <div class="thumb">
                                                <a href="<?php echo BASE_URL; ?>assets/uploads/<?php echo $row1['art_path']; ?>" class="img-pop-up">
												<div class="single-gallery-image" style="background: url(<?php echo BASE_URL; ?>assets/uploads/<?php echo $row1['art_path']; ?>);"></div>
												</a>
                                            </div>
                                            <div class="courses_info">
                                                <span><?php echo $row1['art_name']; ?></span>
                                                <div class="star_prise d-flex justify-content-between">
                                                    <div class="prise">
                                                        <span class="active_prise"><?php echo '<b>'.$row2['currency'].' '.$row2['art_price'].'</b>'; ?></span>
                                                    <a href="#test-form" class="login popup-with-form">
                                    				<button>Buy</button>
                                					</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

  
<?php require_once('footer.php')?>