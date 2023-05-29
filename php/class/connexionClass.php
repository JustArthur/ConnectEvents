<?php
    class Connexion {

        private $erreur;
        private $valid;

        public function connexion_user($email, $password) {

            $email = (String) htmlspecialchars(trim($email));
            $password = (String) htmlspecialchars(trim($password));

            $this->erreur = (String) "";
            $this->valid = (boolean) true;

            if($this->valid) {                
                $verif_password = getPassword($email);
                $verif_password = $verif_password->fetch();

                $verif_otp = getOTP($email);
                $verif_otp = $verif_otp->fetch();

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

                    if($verif_otp['otp_activate'] == 1) {
                        userLogInSession($email);

                        $_SESSION['verif_otp_before_logIn'] = true;

                        header('Location: ' . ROOT_PATH . 'website/custom_pages/activate_auth');
                        exit();
                    } else {
                        $_SESSION['verif_otp_before_logIn'] = false;
                        
                        userLogInSession($email);

                        header('Location: ' . ROOT_PATH . 'website/pages/');
                        exit();
                    }    
                }
            }

            return [$this->erreur, $email];
        }
    }
?>