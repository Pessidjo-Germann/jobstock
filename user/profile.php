

<?php
session_start();
if(!isset($_SESSION['connect'])){
    header('location:../');
}
?>


<!doctype html>
<html lang="en">
	
<!-- Mirrored from shreethemes.net/jobstock-landing-2.2/jobstock/employer-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Sep 2024 12:34:19 GMT -->
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
			<?php include('view/profile_view.php')?>
			<!-- ======================= dashboard Detail End ======================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		
			
			<div class="modal fade" id="education" tabindex="-1" role="dialog" aria-labelledby="messagemodal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered education-pop-form" role="document">
					<div class="modal-content" id="educationmodal">
						<span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="fas fa-close"></i></span>
						<div class="modal-body">
							<div class="text-center">
								<h4 class="mb-3">Ajouter une langue</h4>
							</div>
							<div class="added-form">
								<form action="../actions/updateImage.php?u=langue" method="post">
									<div class="row mb-3">
										<label class="col-md-12 col-form-label">langue</label>
										<div class="col-md-12">
											<input type="text" name="langue" id="langue" class="form-control">
										</div>
									</div> 
									<div class="row mb-3">
										<div class="col-md-12">
											<button type="submit" class="btn full-width btn-primary">Ajouter</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->


			
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
			function updateImage(){	
			var form = document.forms.namedItem("image_form");			
			var oData = new FormData(form);	
			var avatar = document.getElementById('user_avatar');
			oData.append("type", "contactForm"); 
			$.ajax({
				url: "../actions/updateImage.php?u=image",
				type: "POST",
				data: oData,
				processData: false,  
				contentType: false,
				success: function(data){
					console.log(data);
					avatar.src = data;
					alert('Image Modifiee');
				},
				error: function(xhr, status, error) {
					alert('Une error s\'est produite');
					notification_error_ajax_js(xhr, status, error);
				}
			});
			
		}

		function reinitialiser_formulaire_js(){	
			document.getElementById("contact-form").reset();
		}

		</script>

	</body>

</html>