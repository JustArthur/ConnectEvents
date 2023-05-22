<?php
    class Connexion {

        private $erreur;
        private $valid;

        public function connexion_user($email, $password) {

            global $DB;

            $email = (String) trim($email);
            $password = (String) trim($password);

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
                        $connexion_user['user_id'], //0
                        $connexion_user['username'], //1
                        $connexion_user['email'], //2
                        $connexion_user['profile_photo'], //3
                        $connexion_user['banner_image'] //4
                    );

                    header('Location: http://127.0.0.1/ConnectEvents/website/pages/index');
                    exit;
                }
            }

            return [$this->erreur];
        }
    }
?>