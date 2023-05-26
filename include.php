<?php
    session_start();
    
    //-- Import des class -----------------
    include_once('php/database/connexionBD.php');
    include_once('php/class/inscriptionClass.php');
    include_once('php/class/connexionClass.php');
    include_once('php/class/addPostClass.php');
    
    //-- Import des fonctions -----------------
    require_once('php/functions/functionsCode.php');
    require_once('php/functions/functionsSQL.php');
    require_once('php/functions/user_info.php');

    //-- Création des variable de class -----------------
    $_INSCRIPTION = new Inscription;
    $_CONNEXION = new Connexion;
    $_ADDPOST = new addPost;
?>