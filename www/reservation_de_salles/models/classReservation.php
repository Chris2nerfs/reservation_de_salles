<?php
    class Reservation{
        //Attributs
        //Attributs spécifique à la réservation
        private $id;
        private $salle_id;
        private $user_id;
        private $dateJour;
        private $heureDepart;
        private $heureFin;
        private $message;
        private $projecteur;
        private $tableau;
        private $tele;

        //Constructeur par défaut

        //Fonctions
        public function __set($name, $value){}

        public function getId(){
        return $this->id;
        }

        public function getSalle_id(){
            return $this->salle_id;
        }

        public function getUser_id(){
            return $this->user_id;
        }

        public function getDateJour(){
            return $this->dateJour;

        }
        public function getHeuredepart(){
            return $this->heureDepart;
        }
        public function getHeurefin(){
            return $this->heureFin;
        }
        public function getMessage(){
            return $this->message;
        }
        public function hasProjecteur(){
            return $this->projecteur;
        }
        public function hasTableau(){
            return $this->tableau;
        }

        public function hasTele(){
            return $this->tele;
        }
    }
