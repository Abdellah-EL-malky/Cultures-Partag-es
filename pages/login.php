<?php
session_start();
require_once '../assets/config/config.php';
require_once '../assets/models/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    if ($user->connexion($_POST['email'], $_POST['password'])) {
        switch ($_SESSION['user_role']) {
            case 'admin':
                header('Location: dashboard.php');
                break;
            default:
                header('Location: index.php');
        }
        exit();
    } else {
        $error = "Email ou mot de passe incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ArtCulture</title>
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
    <div class="form-container">
        <h2 class="form-title">Connexion</h2>
        <form>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" class="form-input" required>
            </div>
            <button type="submit" class="form-button">Se connecter</button>
        </form>
        <p style="text-align: center; margin-top: 1rem;">
            Pas encore de compte ? <a href="register.php" style="color: var(--primary-color);">S'inscrire</a>
        </p>
    </div>
</body>
</html>