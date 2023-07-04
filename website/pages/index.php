<?php
    include_once('../../include.php');

    if(isset($_SESSION['verif_otp_before_logIn']) && $_SESSION['verif_otp_before_logIn'] == true) {
        header('Location: ' . ROOT_PATH . 'website/custom_pages/activate_auth');
        exit();
    }

    $countPost = countPostforError();
    $countPost = $countPost->fetch();
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

    <title>Accueil</title>
</head>
<body>
    <?php include_once('../src/navbar.php') ?>

    <?php if($countPost['return_count'] != 0) {?>

        <div class="blogs" id="content"></div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            var isLoading = false;
            var page = 1;

            $(document).ready(function() {
                loadData();

                $('#content').scroll(function() {
                if ($('#content').scrollTop() >= ($('#content')[0].scrollHeight - $('#content').height())) {
                    loadData();
                }
                });
            });

            function loadData() {
                if (isLoading) {
                    return;
                }

                isLoading = true;

                $.ajax({
                    url: '../../php/functions/getBlogs.php',
                    method: 'POST',
                    dataType: 'html',
                    data: { page: page },
                    success: function(response) {
                        $('#content').append(response);
                        page++;
                        isLoading = false;
                    }
                });
            }
        </script>
    <?php } else { ?>
        <div class="no_blog">
            <img src="../../public/public_img/error.png">
            <h3>Aucune publication trouvé</h3>
        </div>
    <?php } ?>
</body>
</html>