

<?php
	session_start();
	
				?>

			

<!doctype html>
<html lang="en">
	
<!-- Mirrored from shreethemes.net/jobstock-landing-2.2/jobstock/single-layout-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Sep 2024 12:32:53 GMT -->
<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <title>Digex Booker</title>
		<link rel="icon" type="image/x-icon" href="assets/img/logo_DIGEX.png">
		
        <!-- Custom CSS -->
        <link href="assets/css/styles.css" rel="stylesheet">
		
		<!-- Colors CSS -->
        <link href="assets/css/colors.css" rel="stylesheet">
		
    </head>
	
    <body class="blue-theme">
	
		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            <?php include('includes/header.php')?>
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			<?php include('controller/service_controller.php')?>
			<!-- ============================ Call To Action ================================== -->
			<?php include('includes/candidature.php')?>
			<!-- ============================ Call To Action End ================================== -->
			<!-- ============================ Footer Start ================================== -->
            <?php include('includes/footer.php')?>
			<!-- ============================ Footer End ================================== -->
			<!-- Log In Modal -->
            <?php include('includes/logIn_modal.php')?>
			<!-- End Modal -->
		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/rangeslider.js"></script>
		<script src="assets/js/jquery.nice-select.min.js"></script>
		<script src="assets/js/slick.js"></script>
		<script src="assets/js/counterup.min.js"></script>
		
		 
		<script src="assets/js/custom.js"></script><script src="assets/js/cl-switch.js"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->

	</body>
</html>