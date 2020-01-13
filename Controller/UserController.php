<?php

include "View/UserView.php";
include "Model/UserModel.php";

class UserController extends Controller
{

    public function __construct()
    {
        $this->view = new UserView();
        $this->model = new UserModel();
    }
/**
 * Construction de la page d'accueil
 *
 * @return void
 */
    public function start()
    {
        $model = new UserModel();
        $listeUser = $model->getUsers();
        $this->view->home($listeUser);
    }

/**
 * Ajouter news dans BDD
 *
 * @return void
 */
    public function addDB()
    {
        $this->model->addDB();
        header('location:index.php?controller=user');
    }
/**
 * Ajout tilisateur à l'aide du formulaire
 *
 * @return void
 */
public function addForm()
{
    $this->view->addForm();
}


/**
 * Supprimer news dans la BDD
 *
 * @return void
 */
    public function suppDB()
    {
        $this->model->suppDB();
        header('location:index.php?controller=user');
    }

/**
 * Modifier news dans la BDD
 *
 * @return void
 */
public function updateForm()
{

    $user = $this->model->getUser();
    $this->view->updateForm($user);
    
}

/**
 * Mise à jour de l'information dans la BDD
 *
 * @return void
 */
public function updateDB()
{
    $this->model->updateDB();
    header('location:index.php?controller=user');
}



}
