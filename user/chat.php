<?php
session_start();
if(!isset($_SESSION['connect'])){
    header('location:../');
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chat - Digex Booker</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/logo_DIGEX.png">
        
        <!-- Custom CSS -->
        <link href="../assets/css/styles.css" rel="stylesheet">
        
        <!-- Colors CSS -->
        <link href="../assets/css/colors.css" rel="stylesheet">
        
        <!-- Chat CSS -->
        <style>
            .chat-container {
                height: 600px;
                display: flex;
                border: 1px solid #e0e0e0;
                border-radius: 10px;
                overflow: hidden;
                background: white;
            }
            
            .chat-sidebar {
                width: 300px;
                border-right: 1px solid #e0e0e0;
                background: #f8f9fa;
                display: flex;
                flex-direction: column;
            }
            
            .chat-sidebar-header {
                padding: 15px;
                background: #007bff;
                color: white;
                font-weight: bold;
            }
            
            .chat-conversations {
                flex: 1;
                overflow-y: auto;
            }
            
            .conversation-item {
                padding: 12px 15px;
                border-bottom: 1px solid #e0e0e0;
                cursor: pointer;
                transition: background-color 0.2s;
                position: relative;
            }
            
            .conversation-item:hover {
                background: #e9ecef;
            }
            
            .conversation-item.active {
                background: #007bff;
                color: white;
            }
            
            .conversation-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 10px;
                object-fit: cover;
            }
            
            .conversation-info {
                flex: 1;
            }
            
            .conversation-name {
                font-weight: bold;
                margin-bottom: 2px;
            }
            
            .conversation-last-message {
                font-size: 0.85em;
                color: #666;
                max-width: 200px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            .conversation-item.active .conversation-last-message {
                color: rgba(255,255,255,0.8);
            }
            
            .conversation-time {
                font-size: 0.75em;
                color: #999;
                position: absolute;
                top: 12px;
                right: 12px;
            }
            
            .conversation-item.active .conversation-time {
                color: rgba(255,255,255,0.8);
            }
            
            .unread-badge {
                background: #dc3545;
                color: white;
                border-radius: 10px;
                padding: 2px 6px;
                font-size: 0.7em;
                position: absolute;
                bottom: 12px;
                right: 12px;
            }
            
            .chat-main {
                flex: 1;
                display: flex;
                flex-direction: column;
            }
            
            .chat-header {
                padding: 15px;
                background: #f8f9fa;
                border-bottom: 1px solid #e0e0e0;
                display: flex;
                align-items: center;
            }
            
            .chat-header-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 10px;
                object-fit: cover;
            }
            
            .chat-messages {
                flex: 1;
                overflow-y: auto;
                padding: 15px;
                background: #fff;
            }
            
            .message {
                margin-bottom: 15px;
                display: flex;
                align-items: flex-start;
            }
            
            .message.mine {
                flex-direction: row-reverse;
            }
            
            .message-avatar {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                margin: 0 8px;
                object-fit: cover;
            }
            
            .message-content {
                max-width: 70%;
                background: #f1f3f4;
                padding: 10px 15px;
                border-radius: 15px;
                position: relative;
            }
            
            .message.mine .message-content {
                background: #007bff;
                color: white;
            }
            
            .message-time {
                font-size: 0.7em;
                color: #999;
                margin-top: 5px;
            }
            
            .message.mine .message-time {
                color: rgba(255,255,255,0.7);
                text-align: right;
            }
            
            .chat-input {
                padding: 15px;
                border-top: 1px solid #e0e0e0;
                background: #f8f9fa;
            }
            
            .chat-input-form {
                display: flex;
                gap: 10px;
            }
            
            .chat-input-field {
                flex: 1;
                border: 1px solid #ddd;
                border-radius: 25px;
                padding: 10px 15px;
                outline: none;
                resize: none;
                max-height: 100px;
            }
            
            .chat-send-btn {
                background: #007bff;
                color: white;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .chat-send-btn:hover {
                background: #0056b3;
            }
            
            .chat-welcome {
                text-align: center;
                padding: 50px;
                color: #666;
            }
            
            .loading {
                text-align: center;
                padding: 20px;
                color: #666;
            }
            
            .no-conversations {
                text-align: center;
                padding: 50px;
                color: #666;
            }
            
            @media (max-width: 768px) {
                .chat-container {
                    height: 500px;
                }
                
                .chat-sidebar {
                    width: 100%;
                    display: none;
                }
                
                .chat-sidebar.mobile-show {
                    display: flex;
                }
                
                .chat-main {
                    width: 100%;
                    display: none;
                }
                
                .chat-main.mobile-show {
                    display: flex;
                }
            }
        </style>
    </head>
    
    <body class="blue-theme">
        <!-- Preloader -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
        
        <div id="main-wrapper">
            <!-- Navigation -->
            <?php include('include/header_dash.php')?>
            
            <div class="clearfix"></div>
            
            <!-- Dashboard Content -->
            <div class="dashboard-wrap bg-light">
                <a class="mobNavigation" data-bs-toggle="collapse" href="#MobNav" role="button" aria-expanded="false" aria-controls="MobNav">
                    <i class="fas fa-bars mr-2"></i>Dashboard Navigation
                </a>
                <?php include('include/mobnav_dash.php')?>
                
                <div class="dashboard-content">
                    <div class="dashboard-tlbar d-block mb-4">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <h1 class="mb-1 fs-3 fw-medium">
                                    <i class="fas fa-comments me-2"></i>Messages & Chat
                                </h1>
                                <p class="text-muted">Communiquez directement avec vos clients et prestataires</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-widg-bar d-block">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="chat-container">
                                    <!-- Sidebar des conversations -->
                                    <div class="chat-sidebar" id="chat-sidebar">
                                        <div class="chat-sidebar-header">
                                            <i class="fas fa-comments me-2"></i>Conversations
                                        </div>
                                        <div class="chat-conversations" id="chat-conversations">
                                            <div class="loading">
                                                <i class="fas fa-spinner fa-spin"></i> Chargement...
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Zone de chat principale -->
                                    <div class="chat-main" id="chat-main">
                                        <div class="chat-welcome">
                                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                            <h4>Bienvenue dans votre messagerie</h4>
                                            <p class="text-muted">Sélectionnez une conversation pour commencer à discuter</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php include('include/footer_dash.php')?>
                </div>
            </div>
        </div>
        
        <!-- Scripts -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/custom.js"></script>
        
        <!-- Chat JavaScript -->
        <script>
        let currentConversationId = null;
        let currentOtherUser = null;
        let messagesPolling = null;
        
        $(document).ready(function() {
            loadConversations();
            
            // Vérifier si une conversation spécifique doit être ouverte via l'URL
            const urlParams = new URLSearchParams(window.location.search);
            const conversationId = urlParams.get('conversation');
            if (conversationId) {
                // Attendre que les conversations soient chargées puis ouvrir la bonne
                setTimeout(() => {
                    const conversationElement = $(`.conversation-item[data-conversation-id="${conversationId}"]`);
                    if (conversationElement.length > 0) {
                        conversationElement.click();
                    }
                }, 1000);
            }
            
            // Polling pour les nouvelles conversations toutes les 30 secondes
            setInterval(loadConversations, 30000);
        });
        
        function loadConversations() {
            $.ajax({
                url: '../actions/chat_handler.php',
                method: 'POST',
                data: { action: 'get_conversations' },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        displayConversations(response.conversations);
                    } else {
                        console.error('Erreur:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX:', error);
                }
            });
        }
        
        function displayConversations(conversations) {
            const container = $('#chat-conversations');
            
            if (conversations.length === 0) {
                container.html(`
                    <div class="no-conversations">
                        <i class="fas fa-comment-slash fa-2x text-muted mb-3"></i>
                        <p>Aucune conversation</p>
                        <small class="text-muted">Commencez à discuter en contactant un prestataire depuis la page des services</small>
                    </div>
                `);
                return;
            }
            
            let html = '';
            conversations.forEach(conv => {
                const unreadBadge = conv.unread_count > 0 ? 
                    `<span class="unread-badge">${conv.unread_count}</span>` : '';
                
                const lastMessage = conv.last_message ? 
                    (conv.last_message.length > 30 ? conv.last_message.substring(0, 30) + '...' : conv.last_message) : 
                    'Aucun message';
                
                const timeFormatted = conv.last_message_time_formatted || '';
                
                html += `
                    <div class="conversation-item" data-conversation-id="${conv.conversation_id}" 
                         data-other-user-name="${conv.other_user_name}" 
                         data-other-user-img="${conv.other_user_img}"
                         data-service-title="${conv.service_title}">
                        <div class="d-flex align-items-center">
                            <img src="${conv.other_user_img}" alt="${conv.other_user_name}" class="conversation-avatar">
                            <div class="conversation-info">
                                <div class="conversation-name">${conv.other_user_name}</div>
                                <div class="conversation-last-message">${lastMessage}</div>
                                <small class="text-muted">${conv.service_title}</small>
                            </div>
                        </div>
                        <div class="conversation-time">${timeFormatted}</div>
                        ${unreadBadge}
                    </div>
                `;
            });
            
            container.html(html);
            
            // Événement clic sur les conversations
            $('.conversation-item').click(function() {
                const conversationId = $(this).data('conversation-id');
                const otherUserName = $(this).data('other-user-name');
                const otherUserImg = $(this).data('other-user-img');
                const serviceTitle = $(this).data('service-title');
                
                selectConversation(conversationId, {
                    name: otherUserName,
                    img: otherUserImg,
                    service: serviceTitle
                });
                
                // Marquer comme active
                $('.conversation-item').removeClass('active');
                $(this).addClass('active');
                
                // Mobile: masquer sidebar et afficher chat
                if (window.innerWidth <= 768) {
                    $('#chat-sidebar').removeClass('mobile-show');
                    $('#chat-main').addClass('mobile-show');
                }
            });
        }
        
        function selectConversation(conversationId, otherUser) {
            currentConversationId = conversationId;
            currentOtherUser = otherUser;
            
            // Arrêter le polling précédent
            if (messagesPolling) {
                clearInterval(messagesPolling);
            }
            
            // Afficher l'en-tête du chat
            const chatHeader = `
                <div class="chat-header">
                    <button class="btn btn-sm btn-outline-primary d-md-none me-2" onclick="showConversationsList()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <img src="${otherUser.img}" alt="${otherUser.name}" class="chat-header-avatar">
                    <div>
                        <h6 class="mb-0">${otherUser.name}</h6>
                        <small class="text-muted">${otherUser.service}</small>
                    </div>
                </div>
            `;
            
            // Zone des messages
            const chatMessages = `
                <div class="chat-messages" id="chat-messages">
                    <div class="loading">
                        <i class="fas fa-spinner fa-spin"></i> Chargement des messages...
                    </div>
                </div>
            `;
            
            // Zone de saisie
            const chatInput = `
                <div class="chat-input">
                    <div class="chat-input-form">
                        <textarea class="chat-input-field" id="message-input" placeholder="Tapez votre message..." rows="1"></textarea>
                        <button class="chat-send-btn" onclick="sendMessage()">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            `;
            
            $('#chat-main').html(chatHeader + chatMessages + chatInput);
            
            // Charger les messages
            loadMessages(conversationId);
            
            // Démarrer le polling des messages toutes les 3 secondes
            messagesPolling = setInterval(() => {
                loadMessages(conversationId, false); // false = ne pas faire défiler
            }, 3000);
            
            // Auto-resize du textarea
            $('#message-input').on('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 100) + 'px';
            });
            
            // Envoyer avec Entrée
            $('#message-input').keypress(function(e) {
                if (e.which === 13 && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
        }
        
        function loadMessages(conversationId, scrollToBottom = true) {
            $.ajax({
                url: '../actions/chat_handler.php',
                method: 'POST',
                data: { 
                    action: 'get_messages',
                    conversation_id: conversationId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        displayMessages(response.messages, scrollToBottom);
                    } else {
                        $('#chat-messages').html(`
                            <div class="text-center p-3">
                                <div class="alert alert-warning">${response.message}</div>
                            </div>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors du chargement des messages:', error);
                }
            });
        }
        
        function displayMessages(messages, scrollToBottom = true) {
            let html = '';
            
            if (messages.length === 0) {
                html = `
                    <div class="text-center p-3">
                        <i class="fas fa-comment fa-2x text-muted mb-3"></i>
                        <p class="text-muted">Aucun message. Commencez la conversation !</p>
                    </div>
                `;
            } else {
                messages.forEach(msg => {
                    const messageClass = msg.is_mine ? 'message mine' : 'message';
                    html += `
                        <div class="${messageClass}">
                            <img src="${msg.sender_img}" alt="${msg.sender_name}" class="message-avatar">
                            <div class="message-content">
                                <div>${msg.message}</div>
                                <div class="message-time">${msg.time_formatted}</div>
                            </div>
                        </div>
                    `;
                });
            }
            
            $('#chat-messages').html(html);
            
            if (scrollToBottom) {
                scrollMessagesToBottom();
            }
        }
        
        function sendMessage() {
            const messageText = $('#message-input').val().trim();
            
            if (!messageText) {
                return;
            }
            
            if (!currentConversationId) {
                alert('Aucune conversation sélectionnée');
                return;
            }
            
            // Désactiver le bouton d'envoi
            $('.chat-send-btn').prop('disabled', true);
            
            $.ajax({
                url: '../actions/chat_handler.php',
                method: 'POST',
                data: { 
                    action: 'send_message',
                    conversation_id: currentConversationId,
                    message: messageText
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#message-input').val('');
                        $('#message-input').css('height', 'auto');
                        loadMessages(currentConversationId);
                        loadConversations(); // Rafraîchir la liste des conversations
                    } else {
                        alert('Erreur: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Erreur lors de l\'envoi du message');
                    console.error('Erreur AJAX:', error);
                },
                complete: function() {
                    $('.chat-send-btn').prop('disabled', false);
                }
            });
        }
        
        function scrollMessagesToBottom() {
            const messagesContainer = $('#chat-messages');
            messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
        }
        
        function showConversationsList() {
            $('#chat-main').removeClass('mobile-show');
            $('#chat-sidebar').addClass('mobile-show');
        }
        
        // Arrêter le polling quand on quitte la page
        $(window).on('beforeunload', function() {
            if (messagesPolling) {
                clearInterval(messagesPolling);
            }
        });
        </script>
    </body>
</html>
