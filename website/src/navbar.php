<?php
    $addPostPath = ROOT_PATH . 'website/pages/add_post';
    $logOutPath = ROOT_PATH . 'website/src/deconnexion';
    $index = ROOT_PATH . 'website/pages/';

    $connecter = false;

    if(isset($_SESSION['utilisateur'])) {
        $profile_picture = profilPicture($_SESSION['utilisateur'][3], $_SESSION['utilisateur'][1]);
        $connecter = true;
    }
?>

<nav class="navbar">
    <a class="logo" href="<?= $index ?>"><h3>Connect<span class="bleu">Events</span></h3></a>

    <div class="user_info">
        <?php if($connecter) {?>

            <a href="<?= $addPostPath ?>" class="add_post">Créer un post<span class="material-symbols-outlined">add</span></a>
            <a href="<?= $logOutPath ?>" class="deco">Se déconnecter</a>
            <a href="#" class="pfp" style="background: url('<?= $profile_picture ?>');background-position: center; background-repeat: no-repeat; background-size: cover;"></a>

        <?php } else {?>

            <div class="btn_co">
                <a href="<?= ROOT_PATH ?>" class="login">Se connecter</a>
                <a href="<?= ROOT_PATH ?>register" class="register">S'inscrire</a>
            </div>
            
        <?php } ?>
    </div>
</nav>