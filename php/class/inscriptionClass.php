<?php
    class Inscription {
        private $erreur;
        private $valid;

        private $banner;
        private $avatar;

        public function inscription_user($identifiant, $email, $password, $conf_password) {

            $username = (String) htmlspecialchars($identifiant,ENT_QUOTES);
            $email = (String) htmlspecialchars($email,ENT_QUOTES);
            $password = (String) htmlspecialchars($password,ENT_QUOTES);
            $conf_password = (String) htmlspecialchars($conf_password,ENT_QUOTES);


            $this->erreur = (String) "";
            $this->valid = (boolean) true;

            $this->banner = (String) "";
            $this->avatar = (String) "";


            if(isset($username)) {
                $verif_user_exsite = getUserIdByEmail($email);
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

                    insertUser($username, $email, $crypt_password, $avatar, $banner, $_SESSION['user_token']);

                    userLogInSession($email);

                    header('Location: ' . ROOT_PATH . 'website/pages/');
                    exit();
                }
            }


            return [$this->erreur, $identifiant, $email];
        }
    }
?>