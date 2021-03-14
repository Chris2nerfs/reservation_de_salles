<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");

include("../database/database.php");

$appli = new Database();

// page intermédiaire (elle ne se verra pas sur le site)
//variable qui recupere l'id de l'utilisateur et sa cle unique
$id = $_GET['id'];
$key = $_GET['key'];

// 2 // Connexion à la base de données


//Recuperation de l'utilisateur par son id
$user = $appli->getUserById($id);


//si la cle n'est pas la meme rediriger a la page inscription.php
if ($key != $user->getToken()) {
    $error = 'L\'activation n\'a pas fonctionné, veuillez vous ré-inscrire';
    header("Location:inscription.php?error=" . $error);
    exit();
}

// J'active le user
$appli->activeUser($id);

//rediriger vers la page login.php
header('Location:index.php');

?>




<!-- // Préparation du mail contenant le lien d'activation
$destinataire = $email;
$sujet = "Activer votre compte" ;
$entete = "From: inscription@realisecafetariat.ch" ;

// Le lien d'activation est composé du login(log) et de la clé(cle)
$message = 'Bienvenue sur CaferariatRealise,

Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.

http://realise.ch'.urlencode($login).'&cle='.urlencode($cle).'


---------------
Ceci est un mail automatique, Merci de ne pas y répondre.'; -->
