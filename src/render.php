<?php

    require_once 'include/fonctions.php';
    require_once 'class/config.class.php';
    require_once 'class/lego.class.php';
    require_once 'class/notif.class.php';

    $notif = new notification();

    if(($_SERVER['HTTP_REFERER'] == $GLOBALS['url'] || $_SERVER['HTTP_REFERER'] == $GLOBALS['url'] . "index.php") && isset($_SESSION['lego'])) {
        $time = $_SESSION['lego']['time'];
        $crypt = $_SESSION['lego']['crypt'];
        $path_temp = $_SESSION['lego']['path_temp'];
        $path = $_SESSION['lego']['path'];
        $filename = $_SESSION['lego']['lego'];

        mkdir($path);
        copy($path_temp.$filename, $path.$filename);
        unlink($path_temp.$filename);
        rmdir($path_temp);

        $config = new database();

        if($config) {
            $db = $config->getDataBase();

            $insert = $db->prepare("INSERT INTO lego (image_upload_lego, timestamp_lego, crypt_lego)
                                    VALUES ('".$filename."', '".$time."', '".$crypt."')");
            $insert->execute();
            $insert->closeCursor();

            $lego = new LEGO();
            $lego->create($crypt, $filename);
            $lego->output(true);

            $return = array();
            $return['lego'] = $GLOBALS['url'] . 'lego/' . $crypt . '/lego.jpg';
            $return['share'] = $GLOBALS['url'] . 'lego/' . $crypt . '/';
            $return['folder'] = $crypt;

            echo json_encode($return);
        } else {
            $config->getErreur();
        }
    } else {
        header('Location: '.$GLOBALS['url']);
    }

?>