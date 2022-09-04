<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Accueil</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='CSS/main.css'>
</head>

<body>
    <?php include('session.php'); 
    
    if(isset($_SESSION['connexion'])) {
    ?>
        <div> Vous êtes connecté en tant que : <?php echo $TheUser->getLogin()?></div>
        <div> <a href = "page2.php"> Vers la page 2 </a></div>

        <?php if($TheUser->isAdmin()>0) {
            echo "👑 Vous êtes sur une session administrateur";
        } else {
            echo "👤 Vous êtes un simple utilisateur";
        }
    }
    ?>

    <?php 
        // Affichage des livres en base
        $Livre = new Livre (null, null, null, null, 0);
        $tabLivres = $Livre->getAllLivre();
        echo "<ul>";

        foreach ($tabLivres as $livre) {
            echo "<li>";
            echo $livre->getTitre();
            echo $livre->getAuteur();
            echo $livre->getImage();
            echo $livre->getMoyenneNote();
            echo "</li>";
        }
        echo "</ul>";
        ?>
</body>
</html>