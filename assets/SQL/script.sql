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
