<?php

include "View/SecurityView.php";
include "Model/SecurityModel.php";

class SecurityController extends Controller
{

    public function __construct()
    {
        $this->view = new SecurityView();
        $this->model = new SecurityModel();
    }
/**
 * Afficher le formulaire de login
 *
 * @return void
 */
    public function formLogin()
    {
        $this->view->addform();
    }

    /**
 * Afficher le formulaire de login
 *
 * @return void
 */
public function testLogin()
{
    $loginCorrect = $this->model->testLogin();
    if ($loginCorrect) {
        header('location:index.php?controller=new');
    }else{
        $this->view->addform();
    } 

}

    /**
 * Afficher le formulaire de login
 *
 * @return void
 */
public function logout()
{
    $this->model->logout();
    header('location:index.php?controller=new');
}




}
