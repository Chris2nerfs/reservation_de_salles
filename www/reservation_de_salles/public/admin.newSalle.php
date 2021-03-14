<?php
// démarrage de la session utilisateur
    session_start();
    
    $idUser = $_SESSION['userId'];
    $isAdmin = $_SESSION['isAdmin'];

    if($isAdmin != 1){
        // Redirection vers les reservations
        header("Location:reservations.php");
        exit;
      }
?>
<!doctype html>
<html lang="fr">
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "reservation-salle/config.php");
require_once(constant('ROOT_DIR') . "/Database/database.php");
?>

<head>
    <?php require_once(constant('ROOT_DIR') . "/Public/include/header_inc.php") ?>
</head>

<body>
    <?php if($isAdmin == 1){ ?>
        <div>
            <div>
                <?php require_once(constant('ROOT_DIR') . "/Public/include/nav_inc.php") ?>
            </div>
            <div class="col text-center pb-4">
                <h1 class="h1">Nouvelle salle</h1>
            </div>


            <div class="container bg-primary shadow rounded  my-auto">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <br>
                            <form action="Process/creation-salle.php" method="POST">

                                <div class="form-group">
                                    <label for="batiment">Bâtiment</label>
                                    <input type="text" name="batiment" required class="form-control" id="batiment" placeholder="Entrez le nom du bâtiment">
                                </div>
                                <div class="form-group">
                                    <label for="numero">N°</label>
                                    <input type="text" name="numero" required class="form-control" id="numero" placeholder="Entrez le numéro de la salle">
                                </div>
                                <div class="form-group">
                                    <label for="etage">Étage</label>
                                    <input type="number" name="etage" required class="form-control" id="etage" placeholder="Entrez l'étage">
                                </div>
                                <div class="form-group">
                                    <label for="secteur">Secteur</label>
                                    <input type="text" name="secteur" class="form-control" id="secteur" placeholder="Entrez son secteur">
                                </div>
                                <div class="form-group">
                                    <label for="nbPlaces">Capacité (Nombre de personnes)</label>
                                    <input type="number" name="nbPlaces" required class="form-control" id="nbPlaces" placeholder="Entrez le nombre de places">
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="projecteur" class="custom-control-input" id="projecteur">
                                    <label class="custom-control-label mb-5" for="projecteur">Projecteur</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="tableau" class="custom-control-input" id="tableau">
                                    <label class="custom-control-label mb-5" for="tableau">Tableau</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="tele" class="custom-control-input" id="tele">
                                    <label class="custom-control-label mb-5" for="tele">Télévision</label>
                                </div>


                                <p>
                                    <button type="submit" class="btn btn-success">Créer</button>
                                </p>






                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php require_once(constant('ROOT_DIR') . "/Public/include/footer_inc.php") ?>

    <?php require_once(constant('ROOT_DIR') . "/Public/include/scripts_inc.php") ?>
</body>

</html>