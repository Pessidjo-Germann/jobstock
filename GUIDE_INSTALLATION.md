# 🚀 Guide d'Installation - Double Authentification par Email

## Étapes d'installation

### 1. Base de données
Exécutez le script SQL pour créer la table de vérification :

```sql
-- Connectez-vous à votre base de données et exécutez :
USE digexbooker;
SOURCE verification_codes.sql;
```

Ou copiez-collez le contenu de `verification_codes.sql` dans phpMyAdmin.

### 2. Test du système
1. Ouvrez votre navigateur et allez sur `http://votre-domaine/test_email.php`
2. Vérifiez que la table a été créée correctement
3. Testez l'envoi d'email (décommentez la section dans le fichier)

### 3. Configuration email (si nécessaire)
Si vous êtes sur un serveur partagé, l'envoi d'email devrait fonctionner directement.
Si vous êtes en local ou sur un VPS, vous devrez peut-être configurer :

```php
// Dans includes/email_verification.php, vous pouvez modifier les headers :
$headers = 'From: votre-email@votre-domaine.com' . "\r\n";
```

### 4. Test des fonctionnalités

#### Test d'inscription :
1. Allez sur `signup.php`
2. Remplissez le formulaire d'inscription
3. Cliquez sur "Create An Account"
4. Vous devriez être redirigé vers la page de vérification
5. Vérifiez vos emails et saisissez le code

#### Test de connexion :
1. Allez sur `signup.php` (onglet Login)
2. Saisissez vos identifiants
3. Cliquez sur "Log In"
4. Vous devriez être redirigé vers la page de vérification
5. Vérifiez vos emails et saisissez le code

### 5. Nettoyage
Une fois que tout fonctionne :
- Supprimez le fichier `test_email.php`
- Configurez un cron job pour le nettoyage automatique :

```bash
# Éditer le crontab
crontab -e

# Ajouter cette ligne pour nettoyer toutes les heures
0 * * * * /usr/bin/php /chemin/vers/votre/projet/actions/cleanup_verification_codes.php
```

## ⚠️ Problèmes courants

### "Table doesn't exist"
- Vérifiez que vous avez bien exécuté le script SQL
- Vérifiez la connexion à la base de données dans `actions/conbd.php`

### "Email non envoyé"
- Vérifiez la configuration du serveur mail
- Consultez les logs d'erreur PHP
- Essayez de modifier l'adresse d'expéditeur

### "Page blanche"
- Activez l'affichage des erreurs PHP
- Vérifiez les permissions des fichiers
- Consultez les logs d'erreur

## 🎉 Félicitations !

Votre système de double authentification par email est maintenant fonctionnel !

Les utilisateurs devront maintenant :
1. Saisir leurs informations de connexion/inscription
2. Vérifier leur email
3. Saisir le code à 6 chiffres reçu
4. Être automatiquement connectés/inscrits

## 📧 Template d'email

Le template d'email est entièrement personnalisable dans le fichier `includes/email_verification.php`. Il inclut :
- Un design responsive
- Le code de vérification mis en évidence
- Des instructions claires
- Un délai d'expiration (15 minutes)
