<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include_once('include.php');

    if(isset($_SESSION['utilisateur'])) {
        header('Location: ' . ROOT_PATH . 'website/pages/');
        exit();
    }

    $email = '';

    $forgotPassword_Path = ROOT_PATH . 'website/custom_pages/forgot_password';

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['connexion'])) {
            [$erreur, $email] = $_CONNEXION->connexion_user($email, $password);
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles CSS -->
    <link rel="stylesheet" href="<?= ROOT_PATH ?>/styles/login_register.css">

    <title>Se connecter à mon compte</title>
</head>
<body>
    <div class="left-container">
        <div class="container">

            <h3 class="logo">Connect<span class="bleu">Event</span></h3>

            <div class="textes">
                <h2 class="titre">Bon retour parmi nous</h2>
                <p class="description">Merci de renseignez vos informations </p>
            </div>

            <form method="post" class="formulaire">

                <?php if(isset($erreur)) { ?><div class="erreur"><?= $erreur ?></div> <?php } ?>

                <div class="input-box">
                    <label for="email" class="text-label">Adresse mail</label>
                    <input required type="email" id="email" name="email" value="<?= $email ?>" class="input" placeholder="Entrez votre adresse mail">
                </div>

                <div class="input-box">
                    <label for="password" class="text-label">Mot de passe</label>
                    <input required type="password" id="password" name="password" class="input" placeholder="Entrez votre mot de passe">
                </div>

                <a href="<?= $forgotPassword_Path ?>" class="forgot-password">J'ai oublié mon mot de passe</a>

                <input type="submit" name="connexion" value="Connexion à mon compte" class="submit-input">

                <p class="info-compte">Je n’ai pas de compte. <a href="register">Se créer un compte</a></p>
            </form>
        </div>
    </div>

    <div class="right-container">
        <img src="<?= ROOT_PATH ?>/public/public_img/bg-login-register.jpg">
    </div>
</body>
</html>