<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include_once('../../include.php');

    $_SESSION['user_token'] = generateToken();

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['send_mail'])) {

            $select_mail = getUserEmailByEmail($email);
            $select_mail = $select_mail->fetch();

            setUserToken($_SESSION['user_token'], $email);

            if(isset($select_mail['email'])) {

                $subject = 'Changer le mot de passe de votre compte ConnectEvent';
                $message = 'Bonjour, vous avez fait une demande pour changer votre mot de pasee, merci de cliquer sur ce lien : ' . ROOT_PATH . 'website/custom_pages/new_password?token=' . $_SESSION['user_token'];
    
                $headers = "Content-Type: text/plain; charset=utf-8\r\n";
                $headers .= "From: maxxxozou@gmail.com\r\n";

                if(sendMail($email, $subject, $message, $headers)) {
                    $erreur = "Le mail à bien été envoyé à l'adresse " . $email;
                } else {
                    $erreur = "Impossible d'envoyé le mail.";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../styles/login_register.css">
    <title>J'ai oublié mon mot de passe</title>
</head>
<body>
    <div class="left-container">
        <div class="container">

            <h3 class="logo">Connect<span class="bleu">Event</span></h3>

            <div class="textes">
                <h2 class="titre">Mot de passe oublié ?</h2>
                <p class="description">Pas de soucis un mail vous sera envoyé pour la rénitialisation de votre mot de passe</p>
            </div>

            <form method="post" class="formulaire">

                <?php if(isset($erreur)) { ?><div class="erreur"><?= $erreur ?></div> <?php } ?>

                <div class="input-box">
                    <label for="email" class="text-label">Adresse mail</label>
                    <input required type="email" id="email" name="email" class="input" placeholder="Entrez votre adresse mail">
                </div>

                <input type="submit" name="send_mail" value="Envoyer le mail" class="submit-input">

                <p class="info-compte">Je me souviens de mon mot de passe. <a href="../../login">Se connecter</a></p>
            </form>
        </div>
    </div>

    <div class="right-container">
        <img src="<?= ROOT_PATH ?>public/public_img/bg-login-register.jpg">
    </div>
</body>
</html>