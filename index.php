<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php

        try {
            $ipserver = "localhost";
            $nomBase = "NoteLivre";
            $loginPrivilege = "Alexis";
            $passwordPrivilege = "Alexis";

            $pdo = new PDO ('mysql:host='.$ipserver.';dbname='.$nomBase.'', $loginPrivilege, $passwordPrivilege);
            // echo "Connexion à la base de donnée réussi ! ";
        } catch (Exception $e) {
            $e->getMessage();
        }



        if(isset($_POST['Connexion'])) {
            // echo "Vous avez saisie le login : ".$_POST['login']." et le mot de passe ".$_POST['password']."";
            // Comparaison des valeurs saisies avec celles entrées en BDD
            $SQL = "SELECT * FROM `User` WHERE `login` = '".$_POST['login']."' AND `password` = '".$_POST['password']."'";

            $result = $pdo->query($SQL);
            if($result->rowCount()>0) {
                echo "✔️ Identifiants correct, vous êtes connectés...";
            } else {
                echo "❌ Identifiants incorrects ! Veuillez réessayez.";
            }
        } else {
            echo "Veuillez vous identifier";
        }
    ?>
    <form action = "" method = "POST">
        Login : <input type = "text" name = "login" value = "Alexis">
        Password : <input type = "password" name = "password" value = "Alexis">
        <input type = "submit" name = "Connexion">
    </form>
</body>
</html>