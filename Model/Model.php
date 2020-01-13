<?php

abstract class Model
{
    /**
     * connexion a la BDD local
     */
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "testmvc";

// connexion à distance
// const SERVER ="sqlprive-pc2372-001.privatesql.ha.ovh.net";
// const USER = "cefiidev942";
// const PASSWORD = "H9hm2Qg7" ;
// const BASE = "cefiidev942";

    protected $connexion;

    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname=" . self::BASE, self::USER, self::PASSWORD);
            $this->connexion->exec("SET NAMES 'UTF8'");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

        /**
     * Récupération de l'ensemble des données de la base
     *
     * @return void
     */
    public function getCategories()
    {
        $requete = "SELECT * FROM category";
        $result = $this->connexion->query($requete);
        $listeCategories = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listeCategories;
    }
}
