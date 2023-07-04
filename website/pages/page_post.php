<?php
    include_once('../../include.php');

    if(isset($_SESSION['verif_otp_before_logIn']) && $_SESSION['verif_otp_before_logIn'] == true) {
        header('Location: ' . ROOT_PATH . 'website/custom_pages/activate_auth');
        exit();
    }

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['submit_comment'])) {
            $_ADDCOMMENT->ajouter_commentaire($_GET['post_id'], $contenu_post, $_SESSION['utilisateur'][0]);
        }
    }

    $sql = getPost($_GET['post_id']);
    $res = $sql->fetch();

    $profilePictureBlog = profilPicture($res['profile_photo'], $res['username']);

    $username = htmlspecialchars(trim($res['username']));
    $titrePost = htmlspecialchars(trim($res['title']));
    $contentPost = htmlspecialchars(trim($res['content']));
    $datePost = htmlspecialchars(trim($res['created_at']));

    $date_du_Post = getDatePost($datePost);


    $getNbrComment = getNbrComments($_GET['post_id']);
    $getNbrComment = $getNbrComment->fetch();

    $getComments = getComments($_GET['post_id']);
    $res_comment = $getComments->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/post.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title><?= $titrePost ?></title>
</head>
<body>
    <?php include_once('../src/navbar.php') ?>

    <div class="blogs">
        <div class="blog long">
            <div class="info-blog">
                <div class="user-info">
                    <img src="<?= $profilePictureBlog ?>" alt="" class="profil_blog">
    
                    <div class="informations">
                        <div class="nomPrenom"><?= $username ?></div>
                        <a class="titre-blog no_hover"><?= $titrePost ?></a>
                    </div>
                </div>
    
                <div class="date-blog"><?= $date_du_Post[0] ?>, il y a <?= $date_du_Post[1] ?></div>
            </div>
    
            <div class="contenu-blog"><?= $contentPost ?></div>
        </div>

        <?php if(!empty($_SESSION['utilisateur'])) {?>
            <form method="POST" class="section_add_comment">
                <textarea required maxlength="500" id="myTextarea" name="contenu_post" class="input" placeholder="Ajouter un commentaire..."></textarea>

                <div class="infos">
                    <span class="nbrChar"><span id="charCount">0</span> / 500</span>
                    <input type="submit" name="submit_comment" class="submit_comment" value="Ajouter le commentaire">
                </div>
            </form>
        <?php } ?>
    </div>

    <section class="comments">
        <h3><?= $getNbrComment['return_nbr_comments'] ?> Commentaire(s)</h3>

        <div class="comment_list">

        <?php if($getNbrComment['return_nbr_comments'] != 0) {
                foreach($res_comment as $commentaire) {              
                    $username_comment = htmlspecialchars(trim($commentaire['username']));
                    $profilPictureComment = profilPicture($commentaire['profile_photo'], $commentaire['username']);
                    $contentComment = htmlspecialchars(trim($commentaire['content'])); 
        ?>
            <div class="comment">
                <div class="user_info_comment">
                    <img src="<?= $profilPictureComment ?>" class="profil_comment">
        
                    <div class="informations">
                        <div class="nomPrenom"><?= $username_comment ?></div>
                    </div>
                </div>

                <div class="contenu_comment"><?= $contentComment ?></div>
            </div>
        <?php }
            }
        ?>
        </div>
    </section>


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