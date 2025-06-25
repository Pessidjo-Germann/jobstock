# Système de Double Authentification par Email - Digex Booker

## 📋 Description

Ce système ajoute une couche de sécurité supplémentaire à votre application en demandant aux utilisateurs de vérifier leur adresse email via un code à 6 chiffres lors de l'inscription et de la connexion.

## 🔄 Flow du processus

### Inscription
1. L'utilisateur remplit le formulaire d'inscription
2. Les données sont temporairement stockées en session
3. Un code de vérification à 6 chiffres est généré et envoyé par email
4. L'utilisateur saisit le code reçu
5. Une fois vérifié, le compte est créé et l'utilisateur est connecté

### Connexion
1. L'utilisateur saisit son email et mot de passe
2. Si les identifiants sont corrects, un code de vérification est envoyé
3. L'utilisateur saisit le code reçu
4. Une fois vérifié, l'utilisateur est connecté

## 📁 Fichiers ajoutés/modifiés

### Nouveaux fichiers
- `verification_codes.sql` - Script de création de la table de vérification
- `includes/email_verification.php` - Classe pour gérer la vérification d'email
- `view/email_verification_view.php` - Vue pour la saisie du code
- `email_verification.php` - Page principale de vérification
- `actions/verify_email.php` - Traitement de la vérification du code
- `actions/resend_code.php` - Renvoi d'un nouveau code
- `test_email.php` - Fichier de test (à supprimer en production)

### Fichiers modifiés
- `actions/inscription.php` - Intégration de la vérification pour l'inscription
- `actions/login.php` - Intégration de la vérification pour la connexion

## 🗄️ Base de données

### Nouvelle table: `email_verifications`
```sql
CREATE TABLE `email_verifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `verification_code` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `is_used` tinyint(1) DEFAULT 0,
  `action_type` enum('login','register') NOT NULL,
  `user_data` TEXT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_email_code` (`email`, `verification_code`),
  INDEX `idx_expires` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

## ⚙️ Installation

1. **Ajouter la table à la base de données:**
   ```bash
   mysql -u root -p digexbooker < verification_codes.sql
   ```

2. **Vérifier la configuration email:**
   - Accédez à `test_email.php` pour tester le système
   - Vérifiez que votre serveur peut envoyer des emails

3. **Test du système:**
   - Essayez de créer un nouveau compte
   - Essayez de vous connecter avec un compte existant

## 🔧 Configuration

### Configuration email
Le système utilise la fonction `mail()` de PHP. Assurez-vous que :
- Votre serveur web peut envoyer des emails
- Les headers d'email sont correctement configurés
- L'adresse `noreply@digexbooker.com` est autorisée (ou modifiez-la)

### Personnalisation
Vous pouvez modifier :
- La durée d'expiration des codes (15 minutes par défaut)
- Le template d'email dans `includes/email_verification.php`
- L'apparence de la page de vérification

## 🛡️ Sécurité

### Mesures implementées
- Codes à usage unique
- Expiration après 15 minutes
- Limitation du renvoi de codes (1 par minute)
- Nettoyage automatique des anciens codes
- Protection contre les attaques par force brute

### Bonnes pratiques
- Les codes sont stockés en base de données, pas en session
- Suppression automatique des codes expirés
- Validation côté serveur et client

## 🔍 Dépannage

### Problèmes courants

1. **Les emails ne sont pas envoyés:**
   - Vérifiez la configuration du serveur mail
   - Consultez les logs du serveur web
   - Testez avec `test_email.php`

2. **Erreur "Table doesn't exist":**
   - Assurez-vous d'avoir exécuté le script SQL
   - Vérifiez la connexion à la base de données

3. **Codes invalides:**
   - Vérifiez l'horloge du serveur
   - Assurez-vous que les codes ne sont pas expirés

## 📱 Interface utilisateur

### Fonctionnalités
- Saisie automatique du code (6 chiffres)
- Compte à rebours pour le renvoi
- Messages d'erreur clairs
- Interface responsive
- Auto-focus sur le champ de saisie

## 🚀 Améliorations possibles

- Intégration avec des services d'email professionnels (SendGrid, Mailgun)
- Authentification par SMS en alternative
- Statistiques des tentatives de connexion
- Support multilingue des emails
- Interface d'administration pour gérer les vérifications

## ⚠️ Notes importantes

1. **Supprimez `test_email.php` en production**
2. **Configurez un vrai serveur email en production**
3. **Surveillez les logs pour détecter d'éventuels abus**
4. **Testez le système après chaque déploiement**

## 📞 Support

En cas de problème, vérifiez :
1. La configuration de la base de données
2. Les permissions d'envoi d'email
3. Les logs d'erreur PHP
4. La connectivité réseau
