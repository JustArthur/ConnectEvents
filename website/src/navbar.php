<?php
    $profile_picture = profilPicture($_SESSION['utilisateur'][3], $_SESSION['utilisateur'][1]);
?>

<nav class="navbar">
    <a class="logo" href="http://127.0.0.1/ConnectEvents/website/pages/index"><h3>Connect<span class="bleu">Events</span></h3></a>

    <div class="user_info">
        <a href="http://127.0.0.1/ConnectEvents/website/pages/add_post" class="add_post">Créer un post<span class="material-symbols-outlined">add</span></a>
        <a href="http://127.0.0.1/ConnectEvents/website/src/deconnexion.php" class="deco">Se déconnecter</a>
        <a href="#" class="pfp" style="background: url('<?= $profile_picture ?>');background-position: center; background-repeat: no-repeat; background-size: cover;"></a>
    </div>
</nav>