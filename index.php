<?php

session_start();

include 'View/View.php';
include "Model/Model.php";
include "Controller/Controller.php";
include "Controller/NewController.php";
include "Controller/CategoryController.php";
include "Controller/UserController.php";
include "Controller/SecurityController.php";

$paramGet = extractParameters();
$controller = $paramGet['controller'];
$action = $paramGet['action'];

$controller = new $controller();

$controller->$action();

/**
 * Cette fonction permet d'extraire le contrôleur et l'action à lancer
 * à partir des informations reçues via l'URL et en tenant comptes des 
 * restrictions selon l'authentification de l'utilisateur
 *
 * @return array tableau contenant le contrôleur et l'action 
 */
function extractParameters()
{

    $controllerNotAuth = ['NewController', 'SecurityController'];
    $actionNotAuth = ['start', 'modal', 'formLogin', 'testLogin'];

    /**
     * récupération des données de l'url
     */
    if (isset($_GET['controller'])) {
        $controller = ucfirst($_GET['controller']) . "Controller";
    } else {
        $controller = 'NewController';
    }

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'start';
    }

    /**
     * validation selon les droits établis si l'utilisateur n'est pas authentifié
     */
    if (!isset($_SESSION['user'])) {
        if (!in_array($controller, $controllerNotAuth) || !in_array($action, $actionNotAuth)) {
            $controller = 'SecurityController';
            $action = "formLogin";
        }
    }

    return (['controller' => $controller, 'action' => $action]);
}


