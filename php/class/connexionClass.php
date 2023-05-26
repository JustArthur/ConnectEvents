<?php
    class Connexion {

        private $erreur;
        private $valid;

        public function connexion_user($email, $password) {

            global $DB;

            $email = (String) htmlspecialchars(trim($email));
            $password = (String) htmlspecialchars(trim($password));

            $this->erreur = (String) "";
            $this->valid = (boolean) true;

            if($this->valid) {                
                $verif_password = $DB->prepare("SELECT password FROM users WHERE email = ?");
                $verif_password->execute([$email]);
                $verif_password = $verif_password->fetch();

                if(isset($verif_password['password'])) {
                    if(!password_verify($password, $verif_password['password'])) {
                        $this->valid = false;
                        $this->erreur = 'Mauvais mot de passe ou adresse mail.';
                    }
                } else {
                    $this->valid = false;
                    $this->erreur = 'Mauvais mot de passe ou adresse mail.';
                }               

                if($this->valid) {
                    
                    $connexion_user = $DB->prepare("SELECT * FROM users WHERE email = ?");
                    $connexion_user->execute([$email]);
                    $connexion_user = $connexion_user->fetch();

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

            return [$this->erreur, $email];
        }
    }
?>