<?php

require_once 'auteur.php';

class Admin extends Author {
    public function createCategorie($nom, $description) {
        $stmt = $this->db->prepare("INSERT INTO categories (nom, description) VALUES (?, ?)");
        return $stmt->execute([$nom, $description]);
    }
    
    public function updateCategorie($id, $nom, $description) {
        $stmt = $this->db->prepare("UPDATE categories SET nom = ?, description = ? WHERE id = ?");
        return $stmt->execute([$nom, $description, $id]);
    }
    
    public function deleteCategorie($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function consulterUtilisateur($userId = null) {
        if ($userId) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consulterArticlesSoumis() {
        $stmt = $this->db->prepare("SELECT a.*, u.nom as auteur_nom, c.nom as categorie_nom 
                                  FROM articles a 
                                  JOIN users u ON a.auteur_id = u.id 
                                  JOIN categories c ON a.categorie_id = c.id 
                                  WHERE a.statut = 'refusé'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validerArticle($articleId) {
        $stmt = $this->db->prepare("UPDATE articles SET statut = 'validé' WHERE id = ?");
        return $stmt->execute([$articleId]);
    }

    public function refuserArticle($articleId, $raison = null) {
        $stmt = $this->db->prepare("UPDATE articles SET statut = 'refusé', raison_refus = ? WHERE id = ?");
        return $stmt->execute([$raison, $articleId]);
    }
}

?>