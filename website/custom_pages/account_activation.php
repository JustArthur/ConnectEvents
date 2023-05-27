<?php

    include_once('../include.php');

    $user_token = getTokenUserByEmail($email);
    $user_token = $user_token->fetch();

    if($_SESSION['user_token'] == $user_token || $_GET['token'] == $user_token) {

        is_verified($_SESSION['utilisateur'][0]);

        header('Location: ' . ROOT_PATH .'website/pages/index');
    } else {

        echo 'Votre email n\'a pas pu été vérifié.';
    }

?>