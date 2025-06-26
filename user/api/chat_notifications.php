<?php
// Widget pour afficher les notifications de chat dans le dashboard
session_start();
include('../actions/conbd.php');

if (!isset($_SESSION['connect'])) {
    echo json_encode(['unread_count' => 0, 'recent_messages' => []]);
    exit;
}

$user_id = $_SESSION['connect']['id'];

// Compter les messages non lus
$unread_sql = "SELECT COUNT(*) as unread_count 
               FROM chat_messages cm
               INNER JOIN chat_conversations cc ON cm.conversation_id = cc.id
               WHERE (cc.client_id = ? OR cc.prestataire_id = ?)
               AND cm.sender_id != ?
               AND cm.is_read = 0";

$unread_stmt = mysqli_prepare($link, $unread_sql);
mysqli_stmt_bind_param($unread_stmt, "iii", $user_id, $user_id, $user_id);
mysqli_stmt_execute($unread_stmt);
$unread_result = mysqli_stmt_get_result($unread_stmt);
$unread_data = mysqli_fetch_assoc($unread_result);
$unread_count = $unread_data['unread_count'];

// Récupérer les 3 derniers messages
$recent_sql = "SELECT DISTINCT
                   cm.message,
                   cm.created_at,
                   CASE 
                       WHEN cc.client_id = ? THEN u_prestataire.prenom
                       ELSE u_client.prenom 
                   END as sender_name,
                   CASE 
                       WHEN cc.client_id = ? THEN u_prestataire.img
                       ELSE u_client.img 
                   END as sender_img,
                   s.title as service_title,
                   cc.id as conversation_id
               FROM chat_messages cm
               INNER JOIN chat_conversations cc ON cm.conversation_id = cc.id
               INNER JOIN services s ON cc.service_id = s.id
               INNER JOIN users u_client ON cc.client_id = u_client.id
               INNER JOIN users u_prestataire ON cc.prestataire_id = u_prestataire.id
               WHERE (cc.client_id = ? OR cc.prestataire_id = ?)
               AND cm.sender_id != ?
               AND cm.is_read = 0
               ORDER BY cm.created_at DESC
               LIMIT 3";

$recent_stmt = mysqli_prepare($link, $recent_sql);
mysqli_stmt_bind_param($recent_stmt, "iiiii", $user_id, $user_id, $user_id, $user_id, $user_id);
mysqli_stmt_execute($recent_stmt);
$recent_result = mysqli_stmt_get_result($recent_stmt);

$recent_messages = [];
while ($row = mysqli_fetch_assoc($recent_result)) {
    // Formater l'image
    if ($row['sender_img'] && trim($row['sender_img']) !== '') {
        $row['sender_img'] = '../images_users/' . $row['sender_img'];
    } else {
        $row['sender_img'] = '../assets/img/user.png';
    }
    
    // Formater le message (limiter la longueur)
    if (strlen($row['message']) > 50) {
        $row['message'] = substr($row['message'], 0, 50) . '...';
    }
    
    // Formater la date
    $row['time_ago'] = time_elapsed_string($row['created_at']);
    
    $recent_messages[] = $row;
}

echo json_encode([
    'unread_count' => $unread_count,
    'recent_messages' => $recent_messages
]);

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $string = array();
    
    if ($diff->y > 0) $string[] = $diff->y . ' année' . ($diff->y > 1 ? 's' : '');
    if ($diff->m > 0) $string[] = $diff->m . ' mois';
    if ($diff->d >= 7) {
        $weeks = floor($diff->d / 7);
        $string[] = $weeks . ' semaine' . ($weeks > 1 ? 's' : '');
    } elseif ($diff->d > 0) {
        $string[] = $diff->d . ' jour' . ($diff->d > 1 ? 's' : '');
    }
    if ($diff->h > 0) $string[] = $diff->h . ' heure' . ($diff->h > 1 ? 's' : '');
    if ($diff->i > 0) $string[] = $diff->i . ' minute' . ($diff->i > 1 ? 's' : '');
    if (empty($string) && $diff->s >= 0) $string[] = $diff->s . ' seconde' . ($diff->s > 1 ? 's' : '');

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? 'Il y a ' . implode(', ', $string) : 'À l\'instant';
}
?>
