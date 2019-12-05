<?php
		$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
			$footer_about = $row['footer_about'];
			$footer_copyright = $row['footer_copyright'];
			$contact_address = $row['contact_address'];
			$contact_email = $row['contact_email'];
			$contact_phone = $row['contact_phone'];
		}
		?>
<!-- footer -->
    <footer class="footer footer_bg_1">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                	<div class="col-xl-2 col-md-2 col-lg-2"></div>
                    <div align="center" class="col-xl-8 col-md-8 col-lg-8">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="assets/inc/img/logo.png" alt="">
                                </a>
                            </div>
                            <p><?php echo $footer_about; ?></p>
                            <div class="socail_links">
                                <ul>
							<?php
							// Getting and showing all the social media icon URL from the database
							$statement = $pdo->prepare("SELECT * FROM tbl_social");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
							foreach ($result as $row) 
							{
								if($row['social_url']!='')
								{
                                    echo '<li>
                                        <a href="'.$row['social_url'].'">
                                            <i class="'.$row['social_icon'].'"></i>
                                        </a>
                                    </li>';
                                    }
							}
							?>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-2 col-lg-2"></div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Aj Artist | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer -->
		<!-- link that opens popup -->
	
		<!-- form itself end-->
		<form id="test-form" class="white-popup-block mfp-hide">
			<div class="popup_box ">
				<div class="popup_inner">
					<div class="logo text-center">
						<a href="#">
							<img src="assets/inc/img/form-logo.png" alt="">
						</a>
					</div>
					<h3>Contact me</h3>
					<a href="mailto:<?php echo $footer_about; ?>" class="boxed_btn_orange">Send me an Email</a>
				</div>
			</div>
		</form>
		<!-- form itself end -->

	<!-- JS here -->
	<script src="assets/inc/js/vendor/modernizr-3.5.0.min.js"></script>
	<script src="assets/inc/js/vendor/jquery-1.12.4.min.js"></script>
	<script src="assets/inc/js/popper.min.js"></script>
	<script src="assets/inc/js/bootstrap.min.js"></script>
	<script src="assets/inc/js/owl.carousel.min.js"></script>
	<script src="assets/inc/js/isotope.pkgd.min.js"></script>
	<script src="assets/inc/js/ajax-form.js"></script>
	<script src="assets/inc/js/waypoints.min.js"></script>
	<script src="assets/inc/js/jquery.counterup.min.js"></script>
	<script src="assets/inc/js/imagesloaded.pkgd.min.js"></script>
	<script src="assets/inc/js/scrollIt.js"></script>
	<script src="assets/inc/js/jquery.scrollUp.min.js"></script>
	<script src="assets/inc/js/wow.min.js"></script>
	<script src="assets/inc/js/nice-select.min.js"></script>
	<script src="assets/inc/js/jquery.slicknav.min.js"></script>
	<script src="assets/inc/js/jquery.magnific-popup.min.js"></script>
	<script src="assets/inc/js/plugins.js"></script>
	<script src="assets/inc/js/gijgo.min.js"></script>

	<!--contact js-->
	<script src="assets/inc/js/contact.js"></script>
	<script src="assets/inc/js/jquery.ajaxchimp.min.js"></script>
	<script src="assets/inc/js/jquery.form.js"></script>
	<script src="assets/inc/js/jquery.validate.min.js"></script>
	<script src="assets/inc/js/mail-script.js"></script>

	<script src="assets/inc/js/main.js"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            disableDaysOfWeek: [0, 0],
        //     icons: {
        //      rightIcon: '<span class="fa fa-caret-down"></span>'
        //  }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }

        });
        var timepicker = $('#timepicker').timepicker({
         format: 'HH.MM'
     });
    </script>
</body>
</html>