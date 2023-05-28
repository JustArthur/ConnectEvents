<?php
    include_once('../../include.php');

    session_destroy();
    
    header('Location: ' . ROOT_PATH . 'website/pages/');
    exit;
?>