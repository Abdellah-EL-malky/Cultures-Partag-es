<?php
require_once '../assets/config/config.php';

abstract class User {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $phone;
    protected $role;
    protected $db;
    
    public function __construct($id = null) {
        $this->db = Database::getInstance()->getConnection();
        if($id) {
            $this->loadUser($id);
        }
    }
    
    protected function loadUser($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user) {
            $this->id = $user['id'];
            $this->nom = $user['nom'];
            $this->prenom = $user['prénom'];
            $this->email = $user['email'];
            $this->phone = $user['phone'];
            $this->role = $user['role'];
        }
    }
    
    public function seConnecter() {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND mdp = ?");
        $stmt->execute([$this->email, $this->password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inscription($userData) {
        if ($this->emailExiste($userData['email'])) {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO users (nom, prénom, email, phone, mdp, role) 
                                  VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $userData['nom'],
            $userData['prenom'],
            $userData['email'],
            $userData['phone'],
            password_hash($userData['password'], PASSWORD_DEFAULT),
            'membre'
        ]);
    }

    public function connexion($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mdp'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            return true;
        }
        return false;
    }

    private function emailExiste($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}




?>