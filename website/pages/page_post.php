<?php
    include_once('../../include.php');

    if(empty($_SESSION['utilisateur'])) {
        header('Location: http://127.0.0.1/ConnectEvents/');
        exit;
    }

    $sql = $DB->prepare('SELECT blogposts.post_id, blogposts.title, blogposts.content, blogposts.user_id, blogposts.created_at, users.username, users.profile_photo FROM blogposts INNER JOIN users ON users.user_id = blogposts.user_id WHERE blogposts.post_id = :idPost');
    $sql->bindValue(':idPost', $_GET['post_id'], PDO::PARAM_INT);
    $sql->execute();
    $res = $sql->fetch();

    $profilePictureBlog = profilPicture($res['profile_photo'], $res['username']);

    $username = htmlspecialchars($res['username']);
    $titrePost = htmlspecialchars($res['title']);
    $contentPost = htmlspecialchars($res['content']);
    $datePost = htmlspecialchars($res['created_at']);

    $currentDateTime = new DateTime();
    $dateTimeToFormat = new DateTime($datePost);
    $formattedDate = $dateTimeToFormat->format('d / m / Y');
    $diff = $currentDateTime->diff($dateTimeToFormat);

    if($diff->y > 0) {
        $elapsedTime = $diff->y . ' an(s)';

    } elseif ($diff->m > 0) {
        $elapsedTime = $diff->m . ' mois';

    } elseif ($diff->d > 0) {
        $elapsedTime = $diff->d . ' jour(s)';

    } elseif ($diff->h > 0) {
        $elapsedTime = $diff->h . ' heure(s)';

    } elseif ($diff->i > 0) {
        $elapsedTime = $diff->i . ' minute(s)';

    } else {
        $elapsedTime = 'quelques secondes';
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/blog_card.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Document</title>
</head>
<body>
    <?php include_once('../src/navbar.php') ?>

    <div class="blogs">
        <div class="blog">
            <div class="info-blog">
                <div class="user-info">
                    <img src="<?= $profilePictureBlog ?>" alt="" class="profil_blog">
    
                    <div class="informations">
                        <div class="nomPrenom"><?= $username ?></div>
                        <a class="titre-blog no_hover"><?= $titrePost ?></a>
                    </div>
                </div>
    
                <div class="date-blog"><?= $formattedDate ?>, il y a <?= $elapsedTime ?></div>
            </div>
    
            <div class="contenu-blog"><?= $contentPost ?></div>
        </div>
    </div>
</body>
</html>