<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");

include("../database/database.php");


//1 variables
// Récupére les données du formulaire d'inscription
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$code = $_POST['code'];
$pwd1 = $_POST['password1'];
$pwd2 = $_POST['password2'];


// Vérification des données //
if (empty($nom)) {
    $error = 'le champ de prenom est vide';
    header("location: ../public/inscription.php?error=" . $error);
    exit;
}

if (empty($prenom)) {
    $error = 'le champ de nom est vide';
    header("location:../../public/inscription.php?error=" . $error);
    exit;
}

if (empty($email)) {
    $error = 'le champ de email est vide';
    header("location: ../../public/inscription.php?error=" . $error);
    exit;
}

if (empty($code)) {
    $error = 'le champ de email est vide';
    header("location: ../public/inscription.php?error=" . $error);
    exit;
}

if (empty($pwd1)) {
    $error = 'le champ de mot de pass est vide';
    header("location: ../public/inscription.php?error=" . $error);
    exit;
}

if (empty($pwd2)) {
    $error = 'le champ de confirm mot de pass est vide';
    header("location: ../public/inscription.php?error=" . $error);
    exit;
}

if ($pwd1 !== $pwd2) {
    $error = 'Attention, mots de passe différents !!!';
    header("location: ../public/inscription.php?error=" . $error);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "L'email est incorrect";
    header("location: ../public/inscription.php?error=" . $error);
    exit;
}           // La vérification est OK //


//2 J'appelle la fonction vérifier email
$appli = new Database();

$emailOk = $appli->verifierEmailRealise($email);

//2b Si l'email n'est pas bon alors rediriger vers inscription
if (!$emailOk) {
    $error = "L'email n'est pas correct : utilisez un email de Réalise";
    header('Location:inscription.php?error=' . $error);
    exit();
}
//3
//3a hachage du mot de passe
$pwdHash = password_hash($pwd1, PASSWORD_DEFAULT);

//3b function qui Génére la clé unique pour le utilisateur
$key = uniqid();
$activeUser = 0;
$admin = 0;

$testSeulEmail = $appli->verifierSeulEmail($email);

if ($testSeulEmail > 0) {
    $error = "L'email est deja utliser";
    header('Location:../../inscription.php?error=' . $error);
    exit();
}

$id = $appli->insertUser($nom, $prenom, $email, $code, $pwdHash, $admin, $activeUser, $key);

//4 générer l'email d'activation
$to = $email;
$subject = 'Activation de votre compte Réalise';
$message = "Bonjour,
Vous avez créer un compte sur l'application Réalise Réservation Salles

Pour activer votre compte, veuillez cliquer sur le lien suivant :

" . BASE_URL . "/process/process-activation.php?id=$id&key=$key\" Lien d'activation";
$headers = 'From: donotreply@realisecafetariat.ch' . "\r\n" .
    'Reply-To: donotreply@realisecafetariat.ch' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//5 Envoyer l'email
mail($to, $subject, $message, $headers);

//6 Rediriger vers la page demande_activation.php
$error = "Un email d'activation vous a été envoyé, veuillez cliquer sur le lien avant de vous connecter";
header("location: ../../public/index.php?error=" . $error);
exit;
