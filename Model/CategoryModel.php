<?php

class CategoryModel extends Model
{

    public function getCategory()
    {
        $id = $_GET['id'];

        

        $requete = $this->connexion->prepare("SELECT * FROM `category` WHERE id=:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $new = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($new);
        return $new;
    }

/**
 * Code SQL pour ajout en BDD
 *
 * @return void
 */
    public function addDB()
    {
        $nom = $_POST['nom'];
        $description = $_POST['descrip'];

        $requete = $this->connexion->prepare("INSERT INTO `category`(`id`, `nom`, `description`)
        VALUES (NULL, :nom, :description)");
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':description', $description);
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

        $requete = $this->connexion->prepare("DELETE FROM `category` WHERE id=:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        // var_dump($resultat);
    }

 

    public function updateDB()
    {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $description = $_POST['descrip'];

        $requete = $this->connexion->prepare("UPDATE category SET nom = :nom, description= :description WHERE id= :id");
        $requete->bindParam(':id', $id);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':description', $description);
        $resultat = $requete->execute();

        // var_dump($resultat);
    }
}
