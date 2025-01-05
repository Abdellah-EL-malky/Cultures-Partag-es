<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme Culturelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="index.html" class="logo">ArtCulture</a>
            <div class="nav-links">
                <a href="index.html">Accueil</a>
                <a href="../pages/write.html">Écrire</a>
                <a href="../pages/login.html">Connexion</a>
                <a href="../pages/register.html">S'inscrire</a>
            </div>
        </div>
    </nav>

    <!-- Page d'accueil -->
    <main class="container">
        <!-- Filtres -->
        <div class="filters">
            <button class="filter-button active">Tous</button>
            <button class="filter-button">Peinture</button>
            <button class="filter-button">Musique</button>
            <button class="filter-button">Littérature</button>
        </div>

        <!-- Grille d'articles -->
        <div class="articles-grid">
            <!-- Article exemple -->
            <article class="article-card">
                <img src="/api/placeholder/400/200" alt="Article image" class="article-image">
                <div class="article-content">
                    <div class="category">Peinture</div>
                    <h3 class="article-title">L'art moderne au XXIe siècle</h3>
                    <p class="article-excerpt">Une exploration des nouvelles tendances artistiques qui définissent notre époque...</p>
                    <div class="article-meta">
                        <span>Par Marie Martin</span>
                        <a href="article.html">Lire plus</a>
                    </div>
                </div>
            </article>
            <!-- Répéter pour plus d'articles -->
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <button class="pagination-button">Précédent</button>
            <button class="pagination-button active">1</button>
            <button class="pagination-button">2</button>
            <button class="pagination-button">3</button>
            <button class="pagination-button">Suivant</button>
        </div>
    </main>
</body>
</html>