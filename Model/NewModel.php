<?php

class NewModel extends Model
{

    /**
     * Récupération de l'ensemble des données de la base
     *
     * @return void
     */
    public function getNews()
    {
        $requete =
            "SELECT news.*,
        category.id as id_category,
        category.description as description_category,
        category.nom as nom_category
        FROM news
        LEFT JOIN `category`
        ON news.category=category.id";
        $result = $this->connexion->query($requete);
        $listeNews = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listeNews;
    }
    /**
     * Code SQL pour ajouter en BDD
     *
     * @return void
     */
    public function addDB()
    {
        $titre = $_POST['titre'];
        $description = $_POST['descrip'];
        $category = $_POST['categorie'];
        if (empty($category)) {
            $category = NULL;
        }
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
        $requete = $this->connexion->prepare("INSERT INTO `news`(`id`, `titre`,`photo`, `description`,`category`)
        VALUES (NULL, :titre,:photo, :description, :category)");
        $requete->bindParam(':titre', $titre);
        $requete->bindParam(':photo', $photo);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':category', $category);
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

        $requete = $this->connexion->prepare("DELETE FROM `news` WHERE id=:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        // var_dump($resultat);
    }

    public function getNew()
    {
        $id = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT * FROM `news` WHERE id=:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $new = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($new);
        return $new;
    }

    public function updateDB()
    {
        $id = $_POST['id'];
        $titre = $_POST['titre'];
        $description = $_POST['descrip'];
        $category = $_POST['categorie'];
        if (empty($category)) {
            $category = NULL;
        }

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

            $requete = $this->connexion->prepare
            ("UPDATE news SET titre = :titre, photo= :photo, description= :description, category =:category WHERE id= :id");
            $requete->bindParam(':photo', $photo);
        } else {
            $requete = $this->connexion->prepare
            ("UPDATE news SET titre = :titre, description= :description, category =:category WHERE id= :id");
        }

        $requete->bindParam(':id', $id);
        $requete->bindParam(':titre', $titre);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':category', $category);
        $resultat = $requete->execute();

        // var_dump($resultat);
    }
}
