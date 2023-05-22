<?php
    include_once('../../include.php');

    if(empty($_SESSION['utilisateur'])) {
        header('Location: http://127.0.0.1/ConnectEvents/');
        exit;
    }

    var_dump($_SESSION['utilisateur']);
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="deconnexion">Se déconnecter</a>
</body>
</html>