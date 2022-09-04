<?php 
    session_start();

    include('class/User.php');
    include('class/Livre.php');

    $TheUser = new User (null, null, null);

    // CONNEXION BASE DE DONNEES
    try {
        $GLOBALS["pdo"] = new PDO('mysql:host=mysql-bordrezcesar.alwaysdata.net;dbname=bordrezcesar_book', '256339', 'bordrez0908cesar2207');
        // echo "Connexion à la base de donnée réussi !";
    } catch (Exception $e) {
        $e->getMessage();
        // echo "Connexion à la base de donnée échoué !";
    }

    // CONNEXION AU SITE
    if(isset($_POST['connexion'])) {
        $TheUser->seConnecter($_POST['login'], $_POST['pass']);
    }

    // DECONNEXION
    if(isset($_POST['deconnexion'])) {
        $TheUser->seDeconnecter();
    }

    if(isset($_SESSION['connexion']) && $_SESSION['connexion'] == true) {
        // echo "Vous êtes déjà connecté";

        $TheUser->setUserByID($_SESSION['id']);
        
        ?>
        <form action = "" method = "POST"> 
            <input type = "submit" name = "deconnexion" value = "Se deconnecter"/>
        </form>
        
        <?php
    } else { 
        echo "Veuillez vous identifier";
        ?>
        <form action = "" method = "POST"> 
            Login : <input type = "text" name = "login" value = "Alexis"/>
            Password : <input type = "password" name = "pass" value = "Alexis"/>
            <input type = "submit" name = "connexion"/>
        </form>
        <?php
    }
?>  