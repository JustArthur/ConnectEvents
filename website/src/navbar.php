<?php
    $profile_picture = profilPicture($_SESSION['utilisateur'][3], $_SESSION['utilisateur'][1]);
?>

<nav class="navbar">
    <h3 class="logo">Connect<span class="bleu">Events</span></h3>

    <div class="user_info">
        <a href="#" class="add_post">Créer un post<span class="material-symbols-outlined">add</span></a>
        <a href="../src/deconnexion.php" class="deco">Se déconnecter</a>
        <a href="#" class="pfp" style="background: url('<?= $profile_picture ?>');background-position: center; background-repeat: no-repeat; background-size: cover;"></a>
    </div>
</nav>