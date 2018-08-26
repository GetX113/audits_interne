<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    
    public function index()
    {
        session_start();
        $clrAccueil = "#162e45";
        $affiches = $this->adminmodel->getAllAffiche();
        $total = $this->adminmodel->getTotalRecord("id_affiche", "affichage_accueil");
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';

    }

     public function login()
    {
        $status = "";
        if (isset($_POST["username"]) and isset($_POST["password"])) {
            $admin = $this->adminmodel->login($_POST["username"], md5($_POST["password"]));
            if (count($admin) > 0) {
                session_start();
                foreach ($admin as $ad) {
                    $_SESSION["username"] = $ad->username;
                    $_SESSION["password"] = $ad->password;
                    $_SESSION["nom"] = $ad->nom;
                    $_SESSION["prenom"] = $ad->prenom;
                    $_SESSION["fonction"] = $ad->fonctionnalite;
                    $_SESSION["id"] = $ad->id;
                }
                header('location: ' . URL . 'home/index');
            }else{
                $status = "Identifient ou Mot de passe incorrect !";
            }
        }
        
        require APP . 'view/home/login.php';
    }
    public function LogOut()
    {
        session_start();
        if (isset($_SESSION["username"])) {
            session_destroy();
            header('location: ' . URL);
        }else header('location: ' . URL);
    }


}
