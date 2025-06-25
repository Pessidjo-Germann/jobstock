# 🚀 Système d'Authentification à Double Facteur (2FA) via Email

## 📧 Configuration Email avec PHPMailer

Le système utilise maintenant **PHPMailer** pour un envoi d'emails plus fiable.

### ⚙️ Configuration requise

1. **Modifiez le fichier** `includes/email_config.php` avec vos paramètres SMTP :

```php
return [
    // Configuration SMTP
    'smtp_host' => 'smtp.gmail.com', // Votre serveur SMTP
    'smtp_port' => 587,
    'smtp_secure' => 'tls',
    'smtp_auth' => true,
    
    // Vos identifiants (IMPORTANT : À MODIFIER)
    'smtp_username' => 'votre-email@gmail.com',
    'smtp_password' => 'votre-mot-de-passe-app',
    
    // Informations expéditeur
    'from_email' => 'noreply@digexbooker.com',
    'from_name' => 'Digex Booker',
];
```

### 🔧 Fournisseurs d'email supportés

#### Gmail
```php
'smtp_host' => 'smtp.gmail.com',
'smtp_port' => 587,
'smtp_secure' => 'tls',
'smtp_username' => 'votre-email@gmail.com',
'smtp_password' => 'mot-de-passe-dapplication', // Pas votre mot de passe Gmail !
```

**Générer un mot de passe d'application Gmail :**
1. Aller dans votre compte Google
2. Sécurité > Validation en 2 étapes
3. Mots de passe d'application
4. Générer un nouveau mot de passe pour "Mail"

#### Outlook/Hotmail
```php
'smtp_host' => 'smtp.live.com',
'smtp_port' => 587,
'smtp_secure' => 'tls',
```

#### Yahoo
```php
'smtp_host' => 'smtp.mail.yahoo.com',
'smtp_port' => 587,
'smtp_secure' => 'tls',
```

#### Serveur SMTP personnalisé
```php
'smtp_host' => 'mail.votre-domaine.com',
'smtp_port' => 587, // ou 465 pour SSL
'smtp_secure' => 'tls', // ou 'ssl'
```

## 🔄 Flow d'authentification

### 1. Inscription
- User remplit le formulaire → Données stockées en session
- Code 6 chiffres envoyé par email → User saisit le code
- Compte créé et connexion automatique

### 2. Connexion  
- User saisit email/mot de passe → Vérification des identifiants
- Code 6 chiffres envoyé par email → User saisit le code
- Connexion réussie

## 🧪 Test du système

Un fichier de test a été créé pour vérifier la configuration :
