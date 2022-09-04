<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page 2</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
        include('session.php');

        if(isset($_SESSION['connexion'])) {
    ?>
        <h1> Page 2 </h1>
        <div> Private page </div>

        <a href = "index.php"> Accueil </a>
    <?php      
        } else {
            echo "Vous devez vous connecter pour accèder à ce contenu !";
        }
    ?>
</body>
</html>