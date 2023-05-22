<?php
    include_once('../../include.php');

    session_destroy();
    
    header('Location: http://127.0.0.1/ConnectEvents/');
    exit;
?>