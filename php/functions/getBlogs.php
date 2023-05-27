<?php
    include_once('../../include.php');

    $page = $_POST['page'];
    $limit = 4;
    $offset = ($page - 1) * $limit;

    $sql = getPostForBlog($offset, $limit);

    $output = '';

    if ($sql->rowCount() > 0) {
        while ($row = $sql->fetch()) {
            $profilePictureBlog = profilPicture($row['profile_photo'], $row['username']);

            $usernamePost = htmlspecialchars(trim($row['username']));
            $titlePost = htmlspecialchars(trim($row['title']));
            $datePost = htmlspecialchars(trim($row['created_at']));
            $contentPost = htmlspecialchars(trim($row['content']));

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

            $output .= '<div class="blog">
            <div class="info-blog">
                <div class="user-info">
                    <img src="' . $profilePictureBlog . '" alt="" class="profil_blog">
                    <div class="informations">
                        <div class="nomPrenom">' . $usernamePost . '</div>
                        <a href="http://127.0.0.1/ConnectEvents/website/pages/page_post?post_id='. $row['post_id'] .'" class="titre-blog">' . $titlePost . '</a>
                    </div>
                </div>

                <div class="date-blog">' . $formattedDate . ', il y a ' . $elapsedTime . '</div>
            </div>

            <div class="contenu-blog">'.
                $contentPost
            .'</div>
        </div>';
        }
    }

    echo $output;
?>
