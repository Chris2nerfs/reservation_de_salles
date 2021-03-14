<?php

//////////////////////////////////////////////// PROCESS / LOGIN.PHP ///////////////////////////////////////////////////////


require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");

include("../database/database.php");


//  1 - Connexion à la base de données

$appli = new Database;


//  2 - On récupère l'email et le password avec les variables $_POST de la page index.php

$email = $_POST['email'];
$pwd = $_POST['password'];


//  3 - On récupère l'user par le biais de son email dans la base de données

$user = $appli->getUserbyEmail($email);
// var_dump ($appli->getUserbyEmail($email));

// On vérifie si l'user existe

if ($user == null) {
    $error = "L'email utilisé n'a pas été trouvé.";
    header("location: ../../public/index.php?error=" . $error);
    exit;
}

//  4 - On récupère le password de l'user dans la base de données

$pwdHash = $user->getPassword();
// var_dump ($user->getPassword());

// On vérifie si le password existe

if ($pwdHash == null) {
    $error = "Problème recontré lors de la recherche du mot de passe.";
    header("location: ../public/index.php?error=" . $error);
    exit;
}

//  5 - Authentification de l’utilisateur en comparant le mot de passe entré dans la base de données et
//      celui entrée dans le formulaire de la page index.php

$authenticate = password_verify($pwd, $pwdHash);

//  On vérifie si le mot de passe haché est différent

if (!$authenticate) {
    $error = "Le mot de passe n'est pas valide";
    header("location: ../public/index.php?error=" . $error);
    exit;
}

//  6 - On récupère l'actif de l'user

$activeUser = $user->isActif();

// On vérifie si l'actif récupérer est égal à 1

if ($activeUser == 1) {

    session_start();

    $_SESSION['userId'] = $user->getId();
    $_SESSION['userEmail'] = $user->getEmail();
    $_SESSION['isAdmin'] = $user->isAdmin();
    header("location: ../public/reservations.php");
    exit;
} else {
    $error = "Vous n'avez pas activé votre compte en cliquant sur le lien que vous avez reçu dans votre email.";
    header("location: ../public/index.php?error=" . $error);
    exit;
}
