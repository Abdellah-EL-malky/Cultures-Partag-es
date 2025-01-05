<?php
class Categorie {
    private $id;
    private $nom;
    private $description;
    private $db;
    
    public function __construct($id = null) {
        try {
            $this->db = Database::getInstance()->getConnection();
            if($id) {
                $this->loadCategorie($id);
            }
        } catch(Exception $e) {
            handleDatabaseError($e);
        }
    }
    
    private function loadCategorie($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
            $stmt->execute([$id]);
            $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($categorie) {
                $this->id = $categorie['id'];
                $this->nom = $categorie['nom'];
                $this->description = $categorie['description'];
            }
        } catch(PDOException $e) {
            handleDatabaseError($e);
        }
    }
    
    public function getAllCategories() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM categories ORDER BY nom");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            handleDatabaseError($e);
        }
    }
    
    public function afficherCategorie() {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'description' => $this->description
        ];
    }
    
    public function nombreArticles() {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM articles WHERE categorie_id = ? AND statut = 'validé'");
            $stmt->execute([$this->id]);
            return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        } catch(PDOException $e) {
            handleDatabaseError($e);
        }
    }
    
    public function getStats() {
        try {
            $stmt = $this->db->prepare("
                SELECT 
                    COUNT(*) as total_articles,
                    SUM(CASE WHEN statut = 'validé' THEN 1 ELSE 0 END) as articles_valides,
                    SUM(CASE WHEN statut = 'refusé' THEN 1 ELSE 0 END) as articles_refuses
                FROM articles 
                WHERE categorie_id = ?
            ");
            $stmt->execute([$this->id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            handleDatabaseError($e);
        }
    }
}