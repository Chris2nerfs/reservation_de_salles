<?php

session_start();

if (isset($_SESSION['userId'])) {
    //déjà loger alors redirection page profil
    header("Location:.reservations.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");
include("../database/database.php");
?>

<head>
    <?php
    include("../include/header_inc.php");
    ?>
</head>

<body>


    <div class="container bg-primary shadow rounded  my-auto">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <h3 class="text-center text-dark">Connection</h3>



                    <?php include("../include/erreur_inc.php"); ?>


                    <form action="../process/login.php" method="POST">

                        <div class="form-group">
                            <label for="email" class="text-dark">Email:</label><br>
                            <input type="email" required class="form-control" name="email" id="email" placeholder="Entrez votre email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-dark">Mot de passes:</label><br>
                            <input type="password" name="password" id="password" required class="form-control" placeholder="Entrez votre mot de passe">
                        </div>
                        <p class="form-group">
                            <button type="submit" name="submit" class="btn btn-success">Se connecter</button>
                            <a href="../public/inscription.php" class="text-dark">
                                <h5>Pas encore inscrit ? Inscrivez-vous !</h5>
                            </a>


                        </p>






                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("../include/footer_inc.php") ?>

</body>

</html>
