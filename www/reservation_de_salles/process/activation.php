<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");

include("../database/database.php");

$appli = new  Database;

// page intermédiaire (elle ne se verra pas sur le site)
//variable qui recupere l'id de l'utilisateur et sa cle unique
$id = $_GET['id'];
$validationKey = $_GET['key'];

//Recuperation de l'utilisateur par son id
$user = $appli->getUserById($id);

//si la cle n'est pas la meme rediriger a la page inscription.php
if ($validationKey != $user->getToken()) {
    header('Location: ../public/inscription.php');
    exit();
}

//appel de la function activeUser dans database.php dans le cas ou ça a marché
$appli->activeUser($actif);

//rediriger vers la page login.php
header('Location: ../public/index.php');
