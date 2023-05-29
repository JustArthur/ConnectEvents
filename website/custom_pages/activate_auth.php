<?php
    include_once('../../include.php');

    if(empty($_SESSION['utilisateur'])) {
        header('Location: ' . ROOT_PATH);
        exit();
    }

    $erreur = '';
    $code = random_int(1000, 9999);

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['verif_otp'])) {
            if(!empty($ch_1) && !empty($ch_2) && !empty($ch_3) && !empty($ch_4)) {
                $inputCode = $ch_1 . $ch_2 . $ch_3 . $ch_4;
    
                if($_SESSION['otp_code'] == $inputCode) {
                    OTPCodeActivated($_SESSION['utilisateur'][0]);
                    userLogInSession($_SESSION['utilisateur'][4]);

                    $_SESSION['verif_otp_before_logIn'] = false;

                    header('Location: ' . ROOT_PATH . 'website/pages/');
                    exit();

                } else {
                    $erreur = "Code pas bon.";
                }
            } else {
                $erreur = "Code vide.";
            }
        }

        if(isset($_POST['re_send_otp'])) {}
    }

    $_SESSION['otp_code'] = $code;

    $subject = 'Code d\'authentificateur à deux facteurs';
    $message = 'Bonjour, voici le code à saisir dans le formulaire : ' . $_SESSION['otp_code'];
    $headers = "Content-Type: text/plain; charset=utf-8\r\n";
    $headers .= "From: maxxxozou@gmail.com\r\n";

    sendMail($_SESSION['utilisateur'][4], $subject, $message, $headers);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/otp_form.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Confirmer l'A2F</title>
</head>
<body>
    <?php include_once('../src/navbar.php') ?>

    <div class="container_form">
        <form method="post">
            <h2>Entrez le code reçus par mail</h2>
            <?php if(!empty($erreur)) { ?><div class="erreur"><?= $erreur ?></div><?php } ?>
            <div class="input-field">
                <input type="text" name="ch_1" maxlength="1" />
                <input type="text" name="ch_2" maxlength="1" disabled />
                <input type="text" name="ch_3" maxlength="1" disabled />
                <input type="text" name="ch_4" maxlength="1" disabled />
            </div>

            <input type="submit" onkeydown="disableEnterKey(event)" id="verif_otp" name="verif_otp" class="submit-input" value="Vérifier le code">
            <input type="submit" onkeydown="disableEnterKey(event)" id="re_send_otp" name="re_send_otp" class="submit-input resend" value="Renvoyer un code">
        </form>
    </div>

    <script src="../javascript/otp_code.js"></script>
</body>
</html>