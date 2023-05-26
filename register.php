<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include_once('./include.php');

    $identifiant = '';
    $email = '';

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['inscription'])) {
            [$erreur, $identifiant, $email] = $_INSCRIPTION->inscription_user($identifiant, $email, $password, $conf_password);
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

    <title>Créer mon compte</title>
</head>
<body>
    <div class="left-container">
        <div class="container">

            <h3 class="logo">Connect<span class="bleu">Event</span></h3>

            <div class="textes">
                <h2 class="titre">Bienvenue parmi nous</h2>
                <p class="description">Merci de renseignez vos informations </p>
            </div>

            <form method="post" class="formulaire">

                <?php if(isset($erreur)) { ?><div class="erreur"><?= $erreur ?></div> <?php } ?>

                <div class="input-box">
                    <label for="identifiant" class="text-label">Identifiant</label>
                    <input required type="text" id="identifiant" name="identifiant" value="<?= $identifiant ?>" class="input" placeholder="Entrez votre identifiant">
                </div>

                <div class="input-box">
                    <label for="email" class="text-label">Adresse mail</label>
                    <input required type="email" id="email" name="email" value="<?= $email ?>" class="input" placeholder="Entrez votre adresse mail">
                </div>

                <div class="input-box">
                    <label for="password" class="text-label">Mot de passe</label>
                    <input required type="password" id="password" name="password" class="input" placeholder="Entrez votre mot de passe">
                </div>

                <div class="input-box">
                    <label for="conf_password" class="text-label">Confirmer le mot de passe</label>
                    <input required type="password" id="conf_password" name="conf_password" class="input" placeholder="Entrez de nouveau votre mot de passe">
                </div>

                <input type="submit" name="inscription" value="Créer mon compte" class="submit-input">

                <p class="info-compte">J'ai déjà un compte. <a href="login">Se connecter</a></p>
            </form>
        </div>
    </div>

    <div class="right-container">
        <img src="<?= ROOT_PATH ?>/public/public_img/bg-login-register.jpg">
    </div>
</body>
</html>