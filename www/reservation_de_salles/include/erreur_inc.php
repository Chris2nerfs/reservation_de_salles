<?php
                // Affiche les erreurs envoyées dans l'url
                if(isset($_GET['error'])){
                    $error = $_GET['error'];
                    echo '<div class="alert alert-danger">' .$error .'</div>';
                }
