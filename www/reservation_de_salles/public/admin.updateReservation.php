<!doctype html>
<html lang="fr">
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "reservation-salle/config.php");
require_once(constant('ROOT_DIR') . "/Database/database.php");

$id = $_GET['id'];
$database = new Database();
$reservation = $database->getReservationById($id);

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
                <h1 class="h1">Modifier une reservation</h1>
            </div>


            <div class="container bg-primary shadow rounded  my-auto">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <br>
                            <form action="Process/process-updateReservation.php" method="POST">
                                <div class="form-group">
                                    <label for="batiment" class="text-dark">Choisissez un bâtiment:</label> <br>
                                    <select class="form-control" id="batiment" name="batiment">
                                        <option value="">Tous les bâtiments</option>
                                        <?php foreach ($batiments as $batiment) { ?>
                                            <option value="<?php echo $batiment; ?>"><?php echo $batiment; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date" class="text-dark">Date:</label> <br>
                                    <input type="date" name="date"><span class="glyphicon glyphicon-calendar ml-2">
                                </div>
                                <div class="form-group">
                                    <label for="time" class="text-dark">Heure de début:</label><br>
                                    <input type="time" name="heureDeb" id="time">
                                </div>
                                <div class="form-group">
                                    <label for="time" class="text-dark">Heure de fin:</label><br>
                                    <input type="time" name="heureFin" id="time">
                                </div>

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