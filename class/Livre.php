<?php 
    class Livre {
        private $id_;
        private $titre_;
        private $auteur_;
        private $lienImage_;

        public function __construct($id, $titre, $auteur, $lienImage) {
            $this->id_ = $id;
            $this->titre_ = $titre;
            $this->auteur_ = $auteur;
            $this->lienImage_ = $lienImage;
        }

        public function saveInBdd() {
            if(is_null($this->id_)) {
                $SQL = "INSERT INTO `Livre` (`titre`, `auteur`, `lienImage`) VALUES ('".$this->titre_."','".$this->auteur_."','".$this->lienImage_."')";

                $result = $GLOBALS["pdo"]->query($SQL);
                $this->id_ = $GLOBALS["pdo"]->lastInsertId();
            }
        }

        public function setLivreById($id) {

        }

        public function getAllLivre() {
            $ListeLivres = array();

            $SQL = "SELECT * FROM `Livre`";

            $result = $GLOBALS["pdo"]->query($SQL);
            while($tab = $result->fetch()) {
                $livre = new Livre($tab['id'], $tab['titre'], $tab['auteur'], $tab['lienImage']);
                array_push($ListeLivres, $livre);
            }

            return $ListeLivres;
        }

        public function getTitre() {
            return $this->titre_;
        }

        public function getAuteur() {
            return $this->auteur_;
        }

        public function renderHTML() {
            echo "<li>";
            echo $this->titre_;
            echo $this->auteur_;
            echo $this->getImage();
            echo "</li>";
        }

        public function getImage() {
            $imageHTML = '<img src = "'.$this->lienImage_.'" alt = "'.$this->titre_.'"/>';
            return $imageHTML;
        }
    }
?>