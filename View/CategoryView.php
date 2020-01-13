<?php



class CategoryView extends View
{

    /**
     * Construction de la page d'accueil
     *
     * @param [type] $listeCategories
     * @return void
     */
    public function home($listeCategories)
    {
        $this->page .= "<h2>Liste catégories</h2><br>";
        $this->page .= "<table class='table text-center'>
        <thead class='thead-dark'>
          <tr>
            <th scope='col'>Nom</th>
            <th scope='col'>Description</th>
            <th scope='col'>Modifier</th>
            <th scope='col'>Supprimer</th>
          </tr>
        </thead>
        <tbody class='text-center'>";
        foreach ($listeCategories as $news) {
            $this->page .=
                "<tr>
                <td>"
                . ucfirst($news['nom'])
                . "</td>
                 <td>"
                . $news['description']
                . "</td>
                <td><a href='index.php?controller=category&action=updateForm&id=" . $news['id'] . "'class='btn btn-warning'><i class='fas fa-pen'></i></a>
                </td>"
                . "<td><a href='index.php?controller=category&action=suppDB&id=" . $news['id'] . "'class='btn btn-danger' ><i class='fas fa-trash-alt'></i></a>
                </td>"
                . "</td>
                </tr>";
        }
        $this->page .= "</tbody>
        </table>";
        $this->page .= "<a href='index.php?controller=category&action=addForm' type='button' class='btn btn-success mb-3 ml-3 '><i class='fas fa-plus-circle'></i> Ajouter</a>";
        $this->displayPage();
    }

    /**
     * Ajout du formulaire 
     *
     * @return void
     */
    public function addForm()
    {
        $this->page .= file_get_contents("template/formCategory.html");
        $this->page = str_replace("{action}","addDB",$this->page);
        $this->page = str_replace("{id}","",$this->page);
        $this->page = str_replace("{nom}","",$this->page);
        $this->page = str_replace("{descrip}","",$this->page);
        $this->displayPage();
    }
    
    /**
     * Affichage du formulaire avec contenu à modifier
     *
     * @param [type] $new
     * @return void
     */
    public function updateForm($new)
    {
        // var_dump($new);
        $this->page .= "<h3>Modification de l'information</h3>";
        $this->page .= file_get_contents("template/formCategory.html");
        $this->page = str_replace("{action}","updateDB",$this->page);
        $this->page = str_replace("{id}",$new['id'],$this->page);
        $this->page = str_replace("{nom}",$new['nom'],$this->page);
        $this->page = str_replace("{descrip}",$new['description'],$this->page);
        $this->displayPage();
    }
}
