<?php session_start();

include("./class/User.php");
include("./class/Livre.php");

$TheUser = new User(null, null, null);

    try {
        $ipserver = "localhost";
        $nomBase = "NoteLivre";
        $loginPrivilege = "Alexis";
        $passwordPrivilege = "Alexis";

        $GLOBALS["pdo"] = new PDO ('mysql:host='.$ipserver.';dbname='.$nomBase.'', $loginPrivilege, $passwordPrivilege);
        // echo "Connexion à la base de donnée réussi ! ";
    } catch (Exception $e) {
        $e->getMessage();
    }

    if(isset($_POST['Connexion'])) {
        $TheUser->seConnecter($_POST['login'], $_POST['password']);
    }

    if(isset($_POST['Deconnexion'])) {
        $TheUser->seDeconnecter();
    }

    if(isset($_SESSION['Connexion']) && ($_SESSION['Connexion'] == true)) {
        //echo "Vous êtes déjà connecté !";

        $TheUser->setUserById($_SESSION['id']);

        ?>
        <form action = "" method = "POST">
            <input type = "submit" name = "Deconnexion" value = "Se deconnecter">
        </form>
        <a href = "page2.php"> 🚪 Accès à la page 2 </a>
        <?php
    } else {
        echo "Veuillez vous identifier...";
        ?>
        <form action = "" method = "POST">
            Login : <input type = "text" name = "login" value = "Alexis">
            Password : <input type = "password" name = "password" value = "Alexis">
            <input type = "submit" name = "Connexion" value = "Se connecter">
        </form>
        <?php
    }
?>