<?php
// Script d'installation des tables de chat
echo "=== Installation des tables de chat ===\n";
echo "Inclusion du fichier de connexion...\n";

try {
    include('actions/conbd.php');
    echo "✓ Connexion à la base de données établie\n";
} catch (Exception $e) {
    echo "✗ Erreur de connexion: " . $e->getMessage() . "\n";
    exit;
}

// Vérifier si les tables existent
$check_conv = mysqli_query($link, "SHOW TABLES LIKE 'chat_conversations'");
$check_msg = mysqli_query($link, "SHOW TABLES LIKE 'chat_messages'");

$conv_exists = mysqli_num_rows($check_conv) > 0;
$msg_exists = mysqli_num_rows($check_msg) > 0;

echo "Table chat_conversations: " . ($conv_exists ? "EXISTE" : "N'EXISTE PAS") . "\n";
echo "Table chat_messages: " . ($msg_exists ? "EXISTE" : "N'EXISTE PAS") . "\n";

if (!$conv_exists || !$msg_exists) {
    echo "\n=== Création des tables manquantes ===\n";
    
    // Créer la table chat_conversations si elle n'existe pas
    if (!$conv_exists) {
        $create_conv = "CREATE TABLE `chat_conversations` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `service_id` int(11) NOT NULL,
          `client_id` int(11) NOT NULL,
          `prestataire_id` int(11) NOT NULL,
          `status` enum('active','archived','blocked') NOT NULL DEFAULT 'active',
          `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
          `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          PRIMARY KEY (`id`),
          UNIQUE KEY `unique_conversation` (`service_id`, `client_id`, `prestataire_id`),
          KEY `idx_client` (`client_id`),
          KEY `idx_prestataire` (`prestataire_id`),
          KEY `idx_service` (`service_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        
        if (mysqli_query($link, $create_conv)) {
            echo "✓ Table chat_conversations créée avec succès\n";
        } else {
            echo "✗ Erreur lors de la création de chat_conversations: " . mysqli_error($link) . "\n";
        }
    }
    
    // Créer la table chat_messages si elle n'existe pas
    if (!$msg_exists) {
        $create_msg = "CREATE TABLE `chat_messages` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `conversation_id` int(11) NOT NULL,
          `sender_id` int(11) NOT NULL,
          `message` text NOT NULL,
          `message_type` enum('text','image','file') NOT NULL DEFAULT 'text',
          `file_path` varchar(255) DEFAULT NULL,
          `is_read` tinyint(1) NOT NULL DEFAULT 0,
          `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
          PRIMARY KEY (`id`),
          KEY `idx_conversation` (`conversation_id`),
          KEY `idx_sender` (`sender_id`),
          KEY `idx_created` (`created_at`),
          KEY `idx_read` (`is_read`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        
        if (mysqli_query($link, $create_msg)) {
            echo "✓ Table chat_messages créée avec succès\n";
        } else {
            echo "✗ Erreur lors de la création de chat_messages: " . mysqli_error($link) . "\n";
        }
    }
    
    echo "\n=== Vérification finale ===\n";
    $check_conv_final = mysqli_query($link, "SHOW TABLES LIKE 'chat_conversations'");
    $check_msg_final = mysqli_query($link, "SHOW TABLES LIKE 'chat_messages'");
    
    echo "Table chat_conversations: " . (mysqli_num_rows($check_conv_final) > 0 ? "✓ OK" : "✗ ERREUR") . "\n";
    echo "Table chat_messages: " . (mysqli_num_rows($check_msg_final) > 0 ? "✓ OK" : "✗ ERREUR") . "\n";
    
} else {
    echo "\n✓ Toutes les tables de chat existent déjà !\n";
}

// Tester la connexion et afficher quelques statistiques
echo "\n=== Statistiques ===\n";

if ($conv_exists || mysqli_num_rows(mysqli_query($link, "SHOW TABLES LIKE 'chat_conversations'")) > 0) {
    $conv_count = mysqli_query($link, "SELECT COUNT(*) as count FROM chat_conversations");
    $conv_result = mysqli_fetch_assoc($conv_count);
    echo "Nombre de conversations: " . $conv_result['count'] . "\n";
}

if ($msg_exists || mysqli_num_rows(mysqli_query($link, "SHOW TABLES LIKE 'chat_messages'")) > 0) {
    $msg_count = mysqli_query($link, "SELECT COUNT(*) as count FROM chat_messages");
    $msg_result = mysqli_fetch_assoc($msg_count);
    echo "Nombre de messages: " . $msg_result['count'] . "\n";
}

echo "\n=== Installation terminée ===\n";
?>
