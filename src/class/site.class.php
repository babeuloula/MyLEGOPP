<?php

    class Site {
        private $rub;

        public $titre;
        public $keywords;
        public $description;
        public $contenu;


        public function __construct() {
            if(count($_GET) == 0) {
                $this->rub = "accueil";
            } else {
                $this->rub = $_GET['rub'];
            }
        }

        public function init() {
            $meta = $this->meta();

            $this->titre = $meta['titre'];
            $this->keywords = $meta['keywords'];
            $this->description = $meta['description'];

            switch($this->rub) {
                case "affichage":
                    $this->contenu = $this->__Affichage();
                    break;

                default:
                    $this->contenu = $this->__Accueil();
                    break;
            }
        }

        private function __Affichage() {
            if(!isset($_GET['crypt']) || empty($_GET)) {
                header('Location: '.$GLOBALS['url']);
            } else {
                $config = new database();

                if($config) {
                    $db = $config->getDataBase();

                    $select = $db->prepare("SELECT id_lego FROM lego WHERE crypt_lego = '".$_GET['crypt']."'");
                    $select->execute();

                    if($select->rowCount() > 0) {
                        $select->closeCursor();
                    } else {
                        header('Location: '.$GLOBALS['url']);
                    }
                } else {
                    $config->getErreur();
                }
            }

            $content = '
                <div class="logoMini"><a href="'.$GLOBALS['url'].'"><img src="'.$GLOBALS['url'].'css/images/logo_mlpp.png" alt="Logo My LEGO profil pic" width="255" height="180"></a></div>

                <div class="affichage">
                    <img src="'.$GLOBALS['url'].'lego/'.$_GET['crypt'].'/lego.jpg" alt="render" width="480" height="480">
                </div>
            ';


            return $content;
        }

        private function __Accueil() {
            $content = '
                <div class="logo"><img src="'.$GLOBALS['url'].'css/images/logo_mlpp.png" alt="Logo My LEGO profil pic" width="338" height="220"></div>

                <div class="step1 clear">
                    <div class="facebook">
                        <a href="#">Utiliser ma photo de profil facebook</a>
                    </div>
                    <div class="autre">
                        <a href="#">Ou utiliser une nouvelle photo</a>
                        <input type="file" id="autreImage" name="image">
                    </div>

                    <div class="clear"></div>

                    <div class="notif"></div>
                </div>

                <div class="step2 step4 clear">
                    <div class="telechargement">
                        <div class="loader">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <p></p>
                    </div>
                </div>

                <div class="step3 clear">
                    <div class="crop">
                        <img src="" alt="jcrop">

                        <form id="formCrop">
                            <input type="hidden" id="x" name="x">
                            <input type="hidden" id="y" name="y">
                            <input type="hidden" id="w" name="w">
                            <input type="hidden" id="h" name="h">
                        </form>
                    </div>

                    <div class="bouton" id="rogner">Rogner l\'image</div>
                </div>

                <div class="step5 clear">
                    <div class="affichage">
                        <img src="" alt="render" width="480" height="480">
                    </div>

                    <div class="partage">
                        <div class="download bouton">Télécharger l\'image</div>
                        <div class="facebook bouton">Partager sur Facebook</div>
                        <div class="twitter bouton">Partager sur Twitter</div>
                    </div>
                </div>
            ';

            return $content;
        }

        private function meta() {
            switch($this->rub) {
                case "affichage":
                    $titre = "My LEGO Profil Pic";
                    $description = "";
                    $keywords = "";

                    break;

                default:
                    $titre = "My LEGO Profil Pic";
                    $description = "";
                    $keywords = "";

                    break;
            }

            return array("titre"=>$titre,"description"=>$description,"keywords"=>$keywords);
        }
    }