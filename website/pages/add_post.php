<?php
    include_once('../../include.php');

    if(empty($_SESSION['utilisateur'])) {
        header('Location: ' . ROOT_PATH);
        exit;
    }

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['add_post'])) {
            $_ADDPOST->ajouter_post($titre_post, $contenu_post, $_SESSION['utilisateur'][0]);
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
    <link rel="stylesheet" href="../../styles/add_post.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Document</title>
</head>
<body>
    <?php include_once('../src/navbar.php') ?>

    <form method="POST" class="formulaire">
        <h2 class="titre">Ajouter un post</h2>

        <div class="input-box">
            <label for="titre_post" class="text-label">Titre du post</label>
            <input required type="titre_post" id="titre_post" name="titre_post" class="input" placeholder="Entrez le titre de votre post">
        </div>

        <div class="input-box">
            <label for="contenu_post" class="text-label">Contenu du post</label>
            <textarea required maxlength="1000" type="contenu_post" id="myTextarea" name="contenu_post" class="textarea" placeholder="Entrez le contenu de votre post"></textarea>
            <span class="nbrChar"><span id="charCount">0</span> / 1000</span>
        </div>

        <input type="submit" name="add_post" value="Ajouter le post" class="submit-input">
    </form>

    <script>
        const textarea = document.getElementById('myTextarea');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', function() {
            const textLength = textarea.value.length;
            charCount.textContent = textLength;
        });
    </script>
</body>
</html>