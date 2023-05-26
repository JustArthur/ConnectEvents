<?php
    class addPost {

        public function ajouter_post($titre, $contenu, $userId) {

            global $DB;

            $titre = (String) htmlspecialchars(trim($titre));
            $contenu = (String) htmlspecialchars(trim($contenu));
            $userId = (Int) htmlspecialchars(trim($userId));

            $insert_blog = $DB->prepare('INSERT INTO blogposts (title, content, user_id) VALUES(?, ?, ?)');
            $insert_blog->execute([$titre, $contenu, $userId]);

            header('Location: http://127.0.0.1/ConnectEvents/website/pages/index');

        }
    }
?>