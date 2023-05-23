<?php
    include_once('../../include.php');

    $page = $_POST['page'];

    $limit = 5;

    $offset = ($page - 1) * $limit;

    $sql = $DB->prepare('SELECT blogposts.post_id, blogposts.title, blogposts.content, blogposts.user_id, blogposts.created_at, users.username, users.profile_photo FROM blogposts INNER JOIN users ON users.user_id = blogposts.user_id LIMIT :offset, :limit');
    $sql->bindValue(':offset', $offset, PDO::PARAM_INT);
    $sql->bindValue(':limit', $limit, PDO::PARAM_INT);
    $sql->execute();

    $output = '';

    if ($sql->rowCount() > 0) {
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $profilePictureBlog = profilPicture($row['profile_photo'], $row['username']);

            $usernamePost = htmlspecialchars($row['username']);
            $titlePost = htmlspecialchars($row['title']);
            $datePost = htmlspecialchars($row['created_at']);

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
                        <a href="" class="titre-blog">' . $titlePost . '</a>
                    </div>
                </div>

                <div class="date-blog">' . $formattedDate . ', il y a ' . $elapsedTime . '</div>
            </div>

            <div class="contenu-blog">'.
                $row['content']
            .'</div>
        </div>';
        }
    }

    echo $output;
?>
