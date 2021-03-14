<?php

    class FullReservation {
        private $id;
        private $user_id;
        private $salle_id;
        private $dateJour;
        private $numero;
        private $secteur;
        private $etage;
        private $nbPlaces;
        private $heureDepart;
        private $heureFin;
        private $projecteur;
        private $tableau;
        private $batiment;
        private $message;
        private $recurrence_id;
        private $tele;

        public function __set($name, $value){}
    
        public function getId(){
            return $this->id;
        }
        
        public function getUser_id(){
            return $this->user_id;
        }

        public function getSalle_id(){
            return $this->salle_id;
        }

        public function getDateJour(){
            return $this->dateJour;
        }
        
        public function getNumero(){
            return $this->numero;
        }
        
        public function getSecteur(){
            return $this->secteur;
        }
            
        public function getEtage(){
            return $this->etage;
        }
        
        public function getNombrePlaces(){
            return $this->nbPlaces;
        }

        public function getHeuredepart(){
           return $this->heureDepart;
        }

        function getHeurefin(){
            return $this->heureFin;
        }

        public function hasProjecteur(){
            return $this->projecteur;
        }

        public function hasTableau(){
            return $this->tableau;
        }

        public function getBatiment(){
            return $this->batiment;
        }

        public function getMessage(){
            return $this->message;
        }

        public function getRecurrence_id(){
            return $this->recurrence_id;
        }

        public function hasTele(){
            return $this->tele;
        }
    }
?>
