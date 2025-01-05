<?php

class Categorie {
    private $id;
    private $nom;
    private $description;
    private $db;
    
    public function __construct($id = null) {
        $this->db = Database::getInstance()->getConnection();
        if($id) {
            $this->loadCategorie($id);
        }
    }
    
    private function loadCategorie($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($categorie) {
            $this->id = $categorie['id'];
            $this->nom = $categorie['nom'];
            $this->description = $categorie['description'];
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
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM articles WHERE categorie_id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
}

?>