<?php
    session_start();
    define('ROOT_PATH', '/ConnectEvents/');
    
    include_once('php/database/connexionBD.php');
    include_once('php/class/inscriptionClass.php');
    include_once('php/class/connexionClass.php');
    include_once('php/class/addPostClass.php');
    include_once('php/class/saveUserInformation.php');
    include_once('php/class/addComment.php');
    
    require_once('php/functions/functionsCode.php');
    require_once('php/functions/functionsSQL.php');

    $_INSCRIPTION = new Inscription;
    $_CONNEXION = new Connexion;
    $_ADDPOST = new addPost;
    $_SAVE = new Sauvegarder;
    $_ADDCOMMENT = new addComment;

    if(!empty($_SESSION['utilisateur'])) {
        $profile_picture = profilPicture($_SESSION['utilisateur'][5], $_SESSION['utilisateur'][1]);
        $banner_picture = bannerPicture($_SESSION['utilisateur'][6], $_SESSION['utilisateur'][1]);
    }
?>