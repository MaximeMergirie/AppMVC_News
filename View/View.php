<?php

abstract class View
{
    protected $page;

    /**
     * Ajout du head en html
     */
    public function __construct()
    {
        $this->page = file_get_contents("template/head.html");
        $this->page .= file_get_contents("template/nav.html");
    }

    /**
     * Ajout du footer 
     *
     * @return void
     */
    protected function displayPage()
    {
        $this->page .= file_get_contents("template/footer.html");
        if (isset($_SESSION['user'])) {
            $connect = "<a class='nav-link' href='index.php?controller=security&action=logout'><i class='fas fa-sign-out-alt'></i> Se déconnecter</a>";

            $optLog = "<li class='nav-item  {activeCategory}'>
            <a class='nav-link' href='index.php?controller=category'><i class='fas fa-clipboard-list'></i>
                Catégories</a>
        </li>
        <li class='nav-item {activeUser}'>
            <a class='nav-link ' href='index.php?controller=user'><i class='fas fa-user'></i>
                Utilisateurs</a>
        </li>";

        $infoUser="<img src='img/".$_SESSION['user']['photo']. "'class='rounded-circle' width='10%'>"."  ".ucfirst($_SESSION['user']['prenom'])." ".strtoupper($_SESSION['user']['nom']);
   
         }else{
             $connect = "<a class='nav-link ' href='index.php?controller=security&action=formLogin'><i class='fas fa-sign-in-alt'></i> S'authentifier</a>";
             $optLog = "";
             $infoUser="";
         }

         $this->page = str_replace("{optionConnect}",$connect,$this->page);
         $this->page = str_replace("{optionlogin}",$optLog,$this->page);
         $this->page = str_replace("{infoUser}",$infoUser,$this->page);

         /**
          * Gestion de la class active sur le menu
          */
         if (isset($_GET['controller'])) {
            
               if ($_GET['controller'] == "new") {
            $this->page = str_replace('{activeNews}','active',$this->page);
        }else {
            $this->page = str_replace('{activeNews}','',$this->page);
        }
        if ($_GET['controller'] == "category") {
            $this->page = str_replace('{activeCategory}','active',$this->page);
        }else {
            $this->page = str_replace('{activeCategory}','',$this->page);
        }
        if ($_GET['controller'] == "user") {
            $this->page = str_replace('{activeUser}','active',$this->page);
        }else {
            $this->page = str_replace('{activeUser}','',$this->page);
        }
        if ($_GET['controller'] == "security") {
            $this->page = str_replace('{activeLogin}','active',$this->page);
        }else {
            $this->page = str_replace('{activeLogin}','',$this->page);
        }

         }
        
        echo $this->page;
    }
}