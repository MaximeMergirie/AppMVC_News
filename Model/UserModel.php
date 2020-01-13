<?php

class UserModel extends Model
{

    public function getUsers()
    {

        $requete = $this->connexion->prepare("SELECT * FROM `user`");
        $resultat = $requete->execute();
        $listeUser = $requete->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($listeUser);
        return $listeUser;
    }
   
    /**
     * Code SQL pour ajout en BDD
     *
     * @return void
     */
    // public function addDB()
    // {
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     $nom = $_POST['nom'];
    //     $prenom = $_POST['prenom'];

    //     $requete = $this->connexion->prepare("INSERT INTO `user`(`id`, `username`, `password`, `nom`, `prenom`)
    //     VALUES (NULL, :username, :password, :nom, :prenom)");
    //     $requete->bindParam(':username', $username);
    //     $requete->bindParam(':password', $password);
    //     $requete->bindParam(':nom', $nom);
    //     $requete->bindParam(':prenom', $prenom);
    //     $resultat = $requete->execute();
    // }

        /**
     * Code SQL pour ajouter en BDD
     *
     * @return void
     */
    public function addDB()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $photo = "undifine.jpg";

        if (isset($_FILES['photo']) && !empty($_FILES['photo'])) {
            $emplacement_temporaire = $_FILES['photo']['tmp_name'];
            $nom_fichier = $_FILES['photo']['name'];
            // $emplacement_destination = 'C:\wamp64\www\MVC\exemples\crudComplet\img\\'. $nom_fichier;
            $emplacement_destination = 'img/' . $nom_fichier;
            // var_dump($emplacement_temporaire);
            // var_dump($emplacement_destination);

            $result = move_uploaded_file($emplacement_temporaire, $emplacement_destination);
            if ($result) {
                $photo = $nom_fichier;
                // $photo = 'C:\wamp64\www\MVC\exemples\crudComplet\img\\'. $nom_fichier;
            }
        }
        $requete = $this->connexion->prepare("INSERT INTO `user`(`id`, `username`, `password`,`photo` `nom`, `prenom`)
        VALUES (NULL, :username, :password,:photo :nom, :prenom)");
        $requete->bindParam(':username', $username);
        $requete->bindParam(':password', $password);
        $requete->bindParam(':photo', $photo);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $resultat = $requete->execute();
    }

    /**
     * Code SQL pour suppression en BDD
     *
     * @return void
     */
    public function suppDB()
    {
        $id = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM `user` WHERE id=:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
    }
    
    // /**
    //  * mise à jour des données en BDD
    //  *
    //  * @return void
    //  */
    // public function updateDB()
    // {
    //     $id = $_POST['id'];
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     $nom = $_POST['nom'];
    //     $prenom = $_POST['prenom'];

    //     $requete = $this->connexion->prepare("UPDATE user SET username = :username, password= :password, nom= :nom, prenom= :prenom WHERE id= :id");
    //     $requete->bindParam(':id', $id);
    //     $requete->bindParam(':username', $username);
    //     $requete->bindParam(':password', $password);
    //     $requete->bindParam(':nom', $nom);
    //     $requete->bindParam(':prenom', $prenom);
    //     $resultat = $requete->execute();

    // }

    public function updateDB()
    {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        if (isset($_FILES['photo']) && ($_FILES['photo']['size'] > 0)) {
            $photo = "undefine.jpg";
            $emplacement_temporaire = $_FILES['photo']['tmp_name'];
            $nom_fichier = $_FILES['photo']['name'];
            $emplacement_destination = 'img/' . $nom_fichier;
            // var_dump($emplacement_temporaire);
            // var_dump($emplacement_destination);		
            $result = move_uploaded_file($emplacement_temporaire, $emplacement_destination);
            if ($result) {
                $photo = $nom_fichier;
            }
            $requete = $this->connexion->prepare("UPDATE user SET username = :username, password= :password,photo = :photo, nom= :nom, prenom= :prenom WHERE id= :id");
            $requete->bindParam(':photo', $photo);
        } else {
            $requete = $this->connexion->prepare("UPDATE user SET username = :username, password= :password, nom= :nom, prenom= :prenom WHERE id= :id");
        }

        $requete->bindParam(':id', $id);
        $requete->bindParam(':username', $username);
        $requete->bindParam(':password', $password);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $resultat = $requete->execute();

        // var_dump($resultat);
    }

    public function getUser()
    {
        $id = $_GET['id'];

        // var_dump($_GET);

        $requete = $this->connexion->prepare("SELECT * FROM `user` WHERE id=:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}
