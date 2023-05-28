<?php

    //-- Génére une chaine de caractère avec une taille de 100 ----------------
    function generateToken($length = 100) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        $maxIndex = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $maxIndex);
            $randomString .= $characters[$randomIndex];
        }

        return $randomString;
    }

    function profilPicture($sessionProfilePicture, $sessionUsername) {
        switch($sessionProfilePicture) {
            case 'profile_picture_1.png';
                $profile_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/profile_picture/profile_picture_1.png';
                break;
    
            case 'profile_picture_2.png';
                $profile_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/profile_picture/profile_picture_2.png';
                break;
    
            case 'profile_picture_3.png';
                $profile_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/profile_picture/profile_picture_3.png';
                break;
    
            case 'profile_picture_4.png';
                $profile_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/profile_picture/profile_picture_4.png';
                break;
    
            default:
                $profile_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/' . $sessionUsername .'/profile_picture/' . $sessionProfilePicture . '';
        }

        return $profile_picture;
    }

    function bannerPicture($sessionBannerPicture, $sessionUsername) {
        switch($sessionBannerPicture) {
            case 'banner_1.jpg';
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/banner_picture/banner_1.jpg';
                break;
    
            case 'banner_2.jpg';
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/banner_picture/banner_2.jpg';
                break;
    
            case 'banner_3.jpg';
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/banner_picture/banner_3.jpg';
                break;
    
            case 'banner_4.jpg';
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/banner_picture/banner_4.jpg';
                break;
    
            default:
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/' . $sessionUsername . '/banner_picture/' . $sessionBannerPicture;
        }

        return $banner_picture;
    }

    function sendMail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }
?>