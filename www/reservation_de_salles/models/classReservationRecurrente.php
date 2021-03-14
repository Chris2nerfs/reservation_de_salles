<?php
    class ReservationRecurrente{
        //Attributs
        //Attributs spécifique à la réservation
        private $id; 
        private $dateDebut;
        private $dateFin;	
        private $type;
        private $user_id;

        //Constructeur par défaut

        //Fonctions

        public function __set($name, $value){}
    
        public function getId(){
        return $this->id;
        }

        public function getDateDebut(){
            return $this->dateDebut;
        }

        public function getDateFin(){
            return $this->dateFin;	
        }

        public function getType(){
            return $this->type;
        }

        public function getUser_id(){
            return $this->user_id;
        }
    }
?>
        