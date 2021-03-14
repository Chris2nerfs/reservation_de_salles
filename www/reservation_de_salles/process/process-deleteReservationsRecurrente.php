<?php
// démarrage de la session utilisateur
session_start();

$idUser = $_SESSION['userId'];
$isAdmin = $_SESSION['isAdmin'];


require_once ($_SERVER['DOCUMENT_ROOT']."reservation-salle/config.php");
require_once (constant('ROOT_DIR')."/Database/database.php");

// Connexion à la base de données
$database = new Database();

// Récupère id récurrent de la salle réservée par l'url
$id = $_GET ['id'];
// var_dump($id);
// Récupère id 
$reservation = $database->getReservationById($id);

$idRecurrence = $reservation->getRecurrence_id();

// Supprimer toute les réservations qui ont la même id récurrent
$database->deleteAllReservationsByRecurrenteId($idRecurrence);

// Supprimer la réservation récurrente
$database->deleteReservationRecurrente($idRecurrence);

header('Location: ../reservations.php'); 
?>