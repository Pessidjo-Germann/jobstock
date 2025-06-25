<!-- ============================ Page Title Start================================== -->
<section class="bg-cover primary-bg-dark" style="background:url(assets/img/bg2.png)no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="ipt-title text-light">Vérification Email</h2>
                <span class="text-light opacity-75">Saisissez le code reçu par email</span>
            </div>
        </div>
    </div>
</section>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Verification Form Start ================================== -->
<section class="gray-simple">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-12">
                <div class="vesh-detail-bloc">
                    <div class="vesh-detail-bloc-body pt-3">
                        <div class="text-center mb-4">
                            <div class="mdl-thumb mb-3">
                                <img src="assets/img/ico.png" class="img-fluid" width="70" alt="">
                            </div>
                            <h4 class="modal-header-title">Vérification de l'email</h4>
                            <p class="text-muted">
                                Nous avons envoyé un code de vérification à<br>
                                <strong><?php echo isset($_SESSION['verification_email']) ? htmlspecialchars($_SESSION['verification_email']) : ''; ?></strong>
                            </p>
                        </div>

                        <div class="modal-login-form">
                            <form action="./actions/verify_email.php" method="post">
                                <input type="hidden" name="email" value="<?php echo isset($_SESSION['verification_email']) ? htmlspecialchars($_SESSION['verification_email']) : ''; ?>">
                                <input type="hidden" name="action_type" value="<?php echo isset($_SESSION['verification_action']) ? htmlspecialchars($_SESSION['verification_action']) : ''; ?>">
                                
                                <div class="form-floating mb-4">
                                    <input type="text" name="verification_code" class="form-control text-center" 
                                           placeholder="000000" maxlength="6" pattern="[0-9]{6}" 
                                           style="font-size: 24px; letter-spacing: 5px;" required
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <label>Code de vérification (6 chiffres)</label>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary full-width font--bold btn-lg">
                                        Vérifier
                                    </button>
                                </div>
                            </form>

                            <div class="text-center">
                                <p class="text-muted mb-2">Vous n'avez pas reçu le code ?</p>
                                <form action="./actions/resend_code.php" method="post" style="display: inline;">
                                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['verification_email']) ? htmlspecialchars($_SESSION['verification_email']) : ''; ?>">
                                    <input type="hidden" name="action_type" value="<?php echo isset($_SESSION['verification_action']) ? htmlspecialchars($_SESSION['verification_action']) : ''; ?>">
                                    <button type="submit" class="btn btn-link p-0 text-primary" id="resend-btn">
                                        Renvoyer le code
                                    </button>
                                </form>
                                <div class="text-muted small mt-2">
                                    Vous pourrez renvoyer le code dans <span id="countdown">60</span> secondes
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="signup.php" class="text-muted">
                                    <i class="fas fa-arrow-left me-2"></i>Retour
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================ Verification Form End ================================== -->

<script>
// Countdown pour le bouton de renvoi
let countdown = 60;
const resendBtn = document.getElementById('resend-btn');
const countdownSpan = document.getElementById('countdown');

function updateCountdown() {
    if (countdown > 0) {
        countdownSpan.textContent = countdown;
        resendBtn.disabled = true;
        resendBtn.style.opacity = '0.5';
        countdown--;
        setTimeout(updateCountdown, 1000);
    } else {
        resendBtn.disabled = false;
        resendBtn.style.opacity = '1';
        document.querySelector('.text-muted.small').style.display = 'none';
    }
}

// Démarrer le countdown si on vient juste d'envoyer un code
<?php if (isset($_SESSION['code_sent_time']) && (time() - $_SESSION['code_sent_time']) < 60): ?>
    countdown = <?php echo 60 - (time() - $_SESSION['code_sent_time']); ?>;
    updateCountdown();
<?php else: ?>
    resendBtn.disabled = false;
    resendBtn.style.opacity = '1';
    document.querySelector('.text-muted.small').style.display = 'none';
<?php endif; ?>

// Auto-focus sur le champ de saisie
document.addEventListener('DOMContentLoaded', function() {
    const codeInput = document.querySelector('input[name="verification_code"]');
    codeInput.focus();
    
    // Auto-submit quand 6 chiffres sont saisis
    codeInput.addEventListener('input', function() {
        if (this.value.length === 6) {
            // Petit délai pour que l'utilisateur voie le code complet
            setTimeout(() => {
                this.closest('form').submit();
            }, 500);
        }
    });
});
</script>
