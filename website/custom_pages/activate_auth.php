<?php
    if(empty($_SESSION['utilisateur'])) {
        header('Location: ' . ROOT_PATH);
        exit();
    }

    sendMail()
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activer l'A2F sur mon compte</title>
</head>
<body>
    .container
</body>
</html>