<?php
    include_once('../../include.php');

    if(empty($_SESSION['utilisateur'])) {
        header('Location : ' . ROOT_PATH);
        exit();
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
<body>
    <?php include_once('../src/navbar.php') ?>

    <div class="container_profile">
        <div class="banner_user">
            <img src="<?= $banner_picture ?>" alt="" class="banner">
            <img src="<?= $profile_picture ?>" alt="" class="profil_picture">
        </div>

        <from class="user_informations">
            <div class="settings_user settings">
                <h2 class="titre_compte">Paramètres utilisateur</h2>
                <div class="input-box">
                    <label for="username" class="text-label">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" value="<?= $_SESSION['utilisateur'][3] ?>" class="input" placeholder="Entrez votre nom d'utilisateur">
                </div>

                <div class="input-box">
                    <label for="email" class="text-label">Adresse mail</label>
                    <input type="email" id="email" name="email" value="<?= $_SESSION['utilisateur'][4] ?>" class="input" placeholder="Entrez votre adresse mail">
                </div>

                <div class="input-box">
                    <label for="nom" class="text-label">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= $_SESSION['utilisateur'][1] ?>" class="input" placeholder="Entrez votre nom de famille">
                </div>

                <div class="input-box">
                    <label for="prenom" class="text-label">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?= $_SESSION['utilisateur'][2] ?>" class="input" placeholder="Entrez votre prénom">
                </div>
            </div>
            
            <div class="settings_security settings">
                <h2 class="titre_compte">Sécurité du compte</h2>
                <div class="input-box">
                    <label for="last_password" class="text-label">Ancien mot de passe</label>
                    <input type="password" id="last_password" name="last_password" class="input" placeholder="Entrez votre ancien mot de passe">
                </div>

                <div class="input-box">
                    <label for="new_password" class="text-label">Nouveau mot de passe</label>
                    <input type="password" id="new_password" name="new_password" class="input" placeholder="Entrez votre nouveau mot de passe">
                </div>

                <div class="input-box">
                    <label for="new_conf_password" class="text-label">Confirmer le nouveau mot de passe</label>
                    <input type="text" id="new_conf_password" name="new_conf_password" class="input" placeholder="Entrez de nouveau votre nouveau mot de passe">
                </div>

                <div class="input-box">
                    <?php if($_SESSION['utilisateur'][8] == 0) {?>
                        <a href="<?= ROOT_PATH ?>website/custom_pages/activate_auth" class="submit-input">Activer l'authentificateur à deux facteurs (A2F)</a>
                    <?php } else {?>
                        <a href="<?= ROOT_PATH ?>website/custom_pages/desactivate_auth" class="submit-input desactivate">Désactiver l'authentificateur à deux facteurs (A2F)</a>
                    <?php } ?>
                </div>
            </div>

            <div class="settings_deco settings">
                <div class="input-box">
                <a href="<?= ROOT_PATH ?>website/src/deconnexion" class="submit-input desactivate">Se déconnecter de mon compte</a>
                </div>
            </div>
        </from>
    </div>
</body>
</html>