<?php
require_once "../model/ClassDatabase.php";

class ClassAdministrateur extends ClassDatabase
{
    public function  Connexion(){

        $db = $this-> getPDO();

        if (!empty($_POST['email_admin']) && !empty($_POST['password_admin'])) {

            $sql = "SELECT * FROM administration WHERE email_admin = ? AND password_admin = ?";

            $req = $db->prepare($sql);

            $req->bindParam(1, $_POST['email_admin']);
            $req->bindParam(2, $_POST['password_admin']);

            $req->execute();
            $row=$req->fetch(PDO::FETCH_ASSOC);


            if (($_POST['email_admin'] == $row['email_admin']) && ($_POST['password_admin'] == $row['password_admin'])) {

                session_start();
                $_SESSION['connecter_admin'] = true;
                $_SESSION['email_admin'] = $row['email_admin'];
                $_SESSION['name_admin'] = $row['name_admin'];

                header("location:http://localhost/AnnonceMVC2/accueilAdministrateur");

            } else {
                echo "L'email ou le mdp n'est pas bon (admin)";
            }

        } elseif (empty($_POST['email_admin']) || empty($_POST['password_admin'])) {

            echo "<div class='alert alert-danger m-2 text-center' role='alert'>Merci de remplir tous les champs</div>";

        } else {
            echo "Else vide";
        }

    }

    public function afficherUtilisateur(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM utilisateurs";
        $stmt = $db->query($sql);
        return $stmt;
    }

    public function afficherToutesAnnonces(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM articles";
        $stmt = $db->query($sql);
        return $stmt;
    }

    public function afficherToutescatégories(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM categories";
        $stmt = $db->query($sql);
        return $stmt;

    }


    public function afficherTousAdministrateurs(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM administration";
        $stmt = $db->query($sql);
        return $stmt;
    }

}