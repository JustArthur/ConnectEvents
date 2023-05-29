<?php
    class Sauvegarder {

        private $erreur;
        private $valid;

        public function sauvegarde_user($username, $email, $nom, $prenom, $last_password, $new_password, $new_conf_password, $last_email, $userId) {

            $username = (String) htmlspecialchars(trim($username));
            $email = (String) htmlspecialchars(trim($email));
            $nom = (String) htmlspecialchars(trim($nom));
            $prenom = (String) htmlspecialchars(trim($prenom));
            $last_password = (String) htmlspecialchars(trim($last_password));
            $new_password = (String) htmlspecialchars(trim($new_password));
            $new_conf_password = (String) htmlspecialchars(trim($new_conf_password));

            $this->erreur = (String) "";
            $this->valid = (boolean) true;

            $userInformation_BDD = userInformation($last_email);
            $userInformation_BDD = $userInformation_BDD->fetch();

            //-- Vérifie si l'adresse mail est libre ------------
            if($userInformation_BDD['email'] != $email) {
                $verif_email = getUserIdByEmail($email);

                if(isset($verif_email['user_id'])) {
                    $this->erreur = 'Adresse mail déjà utilisé.';

                } else {
                    changeEmail($email, $userId);
                }
            }

            //-- Vérifie si le username est libre ------------
            if($userInformation_BDD['username'] != $username) {
                $verif_username = getUserIdByUsername($username);
                $verif_username = $verif_username->fetch();

                if(isset($verif_username['user_id'])) {
                    $this->erreur = 'Nom d\'utilisateur déjà utilisé.';

                } else {
                    changeUsername($username, $userId);
                }
            }

            //-- Vérifie si le nom de famille doit être changé ------------
            if(!empty($nom)) {
                if($nom != $userInformation_BDD['last_name']) {
                    changeNom($nom, $userId);
                }
            }

            //-- Vérifie si le prénom doit être changé ------------
            if(!empty($prenom)) {
                if($prenom != $userInformation_BDD['first_name']) {
                    changePrenom($prenom, $userId);
                }
            }

            //-- Vérifie si le mot de passe doit être changé ------------
            if(!empty($last_password)) {
                if(!empty($new_password)) {
                    if(!empty($new_conf_password)) {

                        if(!password_verify($last_password, $userInformation_BDD['password'])) {
                            $this->erreur = 'Le mot de passe actuel est incorect.';
                            $this->valid = false;

                        } else {
                            $weakPasswords = ['password', '123456', 'qwerty', 'abc123', 'letmein', 'admin', 'welcome', '123456789', 'password123', 'iloveyou', 'sunshine', '1234567', '12345678', '1234567890', 'qwertyuiop', 'asdfghjkl', 'zxcvbnm', 'qwerty123', '987654321', 'passw0rd', 'football', 'baseball', 'soccer', 'monkey', '123123', 'hello', 'superman', 'qazwsx', 'michael', 'login', 'abc123', '1q2w3e4r', 'qwertyuiop', 'passw0rd', 'starwars', 'password1', '123qwe', '123456a', '1qaz2wsx', 'trustno1', 'princess', 'sunshine', 'password123', '123abc', 'welcome', 'admin', 'letmein', '123456789', 'football', 'iloveyou', '12345', 'qwerty123', '1234567', '12345678', 'qwerty12345', 'dragon', '1234', 'baseball', 'monkey', 'abcde', 'password!', '123', '1234567890', 'qazwsxedc', 'admin123', 'pass', '123456789a', 'qwertyu', '111111', '123abc!', '123456789!', 'a123456', 'letmein1', '000000', 'test', 'pass123', '123qwe!', '1234qwer', '987654321', '123123', 'qwe123', 'google', 'password!', 'internet', '12345qwert', 'qwerty123!', 'abcd1234', 'changeme', 'computer', 'password12', 'qwertyuio', '999999', 'zxcvbn', 'password1234', '123qweasd', 'q1w2e3r4t5', 'passw0rd1', 'sunshine1', 'qwe123!', 'admin1234', 'password!', 'password123!', 'qazwsx123', 'zaq1zaq1', 'zaqwsx', 'qweasdzxc', 'asdf1234', 'welcome1', 'qweasdzxc!'];              

                            foreach($weakPasswords as $faiblePassword) {
                                if($faiblePassword == $new_password) {
                                    $this->erreur = 'Le mot de passe est trop faible';
                                    $this->valid = false;
                                }
                            }
    
                            if($new_password <> $new_conf_password) {
                                $this->erreur = "Les mots de passe sont différents.";
                                $this->valid = false;
                            }
                        }

                        if($this->valid) {
                            $crypt_password = password_hash($new_password, PASSWORD_BCRYPT);

                            changePassword($crypt_password, $userId);
                        }
                    }
                }
            }

            //-- Recharge la SESSION de l'utilisateur ------------
            userLogInSession($email);

            return [$this->erreur];
        }
    }
?>