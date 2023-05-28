<?php
    $connecter = false;

    if(isset($_SESSION['utilisateur'])) {
        $connecter = true;
    }
?>

<nav class="navbar">
    <a class="logo" href="<?= ROOT_PATH ?>website/pages/"><h3>Connect<span class="bleu">Events</span></h3></a>

    <div class="user_info">
        <?php if($connecter) {?>

            <div class="btn_co">
                <a href="<?= ROOT_PATH ?>website/pages/add_post" class="add_post">Créer un post<span class="material-symbols-outlined">add</span></a>
                <a href="<?= ROOT_PATH ?>website/pages/profil" class="pfp" style="background: url('<?= $profile_picture ?>');background-position: center; background-repeat: no-repeat; background-size: cover;"></a>
            </div>

        <?php } else {?>

            <div class="btn_non_co">
                <a href="<?= ROOT_PATH ?>login" class="login">Se connecter</a>
                <a href="<?= ROOT_PATH ?>register" class="register">S'inscrire</a>
            </div>

        <?php } ?>
    </div>
</nav>