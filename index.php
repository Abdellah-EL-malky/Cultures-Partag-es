<?php
session_start();
require_once ('assets/config/config.php');
require_once ('assets/models/article.php');
require_once('assets/models/categorie.php');

$article = new Article();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$categorie = isset($_GET['categorie']) ? (int)$_GET['categorie'] : null;

$articles = $article->getArticlesPagines($page, 10, $categorie);
$categories = (new Categorie())->getAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme Culturelle</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="index.php" class="logo">ArtCulture</a>
            <div class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (in_array($_SESSION['user_role'], ['author', 'admin'])): ?>
                        <a href="pages/write.php">Écrire</a>
                    <?php endif; ?>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                        <a href="pages/dashboard.php">Dashboard</a>
                    <?php endif; ?>
                    <a href="pages/logout.php">Déconnexion</a>
                <?php else: ?>
                    <a href="pages/login.php">Connexion</a>
                    <a href="pages/register.php">S'inscrire</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Page d'accueil -->
    <main class="container">

        <div class="articles-grid">
            <?php foreach ($articles['articles'] as $article): ?>
                <article class="article-card">
                    <img src="/api/placeholder/400/200" alt="<?php echo htmlspecialchars($article['titre']); ?>" class="article-image">
                    <div class="article-content">
                        <div class="category"><?php echo htmlspecialchars($article['categorie_nom']); ?></div>
                        <h3 class="article-title"><?php echo htmlspecialchars($article['titre']); ?></h3>
                        <p class="article-excerpt"><?php echo htmlspecialchars(substr($article['description'], 0, 150)) . '...'; ?></p>
                        <div class="article-meta">
                            <span>Par <?php echo htmlspecialchars($article['auteur_nom']); ?></span>
                            <a href="pages/read.php?id=<?php echo $article['id']; ?>">Lire plus</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <?php 
        $totalPages = ceil($articles['total'] / 10);
        if ($totalPages > 1): 
        ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo ($page-1); ?><?php echo $categorie ? '&categorie='.$categorie : ''; ?>" 
                   class="pagination-button">Précédent</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?><?php echo $categorie ? '&categorie='.$categorie : ''; ?>" 
                   class="pagination-button <?php echo $page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo ($page+1); ?><?php echo $categorie ? '&categorie='.$categorie : ''; ?>" 
                   class="pagination-button">Suivant</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </main>
</body>
</html>