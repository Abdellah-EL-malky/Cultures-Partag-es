<?php
session_start();
require_once '../assets/config/config.php';
require_once '../assets/models/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $userData = [
        'nom' => $_POST['fullname'],
        'prenom' => '',
        'email' => $_POST['email'],
        'phone' => '',
        'password' => $_POST['password']
    ];
    
    if ($user->inscription($userData)) {
        header('Location: login.php?registered=1');
        exit();
    } else {
        $error = "L'email est déjà utilisé";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - ArtCulture</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="../index.php" class="logo">ArtCulture</a>
            <div class="nav-links">
                <a href="../index.php">Accueil</a>
                <a href="write.php">Écrire</a>
                <a href="login.php">Connexion</a>
                <a href="register.php">S'inscrire</a>
            </div>
        </div>
    </nav>

    <div class="registration-container">
        <div class="registration-box">
            <h1 class="registration-title">Créer un compte</h1>
            <p class="registration-subtitle">Rejoignez notre communauté d'artistes et de passionnés d'art</p>
            
            <form class="registration-form">
                <div class="form-group">
                    <label for="fullname">Nom complet</label>
                    <input type="text" id="fullname" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirmer le mot de passe</label>
                    <input type="password" id="confirm-password" class="form-input" required>
                </div>

                <button type="submit" class="registration-button">Créer mon compte</button>
            </form>

            <div class="registration-footer">
                Déjà membre ? <a href="login.php" class="login-link">Se connecter</a>
            </div>
        </div>
    </div>
</body>
</html>