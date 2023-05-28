<?php
    class addPost {

        public function ajouter_post($titre, $contenu, $userId) {

            insertPost($titre, $contenu, $userId);

            header('Location: ' . ROOT_PATH . 'website/pages/');
            exit();

        }
    }
?>