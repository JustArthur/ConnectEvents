<?php
    $profile_picture = profilPicture($_SESSION['utilisateur'][3], $_SESSION['utilisateur'][1]);

    $addPostPath = ROOT_PATH . 'website/pages/add_post';
    $logOutPath = ROOT_PATH . 'website/src/deconnexion'
?>

<nav class="navbar">
    <a class="logo" href="website/pages/index"><h3>Connect<span class="bleu">Events</span></h3></a>

    <div class="user_info">
        <a href="<?= $addPostPath ?>" class="add_post">Créer un post<span class="material-symbols-outlined">add</span></a>
        <a href="<?= $logOutPath ?>" class="deco">Se déconnecter</a>
        <a href="#" class="pfp" style="background: url('<?= $profile_picture ?>');background-position: center; background-repeat: no-repeat; background-size: cover;"></a>
    </div>
</nav>