<?php
    class Note{
        //  Propriétés
        private $id_;
        private $idLivre_;
        private $idUser_;
        private $note_;


        // Constructeur 
        public function __construct($newIdUser, $newIdLivre, $newNote){
            $this->idLivre_ = $newIdLivre;
            $this->idUser_ = $newIdUser;
            $this->note_ = $newNote;
        }

        public function saveInBdd(){
            if (is_null($this->id_)) {

                $SQL = "Select Film.id FROM Film,Note,User WHERE Film.id = Note.idFilm AND Note.idUser = User.id AND Film.id = '" . $this->idFilm_ . "' AND User.id = '" . $this->idUser_ . "'  Group By Film.id;";

                $result = $GLOBALS["pdo"]->query($SQL); //resultat sera de type pdoStatement
                if ($result->rowCount() > 0) {
                    $SQL = "UPDATE `Note` SET `note`='" . $this->note_ . "'WHERE Note.idFilm = '" .$this->idFilm_ . "' AND Note.idUser ='" .$this->idUser_ . "'";

                    $GLOBALS["pdo"]->query($SQL);

                } else {

                    $SQL = "INSERT INTO `Note` ( `idUser`, `idFilm`, `note`) VALUES ( '".$this->idUser_."', '".$this->idFilm_."', '".$this->note_."');";

                    $GLOBALS["pdo"]->query($SQL);
                    $this->id_ = $GLOBALS["pdo"]->lastInsertId();
                }

            } else {
                $SQL = "UPDATE `Note` SET `note`='" . $this->note_ . "', WHERE `id` = '" . $this->id_ . "'";
        
                $GLOBALS["pdo"]->query($requetSQL);
            }
        }
    }
?>