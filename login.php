<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles CSS -->
    <link rel="stylesheet" href="./styles/login_register.css">

    <title>Se connecter à mon compte</title>
</head>
<body>
    <div class="left-container">
        <div class="container">

            <h3 class="logo">Connect<span class="bleu">Event</span></h3>

            <div class="textes">
                <h2 class="titre">Bon retour parmi nous</h2>
                <p class="description">Merci de renseignez vos informations </p>
            </div>

            <form method="post" class="formulaire">

                <div class="input-box">
                    <label for="email" class="text-label">Adresse mail</label>
                    <input type="email" id="email" name="email" class="input" placeholder="Entrez votre adresse mail">
                </div>

                <div class="input-box">
                    <label for="password" class="text-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="input" placeholder="Entrez votre mot de passe">
                </div>

                <a href="php/functions/forgot_password.php" class="forgot-password">J'ai oublié mon mot de passe</a>

                <input type="submit" name="connexion" value="Connexion à mon compte" class="submit-input">

                <p class="info-compte">Je n’ai pas de compte. <a href="register">Se créer un compte</a></p>
            </form>
        </div>
    </div>

    <div class="right-container">
        <img src="./public/public_img/bg-login-register.jpg">
    </div>
</body>
</html>