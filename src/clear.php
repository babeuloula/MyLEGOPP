<?php

    require_once 'include/fonctions.php';
    require_once 'class/notif.class.php';

    $notif = new notification();

    if(($_SERVER['HTTP_REFERER'] == $GLOBALS['url'] || $_SERVER['HTTP_REFERER'] == $GLOBALS['url'] . "index.php") && isset($_SESSION['lego'])) {
        unlink($_SESSION['lego']['path_temp'].$_SESSION['lego']['lego']);
        rmdir($_SESSION['lego']['path_temp']);

        unset($_SESSION['lego']);
        session_destroy();
    } else {
        header('Location: '.$GLOBALS['url']);
    }

?>