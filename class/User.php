<?php 
    class User {
        // Propriétés
        private $id_;
        private $login_;
        private $isAdmin_ = false;

        // Constructeur 
        public function __construct($id, $login, $isAdmin) {
            $this->id_ = $id;
            $this->login_ = $login;
            $this->isAdmin_ = $isAdmin;
        }

        public function seConnecter ($login, $password) {
            $SQL = "SELECT * FROM `User` WHERE `login` = '".$login."' and `password` = '".$password."';";

            $result = $GLOBALS["pdo"]->query($SQL);

            if($result->rowCount()>0) {
                // echo "🔓 Identifiants corrects...";

                $tab = $result->fetch();
                $_SESSION['connexion'] = true;
                $_SESSION['id'] = $tab['id'];

                $this->id_ = $tab['id'];
                $this->login_ = $tab['login'];
                $this->isAdmin_ = $tab['isAdmin'];

                return true;

            } else {
                // echo "🔒 Identifiants incorrects !";

                return false;
            }
        }

        public function seDeconnecter() {
            session_unset();
            session_destroy();
        }

        public function setUserByID($id) {
            $SQL = "SELECT * FROM `User` WHERE `id` = '".$id."'";

            $result = $GLOBALS["pdo"]->query($SQL);

            if($result->rowCount()>0) {

                $tab = $result->fetch();

                $this->id_ = $tab['id'];
                $this->login_ = $tab['login'];
                $this->isAdmin_ = $tab['isAdmin'];

                return true;

        } else {
            return false;
        }
    }

        // Accesseurs
        public function isAdmin() {
            return $this->isAdmin_;
        }

        public function getLogin() {
            return $this->login_;
        }
    }


?>