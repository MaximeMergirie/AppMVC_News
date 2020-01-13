<?php

class UserView extends View
{

    /**
     * Construction de la page d'accueil
     *
     * @param [type] $$listeUsers
     * @return void
     */
    public function home($listeUser)
    {
        $this->page .= "<h2>Liste catégories</h2><br>";
        $this->page .= "<table class='table text-center'>
        <thead class='thead-dark'>
          <tr>
            <th scope='col'width='10%'>ID</th>
            <th scope='col'width='15%'>Username</th>
            <th scope='col'width='15%'>Password</th>
            <th scope='col'width='20%' >Photo</th>
            <th scope='col'width='10%'>Nom</th>
            <th scope='col'width='10%'>Prénom</th>
            <th scope='col'width='10%'>Modifier</th>
            <th scope='col'width='10%'>Supprimer</th>
          </tr>
        </thead>
        <tbody class='text-center'>";
        foreach ($listeUser as $user) {
            $this->page .=
                "<tr>
                <td class='align-middle'>"
                . $user['id']
                . "</td>
                 <td class='align-middle'>"
                . $user['username']
                . "</td>
                <td class='align-middle'>"
                . $user['password']
                . "</td>
                <td >
                <img src='img/".$user['photo']."'alt='' class='rounded-circle' width='50%'>
                </td>
                <td class='align-middle'>"
                . strtoupper($user['nom'])
                . "</td>
                <td class='align-middle'>"
                . $user['prenom']
                . "</td >
                <td class='align-middle'><a href='index.php?controller=user&action=updateForm&id=" . $user['id'] . "'class='btn btn-warning'><i class='fas fa-pen'></i></a>
                </td>"
                . "<td class='align-middle'><a href='index.php?controller=user&action=suppDB&id=" . $user['id'] . "'class='btn btn-danger' ><i class='fas fa-trash-alt'></i></a>
                </td>"
                . "</td>
                </tr>";
        }
        $this->page .= "</tbody>
        </table>";
        $this->page .= "<a href='index.php?controller=user&action=addForm' type='button' class='btn btn-success mb-3 ml-3 '><i class='fas fa-plus-circle'></i> Ajouter</a>";
        $this->displayPage();
    }

    /**
     * Ajout du formulaire 
     *
     * @return void
     */
    public function addForm()
    {
        $this->page .= file_get_contents("template/formUser.html");
        $this->page = str_replace("{action}","addDB",$this->page);
        $this->page = str_replace("{id}","",$this->page);
        $this->page = str_replace("{username}","",$this->page);
        $this->page = str_replace("{password}","",$this->page);
        $this->page = str_replace("{nom}","",$this->page);
        $this->page = str_replace("{prenom}","",$this->page);
        $this->displayPage();
    }
    
    /**
     * Affichage du formulaire avec contenu à modifier
     *
     * @param [type] $new
     * @return void
     */
    public function updateForm($user)
    {
        $this->page .= "<h3>Modification de l'information</h3>";
        $this->page .= file_get_contents("template/formUser.html");
        $this->page = str_replace("{action}","updateDB",$this->page);
        $this->page = str_replace("{id}",$user['id'],$this->page);
        $this->page = str_replace("{username}",$user['username'],$this->page);
        $this->page = str_replace("{password}",$user['password'],$this->page);
        $this->page = str_replace("{nom}",$user['nom'],$this->page);
        $this->page = str_replace("{prenom}",$user['prenom'],$this->page);
        $this->displayPage();
    }
}
