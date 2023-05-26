<?php
    class Inscription {
        private $erreur;
        private $valid;

        private $banner;
        private $avatar;

        public function inscription_user($identifiant, $email, $password, $conf_password) {
            global $DB;


            $username = (String) htmlspecialchars(trim($identifiant));
            $email = (String) htmlspecialchars(trim($email));
            $password = (String) htmlspecialchars(trim($password));
            $conf_password = (String) htmlspecialchars(trim($conf_password));



            $this->erreur = (String) "";
            $this->valid = (boolean) true;

            $this->banner = (String) "";
            $this->avatar = (String) "";


            if(isset($username)) {
                $verif_user_exsite = $DB->prepare("SELECT user_id FROM users WHERE email = ?");
                $verif_user_exsite->execute([$email]);
                $verif_user_exsite = $verif_user_exsite->fetch();

                if(isset($verif_user_exsite['user_id'])) {
                    $this->valid = false;
                    $this->erreur = "Le mail est déjà utilisé";
                }

                $weakPasswords = ['password', '123456', 'qwerty', 'abc123', 'letmein', 'admin', 'welcome', '123456789', 'password123', 'iloveyou', 'sunshine', '1234567', '12345678', '1234567890', 'qwertyuiop', 'asdfghjkl', 'zxcvbnm', 'qwerty123', '987654321', 'passw0rd', 'football', 'baseball', 'soccer', 'monkey', '123123', 'hello', 'superman', 'qazwsx', 'michael', 'login', 'abc123', '1q2w3e4r', 'qwertyuiop', 'passw0rd', 'starwars', 'password1', '123qwe', '123456a', '1qaz2wsx', 'trustno1', 'princess', 'sunshine', 'password123', '123abc', 'welcome', 'admin', 'letmein', '123456789', 'football', 'iloveyou', '12345', 'qwerty123', '1234567', '12345678', 'qwerty12345', 'dragon', '1234', 'baseball', 'monkey', 'abcde', 'password!', '123', '1234567890', 'qazwsxedc', 'admin123', 'pass', '123456789a', 'qwertyu', '111111', '123abc!', '123456789!', 'a123456', 'letmein1', '000000', 'test', 'pass123', '123qwe!', '1234qwer', '987654321', '123123', 'qwe123', 'google', 'password!', 'internet', '12345qwert', 'qwerty123!', 'abcd1234', 'changeme', 'computer', 'password12', 'qwertyuio', '999999', 'zxcvbn', 'password1234', '123qweasd', 'q1w2e3r4t5', 'passw0rd1', 'sunshine1', 'qwe123!', 'admin1234', 'password!', 'password123!', 'qazwsx123', 'zaq1zaq1', 'zaqwsx', 'qweasdzxc', 'asdf1234', 'welcome1', 'qweasdzxc!'];              

                foreach($weakPasswords as $faiblePassword) {
                    if($faiblePassword == $password) {
                        $this->valid = false;
                        $this->erreur = 'Le mot de passe est trop faible';
                    }
                }

                if($password <> $conf_password) {
                    $this->valid = false;
                    $this->erreur = "Les mots de passe sont différents.";
                }

                if($this->valid) {
                    $crypt_password = password_hash($password, PASSWORD_BCRYPT);

                    switch (random_int(1,4)) {
                        case 1: $avatar = 'profile_picture_1.png';break;
                        case 2: $avatar = 'profile_picture_2.png';break;
                        case 3: $avatar = 'profile_picture_3.png';break;
                        case 4: $avatar = 'profile_picture_4.png';break;
                    }

                    switch (random_int(1, 4)) {
                        case 1: $banner = 'banner_1.jpg';break;
                        case 2: $banner = 'banner_2.jpg';break;
                        case 3: $banner = 'banner_3.jpg';break;
                        case 4: $banner = 'banner_4.jpg';break;
                    }

                    $_SESSION['user_token'] = generateToken();

                    $insert_user = $DB->prepare("INSERT INTO users (username, email, password, profile_photo, banner_image, reset_token) VALUES(?, ?, ?, ?, ?, ?);");
                    $insert_user->execute([$username, $email, $crypt_password, $avatar, $banner, $_SESSION['user_token']]);

                    $connexion_user = $DB->prepare("SELECT * FROM users WHERE email = ?");
                    $connexion_user->execute([$email]);
                    $connexion_user = $connexion_user->fetch();

                    $to = $email;
                    $subject = 'Activation de votre compte ConnectEvent';
                    $message = 'Bonjour, Merci de vous être inscrit à ConnectEvents ! Pour confimer votre compte merci de cliquez sur ce lien : http://127.0.0.1/ConnectEvents/website/account_activation';

                    $headers = "Content-Type: text/plain; charset=utf-8\r\n";
                    $headers .= "From: maxxxozou@gmail.com\r\n";

                    mail($to, $subject, $message, $headers);

                    $_SESSION['utilisateur'] = array(
                        htmlspecialchars($connexion_user['user_id']), //0
                        htmlspecialchars($connexion_user['username']), //1
                        htmlspecialchars($connexion_user['email']), //2
                        htmlspecialchars($connexion_user['profile_photo']), //3
                        htmlspecialchars($connexion_user['banner_image']) //4
                    );

                    header('Location: ' . ROOT_PATH . '/website/pages/');
                    exit();
                }
            }


            return [$this->erreur, $identifiant, $email];
        }
    }
?>