<?php
    class addComment {

        public function ajouter_commentaire($post_id, $contenu, $userId) {

            insertCom($post_id, $contenu, $userId);

            header('Location: ' . ROOT_PATH . 'website/pages/page_post?post_id=' . $post_id);
            exit();

        }
    }
?>