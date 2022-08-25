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
            $titre = addslashes($this->titre_);
            $auteur = addslashes($this->auteur_);
            $lienImage = addslashes($this->lienImage_);

            if(is_null($this->id_)) {
                $SQL = "INSERT INTO `Livre` (`titre`, `auteur`, `lienImage`) VALUES ('".$titre."','".$auteur."','".$lienImage."')";

                $result = $GLOBALS["pdo"]->query($SQL);
                $this->id_ = $GLOBALS["pdo"]->lastInsertId();
            } else {
                echo "Le film avec l'id N°" .$this->id_. " va être update";

                $titre = addslashes($this->titre_);
                $auteur = addslashes($this->auteur_);
                $lienImage = addslashes($this->lienImage_);

                $SQL = "UPDATE `Livre` SET `titre`='".$titre."',`auteur`='".$auteur."',`lienImage`='".$lienImage."' WHERE `id` = '".$this->id_."'";

                $result = $GLOBALS["pdo"]->query($SQL);
            }
        }

        public function setLivreById($id) {
            $SQL = "SELECT * FROM `Livre` WHERE `id` = '".$id."'";

            $result = $GLOBALS["pdo"]->query($SQL);
            if($result->rowCount()>0) {
                $tab = $result->fetch();
                $this->id_ = $tab['id'];
                $this->titre_ = $tab['titre'];
                $this->auteur_ = $tab['auteur'];
                $this->lienImage_ = $tab['lienImage'];
            }
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

        public function getId() {
            return $this->id_;
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

        public function getLienImage() {
            return $this->lienImage_;
        }

        public function setTitre($titre) {
            $this->titre_ = $titre;
        }

        public function setAuteur($auteur) {
            $this->auteur_ = $auteur;
        }

        public function setLienImage($lienImage) {
            $this->lienImage_ = $lienImage;
        }
    }
?>