CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prénom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    mdp varchar(500) NOT NULL,
    role enum('membre','auteur','admin')
);

CREATE TABLE articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(100) NOT NULL,
    statut enum('validé','refusé') DEFAULT 'refusé',
    description text,
    contenu text,
    categorie_id INT NOT NULL,
    auteur varchar(50),
    categorie varchar(50),
    auteur_id INT NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES categories(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (auteur_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Trouver le nombre total d'articles publiés par catégorie
SELECT c.nom AS categorie, COUNT(a.id) AS total_articles
FROM categories c
LEFT JOIN articles a ON c.id = a.categorie_id
WHERE a.statut = 'validé'
GROUP BY c.nom;

-- Identifier les auteurs les plus actifs en fonction du nombre d'articles publiés
SELECT u.nom, u.prénom, COUNT(a.id) AS total_articles
FROM users u
JOIN articles a ON u.id = a.auteur_id
WHERE a.statut = 'validé'
GROUP BY u.id
ORDER BY total_articles DESC
LIMIT 5;

-- Calculer la moyenne d'articles publiés par catégorie
SELECT AVG(article_count) AS moyenne_articles
FROM (
    SELECT COUNT(a.id) AS article_count
    FROM categories c
    LEFT JOIN articles a ON c.id = a.categorie_id
    WHERE a.statut = 'validé'
    GROUP BY c.id
) AS sous_requête;

-- Créer une vue affichant les derniers articles publiés dans les 30 derniers jours
CREATE OR REPLACE VIEW derniers_articles AS
SELECT a.titre, a.description, a.contenu, c.nom AS categorie, u.nom AS auteur, a.statut, a.categorie_id, a.auteur_id, a.categorie
FROM articles a
JOIN categories c ON a.categorie_id = c.id
JOIN users u ON a.auteur_id = u.id
WHERE a.statut = 'validé' AND a.created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY);

-- Trouver les catégories qui n'ont aucun article associé
SELECT c.nom AS categorie
FROM categories c
LEFT JOIN articles a ON c.id = a.categorie_id
WHERE a.id IS NULL;
