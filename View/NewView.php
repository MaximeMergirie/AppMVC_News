<?php

class NewView extends View
{

    /**
     * Construction de la page d'accueil
     *
     * @param [type] $listeNews
     * @return void
     */
    public function home($listeNews)
    {
        //Visuel admin accès total
        if (isset($_SESSION['user'])) {
            $this->page .= "<h2>News du Jeudi 9 janvier 2020</h2><br>";
            $this->page .= "<div class='table-responsive'> <table class='table text-center '>
        <thead class='thead-dark'>
          <tr>
            <th scope='col'>Titre</th>
            <th scope='col'>Photo</th>
            <th scope='col'>Description</th>
            <th scope='col'>Catégorie</th>
            <th scope='col'>Lire</th>
            <th scope='col'>Modifier</th>
            <th scope='col'>Supprimer</th>
          </tr>
        </thead>
        <tbody class='text-center'>";
            foreach ($listeNews as $news) {
                $this->page .=
                    "<tr>
                <th scope='row' class='align-middle'>"
                    . ucfirst($news['titre'])
                    . "</th>
                <td>
                <img src='img/".$news['photo']."' alt='' class='img-fluid img-thumbnail' width='60%'>
                </td>
                <td class='align-middle'>"
                    . substr($news['description'],0,50)."..."
                    . "</td>
                <td class='align-middle'>"
                    . $news['description_category']
                    . "</td>
                <td class='align-middle'><a href='index.php?controller=new&action=modal&id=" . $news['id'] . "'class='btn btn-primary'><i class='far fa-eye'></i></a>
                </td>
                <td class='align-middle'><a href='index.php?controller=new&action=updateForm&id=" . $news['id'] . "'class='btn btn-warning'><i class='fas fa-pen'></i></a>
                </td>"
                    . "<td class='align-middle'><a href='index.php?controller=new&action=suppDB&id=" . $news['id'] . "'class='btn btn-danger' ><i class='fas fa-trash-alt'></i></a>
                </td>"
                    . "</td>
                </tr>";
            }
            $this->page .= "</tbody>
        </table></div>";
            $this->page .= "<a href='index.php?controller=new&action=addForm' type='button' class='btn btn-success mb-3 ml-3'>+ Ajouter News</a>";
            $this->displayPage();
        } else {

            //Visuel visiteur accès partiel
            $this->page .= "<h2>News du Jeudi 9 janvier 2020</h2><br>";
            $this->page .= "<div class='table-responsive'><table class='table text-center'>
        <thead class='thead-dark'>
          <tr>
            <th scope='col'>Titre</th>
            <th scope='col'>Photo</th>
            <th scope='col'>Description</th>
            <th scope='col'>Catégorie</th>
            <th scope='col'>Lire</th>
          </tr>
        </thead>
        <tbody class='text-center'>";
            foreach ($listeNews as $news) {
                $this->page .=
                    "<tr >
                    <th scope='row' class='align-middle'>"
                    . ucfirst($news['titre'])
                    . "</th>
                    <td>
                    <img src='img/".$news['photo']."'alt='' class='img-fluid img-thumbnail' width='60%'>
                    </td>
                    <td class='align-middle'>"
                        . substr($news['description'],0,50)."..."
                        . "</td>
                    <td class='align-middle'>"
                    . $news['description_category']
                    . "</td>
                <td class='align-middle'><a href='index.php?controller=new&action=modal&id=" . $news['id'] . "'class='btn btn-warning'><i class='far fa-eye'></i></a>
                </td></tr>";
            }
            $this->page .= "</tbody>
        </table></div>";
            $this->displayPage();
        }
    }
    /**
     * Ajout du formulaire 
     *
     * @return void
     */
    public function addForm($listeCategories)
    {
        $this->page .= "<h3>Ajouter une news</h3>";
        $this->page .= file_get_contents("template/formNew.html");
        $this->page = str_replace("{action}", "addDB", $this->page);
        $this->page = str_replace("{id}", "", $this->page);
        $this->page = str_replace("{titre}", "", $this->page);
        $this->page = str_replace("{descrip}", "", $this->page);
        $categories = "";
        foreach ($listeCategories as $category) {
            $categories .= "<option value='" . $category['id'] . "'>".$category["description"]. "</option>";
        }
        $this->page = str_replace("{categorie}", $categories, $this->page);
        $this->displayPage();
    }

    /**
     * Affichage du formulaire avec contenu à modifier
     *
     * @param [type] $new
     * @return void
     */
    public function updateForm($new, $listeCategories)
    {
        // var_dump($new);
        $this->page .= "<h3 class='text-center'>Modification de l'information</h3>";
        $this->page .= file_get_contents("template/formNew.html");
        $this->page = str_replace("{action}", "updateDB", $this->page);
        $this->page = str_replace("{id}", $new['id'], $this->page);
        $this->page = str_replace("{titre}", $new['titre'], $this->page);
        $this->page = str_replace("{descrip}", $new['description'], $this->page);
        $categories = "";
        foreach ($listeCategories as $category) {
            if ($category['id'] == $new["category"]) {
                $categories .= " <option value='" . $category['id'] . "'selected>" .$category["description"]. "</option>";
            } else {
                $categories .=  " <option value='" . $category['id'] . "'>" .$category["description"]. "</option>";
            }
        }
        $this->page = str_replace("{categorie}", $categories, $this->page);
        $this->displayPage();
    }

    public function modal($new)
    {
        $this->page .= file_get_contents("template/modal.html");
        $this->page = str_replace("{titre}", ucfirst($new['titre']), $this->page);
        $this->page = str_replace("{photo}", $new['photo'], $this->page);
        $this->page = str_replace("{descrip}", $new['description'], $this->page);
        $this->displayPage();
    }
}
