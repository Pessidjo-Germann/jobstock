<?php
/**
 * Script de nettoyage automatique des codes de vérification expirés
 * À exécuter périodiquement via cron job
 * 
 * Exemple de cron job (exécution toutes les heures):
 * 0 * * * * /usr/bin/php /path/to/your/project/actions/cleanup_verification_codes.php
 */

include('./conbd.php');

// Supprimer tous les codes expirés ou utilisés
$current_time = date('Y-m-d H:i:s');

$sql_cleanup = "DELETE FROM `email_verifications` 
                WHERE `expires_at` <= '$current_time' 
                OR `is_used` = 1";

$result = mysqli_query($link, $sql_cleanup);

if ($result) {
    $deleted_count = mysqli_affected_rows($link);
    error_log("Nettoyage des codes de vérification: $deleted_count codes supprimés");
    
    // Si exécuté manuellement, afficher le résultat
    if (php_sapi_name() !== 'cli') {
        echo "Nettoyage effectué: $deleted_count codes supprimés\n";
    }
} else {
    error_log("Erreur lors du nettoyage des codes de vérification: " . mysqli_error($link));
    
    if (php_sapi_name() !== 'cli') {
        echo "Erreur lors du nettoyage: " . mysqli_error($link) . "\n";
    }
}

// Statistiques optionnelles
$sql_stats = "SELECT 
                COUNT(*) as total_active,
                COUNT(CASE WHEN action_type = 'login' THEN 1 END) as login_codes,
                COUNT(CASE WHEN action_type = 'register' THEN 1 END) as register_codes
              FROM `email_verifications` 
              WHERE `expires_at` > '$current_time' AND `is_used` = 0";

$stats_result = mysqli_query($link, $sql_stats);
if ($stats_result) {
    $stats = mysqli_fetch_assoc($stats_result);
    error_log("Codes actifs restants: {$stats['total_active']} (Login: {$stats['login_codes']}, Register: {$stats['register_codes']})");
}

mysqli_close($link);
?>
