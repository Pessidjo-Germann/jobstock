<!-- ============================ IA Assistant Section Start ================================== -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="sec-heading center light">
                    <h2 class="text-white">Assistant IA - Posez vos questions</h2>
                    <p class="text-white-50">Notre assistant IA est là pour vous aider avec vos questions sur l'emploi, les candidatures et bien plus encore.</p>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        
                        <!-- Formulaire pour poser une question -->
                        <form id="geminiForm" class="mb-4">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="geminiQuestion" class="form-label fw-bold">
                                        <i class="fas fa-question-circle text-primary me-2"></i>Votre question
                                    </label>
                                    <textarea 
                                        class="form-control" 
                                        id="geminiQuestion" 
                                        name="question" 
                                        rows="3" 
                                        placeholder="Posez votre question ici... (ex: Comment rédiger un bon CV ? Quelles sont les compétences les plus demandées ? Comment préparer un entretien ?)"
                                        maxlength="1000"
                                        required></textarea>
                                    <div class="form-text">
                                        <span id="charCount">0</span>/1000 caractères
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100" id="askButton">
                                        <i class="fas fa-robot me-2"></i>Demander à l'IA
                                        <span class="spinner-border spinner-border-sm ms-2 d-none" id="loadingSpinner"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <!-- Zone d'affichage des réponses -->
                        <div id="geminiResponse" class="d-none">
                            <hr class="my-4">
                            <div class="response-container">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-lightbulb me-2"></i>Réponse de l'assistant IA
                                </h5>
                                <div class="alert alert-light border-start border-primary border-4 p-3">
                                    <div id="responseContent"></div>
                                    <small class="text-muted d-block mt-2" id="responseTime"></small>
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
                        
                        <!-- Suggestions de questions -->
                        <div class="mt-4">
                            <h6 class="text-muted mb-3">Questions suggérées :</h6>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <button class="btn btn-outline-secondary btn-sm w-100 suggestion-btn" data-question="Comment rédiger un CV efficace ?">
                                        <i class="fas fa-file-alt me-1"></i>Comment rédiger un CV efficace ?
                                    </button>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <button class="btn btn-outline-secondary btn-sm w-100 suggestion-btn" data-question="Quelles compétences sont les plus demandées en 2024 ?">
                                        <i class="fas fa-chart-line me-1"></i>Compétences demandées en 2024
                                    </button>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <button class="btn btn-outline-secondary btn-sm w-100 suggestion-btn" data-question="Comment préparer un entretien d'embauche ?">
                                        <i class="fas fa-handshake me-1"></i>Préparer un entretien
                                    </button>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <button class="btn btn-outline-secondary btn-sm w-100 suggestion-btn" data-question="Comment négocier son salaire ?">
                                        <i class="fas fa-dollar-sign me-1"></i>Négocier son salaire
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
            askButton.innerHTML = '<i class="fas fa-robot me-2"></i>Traitement en cours... <span class="spinner-border spinner-border-sm ms-2"></span>';
        } else {
            askButton.disabled = false;
            loadingSpinner.classList.add('d-none');
            askButton.innerHTML = '<i class="fas fa-robot me-2"></i>Demander à l\'IA';
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
</script>

<!-- Styles CSS additionnels -->
<style>
.suggestion-btn {
    transition: all 0.3s ease;
    text-align: left;
    font-size: 0.85rem;
}

.suggestion-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.response-container {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#responseContent {
    line-height: 1.6;
    color: #333;
}

#responseContent p {
    margin-bottom: 1rem;
}

.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.border-start {
    border-left-width: 4px !important;
}
</style>
<!-- ============================ IA Assistant Section End ================================== -->
