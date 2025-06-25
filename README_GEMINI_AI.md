# Assistant IA Gemini - Documentation d'installation et d'utilisation

## 📋 Vue d'ensemble

L'Assistant IA Gemini a été intégré à votre plateforme Digex Booker pour offrir aux utilisateurs une aide personnalisée sur les questions d'emploi et de carrière. L'assistant utilise l'API Google Gemini Pro pour fournir des réponses intelligentes et contextualisées.

## 🔧 Installation et Configuration

### 1. Prérequis

- PHP 7.4 ou supérieur
- Extension curl activée
- Connexion internet stable
- Compte Google pour obtenir une clé API Gemini

### 2. Obtenir une clé API Gemini

1. **Accédez à Google AI Studio :**
   - Rendez-vous sur : https://makersuite.google.com/app/apikey
   - Connectez-vous avec votre compte Google

2. **Créez une nouvelle clé API :**
   - Cliquez sur "Create API Key"
   - Sélectionnez votre projet Google Cloud (ou créez-en un nouveau)
   - Copiez la clé API générée

3. **Configurez votre clé API :**
   - Ouvrez le fichier `includes/gemini_config.php`
   - Remplacez `YOUR_GEMINI_API_KEY_HERE` par votre vraie clé API
   ```php
   define('GEMINI_API_KEY', 'votre-cle-api-ici');
   ```

### 3. Vérification de l'installation

```bash
# Testez la configuration
php test_gemini_api.php
```

Si tout est configuré correctement, vous devriez voir :
```
=== Test de l'API Google Gemini ===

1. Vérification de la configuration...
✅ Clé API configurée
✅ URL API: https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent
✅ Timeout: 30 secondes
✅ Max tokens: 1000

2. Vérification de curl...
✅ Extension curl disponible

3. Test de connexion à l'API...
✅ Connexion réussie à l'API Gemini
📝 Réponse de test: Bonjour ! Oui, je peux vous répondre en français...

=== Tous les tests sont passés avec succès ! ===
```

## 📁 Fichiers créés/modifiés

### Nouveaux fichiers :
- `includes/gemini_config.php` - Configuration et classe GeminiAI
- `actions/gemini_ask.php` - Endpoint pour traiter les requêtes IA
- `view/gemini_ai_section.php` - Section IA pour la page d'accueil
- `ai_assistant.php` - Page dédiée à l'assistant IA
- `test_gemini_api.php` - Script de test de l'API

### Fichiers modifiés :
- `view/index_view.php` - Ajout de la section IA
- `includes/header.php` - Ajout du lien vers l'Assistant IA

## 🎯 Fonctionnalités

### 1. Interface utilisateur
- **Page d'accueil :** Section IA intégrée après les statistiques
- **Page dédiée :** `/ai_assistant.php` pour une expérience complète
- **Navigation :** Lien "Assistant IA" dans le menu principal

### 2. Fonctionnalités de l'IA
- Réponses contextualisées pour les questions d'emploi
- Limitation de taille des questions (1000 caractères)
- Protection anti-spam (10 secondes entre les questions)
- Suggestions de questions populaires
- Interface responsive et moderne

### 3. Sécurité et limitations
- Authentification requise (utilisateur connecté)
- Validation des entrées utilisateur
- Timeout de 30 secondes pour les requêtes API
- Gestion d'erreurs complète
- Logs d'interactions (optionnel)

## 🚀 Utilisation

### Pour les utilisateurs :
1. Connectez-vous à votre compte
2. Accédez à la page d'accueil ou cliquez sur "Assistant IA" dans le menu
3. Posez votre question dans la zone de texte
4. Cliquez sur "Demander à l'IA"
5. Consultez la réponse personnalisée

### Exemples de questions :
- "Comment rédiger un CV efficace ?"
- "Quelles compétences sont demandées en 2024 ?"
- "Comment préparer un entretien d'embauche ?"
- "Comment négocier son salaire ?"

## 🔍 Dépannage

### Erreurs courantes :

#### 1. "Clé API non configurée"
**Solution :** Vérifiez que vous avez bien remplacé `YOUR_GEMINI_API_KEY_HERE` dans `includes/gemini_config.php`

#### 2. "Extension curl non disponible"
**Solution :** Installez curl pour PHP :
```bash
# Ubuntu/Debian
sudo apt-get install php-curl

# CentOS/RHEL
sudo yum install php-curl

# Redémarrez votre serveur web
sudo systemctl restart apache2
```

#### 3. "Erreur de connexion à l'API Gemini"
**Solutions possibles :**
- Vérifiez votre connexion internet
- Vérifiez que votre clé API est valide
- Vérifiez les limites de votre quota API Gemini

#### 4. "Vous devez être connecté"
**Solution :** L'utilisateur doit être authentifié. Vérifiez la session PHP.

### Logs et debugging :
- Consultez les logs Apache/Nginx pour les erreurs PHP
- Activez le logging des interactions dans `includes/gemini_config.php`
- Utilisez `test_gemini_api.php` pour diagnostiquer les problèmes

## ⚙️ Configuration avancée

### Paramètres modifiables dans `includes/gemini_config.php` :

```php
// Longueur maximale de la question (caractères)
define('GEMINI_MAX_QUESTION_LENGTH', 1000);

// Nombre maximum de tokens dans la réponse
define('GEMINI_MAX_TOKENS', 1000);

// Timeout en secondes pour l'appel API
define('GEMINI_TIMEOUT', 30);
```

### Personnalisation des réponses :
Vous pouvez modifier le contexte envoyé à Gemini dans `actions/gemini_ask.php` :

```php
$contextualizedQuestion = "Tu es un assistant IA pour une plateforme d'emploi appelée 'Digex Booker'. " .
                         "Réponds de manière professionnelle et utile. " .
                         "Question de l'utilisateur: " . $question;
```

## 📊 Monitoring et maintenance

### 1. Quotas API Gemini
- Surveillez votre utilisation sur Google Cloud Console
- Configurez des alertes de quota si nécessaire

### 2. Performance
- Surveillez les temps de réponse de l'API
- Optimisez les questions trop longues
- Considérez la mise en cache pour les questions fréquentes

### 3. Logs d'utilisation
Les interactions sont automatiquement loggées dans `/logs/gemini_interactions.log` (si activé).

## 🔄 Mises à jour futures

### Améliorations possibles :
1. **Cache des réponses** pour les questions fréquentes
2. **Système de rating** des réponses
3. **Historique des conversations** par utilisateur
4. **Intégration avec la base de données** pour personnaliser selon le profil
5. **Support multilingue**

## 📞 Support

En cas de problème :
1. Vérifiez cette documentation
2. Exécutez `test_gemini_api.php`
3. Consultez les logs d'erreur
4. Vérifiez votre quota API Gemini

## 🔐 Sécurité

**Important :** 
- Ne partagez jamais votre clé API Gemini
- Stockez-la de manière sécurisée (variables d'environnement en production)
- Surveillez l'utilisation de votre API pour détecter tout usage abusif

---

**L'Assistant IA Gemini est maintenant prêt à aider vos utilisateurs !** 🎉
