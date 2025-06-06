<?php session_start(); ?>

<!doctype html>
<html lang="en">
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
			<?php include('view/password_view.php')?>
			<!-- ======================= dashboard Detail End ======================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================= -->
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
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->



        <script>
		
			function blockSubmit(){
				var btn = document.getElementById('btn_submit');
				btn.disabled = true;
			}

			blockSubmit();

			function confirmpassword(){
				const password = document.getElementById('new_password').value;
				const confirmPassword = document.getElementById('con_new_password').value;
				const errorMessage = document.getElementById('errorMessage');
				errorMessage.textContent = '';
				if (password !== confirmPassword) {
					errorMessage.textContent = 'Mot de passe differant.';
					errorMessage.style.color = 'red';
				}else{
					ableSubmit();
				}
				return;
			}
			function ableSubmit(){
				var btn = document.getElementById('btn_submit');
				btn.disabled = false;
			}
		</script>

	</body>
</html>