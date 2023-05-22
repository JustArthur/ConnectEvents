<?php

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
            case 'banner_1.png';
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/banner_picture/banner_1.png';
                break;
    
            case 'banner_2.png';
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/banner_picture/banner_2.png';
                break;
    
            case 'banner_3.png';
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/banner_picture/banner_3.png';
                break;
    
            case 'banner_4.png';
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/default_img/banner_picture/banner_4.png';
                break;
    
            default:
                $banner_picture = 'http://127.0.0.1/ConnectEvents/private/private_img/users_img/' . $sessionUsername . '/banner_picture/' . $sessionBannerPicture;
        }

        return $banner_picture;
    }

?>