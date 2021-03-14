<?php
// démarrage de la session utilisateur

session_start();
$idUser = $_SESSION['userId'];
$isAdmin = $_SESSION['isAdmin'];

// Import de la databse
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");
include("../database/database.php");
// Page intermediaire => que du php

//récupérer les infos du formulaire avec $_POST

$id = $_GET["id"];
$admin = $_GET["status"];

// Importer et mettre une valeur (instancier) une database
// import du fichier database

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");
include("../database/database.php");
$database = new DataBase();

$database->updateUserStatus($id, $admin);


header('Location: ../../include/adminUser.php');
