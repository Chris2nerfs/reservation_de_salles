<?php 
class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $admin;
    private $actif;
    private $token;
    private $code;
    

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function isAdmin(){
        return $this->admin;
    }

    public function isActif(){
        return $this->actif;
    }

    public function getToken(){
        return $this->token;
    }
    
    public function getCode()
    {
        return $this->code;
    }

}
?>