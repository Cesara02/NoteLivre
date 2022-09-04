<?php 
    class Livre {
        // Propriétés
        private $id_;
        private $titre_;
        private $auteur_;
        private $lienImage_;
        private $MoyenneNote_;

        // Constructeur 
        public function __construct($id, $titre, $auteur, $lienImage, $note) {
            $this->id_ = $id;
            $this->titre_ = $titre;
            $this->auteur_ = $auteur;
            $this->lienImage_ = $lienImage;
            $this->MoyenneNote_ = $note;
        }

        public function saveInBDD() {
            // Si l'id est null, l'insertion se fera car il ne n'y a pas d'autre livre avec le même id

            $titre = addslashes($this->titre_);
            $auteur = addslashes($this->auteur_);
            $lienImage = addslashes($this->lienImage_);
            $note = addslashes($this->MoyenneNote_);

            if(is_null($this->id_)) {
                $SQL = "INSERT INTO `Livre` (`titre`, `auteur`, `lienImage`, `note`) VALUES ('".$titre."', '".$auteur."', '".$lienImage."', '".$note."')";

                $result = $GLOBALS["pdo"]->query($SQL);
                $this->id_ = $GLOBALS["pdo"]->lastInsertId();

                $SQL = "INSERT INTO `Note`(`idUser`, `idLivre`, `note`) VALUES ('".$_SESSION['id']."','".$this->id_."','".$this->MoyenneNote_."')";
            } else {
                // Modification des données sur un livre
                $titre = addslashes($this->titre_);
                $auteur = addslashes($this->auteur_);
                $lienImage = addslashes($this->lienImage_);

                $SQL = "UPDATE `Livre` SET `titre` = '".$titre."', `auteur` = '".$auteur."', `lienImage` = '".$lienImage."' WHERE `id` = '".$this->id_."'";

                $result = $GLOBALS["pdo"]->query($SQL);
            }
        }

        public function deleteInBDD() {
            if (!is_null($this->id_)) {
                $SQL = "DELETE FROM `Livre` WHERE id = '" . $this->id_ . "'";

                $GLOBALS["pdo"]->query($SQL);
            }
        }

        public function setLivreByID($id) {
            $SQL = "Select Livre.id, Livre.titre, Livre.auteur, Livre.lienImage, AVG(Note.note) as 'note' FROM Livre, Note, User WHERE Livre.id = Note.idLivre
                AND
                    Note.idUser = User.id
                AND
                    Livre.id = '" .$id. "' Group By Livre.id;";

            $result = $GLOBALS["pdo"]->query($SQL);

            if($result->rowCount()>0) {
                $tab = $result->fetch();
                $this->id_ = $tab['id'];
                $this->titre_ = $tab['titre'];
                $this->auteur_ = $tab['auteur'];
                $this->lienImage_ = $tab['lienImage'];
                $this->MoyenneNote_ = $tab['note'];
            }
        }

        public function getAllLivre() {
            $ListeLivres = array();
            // Requête pour afficher tous les livres en base

            $SQL = "SELECT  * FROM `Livre`";
            $result = $GLOBALS["pdo"]->query($SQL);

            while($tab = $result->fetch()) {
                $livre = new Livre($tab['id'], $tab['titre'], $tab['auteur'], $tab['lienImage'], $tab['note']);
                array_push($ListeLivres, $livre);
            }
            return $ListeLivres;
        }

        // Accesseurs
        public function getId() {
            return $this->id_;
        }

        public function getTitre() {
            return $this->titre_;
        }

        public function getAuteur() {
            return $this->auteur_;
        }

        public function getImage() {
            $imageHTML = '<img src = "'.$this->lienImage_.'" alt = "'.$this->titre_.'"/>';
            return $imageHTML;
        }

        public function getLienImage() {
            return $this->lienImage_;
        }

        public function getMoyenneNote() {
            return $this->MoyenneNote_;
        }

        public function setTitre($titre) {
            $this->titre_ = $titre;
        }

        public function setAuteur($auteur) {
            $this->auteur_ = $auteur;
        }

        public function setLienImage($lienImage){
            $this->lienImage_ = $lienImage;
        }
    }
?>