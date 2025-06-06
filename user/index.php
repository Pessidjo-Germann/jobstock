<?php 
session_start();

if(!isset($_SESSION['connect'])){
    header('location:../');
}
?>

<!doctype html>
<html lang="en">
	
<!-- Mirrored from shreethemes.net/jobstock-landing-2.2/jobstock/candidate-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Sep 2024 12:33:06 GMT -->
<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <title>Digex Booker</title>
		<link rel="icon" type="image/x-icon" href="../assets/img/logo_DIGEX.png">
		
        <!-- Custom CSS -->
        <link href="../assets/css/styles.css" rel="stylesheet">
		
		<!-- Colors CSS -->
        <link href="../assets/css/colors.css" rel="stylesheet">
		
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
            <!-- Start Navigation -->
            <?php include('include/header_dash.php')?>
			
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			
			<!-- ======================= dashboard Detail ======================== -->
			<?php include('view/indexUser_view.php')?>
			<!-- ======================= dashboard Detail End ======================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		
		
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/rangeslider.js"></script>
		<script src="../assets/js/jquery.nice-select.min.js"></script>
		<script src="../assets/js/slick.js"></script>
		<script src="../assets/js/counterup.min.js"></script>
		
		
		<script src="../assets/js/custom.js"></script><script src="../assets/js/cl-switch.js"></script>
		
		<!-- Morris.js charts -->
		<script src="../assets/js/raphael/raphael.min.js"></script>
		<script src="../assets/js/morris.js/morris.min.js"></script>
		<!-- Custom Chart JavaScript -->
		<script src="../assets/js/custom/dashboard.js"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->

	</body>

<!-- Mirrored from shreethemes.net/jobstock-landing-2.2/jobstock/candidate-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Sep 2024 12:33:11 GMT -->
</html>