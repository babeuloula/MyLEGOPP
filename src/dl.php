<?php

    require_once 'class/config.class.php';
    require_once 'class/notif.class.php';

    $notif = new notification();

    if(($_SERVER['HTTP_REFERER'] == $GLOBALS['url'] || $_SERVER['HTTP_REFERER'] == $GLOBALS['url'] . "index.php") && isset($_GET['crypt'])) {
        $config = new database();
        
        if($config) {
            $db = $config->getDataBase();
        
            $select = $db->prepare("SELECT id_lego FROM lego WHERE crypt_lego = '".$_GET['crypt']."'");
            $select->execute();
            
            if($select->rowCount() > 0) {
                $select->closeCursor();

                $path = $GLOBALS['root'] . 'render/' . $_GET['crypt'] . '/';

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=lego.jpg');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($path.'lego.jpg'));
                ob_clean();
                flush();

                readfile($path.'lego.jpg');
                exit;
            } else {
                header('Location: '.$GLOBALS['url']);
            }
        } else {
            $config->getErreur();
        }
    } else {
        header('Location: '.$GLOBALS['url']);
    }

?>