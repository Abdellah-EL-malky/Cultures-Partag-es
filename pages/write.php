<?php
session_start();
require_once '../assets/config/config.php';
require_once '../assets/models/author.php';

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['author', 'admin'])) {
    header('Location: login.php');
    exit();
}

$author = new Author($_SESSION['user_id']);
$categories = (new Categorie())->getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleData = [
        'titre' => $_POST['title'],
        'description' => $_POST['description'],
        'contenu' => $_POST['content'],
        'categorie_id' => $_POST['category']
    ];
    
    if ($author->createArticle($articleData)) {
        header('Location: index.php?success=1');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Écrire un article - ArtCulture</title>
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
    <div class="form-container" style="max-width: 800px;">
        <h2 class="form-title">Écrire un article</h2>
        <form>
            <div class="form-group">
                <label for="title">Titre de l'article</label>
                <input type="text" id="title" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="category">Catégorie</label>
                <select id="category" class="form-input" required>
                    <option value="">Sélectionner une catégorie</option>
                    <option value="peinture">Peinture</option>
                    <option value="musique">Musique</option>
                    <option value="litterature">Littérature</option>
                </select>
            </div>
            <div class="form-group">
                <label for="content">Contenu de l'article</label>
                <textarea id="content" class="form-input" style="min-height: 300px;" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image de couverture</label>
                <input type="file" id="image" class="form-input" accept="image/*">
            </div>
            <button type="submit" class="form-button">Publier l'article</button>
        </form>
    </div>
</body>
</html>