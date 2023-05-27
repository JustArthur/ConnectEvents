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
                    
                    userLogInSession($email);

                    header('Location: ' . ROOT_PATH . '/website/pages/');
                    exit();
                }
            }

            return [$this->erreur, $email];
        }
    }
?>