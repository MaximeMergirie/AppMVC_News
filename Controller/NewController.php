<?php

include "View/NewView.php";
include "Model/NewModel.php";

class NewController extends Controller
{

    public function __construct()
    {
        $this->view = new NewView();
        $this->model = new NewModel();
    }
/**
 * Construction de la page d'accueil
 *
 * @return void
 */
    public function start()
    {
        $model = new NewModel();
        $listeNews = $model->getNews();

        $this->view->home($listeNews);
    }
/**
 * Ajouter news dans BDD
 *
 * @return void
 */
    public function addDB()
    {
        $this->model->addDB();
        header('location:index.php?controller=new');
    }
/**
 * Supprimer news dans la BDD
 *
 * @return void
 */
    public function suppDB()
    {
        $this->model->suppDB();
        header('location:index.php?controller=new');
    }

/**
 * Modifier news dans la BDD
 *
 * @return void
 */
public function updateForm()
{

    $listeCatgories = $this->model->getCategories();
    $new = $this->model->getNew();
    $this->view->updateForm($new,$listeCatgories);
}

/**
 * Mise à jour de l'information dans la BDD
 *
 * @return void
 */
public function updateDB()
{
    $this->model->updateDB();
    header('location:index.php?controller=new');
}

/**
 * Formulaire d'ajout
 *
 * @return void
 */
public function addForm()
{   
    $listeCatgories = $this->model->getCategories();
    $this->view->addForm($listeCatgories);
}

public function  modal()
{
    $new = $this->model->getNew();
    $this->view->modal($new);
}


}
