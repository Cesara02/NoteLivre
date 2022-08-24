<?php 
    class User {
        private $id_;
        private $login_;
        private $idAdmin_ = false;

        public function __construct($id, $login, $isAdmin) {
            $this->id_ = $id;
            $this->login_ = $login;
            $this->idAdmin_ = $isAdmin;
        }

        public function seConnecter($login, $password) {
            $SQL = "SELECT * FROM `User` WHERE `login` = '".$login."' AND `password` = '".$password."'";

            $result = $GLOBALS["pdo"]->query($SQL);
            if($result->rowCount()>0) {
                // echo "✔️ Identifiants correct, vous êtes connectés...";
                $tab = $result->fetch();
                $_SESSION['Connexion'] = true;
                $_SESSION['id'] = $tab['id'];
                

                $this->id_ = $tab['id'];
                $this->login_ = $tab['login'];
                $this->isAdmin_ = $tab['isAdmin'];
                
                return true;
            } else {
                // echo "❌ Identifiants incorrects ! Veuillez réessayez.";
                return false;
            }
        }

        public function setUserById($id) {
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
        
        public function seDeconnecter() {
            // echo "Vous êtes déconnectez";
            session_unset();
            session_destroy();
        }

        public function isAdmin() {
            return $this->isAdmin_;
        }

        public function getLogin() {
            return $this->login_;
        }
    }
?>