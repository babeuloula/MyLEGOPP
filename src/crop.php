<?php

    require_once 'include/fonctions.php';
    require_once 'class/config.class.php';
    require_once 'class/notif.class.php';

    $notif = new notification();

    if(($_SERVER['HTTP_REFERER'] == $GLOBALS['url'] || $_SERVER['HTTP_REFERER'] == $GLOBALS['url'] . "index.php") && isset($_SESSION['lego'])) {
        $extention = explode('.', $_SESSION['lego']['lego']);
        $extention = end($extention);
        $file = $_SESSION['lego']['path_temp'] . $_SESSION['lego']['lego'];

        if(strtolower($extention) == "jpg" || strtolower($extention) == "jpeg") {
            $targ_w = 600;
            $targ_h = 600;

            $img_r = imagecreatefromjpeg($file);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);

            imagejpeg($dst_r, $file, 100);
        } else if(strtolower($extention) == "png") {
            $targ_w = 600;
            $targ_h = 600;

            $img_r = imagecreatefrompng($file);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);

            imagepng($dst_r, $file, 1);
        } else if(strtolower($extention) == "gif") {
            $targ_w = 600;
            $targ_h = 600;

            $img_r = imagecreatefromgif($file);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);

            imagegif($dst_r, $file);
        }

        require_once 'render.php';
    } else {
        header('Location: '.$GLOBALS['url']);
    }

?>