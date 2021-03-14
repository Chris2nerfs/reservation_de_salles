<?php
    class Salle{
        //Attributs
        //Attributs spécifique à la salle
        private $id;
        private $numero;
        private $etage;
        private $secteur;
        private $nbPlaces;
        private $projecteur;
        private $batiment;
        private $tableau;
        private $tele;
        
        //Constructeur par défaut

        //Fonctions
        public function __set($name, $value){}

        public function getId(){
            return $this->id;
        }
        public function getNumero(){
            return $this->numero;
        }
        public function getEtage(){
            return $this->etage;
        }
        
        public function getSecteur(){
            return $this->secteur;
        }
        public function getNombrePlaces(){
            return $this->nbPlaces;
        }
        public function hasProjecteur(){
            return $this->projecteur;
        }
        public function getBatiment(){
            return $this->batiment;
        }
        public function hasTableau(){
            return $this->tableau;
        }
        public function hasTele(){
            return $this->tele;
        }
    }
?>