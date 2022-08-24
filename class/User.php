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
                $_SESSION['Connexion'] = true;
                return true;
            } else {
                // echo "❌ Identifiants incorrects ! Veuillez réessayez.";
                return false;
            }
        }
    }
?>