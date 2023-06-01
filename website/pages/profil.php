<?php
    include_once('../../include.php');

    if(empty($_SESSION['utilisateur'])) {
        header('Location : ' . ROOT_PATH);
        exit();
    }

    if(isset($_SESSION['verif_otp_before_logIn']) && $_SESSION['verif_otp_before_logIn'] == true) {
        header('Location: ' . ROOT_PATH . 'website/custom_pages/activate_auth');
        exit();
    }

    $erreur = '';

    if(!empty($_POST)) {
        extract($_POST);

        if(isset($_POST['saveUserChanges'])) {
            [$erreur] = $_SAVE->sauvegarde_user($username, $email, $nom, $prenom, $last_password, $new_password, $new_conf_password, $_SESSION['utilisateur'][4], $_SESSION['utilisateur'][0]);
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/profil_user.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Profil de <?= $_SESSION['utilisateur'][3] ?></title>
</head>
<body id="body">
    <?php include_once('../src/navbar.php') ?>

    <div class="container_profile">
        <div class="banner_user">
            <img onclick="open_menu()" src="<?= $banner_picture ?>" class="banner">
            <img onclick="open_menu()" src="<?= $profile_picture ?>" class="profil_picture">
        </div>

        <form method="post" class="user_informations">
            <?php if(isset($erreur) && $erreur != '') { ?><div class="erreur"><?= $erreur ?></div> <?php } ?>

            <div class="settings_user settings">
                <h2 class="titre_compte">Paramètres utilisateur</h2>
                <div class="input-box">
                    <label for="username" class="text-label">Nom d'utilisateur</label>
                    <input type="text" id="input_text" name="username" value="<?= $_SESSION['utilisateur'][3] ?>" class="input" placeholder="Entrez votre nom d'utilisateur">
                </div>

                <div class="input-box">
                    <label for="email" class="text-label">Adresse mail</label>
                    <input type="email" id="input_text" name="email" value="<?= $_SESSION['utilisateur'][4] ?>" class="input" placeholder="Entrez votre adresse mail">
                </div>

                <div class="input-box">
                    <label for="nom" class="text-label">Nom</label>
                    <input type="text" id="input_text" name="nom" value="<?= $_SESSION['utilisateur'][1] ?>" class="input" placeholder="Entrez votre nom de famille">
                </div>

                <div class="input-box">
                    <label for="prenom" class="text-label">Prénom</label>
                    <input type="text" id="input_text" name="prenom" value="<?= $_SESSION['utilisateur'][2] ?>" class="input" placeholder="Entrez votre prénom">
                </div>
            </div>
            
            <div class="settings_security settings">
                <h2 class="titre_compte">Sécurité du compte</h2>
                <div class="input-box">
                    <label for="last_password" class="text-label">Ancien mot de passe</label>
                    <input type="password" id="input_text" name="last_password" class="input" placeholder="Entrez votre ancien mot de passe">
                    <a href="<?= ROOT_PATH ?>website/custom_pages/forgot_password">J'ai oublié mon mot de passe</a>
                </div>

                <div class="input-box">
                    <label for="new_password" class="text-label">Nouveau mot de passe</label>
                    <input type="password" id="input_text" name="new_password" class="input" placeholder="Entrez votre nouveau mot de passe">
                </div>

                <div class="input-box">
                    <label for="new_conf_password" class="text-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" id="input_text" name="new_conf_password" class="input" placeholder="Entrez de nouveau votre nouveau mot de passe">
                </div>

                <div class="input-box">
                    <?php if($_SESSION['utilisateur'][8] == 0) {?>
                        <a id="otp_lien" href="<?= ROOT_PATH ?>website/custom_pages/activate_auth" class="submit-input">Activer l'authentificateur à deux facteurs (A2F)</a>
                    <?php } else {?>
                        <a id="otp_lien" href="<?= ROOT_PATH ?>website/custom_pages/desactivate_auth" class="submit-input desactivate">Désactiver l'authentificateur à deux facteurs (A2F)</a>
                    <?php } ?>
                </div>

                <input type="submit" name="saveUserChanges" value="Sauvegarder les changements" class="submit-input save">
            </div>

            <div class="settings_deco settings">
                <div class="input-box">
                <a href="<?= ROOT_PATH ?>website/src/deconnexion" class="submit-input desactivate">Se déconnecter de mon compte</a>
                </div>
            </div>
        </form>
    </div>

    <div class="new_images" id="image_div">
        <form method="post" class="box" enctype="multipart/form-data">
            <h2>Changer les images</h2>
            <div class="input-box">
                <label for="avatar" class="text-label">Changer l'avatar</label>
                <input type="file" name="avatar">
            </div>

            <div class="input-box">
                <label for="banner" class="text-label">Changer la bannière</label>
                <input type="file" name="banner">
            </div>

            <input type="submit" name="saveImagesChange" value="Sauvegarder les changements" class="submit-input save">
        </form>
    </div>

    <script src="../javascript/confirmSave.js"></script>
    <script>
        function open_menu() {
            const box = document.getElementById('image_div'),
                body = document.getElementById('body');

            if (box.classList.contains('active')) {
                box.classList.remove('active')
                body.style.overflow = 'scroll';

            } else {
                box.classList.add('active')
                body.style.overflow = 'hidden';
            }
        }
    </script>
</body>
</html>