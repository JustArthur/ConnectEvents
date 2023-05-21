<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles CSS -->
    <link rel="stylesheet" href="./styles/login_register.css">

    <title>Créer mon compte</title>
</head>
<body>
    <div class="left-container">
        <div class="container">

            <h3 class="logo">Connect<span class="bleu">Event</span></h3>

            <div class="textes">
                <h2 class="titre">Bienvenue parmi nous</h2>
                <p class="description">Merci de renseignez vos informations </p>
            </div>

            <form method="post" class="formulaire">
                <div class="input-box">
                    <label for="identifiant" class="text-label">Identifiant</label>
                    <input type="text" id="identifiant" name="identifiant" class="input" placeholder="Entrez votre identifiant">
                </div>

                <div class="input-box">
                    <label for="email" class="text-label">Adresse mail</label>
                    <input type="email" id="email" name="email" class="input" placeholder="Entrez votre adresse mail">
                </div>

                <div class="input-box">
                    <label for="password" class="text-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="input" placeholder="Entrez votre mot de passe">
                </div>

                <div class="input-box">
                    <label for="conf-password" class="text-label">Confirmer le mot de passe</label>
                    <input type="password" id="conf-password" name="conf-password" class="input" placeholder="Entrez de nouveau votre mot de passe">
                </div>

                <input type="submit" name="inscription" value="Créer mon compte" class="submit-input">

                <p class="info-compte">J'ai déjà un compte. <a href="login">Se connecter</a></p>
            </form>
        </div>
    </div>

    <div class="right-container">
        <img src="./public/public_img/bg-login-register.jpg">
    </div>
</body>
</html>