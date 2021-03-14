<!DOCTYPE html>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");
include("../database/database.php");
?>
<html lang="fr">

<head>
    <?php
    include("../include/header_inc.php");
    ?>
</head>

<body>

    <?php include("../include/erreur_inc.php"); ?>


    <div class="container bg-primary shadow rounded  my-auto">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <h3 class="text-center text-dark">Inscription</h3>


                    <form action="../process/process-createUser.php" method="POST">

                        <div class="form-group">
                            <label for="nom" class="text-dark">Nom:</label>
                            <input type="text" name="nom" required class="form-control" id="nom" placeholder="Entrez votre nom">
                        </div>
                        <div class="form-group">
                            <label for="prenom" class="text-dark">Prénom:</label>
                            <input type="text" name="prenom" required class="form-control" id="prenom" placeholder="Entrez votre prénom">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-dark">Email:</label>
                            <input type="email" name="email" required class="form-control" id="email" placeholder="exemple@realise.ch">
                        </div>
                        <div class="form-group">
                            <label for="code" class="text-dark">Code:</label>
                            <input type="code" name="code" required class="form-control" id="code" placeholder="Entrez votre code personnel">
                        </div>
                        <div class="form-group">
                            <label for="password1" class="text-dark">Password:</label>
                            <input type="password" name="password1" required class="form-control" id="password1" placeholder="Entrez votre mot de passe">
                        </div>
                        <div class="form-group">
                            <label for="password2" class="text-dark">Confirm password:</label>
                            <input type="password" name="password2" required class="form-control" id="password2" placeholder="Confirmez votre mot de passe">
                        </div>

                        <p class="form-group">
                            <button type="submit" name="submit" class="btn btn-success">S'inscrire</button>
                            <a href="../public/index.php" class="text-dark">
                                <h5>Déjà inscrit ? Connectez-vous !</h5>
                            </a>


                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
    include("../include/footer_inc.php");
    ?>
</body>

</html>
