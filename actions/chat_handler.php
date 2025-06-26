<?php
session_start();
include('conbd.php');

header('Content-Type: application/json');

if (!isset($_SESSION['connect'])) {
    echo json_encode(['success' => false, 'message' => 'Non autorisé']);
    exit;
}

$user_id = $_SESSION['connect']['id'];
$action = $_POST['action'] ?? '';

try {
    switch ($action) {
        case 'get_conversations':
            // Récupérer toutes les conversations de l'utilisateur
            $sql = "SELECT DISTINCT 
                        cc.id as conversation_id,
                        cc.service_id,
                        cc.client_id,
                        cc.prestataire_id,
                        cc.status,
                        cc.updated_at,
                        s.title as service_title,
                        CASE 
                            WHEN cc.client_id = ? THEN u_prestataire.prenom
                            ELSE u_client.prenom 
                        END as other_user_name,
                        CASE 
                            WHEN cc.client_id = ? THEN u_prestataire.img
                            ELSE u_client.img 
                        END as other_user_img,
                        CASE 
                            WHEN cc.client_id = ? THEN u_prestataire.id
                            ELSE u_client.id 
                        END as other_user_id,
                        (SELECT COUNT(*) FROM chat_messages cm 
                         WHERE cm.conversation_id = cc.id 
                         AND cm.sender_id != ? 
                         AND cm.is_read = 0) as unread_count,
                        (SELECT cm.message FROM chat_messages cm 
                         WHERE cm.conversation_id = cc.id 
                         ORDER BY cm.created_at DESC LIMIT 1) as last_message,
                        (SELECT cm.created_at FROM chat_messages cm 
                         WHERE cm.conversation_id = cc.id 
                         ORDER BY cm.created_at DESC LIMIT 1) as last_message_time
                    FROM chat_conversations cc
                    INNER JOIN services s ON cc.service_id = s.id
                    INNER JOIN users u_client ON cc.client_id = u_client.id
                    INNER JOIN users u_prestataire ON cc.prestataire_id = u_prestataire.id
                    WHERE cc.client_id = ? OR cc.prestataire_id = ?
                    ORDER BY cc.updated_at DESC";
                    
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "iiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            $conversations = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Formater l'image
                if ($row['other_user_img'] && trim($row['other_user_img']) !== '') {
                    $row['other_user_img'] = '../images_users/' . $row['other_user_img'];
                } else {
                    $row['other_user_img'] = '../assets/img/user.png';
                }
                
                // Formater la date du dernier message
                if ($row['last_message_time']) {
                    $row['last_message_time_formatted'] = date('H:i', strtotime($row['last_message_time']));
                }
                
                $conversations[] = $row;
            }
            
            echo json_encode(['success' => true, 'conversations' => $conversations]);
            break;
            
        case 'get_messages':
            $conversation_id = (int)$_POST['conversation_id'];
            
            // Vérifier que l'utilisateur fait partie de cette conversation
            $check_sql = "SELECT * FROM chat_conversations WHERE id = ? AND (client_id = ? OR prestataire_id = ?)";
            $check_stmt = mysqli_prepare($link, $check_sql);
            mysqli_stmt_bind_param($check_stmt, "iii", $conversation_id, $user_id, $user_id);
            mysqli_stmt_execute($check_stmt);
            $check_result = mysqli_stmt_get_result($check_stmt);
            
            if (mysqli_num_rows($check_result) === 0) {
                echo json_encode(['success' => false, 'message' => 'Conversation non trouvée']);
                break;
            }
            
            // Récupérer les messages
            $sql = "SELECT 
                        cm.id,
                        cm.sender_id,
                        cm.message,
                        cm.message_type,
                        cm.file_path,
                        cm.created_at,
                        u.prenom as sender_name,
                        u.img as sender_img
                    FROM chat_messages cm
                    INNER JOIN users u ON cm.sender_id = u.id
                    WHERE cm.conversation_id = ?
                    ORDER BY cm.created_at ASC";
                    
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $conversation_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            $messages = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Formater l'image de l'expéditeur
                if ($row['sender_img'] && trim($row['sender_img']) !== '') {
                    $row['sender_img'] = '../images_users/' . $row['sender_img'];
                } else {
                    $row['sender_img'] = '../assets/img/user.png';
                }
                
                // Marquer si c'est le message de l'utilisateur actuel
                $row['is_mine'] = ($row['sender_id'] == $user_id);
                
                // Formater la date
                $row['time_formatted'] = date('H:i', strtotime($row['created_at']));
                
                $messages[] = $row;
            }
            
            // Marquer les messages comme lus
            $mark_read_sql = "UPDATE chat_messages SET is_read = 1 WHERE conversation_id = ? AND sender_id != ?";
            $mark_read_stmt = mysqli_prepare($link, $mark_read_sql);
            mysqli_stmt_bind_param($mark_read_stmt, "ii", $conversation_id, $user_id);
            mysqli_stmt_execute($mark_read_stmt);
            
            echo json_encode(['success' => true, 'messages' => $messages]);
            break;
            
        case 'send_message':
            $conversation_id = (int)$_POST['conversation_id'];
            $message = trim($_POST['message']);
            
            if (empty($message)) {
                echo json_encode(['success' => false, 'message' => 'Message vide']);
                break;
            }
            
            // Vérifier que l'utilisateur fait partie de cette conversation
            $check_sql = "SELECT * FROM chat_conversations WHERE id = ? AND (client_id = ? OR prestataire_id = ?)";
            $check_stmt = mysqli_prepare($link, $check_sql);
            mysqli_stmt_bind_param($check_stmt, "iii", $conversation_id, $user_id, $user_id);
            mysqli_stmt_execute($check_stmt);
            $check_result = mysqli_stmt_get_result($check_stmt);
            
            if (mysqli_num_rows($check_result) === 0) {
                echo json_encode(['success' => false, 'message' => 'Conversation non trouvée']);
                break;
            }
            
            // Insérer le message
            $insert_sql = "INSERT INTO chat_messages (conversation_id, sender_id, message, message_type) VALUES (?, ?, ?, 'text')";
            $insert_stmt = mysqli_prepare($link, $insert_sql);
            mysqli_stmt_bind_param($insert_stmt, "iis", $conversation_id, $user_id, $message);
            
            if (mysqli_stmt_execute($insert_stmt)) {
                // Mettre à jour la conversation
                $update_conv_sql = "UPDATE chat_conversations SET updated_at = CURRENT_TIMESTAMP WHERE id = ?";
                $update_conv_stmt = mysqli_prepare($link, $update_conv_sql);
                mysqli_stmt_bind_param($update_conv_stmt, "i", $conversation_id);
                mysqli_stmt_execute($update_conv_stmt);
                
                echo json_encode(['success' => true, 'message' => 'Message envoyé']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi']);
            }
            break;
            
        case 'start_conversation':
            $service_id = (int)$_POST['service_id'];
            
            // Récupérer les infos du service
            $service_sql = "SELECT user_id FROM services WHERE id = ?";
            $service_stmt = mysqli_prepare($link, $service_sql);
            mysqli_stmt_bind_param($service_stmt, "i", $service_id);
            mysqli_stmt_execute($service_stmt);
            $service_result = mysqli_stmt_get_result($service_stmt);
            
            if (mysqli_num_rows($service_result) === 0) {
                echo json_encode(['success' => false, 'message' => 'Service non trouvé']);
                break;
            }
            
            $service_data = mysqli_fetch_assoc($service_result);
            $prestataire_id = $service_data['user_id'];
            
            // Ne pas permettre à un utilisateur de démarrer une conversation avec lui-même
            if ($prestataire_id == $user_id) {
                echo json_encode(['success' => false, 'message' => 'Vous ne pouvez pas démarrer une conversation avec vous-même']);
                break;
            }
            
            // Vérifier si une conversation existe déjà
            $existing_sql = "SELECT id FROM chat_conversations WHERE service_id = ? AND client_id = ? AND prestataire_id = ?";
            $existing_stmt = mysqli_prepare($link, $existing_sql);
            mysqli_stmt_bind_param($existing_stmt, "iii", $service_id, $user_id, $prestataire_id);
            mysqli_stmt_execute($existing_stmt);
            $existing_result = mysqli_stmt_get_result($existing_stmt);
            
            if (mysqli_num_rows($existing_result) > 0) {
                $existing_data = mysqli_fetch_assoc($existing_result);
                echo json_encode(['success' => true, 'conversation_id' => $existing_data['id'], 'message' => 'Conversation existante']);
            } else {
                // Créer une nouvelle conversation
                $create_sql = "INSERT INTO chat_conversations (service_id, client_id, prestataire_id) VALUES (?, ?, ?)";
                $create_stmt = mysqli_prepare($link, $create_sql);
                mysqli_stmt_bind_param($create_stmt, "iii", $service_id, $user_id, $prestataire_id);
                
                if (mysqli_stmt_execute($create_stmt)) {
                    $conversation_id = mysqli_insert_id($link);
                    
                    // Envoyer un message de bienvenue automatique
                    $welcome_message = "Bonjour ! Je suis intéressé(e) par votre service. Pouvons-nous discuter des détails ?";
                    $welcome_sql = "INSERT INTO chat_messages (conversation_id, sender_id, message, message_type) VALUES (?, ?, ?, 'system')";
                    $welcome_stmt = mysqli_prepare($link, $welcome_sql);
                    mysqli_stmt_bind_param($welcome_stmt, "iis", $conversation_id, $user_id, $welcome_message);
                    mysqli_stmt_execute($welcome_stmt);
                    
                    echo json_encode(['success' => true, 'conversation_id' => $conversation_id, 'message' => 'Conversation créée']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erreur lors de la création']);
                }
            }
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
            break;
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur: ' . $e->getMessage()]);
}
?>
