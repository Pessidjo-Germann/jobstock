<?php
// Script de test pour l'API de chat
session_start();

// Simuler une connexion utilisateur (utiliser un utilisateur existant de la base)
if (!isset($_SESSION['connect'])) {
    // Utiliser l'utilisateur avec l'ID 8 (NGAPOUCHE ludger) pour le test
    include('actions/conbd.php');
    
    $user_sql = "SELECT * FROM users WHERE id = 8";
    $user_result = mysqli_query($link, $user_sql);
    
    if (mysqli_num_rows($user_result) > 0) {
        $_SESSION['connect'] = mysqli_fetch_assoc($user_result);
        echo "✓ Session utilisateur créée pour: " . $_SESSION['connect']['prenom'] . " " . $_SESSION['connect']['nom'] . "\n";
    } else {
        echo "✗ Utilisateur de test non trouvé\n";
        exit;
    }
}

echo "\n=== TEST DU SYSTÈME DE CHAT ===\n";

// Test 1: Vérifier les tables
echo "\n1. Vérification des tables de chat:\n";
$tables_check = [
    'chat_conversations' => "SELECT COUNT(*) as count FROM chat_conversations",
    'chat_messages' => "SELECT COUNT(*) as count FROM chat_messages"
];

foreach ($tables_check as $table => $query) {
    $result = mysqli_query($link, $query);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo "   ✓ Table $table: {$data['count']} enregistrements\n";
    } else {
        echo "   ✗ Erreur table $table: " . mysqli_error($link) . "\n";
    }
}

// Test 2: Lister les services disponibles pour créer une conversation
echo "\n2. Services disponibles pour chat:\n";
$services_sql = "SELECT s.id, s.title, s.user_id, u.prenom, u.nom 
                FROM services s 
                INNER JOIN users u ON s.user_id = u.id 
                WHERE s.user_id != {$_SESSION['connect']['id']} 
                LIMIT 3";

$services_result = mysqli_query($link, $services_sql);
if (mysqli_num_rows($services_result) > 0) {
    while ($service = mysqli_fetch_assoc($services_result)) {
        echo "   - Service #{$service['id']}: {$service['title']} par {$service['prenom']} {$service['nom']}\n";
    }
} else {
    echo "   ✗ Aucun service trouvé pour tester\n";
}

// Test 3: Créer une conversation de test
echo "\n3. Test création de conversation:\n";
$test_service_result = mysqli_query($link, "SELECT id, user_id FROM services WHERE user_id != {$_SESSION['connect']['id']} LIMIT 1");
if (mysqli_num_rows($test_service_result) > 0) {
    $test_service = mysqli_fetch_assoc($test_service_result);
    $service_id = $test_service['id'];
    $prestataire_id = $test_service['user_id'];
    $client_id = $_SESSION['connect']['id'];
    
    // Vérifier si une conversation existe déjà
    $existing_conv = mysqli_query($link, 
        "SELECT id FROM chat_conversations 
         WHERE service_id = $service_id AND client_id = $client_id AND prestataire_id = $prestataire_id");
    
    if (mysqli_num_rows($existing_conv) > 0) {
        $conv_data = mysqli_fetch_assoc($existing_conv);
        echo "   ✓ Conversation existante trouvée: ID {$conv_data['id']}\n";
        $conversation_id = $conv_data['id'];
    } else {
        // Créer nouvelle conversation
        $create_conv = mysqli_query($link,
            "INSERT INTO chat_conversations (service_id, client_id, prestataire_id) 
             VALUES ($service_id, $client_id, $prestataire_id)");
        
        if ($create_conv) {
            $conversation_id = mysqli_insert_id($link);
            echo "   ✓ Nouvelle conversation créée: ID $conversation_id\n";
        } else {
            echo "   ✗ Erreur création conversation: " . mysqli_error($link) . "\n";
            $conversation_id = null;
        }
    }
    
    // Test 4: Envoyer un message de test
    if ($conversation_id) {
        echo "\n4. Test envoi de message:\n";
        $test_message = "Message de test automatique - " . date('Y-m-d H:i:s');
        $send_msg = mysqli_query($link,
            "INSERT INTO chat_messages (conversation_id, sender_id, message) 
             VALUES ($conversation_id, {$_SESSION['connect']['id']}, '$test_message')");
        
        if ($send_msg) {
            echo "   ✓ Message envoyé: \"$test_message\"\n";
        } else {
            echo "   ✗ Erreur envoi message: " . mysqli_error($link) . "\n";
        }
        
        // Test 5: Récupérer les messages
        echo "\n5. Test récupération des messages:\n";
        $get_messages = mysqli_query($link,
            "SELECT cm.message, cm.created_at, u.prenom 
             FROM chat_messages cm 
             INNER JOIN users u ON cm.sender_id = u.id 
             WHERE cm.conversation_id = $conversation_id 
             ORDER BY cm.created_at DESC LIMIT 3");
        
        if (mysqli_num_rows($get_messages) > 0) {
            while ($msg = mysqli_fetch_assoc($get_messages)) {
                echo "   - {$msg['prenom']}: {$msg['message']} ({$msg['created_at']})\n";
            }
        } else {
            echo "   ✗ Aucun message trouvé\n";
        }
    }
}

// Test 6: Tester l'API chat_handler via simulation POST
echo "\n6. Test de l'API chat_handler:\n";

// Simuler une requête POST pour récupérer les conversations
$_POST['action'] = 'get_conversations';

ob_start();
include('actions/chat_handler.php');
$api_response = ob_get_clean();

$response_data = json_decode($api_response, true);
if ($response_data && isset($response_data['success']) && $response_data['success']) {
    echo "   ✓ API get_conversations fonctionne - " . count($response_data['conversations']) . " conversations trouvées\n";
} else {
    echo "   ✗ API get_conversations échoue: " . $api_response . "\n";
}

echo "\n=== FIN DES TESTS ===\n";
echo "Le système de chat est " . (isset($conversation_id) && $conversation_id ? "OPÉRATIONNEL" : "EN COURS DE CONFIGURATION") . "\n\n";

// Afficher les liens utiles
echo "Liens pour tester:\n";
echo "- Chat interface: http://localhost:8000/user/chat.php\n";
echo "- Page d'accueil: http://localhost:8000/\n";
echo "- Services: http://localhost:8000/services.php\n\n";
?>
