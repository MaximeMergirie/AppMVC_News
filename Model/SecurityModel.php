<?php

class SecurityModel extends Model
{

    public function testLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $requete = $this->connexion->prepare("SELECT * FROM `user` WHERE username =:username AND password= :password");
        $requete->bindParam(':username', $username);
        $requete->bindParam(':password', $password);
        $resultat = $requete->execute();
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($user);
        if ($user !=false) {
            $_SESSION['user']= $user;
            
        }
        return $user;
    }

    public function logout()
    {
        unset( $_SESSION['user']);
       
    }
}
