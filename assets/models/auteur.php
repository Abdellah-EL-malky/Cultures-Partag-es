<?php

class Author extends User {
    public function createArticle($articleData) {
        $stmt = $this->db->prepare("INSERT INTO articles (titre, description, contenu, categorie_id, auteur_id) 
                                  VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $articleData['titre'],
            $articleData['description'],
            $articleData['contenu'],
            $articleData['categorie_id'],
            $this->id
        ]);
    }

    public function updateArticle($articleId, $articleData) {
        $stmt = $this->db->prepare("UPDATE articles SET titre = ?, description = ?, contenu = ?, categorie_id = ? 
                                  WHERE id = ? AND auteur_id = ? AND statut = 'refusé'");
        return $stmt->execute([
            $articleData['titre'],
            $articleData['description'],
            $articleData['contenu'],
            $articleData['categorie_id'],
            $articleId,
            $this->id
        ]);
    }

    public function deleteArticle($articleId) {
        $stmt = $this->db->prepare("DELETE FROM articles WHERE id = ? AND auteur_id = ? AND statut = 'refusé'");
        return $stmt->execute([$articleId, $this->id]);
    }

    public function getMesArticles() {
        $stmt = $this->db->prepare("SELECT a.*, c.nom as categorie_nom 
                                  FROM articles a 
                                  JOIN categories c ON a.categorie_id = c.id 
                                  WHERE a.auteur_id = ?
                                  ORDER BY a.id DESC");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>