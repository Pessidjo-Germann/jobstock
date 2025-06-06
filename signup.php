
<?php session_start()?>

<!doctype html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Digex Booker</title>
		<link rel="icon" type="image/x-icon" href="assets/img/logo_DIGEX.png">
        <!-- Custom CSS -->
        <link href="assets/css/styles.css" rel="stylesheet">
		<!-- Colors CSS -->
        <link href="assets/css/colors.css" rel="stylesheet">
		<?php 
			if(isset($_GET['message'])){
				echo'<script>
						alert('.$_GET['message'].');
					</script>';
			}
		?>
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
            <?php include('includes/header.php')?>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			<?php include('view/signup_view.php')?>
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


		<script>
			function blockSubmit(){
				var btn = document.getElementById('btn_inscription');
				btn.disabled = true;
			}
			blockSubmit();
			function confirmpassword(){
				const password = document.getElementById('password').value;
				const confirmPassword = document.getElementById('confirmPassword').value;
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
				var btn = document.getElementById('btn_inscription');
				btn.disabled = false;
			}
		</script>
		<!-- ============================================================== -->
		<!-- This ludger js -->
		<!-- ============================================================== -->
	</body>
</html>