<?php
//--------prends la classe créée----///
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/php/config.php");
include("../models/classReservation.php");
include("../models/classUser.php");
include("../models/class-fullReservation.php");
include("../models/classe-salle.php");


class Database
{
    //Attributs

    private $connexion;

    //Constructeur

    public function __construct()
    {

        //chemin vers le serveur
        $PARAM_hote = "mysqldb";
        //Le port de connexion à la base de données
        $PARAM_port = "3306";
        //nom base de données
        $PARAM_nom_bd = "reservation_de_salle";
        //nom user pour connection
        $PARAM_utilisateur = "AdminRdS";
        //mot de passe pour connetion
        $PARAM_mot_passe = "Admin789";



        try {
            //Test du code
            $this->connexion = new PDO(
                "mysql:dbname=" . $PARAM_nom_bd . ";port=" . $PARAM_port . ";host=" . $PARAM_hote,
                $PARAM_utilisateur,
                $PARAM_mot_passe
            );
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            echo "N : " . $e->getCode();
        }
    }

    //Fonction pour insérer une nouvelle salle
    public function insertSalle($batiment, $numero, $etage, $secteur, $nbPlaces, $projecteur, $tableau, $tele)
    {

        //Je prépare la requête
        $pdoStatement = $this->connexion->prepare(
            "INSERT INTO salles (batiment, numero, etage, secteur, nbPlaces, projecteur, tableau, tele)
            VALUES (:Batiment, :Numero, :Etage, :Secteur, :NombrePlaces, :Projecteur, :Tableau, :tele)"
        );

        //J'exécute la requête
        //En lui passant les valeurs en paramètres

        $pdoStatement->execute(array(
            "Batiment" => $batiment,
            "Numero" => $numero,
            "Etage" => $etage,
            "Secteur" => $secteur,
            "NombrePlaces" => $nbPlaces,
            "Projecteur" => $projecteur,
            "Tableau" => $tableau,
            "tele" => $tele
        ));

        //Je récupère l'id qui a été crée par la base de données
        $id = $this->connexion->lastInsertId();
        return $id;
        //-----------------------------Fin fonction InsertSalle-------------------------------//
    }

    //Fonction pour lister toutes les salles
    public function getAllSalle()
    {
        // On prépare la requete
        $pdoStatement = $this->connexion->prepare(
            "SELECT id,numero, batiment, etage, secteur, nbPlaces, projecteur, tableau, tele FROM salles"
        );

        // On exécute la requete
        $pdoStatement->execute();

        // On stocke en php le résultat de la requete
        $salles = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Salle");

        // Je retourne la liste des salles
        return $salles;
        //-----------------------------Fin fonction getAllSalle-------------------------------//
    }


    // Fonction pour supprimer une salle
    public function deleteSalle($salle)
    {
        //Je prépare ma requete auprès de ma base de donnée
        $pdoStatement = $this->connexion->prepare(
            "DELETE
            FROM salles
            WHERE id = :idSalle"
        );
        //J'exécute la requête
        $pdoStatement->execute(
            (["idSalle" => $salle])
        );

        //Récupère le code de retour de l'execution de la requête
        $errorCOde =  $pdoStatement->errorCOde();
        if ($errorCOde == 0) {
            //Si tout fonctionne bien renvoyer true sinon false
            return true;
        } else {
            return false;
        }
        //-----------------------------Fin fonction deleteSalle-------------------------------//
    }

    //function pour getReservationByDate une réservation

    public function getReservationByDate($date)
    {

        $pdoStatement = $this->connexion->prepare("SELECT * FROM reservations WHERE datejour = :Datejour
       ORDER BY dateJour, heureDepart DESC");

        $pdoStatement->execute(array("Datejour" => $date));
        $Reservation = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "FullReservation");
        return $Reservation;
    }

    //function pour insertRecurrenteReservation
    public function insertRecurrenteReservation($dateDebut, $dateFin, $type, $user_id)
    {

        $pdoStatement = $this->connexion->prepare(" INSERT INTO reservations_reccurentes( dateDebut, dateFin, type, user_id)
        VALUE(:DateDebut, :Datefin, :Type, :User_id)");
        $pdoStatement->execute(array(
            "DateDebut" => $dateDebut,
            "Datefin" => $dateFin,
            "Type" => $type,
            "User_id" => $user_id
        ));

        //var_dump($pdoStatement->errorInfo());

        $id = $this->connexion->lastInsertId();
        return $id;
    }

    //function pour getFullReservationByDate une réservation

    public function getFullReservationbydate($dateJour)
    {
        $pdoStatement = $this->connexion->prepare(
            "SELECT r.*, s.numero, s.etage, s.secteur, s.batiment,
        s.nbPlaces, s.projecteur, s.tableau, s.tele
        FROM reservations r
        INNER JOIN salles s
        ON r.salle_id = s.id
        WHERE r.dateJour = :datejour
        AND CURDATE() >= datejour
        ORDER BY r.dateJour ASC, r.heureDepart ASC"
        );

        $pdoStatement->execute(array("datejour" => $dateJour));

        $fullreservation = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "FullReservation");

        return $fullreservation;
    }

    /*
+++++++++++++++++++++++++++++++++++++++++DÉBUT DE FONCTION : insertUser()+++++++++++++++++++++++++++++++++++++++++++++++++++
*/


    //  Créer un nouvel utilisateur
    public function insertUser($nom, $prenom, $email, $code, $password, $admin, $actif, $token)
    {

        /*  1 - Je prepare ma requête et je lui donne comme paramètre toutes les données nécessaires
        pour créer le nouveau profil.
*/
        $pdoStatement = $this->connexion->prepare(
            "INSERT INTO users (nom, prenom, email, password, admin, actif, token, code)
            VALUE(:Nom, :Prenom, :Email, :Password, :Admin, :Actif, :Token, :Code)"
        );

        //  2 - Exécuter les paramètres insérés dans le tableau.
        $pdoStatement->execute(array(
            "Nom" => $nom,
            "Prenom" => $prenom,
            "Email" => $email,
            "Password" => $password,
            "Admin" => $admin,
            "Actif" => $actif,
            "Token" => $token,
            "Code" => $code
        ));

        //  3 - Récupére l'id de la dernière ligne inserée dans la base de données.
        $id = $this->connexion->lastInsertId();
        return $id;
    }

    /*
--------------------------------------------FIN DE FONCTION : insertUser()----------------------------------------------------
*/

    //Fonction pour Supprimer un compte utilisateur

    public function deleteUser($user)
    {
        //Je prépare ma requete auprès de ma base de donnée
        $pdoStatement = $this->connexion->prepare(
            "DELETE
            FROM users
            WHERE id = :idUser"
        );
        //J'exécute la requête
        $pdoStatement->execute(
            (["idUser" => $user])
        );

        //Récupère le code de retour de l'execution de la requête
        $errorCOde =  $pdoStatement->errorCOde();
        if ($errorCOde == 0) {
            //Si tout fonctionne bien renvoyer true sinon false
            return true;
        } else {
            return false;
        }
        // Fin fonction Supprimer un compte utilisateur-------------------------------//
    }
    //Fonction pour lister tous les users
    public function getAllUsers()
    {
        // On prépare la requete
        $pdoStatement = $this->connexion->prepare(
            "SELECT id, nom, prenom, admin FROM users"
        );

        // On exécute la requete
        $pdoStatement->execute();

        // On stocke en php le résultat de la requete
        $users = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "User");

        // Je retourne la liste des users
        return $users;
    }
    /*
----------------------------------------Fin Fonction pour lister tous les users-------------------------------//
*/


    public function getUserbyEmail($email)
    {
        /*recuperer l'user apartir de  son e-mail.
        1-je prepare ma requete
        2-j'execute la requete avec l'email comme parametre
        3-je recupere l'objet "user" à partir de son email et il me *return email*/

        $pdoStatement = $this->connexion->prepare("SELECT *  FROM users WHERE email = :email");
        $pdoStatement->execute(array('email' => $email));
        $user = $pdoStatement->fetchObject("User");
        return $user;
    }


    //+++++++++++++++++++++DEBUT DE FONCTION "update" utilisateur++++++++++++++++++++++++//


    //Fonction pour upgrader le status du user
    public function updateUserStatus($id, $admin)
    {

        //Je prépare la requête
        $pdoStatement = $this->connexion->prepare(
            'UPDATE users
           SET admin = :paraAdmin
           WHERE id = :paramId'
        );

        //J'exécute la requête
        //En lui passant les valeurs en paramètres
        $pdoStatement->execute(
            array(
                "paramId" => $id,
                "paraAdmin" => $admin
            )
        );
        // Récupérer le code erreur
        $code = $pdoStatement->errorCode();
        if ($code == 0) {
            return true;
        }
        return false;
        //-----------------------------Fin fonction pour upgrader le status du user-------------------------------//
    }

    /*
++++++++++++++++++++++++++++++++++++++DÉBUT DE FONCTION : verifierEmailRealise()+++++++++++++++++++++++++++++++++++++++++++++++++++
*/
    public function verifierEmailRealise($email)
    {
        // On crée une variable qui contient le pattern
        $pattern = preg_quote("/@realise.ch/");

        // On test si le pattern est trouvé dans l'email et on stocke le resultat
        $result = preg_match($pattern, $email);

        // On retourne le résultat
        return $result;
    }
    /*
--------------------------------------FIN DE FONCTION : verifierEmailRealise()----------------------------------------------------
*/

    /*
+++++++++++++++++++++++++++++++++++++++DÉBUT DE FONCTION : verifierSeulEmail()+++++++++++++++++++++++++++++++++++++++++++++++++++
*/

    public function verifierSeulEmail($email)
    {

        $pdoStatement = $this->connexion->prepare(
            "SELECT * email
            FROM users
            WHERE  email = :Email"
        );

        $pdoStatement->execute(array('Email' => $email));

        $res = $pdoStatement->fetch();

        return $res['Email'];
    }

    /*
----------------------------------------FIN DE FONCTION : verifierSeulEmail()----------------------------------------------------
*/

    /*
++++++++++++++++++++++++++++++++++++++++++DÉBUT DE FONCTION : getUserById()+++++++++++++++++++++++++++++++++++++++++++++++++++
*/
    //Fonction pour lister tous les id
    public function getUserById($id)
    {
        // On prépare la requete
        $pdoStatement = $this->connexion->prepare("SELECT * FROM users WHERE id = :user_id");

        // On exécute la requete
        $pdoStatement->execute(['user_id' => $id]);

        // On stocke en php le résultat de la requete
        $user = $pdoStatement->fetchObject('User');

        // Je retourne la liste des ids
        return $user;
    }
    /*
------------------------------------------FIN DE FONCTION : getUserById()
----------------------------------------------------
*/
    //Fonction pour recupere id de  reservation recurrentte


    public function getReservationrecurrentebyid($id)
    {

        $pdoStatement = $this->connexion->prepare("SELECT * FROM reservations_reccurentes WHERE id =:ID");

        $pdoStatement->execute(array("ID" => $id));

        $reserecurrente = $pdoStatement->fetchObject("ReservationRecurrente");

        return $reserecurrente;
    }

    //Fonction pour recupere id de reservations par recurrence id

    public function deleteAllReservationsByRecurrenteId($idRecurrente)
    {
        $pdoStatement = $this->connexion->prepare(
            "DELETE FROM reservations WHERE  	recurrence_id = :idrecurrente"
        );
        //J'exécute la requête
        $pdoStatement->execute(
            (["idrecurrente" => $idRecurrente])
        );

        //Récupère le code de retour de l'execution de la requête
        $errorCOde =  $pdoStatement->errorCOde();
        if ($errorCOde == 0) {
            //Si tout fonctionne bien renvoyer true sinon false
            return true;
        } else {
            return false;
        }
    }

    //Fonction pour recupere id de reservations par reccurente id

    public function deleteReservationRecurrente($idRecurrente)
    {
        $pdoStatement = $this->connexion->prepare(
            "DELETE FROM reservations_recurrentes WHERE id = :idrecurrente"
        );
        //J'exécute la requête
        $pdoStatement->execute(
            (["idrecurrente" => $idRecurrente])
        );

        //Récupère le code de retour de l'execution de la requête
        $errorCOde =  $pdoStatement->errorCOde();
        if ($errorCOde == 0) {
            //Si tout fonctionne bien renvoyer true sinon false
            return true;
        } else {
            return false;
        }
    }

    /*
+++++++++++++++++++++++++++++++++++++++++DÉBUT DE FONCTION : activeUser()+++++++++++++++++++++++++++++++++++++++++++++++++++
*/
    public function activeUser($id)
    {
        $pdoStatement = $this->connexion->prepare(
            "UPDATE users
            SET actif = 1
            WHERE id = :id "
        );
        $pdoStatement->execute(array("id" => $id));

        // Récupérer le code erreur
        $code = $pdoStatement->errorCode();
        if ($code == 0) {
            return true;
        }
        return false;
    }
    /*
------------------------------------------FIN DE FONCTION : activeUser()----------------------------------------------------
*/

    // Function getUserReservation (int $idUser)
    public function getUserReservation(int $idUser)
    {
        $pdoStatement = $this->connexion->prepare(
            "SELECT r.*, s.numero, s.etage, s.secteur, s.batiment,
             s.nbPlaces, s.projecteur, s.tableau, s.tele
            FROM reservations r
            INNER JOIN salles s
            ON r.salle_id = s.id
            WHERE r.user_id = :userId
            AND r.dateJour >= CURDATE()
            ORDER BY r.dateJour ASC, r.heureDepart ASC"
        );

        $pdoStatement->execute(array("userId" => $idUser));

        $fullreservation = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "FullReservation");

        return $fullreservation;
    }


    //--------------------------Fin de user reservations-------------------------------------//

    // Fonction pour supprimer une reservation grâce à son id
    public function deleteReservation($id)
    {
        // Je prépare ma requête
        $pdoStatement = $this->connexion->prepare(
            "DELETE FROM reservations WHERE id = :id"
        );

        // J'execute la requete
        $pdoStatement->execute(
            ["id" => $id]
        );

        // Récupère le code de retour de l'execution de la requete
        $errorCode = $pdoStatement->errorCode();
        if ($errorCode == 0) {
            // Si ca c'est bien passé renvoyer true
            return true;
        }
        // Si ca c'est mal passé renvoyer false
        return false;
    }

    //-----------------------------fin de delete réservation----------------------------//





    //function pour récupérer les salles selon les créneaux
    public function getSalleByCreneau($batiment, $date, $heureDebut, $heureFin)
    {

        //Je prépare la requête
        $pdoStatement = $this->connexion->prepare(
            "SELECT * FROM salles
            WHERE id NOT IN(
                SELECT salle_id FROM reservations
                WHERE dateJour = :paramDate
                AND heureDepart <= :paramHeureFin
                AND heureFin >= :paramHeureDeb
                )
            AND batiment LIKE :batiment
            ORDER BY batiment, numero ASC"
        );
        //J'exécute la requête
        //En lui passant les valeurs en paramètres

        $pdoStatement->execute(array(
            'paramDate' => $date,
            'paramHeureDeb' => $heureDebut,
            'paramHeureFin' => $heureFin,
            'batiment' => "%" . $batiment . "%",
        ));

        // On stocke en php le résultat de la requete
        $salles = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Salle");

        // Je retourne la liste des réservations
        return $salles;

        //-----------------------------Fin fonction pour récupérer les salles selon les créneaux-------------------------------//
    }

    //function pour insérer une réservation
    public function insertReservation($salle_id, $user_id, $dateJour, $heureDepart, $heureFin, $message, $reccurenceId)
    {
        //Je prépare la requête
        $pdoStatement = $this->connexion->prepare(
            "INSERT INTO reservations (salle_id, user_id,dateJour, heureDepart, heureFin, message, recurrence_id)
        VALUES (:Salle_id, :User_id, :DateJour, :HeureDebut, :HeureFin, :Message, :reccurenceId)"
        );

        //J'exécute la requête
        //En lui passant les valeurs en paramètres

        $pdoStatement->execute(array(
            "Salle_id" => $salle_id,
            "User_id" => $user_id,
            "DateJour" => $dateJour,
            "HeureDebut" => $heureDepart,
            "HeureFin" => $heureFin,
            "Message" => $message,
            "reccurenceId" => $reccurenceId
        ));

        // Récupérer le code erreur
        $code = $pdoStatement->errorCode();
        if ($code == 0) {
            return true;
        }
        return false;
    }
    //-----------------------------Fin fonction pour insérer une réservation-------------------------------//

    //Fonction pour modifier une salle
    public function updateSalle($id, $batiment, $numero, $etage, $secteur, $nbPlaces, $projecteur, $tableau, $tele)
    {
        $pdoStatement = $this->connexion->prepare(
            "UPDATE `salles`
        SET `id`=:Id,`batiment`=:Batiment,`numero`=:Numero,`etage`=:Etage,`secteur`=:Secteur,`nbPlaces`=:NombrePlaces,`projecteur`=:Projecteur,`tableau`=:Tableau, tele =:Tele
        WHERE id=:Id"
        );

        //Execution de la requête et mapping des valeurs
        $pdoStatement->execute(
            array(
                "Id" => $id,
                "Batiment" => $batiment,
                "Numero" => $numero,
                "Etage" => $etage,
                "Secteur" => $secteur,
                "NombrePlaces" => $nbPlaces,
                "Projecteur" => $projecteur,
                "Tableau" => $tableau,
                "Tele" => $tele
            )
        );

        //Je récupère le code de retour de l'execution de la requete
        $errorCode = $pdoStatement->errorCode();
        if ($errorCode == 0) {
            //Si ça s'est bien passé, renvoyer true
            return true;
        }
        //Si ça s'est mal passé, renvoyer false
        return false;
    }

    //Fonction pour récupérer les salles par l'ID
    public function getSalleById($id)
    {
        // On prépare la requete
        $pdoStatement = $this->connexion->prepare("SELECT * FROM salles WHERE id = :Id");

        // On exécute la requete
        $pdoStatement->execute(['Id' => $id]);

        // On stocke en php le résultat de la requete
        $salle = $pdoStatement->fetchObject('Salle');

        // Je retourne la liste des ids
        return $salle;
    }

    public function updateReservation($id, $salle_id, $user_id, $dateJour, $heureDepart, $heureFin, $message)
    {
        $pdoStatement = $this->connexion->prepare(
            "UPDATE `reservations`
            SET `salle_id`=:Salle_id,`user_id`=:User_id,`dateJour`=:DateJour,
            `heureDep`=:HeureDepart,`heureFin`=:HeureFin,`message`=:Message
            WHERE id=:Id"
        );

        //Execution de la requête et mapping des valeurs
        $pdoStatement->execute(
            array(
                "Id" => $id,
                "Salle_id" => $salle_id,
                "User_id" => $user_id,
                "DateJour" => $dateJour,
                "HeureDepart" => $heureDepart,
                "HeureFin" => $heureFin,
                "Message" => $message
            )
        );

        //Je récupère le code de retour de l'execution de la requete
        $errorCode = $pdoStatement->errorCode();
        if ($errorCode == 0) {
            //Si ça s'est bien passé, renvoyer true
            return true;
        }
        //Si ça s'est mal passé, renvoyer false
        return false;
    }

    public function getReservationById($id)
    {
        // On prépare la requete
        $pdoStatement = $this->connexion->prepare("
            SELECT r.*, s.numero, s.etage, s.secteur, s.batiment,
             s.nbPlaces, s.projecteur, s.tableau, s.tele
            FROM reservations r
            INNER JOIN salles s
            ON r.salle_id = s.id
            WHERE r.id = :Id");

        // On exécute la requete
        $pdoStatement->execute(['Id' => $id]);

        // On stocke en php le résultat de la requete
        $reservation = $pdoStatement->fetchObject('FullReservation');

        // Je retourne la liste des ids
        return $reservation;
    }


    //Fonction pour récupérer count reservation  salles par l'ID

    public function getReservationNum($id)
    {
        // On prépare la requete
        $pdoStatement = $this->connexion->prepare("SELECT count(*) FROM reservations WHERE id = :Id");

        // On exécute la requete
        $pdoStatement->execute(['Id' => $id]);

        // On stocke en php le résultat de la requete
        $number_of_rows = $pdoStatement->FETCHALL(PDO::FETCH_COLUMN, "id");

        // Je retourne la liste des ids
        return $number_of_rows;
    }


    //++++Préparation de requête+++++++++//

    public function getBatiments()
    {
        $pdoStatement = $this->connexion->prepare(
            "SELECT DISTINCT batiment FROM salles"
        );
        // On exécute la requete
        $pdoStatement->execute();
        //+++++Exécution de requête++++++++++//
        $batiments = $pdoStatement->FETCHALL(PDO::FETCH_COLUMN, 'Batiments');
        //++++++++Récupérer le tableau de batiment++++++++
        return $batiments;
    }
}
