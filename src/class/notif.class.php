<?php

    class notification {
        public function __construct () {
            @session_start();

            $GLOBALS['root'] = str_replace('class', '', __DIR__);

            if ($_SERVER['SERVER_ADDR'] == "127.0.0.1") {
                $GLOBALS['url'] = "http://127.0.0.1:8080/@Projets/MyLegoPP/";
            } else {
                //$GLOBALS['url'] = "http://www.mylegoprofilpic.com/";
                $GLOBALS['url'] = "http://lego.babeuloula.fr/";
            }
        }
    }