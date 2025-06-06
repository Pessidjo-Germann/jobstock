<?php
/**
 * Fichier de gestion des redirections et du routage
 * Centralise la logique de navigation de l'application
 */

/**
 * Fonction pour rediriger avec un message d'erreur
 */
function redirectWithError($page, $error_type) {
    header("Location: $page?error=$error_type");
    exit;
}

/**
 * Fonction pour rediriger avec un message de succès
 */
function redirectWithSuccess($page, $success_type) {
    header("Location: $page?success=$success_type");
    exit;
}

/**
 * Fonction pour valider un ID numérique
 */
function validateNumericId($id) {
    return isset($id) && !empty($id) && is_numeric($id);
}

/**
 * Fonction pour nettoyer les données d'entrée
 */
function sanitizeInput($data) {
    global $link; // Connexion à la base de données
    return mysqli_real_escape_string($link, trim($data));
}

/**
 * Fonction pour afficher les messages d'alerte
 */
function displayAlert($type, $message) {
    $alert_class = '';
    switch($type) {
        case 'success':
            $alert_class = 'alert-success';
            break;
        case 'error':
            $alert_class = 'alert-danger';
            break;
        case 'warning':
            $alert_class = 'alert-warning';
            break;
        case 'info':
            $alert_class = 'alert-info';
            break;
        default:
            $alert_class = 'alert-info';
    }
    
    return '<div class="alert ' . $alert_class . ' alert-dismissible fade show" role="alert">
                <strong>' . ucfirst($type) . '!</strong> ' . htmlspecialchars($message) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

/**
 * Messages d'erreur standardisés
 */
function getErrorMessage($error_type) {
    $messages = [
        'service_not_found' => 'Service non trouvé.',
        'service_not_specified' => 'Aucun service spécifié.',
        'invalid_service_id' => 'ID de service invalide.',
        'no_search_term' => 'Veuillez saisir un terme de recherche.',
        'search_too_short' => 'Le terme de recherche doit contenir au moins 2 caractères.',
        'database_error' => 'Erreur de base de données.',
        'access_denied' => 'Accès refusé.',
        'session_expired' => 'Session expirée.'
    ];
    
    return isset($messages[$error_type]) ? $messages[$error_type] : 'Une erreur est survenue.';
}

/**
 * Messages de succès standardisés
 */
function getSuccessMessage($success_type) {
    $messages = [
        'service_created' => 'Service créé avec succès.',
        'service_updated' => 'Service mis à jour avec succès.',
        'service_deleted' => 'Service supprimé avec succès.',
        'profile_updated' => 'Profil mis à jour avec succès.',
        'message_sent' => 'Message envoyé avec succès.'
    ];
    
    return isset($messages[$success_type]) ? $messages[$success_type] : 'Opération réussie.';
}
?>
