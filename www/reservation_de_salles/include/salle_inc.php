<div class="card container shadow border-info bordure_verticale">
    <div class="card-body">

        <div class="card-text row">

            <div class="col">
                <h5>Bâtiment: <?php echo $salle->getBatiment(); ?></h5>
                <h5>Étage: <?php echo $salle->getEtage(); ?></h5>
                <h5>Capacité: <?php echo $salle->getNombrePlaces(); ?></h5>
            </div>
            <div class="col">

                <h5>N°: <?php echo $salle->getNumero(); ?></h5>
                <h5>Secteur: <?php echo $salle->getSecteur(); ?></h5>
                <h5>Projecteur: <strong><?php if ($salle->hasProjecteur()) {
                                            echo "Avec";
                                        } else {
                                            echo "Sans";
                                        } ?></strong></h5>

                <h5>Tableau: <strong><?php if ($salle->hasTableau()) {
                                            echo "Avec";
                                        } else {
                                            echo "Sans";
                                        } ?></strong></h5>
                                        
                <h5>Télévision: <strong><?php if ($salle->hasTele()) {
                                            echo "Avec";
                                        } else {
                                            echo "Sans";
                                        } ?></strong></h5>
            </div>
            <?php if($isAdmin == 1){ ?>
            <div class="col my-auto">
                <h5><a class="btn btn-primary shadow " href="admin.updateSalle.php?id=<?php echo $salle->getId(); ?>
            ">Modifier
                    </a></h5>
            </div>

            <div class="col my-auto">

                <button type="button" class="btn btn-danger shadow" data-toggle="modal" data-target="#exampleModal<?php echo $salle->getId() ?>">
                    Supprimer
                </button>
            </div>
            <?php } ?>


        </div>
        <div class="col-lg my-auto p-1 ">
            <div class="modal fade" id="exampleModal<?php echo $salle->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel<?php echo $salle->getId() ?>">Supprimer</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Etes-vous sûr de vouloir supprimer?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                            <a href="Process/process-deleteSalle.php?id=<?php echo $salle->getId(); ?>" id="delete" class="btn btn-primary" onclick="hidePanel(<?php echo $salle->getId() ?>)">Oui</a> </div>
                    </div>
                </div>
            </div> 
           
        </div>
    </div>

    <script>
        function hidePanel($id){
            $($id).modal('hide');
        }
    </script>
</div>