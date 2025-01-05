<?php
session_start();
require_once '../assets/config/config.php';
require_once '../assets/models/article.php';

$articleId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article = new Article($articleId);
$articleData = $article->afficherArticle();

if (!$articleData || $articleData['statut'] !== 'validé') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'art moderne au XXIe siècle - ArtCulture</title>
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

    <article class="article-full">
        <div class="article-header">
            <div class="article-category">Peinture</div>
            <h1 class="article-full-title">L'art moderne au XXIe siècle</h1>
            <div class="article-full-meta">
                <div class="author-info">
                    <img src="/api/placeholder/50/50" alt="Marie Martin" class="author-avatar">
                    <div class="author-details">
                        <span class="author-name">Marie Martin</span>
                        <span class="article-date">Publié le 2 janvier 2025</span>
                    </div>
                </div>
                <div class="article-tags">
                    <span class="tag">Art Moderne</span>
                    <span class="tag">Peinture</span>
                    <span class="tag">Contemporain</span>
                </div>
            </div>
        </div>

        <div class="article-full-image">
            <img src="/api/placeholder/800/400" alt="L'art moderne">
            <p class="image-caption">Exposition d'art moderne au Musée d'Art Contemporain</p>
        </div>

        <div class="article-full-content">
            <p class="article-lead">
                L'art moderne continue d'évoluer et de nous surprendre en ce début de XXIe siècle, redéfinissant constamment les frontières de la créativité et de l'expression artistique.
            </p>

            <h2 class="article-section">Les nouvelles tendances</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            <blockquote class="article-quote">
                "L'art moderne n'est pas seulement une évolution, c'est une révolution continue de notre perception du monde."
                <cite>- Jean Dupont, Critique d'art</cite>
            </blockquote>

            <h2 class="article-section">L'influence du numérique</h2>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>

        <div class="article-footer">
            <div class="article-share">
                <span>Partager :</span>
                <button class="share-button">Facebook</button>
                <button class="share-button">Twitter</button>
                <button class="share-button">LinkedIn</button>
            </div>
            
            <div class="article-comments">
                <h3>Commentaires</h3>
                <form class="comment-form">
                    <textarea placeholder="Laissez un commentaire..." class="comment-input"></textarea>
                    <button type="submit" class="comment-button">Publier</button>
                </form>
            </div>
        </div>
    </article>
</body>
</html>