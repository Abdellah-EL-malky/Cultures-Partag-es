<?php

class Article {
    private $id;
    private $titre;
    private $description;
    private $contenu;
    private $categorie;
    private $auteur;
    private $statut;
    private $db;
    
    public function __construct($id = null) {
        $this->db = Database::getInstance()->getConnection();
        if($id) {
            $this->loadArticle($id);
        }
    }
    
    private function loadArticle($id) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($article) {
            $this->id = $article['id'];
            $this->titre = $article['titre'];
            $this->description = $article['description'];
            $this->contenu = $article['contenu'];
            $this->categorie = $article['categorie'];
            $this->auteur = $article['auteur'];
            $this->statut = $article['statut'];
        }
    }
    
    public function afficherArticle() {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'description' => $this->description,
            'contenu' => $this->contenu,
            'categorie' => $this->categorie,
            'auteur' => $this->auteur,
            'statut' => $this->statut
        ];
    }

    public function getArticlesPagines($page = 1, $parPage = 10, $categorie = null) {
        $offset = ($page - 1) * $parPage;
        $params = [];
        $sql = "SELECT a.*, u.nom as auteur_nom, c.nom as categorie_nom 
                FROM articles a 
                JOIN users u ON a.auteur_id = u.id 
                JOIN categories c ON a.categorie_id = c.id 
                WHERE a.statut = 'validé'";
        
        if ($categorie) {
            $sql .= " AND c.id = ?";
            $params[] = $categorie;
        }
        
        $sql .= " ORDER BY a.id DESC LIMIT ? OFFSET ?";
        $params[] = $parPage;
        $params[] = $offset;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        
        return [
            'articles' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $this->getTotalArticles($categorie)
        ];
    }

    public function getDerniersArticles($limite = 5) {
        $stmt = $this->db->prepare("SELECT a.*, u.nom as auteur_nom, c.nom as categorie_nom 
                                  FROM articles a 
                                  JOIN users u ON a.auteur_id = u.id 
                                  JOIN categories c ON a.categorie_id = c.id 
                                  WHERE a.statut = 'validé' 
                                  ORDER BY a.id DESC 
                                  LIMIT ?");
        $stmt->execute([$limite]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getTotalArticles($categorie = null) {
        $sql = "SELECT COUNT(*) FROM articles WHERE statut = 'validé'";
        $params = [];
        
        if ($categorie) {
            $sql .= " AND categorie_id = ?";
            $params[] = $categorie;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }
}

?>