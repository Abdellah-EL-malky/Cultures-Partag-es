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
            <a href="../index.html" class="logo">ArtCulture</a>
            <div class="nav-links">
                <a href="../index.html">Accueil</a>
                <a href="write.html">Écrire</a>
                <a href="login.html">Connexion</a>
                <a href="register.html">S'inscrire</a>
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