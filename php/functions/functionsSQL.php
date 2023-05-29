<?php

    function userLogInSession($email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $email = htmlspecialchars(trim($email));

        $sql = $DB->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);
        $sql = $sql->fetch();

        $_SESSION['utilisateur'] = array(
            htmlspecialchars(trim($sql['user_id'])), //0
            htmlspecialchars(trim($sql['last_name'])), //1
            htmlspecialchars(trim($sql['first_name'])), //2
            htmlspecialchars(trim($sql['username'])), //3
            htmlspecialchars(trim($sql['email'])), //4
            htmlspecialchars(trim($sql['profile_photo'])), //5
            htmlspecialchars(trim($sql['banner_image'])), //6
            htmlspecialchars(trim($sql['created_at'])), //7
            htmlspecialchars(trim($sql['otp_activate'])) //8
        );

        return $sql;
    }

    function userInformation($email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $email = htmlspecialchars(trim($email));

        $sql = $DB->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);

        return $sql;
    }

    function insertUser($username, $email, $crypt_password, $avatar, $banner, $token) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $username = htmlspecialchars(trim($username));
        $email = htmlspecialchars(trim($email));

        $sql = $DB->prepare("INSERT INTO users (username, email, password, profile_photo, banner_image, reset_token) VALUES(?, ?, ?, ?, ?, ?);");
        $sql->execute([$username, $email, $crypt_password, $avatar, $banner, $token]);

        return $sql;
    }

    function getUserIdByEmail($email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $email = htmlspecialchars(trim($email));

        $sql = $DB->prepare("SELECT user_id FROM users WHERE email = ?");
        $sql->execute([$email]);

        return $sql;
    }

    function getUserIdByUsername($username) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $username = htmlspecialchars(trim($username));

        $sql = $DB->prepare("SELECT user_id FROM users WHERE username = ?");
        $sql->execute([$username]);

        return $sql;
    }

    function getUserEmailByEmail($email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $email = htmlspecialchars(trim($email));

        $sql = $DB->prepare('SELECT email FROM users WHERE email = ?');
        $sql->execute([$email]);

        return $sql;
    }


    function getPassword($email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $email = htmlspecialchars(trim($email));

        $sql = $DB->prepare("SELECT password FROM users WHERE email = ?");
        $sql->execute([$email]);

        return $sql;
    }


    function insertPost($titre, $contenu, $userId) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $titre = (String) htmlspecialchars(trim($titre));
        $contenu = (String) htmlspecialchars(trim($contenu));
        $userId = (Int) htmlspecialchars(trim($userId));

        $sql = $DB->prepare('INSERT INTO blogposts (title, content, user_id) VALUES(?, ?, ?)');
        $sql->execute([$titre, $contenu, $userId]);

        return $sql;
    }

    function getPostForBlog($offset, $limit) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('SELECT blogposts.post_id, blogposts.title, blogposts.content, blogposts.user_id, blogposts.created_at, users.username, users.profile_photo FROM blogposts INNER JOIN users ON users.user_id = blogposts.user_id ORDER BY created_at DESC LIMIT :offset, :limit');
        $sql->bindValue(':offset', $offset, PDO::PARAM_INT);
        $sql->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sql->execute();

        return $sql;
    }

    function getPost($idpost) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('SELECT blogposts.post_id, blogposts.title, blogposts.content, blogposts.user_id, blogposts.created_at, users.username, users.profile_photo FROM blogposts INNER JOIN users ON users.user_id = blogposts.user_id WHERE blogposts.post_id = ?');
        $sql->execute([$idpost]);

        return $sql;
    }

    function getTokenUserByEmail($email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();
        
        $sql = $DB->prepare("SELECT reset_token FROM users WHERE email = ?");
        $sql->execute([$email]);

        return $sql;
    }

    function setUserToken($token, $email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();
        
        $sql = $DB->prepare('UPDATE users set reset_token = ? WHERE email = ?');
        $sql->execute([$token, $email]);

        return $sql;
    }

    function getUserByToken($token) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('SELECT reset_token, user_id, email, password FROM users WHERE reset_token = ?');
        $sql->execute([$token]);

        return $sql;
    }

    function changePassword($crypt_password, $userId) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('UPDATE users SET password = ?, reset_token = "" WHERE user_id = ?');
        $sql->execute([$crypt_password, $userId]);
        
        return $sql;
    }

    function OTPCodeActivated($userId) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('UPDATE users SET otp_activate = 1 WHERE user_id = ?');
        $sql->execute([$userId]);
        
        return $sql;
    }

    function getOTP($email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('SELECT otp_activate FROM users WHERE email = ?');
        $sql->execute([$email]);
        
        return $sql;
    }

    function changeEmail($email, $userId) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('UPDATE users SET email = ? WHERE user_id = ?');
        $sql->execute([$email, $userId]);
        
        return $sql;
    }

    function changeUsername($username, $userId) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('UPDATE users SET username = ? WHERE user_id = ?');
        $sql->execute([$username, $userId]);
        
        return $sql;
    }

    function changeNom($nom, $userId) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('UPDATE users SET last_name = ? WHERE user_id = ?');
        $sql->execute([$nom, $userId]);
        
        return $sql;
    }

    function changePrenom($prenom, $userId) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $sql = $DB->prepare('UPDATE users SET first_name = ? WHERE user_id = ?');
        $sql->execute([$prenom, $userId]);
        
        return $sql;
    }
?>