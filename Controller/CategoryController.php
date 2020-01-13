<?php

include "View/CategoryView.php";
include "Model/CategoryModel.php";

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->view = new CategoryView();
        $this->model = new CategoryModel();
    }
/**
 * Construction de la page d'accueil
 *
 * @return void
 */
    public function start()
    {
        $model = new CategoryModel();
        $listeCategories = $model->getCategories();
        $this->view->home($listeCategories);
    }

/**
 * Ajouter news dans BDD
 *
 * @return void
 */
    public function addDB()
    {
        $this->model->addDB();
        header('location:index.php?controller=category');
    }
/**
 * Supprimer news dans la BDD
 *
 * @return void
 */
    public function suppDB()
    {
        $this->model->suppDB();
        header('location:index.php?controller=category');
    }

/**
 * Modifier news dans la BDD
 *
 * @return void
 */
public function updateForm()
{

    $new = $this->model->getCategory();
    $this->view->updateForm($new);
    
}

/**
 * Mise à jour de l'information dans la BDD
 *
 * @return void
 */
public function updateDB()
{
    $this->model->updateDB();
    header('location:index.php?controller=category');
}

public function addForm()
{
    $this->view->addForm();
}

}
