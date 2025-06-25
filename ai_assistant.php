<?php
session_start();
// Redirige vers signup.php seulement si l'utilisateur n'est pas connecté
if (!isset($_SESSION['connect'])) {
    header('Location: signup.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <title>Assistant IA - Digex Booker</title>
		<link rel="icon" type="image/x-icon" href="assets/img/logo_DIGEX.png">
		
        <!-- Custom CSS -->
        <link href="assets/css/styles.css" rel="stylesheet">
		
		<!-- Colors CSS -->
        <link href="assets/css/colors.css" rel="stylesheet">
		
		<!-- FontAwesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		
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
			
			<!-- ============================ Page Title Start================================== -->
			<div class="page-title-banner py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="page-title-header text-center">
								<h1 class="text-white">
									<i class="fas fa-robot me-3"></i>Assistant IA Digex Booker
								</h1>
								<p class="text-white-50 fs-5">
									Votre assistant personnel pour toutes vos questions sur l'emploi et les carrières
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->

			<!-- ============================ IA Assistant Full Page Start ================================== -->
			<section class="py-5">
				<div class="container">
					
					<!-- Introduction -->
					<div class="row justify-content-center mb-5">
						<div class="col-lg-10">
							<div class="card border-0 shadow-sm">
								<div class="card-body p-4">
									<div class="row align-items-center">
										<div class="col-md-8">
											<h3 class="text-primary mb-3">
												<i class="fas fa-lightbulb me-2"></i>Comment puis-je vous aider ?
											</h3>
											<p class="mb-0">
												Je suis votre assistant IA spécialisé dans les questions d'emploi et de carrière. 
												Vous pouvez me poser des questions sur la rédaction de CV, la préparation d'entretiens, 
												les compétences recherchées, les négociations salariales, et bien plus encore !
											</p>
										</div>
										<div class="col-md-4 text-center">
											<div class="ai-avatar">
												<i class="fas fa-robot" style="font-size: 4rem; color: #667eea;"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Formulaire principal -->
					<div class="row justify-content-center">
						<div class="col-lg-10">
							<div class="card border-0 shadow-lg">
								<div class="card-body p-5">
									
									<!-- Formulaire pour poser une question -->
									<form id="geminiForm" class="mb-4">
										<div class="row">
											<div class="col-md-12 mb-4">
												<label for="geminiQuestion" class="form-label fw-bold fs-5">
													<i class="fas fa-question-circle text-primary me-2"></i>Posez votre question
												</label>
												<textarea 
													class="form-control form-control-lg" 
													id="geminiQuestion" 
													name="question" 
													rows="5" 
													placeholder="Tapez votre question ici... 

Exemples de questions que vous pouvez poser :
• Comment rédiger un CV qui attire l'attention des recruteurs ?
• Quelles sont les compétences les plus demandées dans mon domaine ?
• Comment négocier mon salaire lors d'un entretien ?
• Quelles questions poser à la fin d'un entretien d'embauche ?
• Comment gérer le stress avant un entretien important ?"
													maxlength="1000"
													style="min-height: 150px;"
													required></textarea>
												<div class="form-text d-flex justify-content-between">
													<span>
														<i class="fas fa-info-circle me-1"></i>
														Soyez précis dans votre question pour obtenir une réponse plus pertinente
													</span>
													<span>
														<span id="charCount">0</span>/1000 caractères
													</span>
												</div>
											</div>
											<div class="col-md-12">
												<button type="submit" class="btn btn-primary btn-lg w-100 py-3" id="askButton">
													<i class="fas fa-paper-plane me-2"></i>Envoyer ma question
													<span class="spinner-border spinner-border-sm ms-2 d-none" id="loadingSpinner"></span>
												</button>
											</div>
										</div>
									</form>
									
									<!-- Zone d'affichage des réponses -->
									<div id="geminiResponse" class="d-none">
										<hr class="my-4">
										<div class="response-container">
											<div class="d-flex align-items-center mb-3">
												<div class="ai-response-icon me-3">
													<i class="fas fa-robot text-primary" style="font-size: 1.5rem;"></i>
												</div>
												<h4 class="text-primary mb-0">Réponse de l'assistant IA</h4>
											</div>
											<div class="alert alert-light border-start border-primary border-4 p-4">
												<div id="responseContent" style="font-size: 1.1rem; line-height: 1.7;"></div>
												<hr class="my-3">
												<div class="d-flex justify-content-between align-items-center">
													<small class="text-muted" id="responseTime"></small>
													<button class="btn btn-outline-primary btn-sm" onclick="copyResponse()">
														<i class="fas fa-copy me-1"></i>Copier la réponse
													</button>
												</div>
											</div>
											<div class="text-center mt-3">
												<button class="btn btn-success btn-sm me-2" onclick="rateResponse(true)">
													<i class="fas fa-thumbs-up me-1"></i>Utile
												</button>
												<button class="btn btn-outline-secondary btn-sm" onclick="rateResponse(false)">
													<i class="fas fa-thumbs-down me-1"></i>Pas utile
												</button>
											</div>
										</div>
									</div>
									
									<!-- Zone d'affichage des erreurs -->
									<div id="geminiError" class="d-none">
										<hr class="my-4">
										<div class="alert alert-danger">
											<i class="fas fa-exclamation-triangle me-2"></i>
											<span id="errorMessage"></span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					
					<!-- Suggestions et FAQ -->
					<div class="row justify-content-center mt-5">
						<div class="col-lg-10">
							<div class="row">
								
								<!-- Questions fréquentes -->
								<div class="col-lg-6 mb-4">
									<div class="card h-100 border-0 shadow-sm">
										<div class="card-body p-4">
											<h5 class="text-primary mb-4">
												<i class="fas fa-star me-2"></i>Questions populaires
											</h5>
											<div class="d-grid gap-2">
												<button class="btn btn-outline-primary text-start suggestion-btn" data-question="Comment rédiger un CV efficace pour un débutant ?">
													<i class="fas fa-file-alt me-2"></i>CV pour débutant
												</button>
												<button class="btn btn-outline-primary text-start suggestion-btn" data-question="Quelles sont les compétences techniques les plus demandées en 2024 ?">
													<i class="fas fa-laptop-code me-2"></i>Compétences techniques 2024
												</button>
												<button class="btn btn-outline-primary text-start suggestion-btn" data-question="Comment préparer un entretien d'embauche à distance ?">
													<i class="fas fa-video me-2"></i>Entretien à distance
												</button>
												<button class="btn btn-outline-primary text-start suggestion-btn" data-question="Comment gérer une période de chômage sur mon CV ?">
													<i class="fas fa-calendar-times me-2"></i>Période de chômage
												</button>
												<button class="btn btn-outline-primary text-start suggestion-btn" data-question="Quelles questions poser au recruteur lors d'un entretien ?">
													<i class="fas fa-comments me-2"></i>Questions à poser
												</button>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Conseils -->
								<div class="col-lg-6 mb-4">
									<div class="card h-100 border-0 shadow-sm">
										<div class="card-body p-4">
											<h5 class="text-success mb-4">
												<i class="fas fa-lightbulb me-2"></i>Conseils d'utilisation
											</h5>
											<ul class="list-unstyled">
												<li class="mb-3">
													<i class="fas fa-check-circle text-success me-2"></i>
													<strong>Soyez spécifique :</strong> Plus votre question est précise, meilleure sera la réponse.
												</li>
												<li class="mb-3">
													<i class="fas fa-check-circle text-success me-2"></i>
													<strong>Contexte :</strong> Mentionnez votre secteur d'activité ou niveau d'expérience.
												</li>
												<li class="mb-3">
													<i class="fas fa-check-circle text-success me-2"></i>
													<strong>Une question à la fois :</strong> Posez une seule question par message.
												</li>
												<li class="mb-3">
													<i class="fas fa-check-circle text-success me-2"></i>
													<strong>Suivez les conseils :</strong> L'IA vous donne des conseils basés sur les meilleures pratiques.
												</li>
											</ul>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ============================ IA Assistant Full Page End ================================== -->
			
			<!-- ============================ Footer Start ================================== -->
            <?php include('includes/footer.php')?>
			<!-- ============================ Footer End ================================== -->
			
		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- All Jquery -->
		<script src="assets/js/jquery-3.7.1.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/dropzone.min.js"></script>
		<script src="assets/js/flatpickr.js"></script>
		<script src="assets/js/flickity.pkgd.min.js"></script>
		<script src="assets/js/lightbox.min.js"></script>
		<script src="assets/js/rangeslider.js"></script>
		<script src="assets/js/select2.min.js"></script>
		<script src="assets/js/counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>
		<script src="assets/js/custom.js"></script>
		
		<!-- JavaScript pour gérer les interactions avec l'IA -->
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			const form = document.getElementById('geminiForm');
			const questionTextarea = document.getElementById('geminiQuestion');
			const askButton = document.getElementById('askButton');
			const loadingSpinner = document.getElementById('loadingSpinner');
			const responseDiv = document.getElementById('geminiResponse');
			const errorDiv = document.getElementById('geminiError');
			const responseContent = document.getElementById('responseContent');
			const responseTime = document.getElementById('responseTime');
			const errorMessage = document.getElementById('errorMessage');
			const charCount = document.getElementById('charCount');
			const suggestionButtons = document.querySelectorAll('.suggestion-btn');
			
			// Compteur de caractères
			questionTextarea.addEventListener('input', function() {
				charCount.textContent = this.value.length;
				
				if (this.value.length > 950) {
					charCount.parentElement.classList.add('text-warning');
				} else if (this.value.length > 990) {
					charCount.parentElement.classList.add('text-danger');
					charCount.parentElement.classList.remove('text-warning');
				} else {
					charCount.parentElement.classList.remove('text-warning', 'text-danger');
				}
			});
			
			// Gestion des suggestions
			suggestionButtons.forEach(button => {
				button.addEventListener('click', function() {
					questionTextarea.value = this.dataset.question;
					charCount.textContent = questionTextarea.value.length;
					questionTextarea.focus();
					questionTextarea.scrollIntoView({ behavior: 'smooth' });
				});
			});
			
			// Soumission du formulaire
			form.addEventListener('submit', function(e) {
				e.preventDefault();
				
				const question = questionTextarea.value.trim();
				
				if (question.length < 3) {
					showError('Votre question doit contenir au moins 3 caractères.');
					return;
				}
				
				// Interface en mode chargement
				setLoadingState(true);
				hideMessages();
				
				// Envoi de la requête
				fetch('actions/gemini_ask.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-Requested-With': 'XMLHttpRequest'
					},
					body: JSON.stringify({
						question: question
					})
				})
				.then(response => response.json())
				.then(data => {
					setLoadingState(false);
					
					if (data.success) {
						showResponse(data.response, data.timestamp);
					} else {
						showError(data.message || 'Une erreur est survenue.');
					}
				})
				.catch(error => {
					setLoadingState(false);
					console.error('Erreur:', error);
					showError('Erreur de connexion. Veuillez réessayer.');
				});
			});
			
			function setLoadingState(loading) {
				if (loading) {
					askButton.disabled = true;
					loadingSpinner.classList.remove('d-none');
					askButton.innerHTML = '<i class="fas fa-cog fa-spin me-2"></i>Traitement en cours... <span class="spinner-border spinner-border-sm ms-2"></span>';
				} else {
					askButton.disabled = false;
					loadingSpinner.classList.add('d-none');
					askButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Envoyer ma question';
				}
			}
			
			function showResponse(response, timestamp) {
				responseContent.innerHTML = response;
				responseTime.textContent = 'Réponse générée le ' + timestamp;
				responseDiv.classList.remove('d-none');
				errorDiv.classList.add('d-none');
				
				// Scroll vers la réponse
				responseDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
			}
			
			function showError(message) {
				errorMessage.textContent = message;
				errorDiv.classList.remove('d-none');
				responseDiv.classList.add('d-none');
			}
			
			function hideMessages() {
				responseDiv.classList.add('d-none');
				errorDiv.classList.add('d-none');
			}
		});
		
		// Fonction pour copier la réponse
		function copyResponse() {
			const responseText = document.getElementById('responseContent').innerText;
			navigator.clipboard.writeText(responseText).then(function() {
				alert('Réponse copiée dans le presse-papiers !');
			});
		}
		
		// Fonction pour évaluer la réponse (peut être étendue pour sauvegarder les ratings)
		function rateResponse(isUseful) {
			const message = isUseful ? 'Merci pour votre retour positif !' : 'Merci pour votre retour. Nous améliorerons nos réponses.';
			alert(message);
		}
		</script>
		
		<style>
		.suggestion-btn {
			transition: all 0.3s ease;
		}

		.suggestion-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(0,0,0,0.15);
		}

		.response-container {
			animation: fadeInUp 0.6s ease-out;
		}

		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		#responseContent {
			line-height: 1.7;
			color: #333;
		}

		#responseContent p {
			margin-bottom: 1rem;
		}

		.ai-avatar {
			animation: float 3s ease-in-out infinite;
		}

		@keyframes float {
			0%, 100% {
				transform: translateY(0px);
			}
			50% {
				transform: translateY(-10px);
			}
		}

		.page-title-banner {
			background-attachment: fixed;
		}

		.card {
			transition: all 0.3s ease;
		}

		.card:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 25px rgba(0,0,0,0.1);
		}
		</style>
		
    </body>
</html>
