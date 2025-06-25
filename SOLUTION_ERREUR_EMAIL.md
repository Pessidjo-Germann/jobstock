# 🔧 GUIDE RAPIDE - Résoudre "Erreur lors de l'envoi de l'email"

## ⚠️ Problème identifié
Votre configuration email n'est pas encore personnalisée avec vos vraies données.

## 🚀 Solution rapide (2 minutes)

### Étape 1: Modifiez votre configuration email

Ouvrez le fichier `includes/email_config.php` et remplacez :

```php
'smtp_username' => 'votre-email@gmail.com',        // ⬅️ CHANGEZ CECI
'smtp_password' => 'votre-mot-de-passe-app',       // ⬅️ CHANGEZ CECI
```

Par vos vraies données :

```php
'smtp_username' => 'moncompte@gmail.com',          // ⬅️ Votre vrai email
'smtp_password' => 'abcd efgh ijkl mnop',          // ⬅️ Mot de passe d'application
```

### Étape 2: Obtenir un mot de passe d'application Gmail

1. **Activez la vérification en 2 étapes** : https://myaccount.google.com/security
2. **Générez un mot de passe d'application** : https://myaccount.google.com/apppasswords
   - Sélectionnez "Mail" 
   - Copiez le code à 16 caractères (exemple: `abcd efgh ijkl mnop`)

### Étape 3: Testez votre configuration

```bash
cd /home/germann/Documents/jobstock
php diagnostic_email.php
```

## 📧 Exemple de configuration complète

```php
<?php
return [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_secure' => 'tls',
    'smtp_auth' => true,
    'smtp_username' => 'moncompte@gmail.com',           // ⬅️ Votre email
    'smtp_password' => 'abcd efgh ijkl mnop',           // ⬅️ Mot de passe d'app
    'from_email' => 'noreply@digexbooker.com',
    'from_name' => 'Digex Booker',
    'debug_mode' => false,
    'debug_level' => 0
];
?>
```

## 🔄 Alternative: Configuration automatique

Utilisez le script de configuration automatique :

```bash
cd /home/germann/Documents/jobstock
php configure_email.php
```

Ce script vous guidera étape par étape.

## ✅ Vérification finale

Une fois configuré, testez :
1. Inscrivez-vous avec un nouveau compte
2. Vérifiez que vous recevez l'email avec le code
3. Si ça marche = problème résolu ! 🎉

## 🆘 Si ça ne marche toujours pas

1. Vérifiez vos dossiers spam/indésirables
2. Vérifiez que le mot de passe d'application est correct
3. Activez le debug en changeant `'debug_mode' => true` dans votre config
4. Consultez les logs Apache : `sudo tail -f /var/log/apache2/error.log`

---

**Le problème sera résolu dès que vous aurez configuré vos vrais identifiants email !**
