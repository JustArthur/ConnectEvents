<?php

    include_once('../include.php');

    $user_token = $DB->prepare("SELECT reset_token FROM users WHERE email = ?");
    $user_token->execute([$_SESSION['user_token']]);
    $user_token = $user_token->fetch();

    if($_SESSION['user_token'] == $user_token || $_GET['token'] == $user_token) {

        $verified = $DB->prepare("UPDATE users SET reset_token = '', is_verified = 1 WHERE user_id = ?;");
        $verified->execute([$_SESSION['utilisateur'][0]]);

        header('Location: ./pages/index');
    } else {

        echo 'Votre email n\'a pas pu été vérifié.';
    }

?>