<?php

    require_once 'include/fonctions.php';
    require_once 'class/notif.class.php';

    $notif = new notification();

    if($_SERVER['HTTP_REFERER'] == $GLOBALS['url'] || $_SERVER['HTTP_REFERER'] == $GLOBALS['url'] . "index.php") {
        $time = time();
        $crypt = generate($time);
        $path_temp = $GLOBALS['root'] . 'temp/' . $crypt . '/';
        $path = $GLOBALS['root'] . 'render/' . $crypt . '/';
        $filename = basename(removeAccents($_FILES['image']['name']));

        mkdir($path_temp);
        move_uploaded_file($_FILES['image']['tmp_name'], $path_temp.$filename);

        list($largeur_image, $hauteur_image) = getimagesize($path_temp.$filename);

        $return = array();
        $return['width'] = $largeur_image;
        $return['height'] = $hauteur_image;

        if($largeur_image < 600 || $hauteur_image < 600) {
            unlink($path_temp.$filename);
            rmdir($path_temp);
        } else {
            $_SESSION['lego']['time'] = $time;
            $_SESSION['lego']['crypt'] = $crypt;
            $_SESSION['lego']['path_temp'] = $path_temp;
            $_SESSION['lego']['path'] = $path;
            $_SESSION['lego']['lego'] = $filename;

            $return['lego'] = $GLOBALS['url'] . 'lego/temp/' . $crypt . '/' . $filename;
        }

        echo json_encode($return);
    } else {
        header('Location: '.$GLOBALS['url']);
    }

?>