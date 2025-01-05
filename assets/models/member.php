<?php
class Member extends User {
    public function consulter() {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE statut = 'validé'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function sinscrire($userData) {
        $stmt = $this->db->prepare("INSERT INTO users (nom, prénom, email, phone, mdp, role) VALUES (?, ?, ?, ?, ?, 'membre')");
        return $stmt->execute([
            $userData['nom'],
            $userData['prenom'],
            $userData['email'],
            $userData['phone'],
            password_hash($userData['password'], PASSWORD_DEFAULT)
        ]);
    }
}

?>