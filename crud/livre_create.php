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
    <?php include('../session.php'); 
    
    if(isset($_SESSION['connexion'])) {
    ?>
        <div> Vous êtes connecté en tant que : <?php echo $TheUser->getLogin()?></div>

        <?php if($TheUser->isAdmin()>0) {
            echo "👑 Vous êtes sur une session administrateur";

            if(isset($_POST["create"])) {
                echo "Insertion du livre ".$_POST["titre"];
                $newLivre = new Livre (null, $_POST["titre"], $_POST["auteur"], $_POST["lienImage"], $_POST["etoile"]);
                $newLivre->saveInBDD();
            }

            ?>
            <form action = "" method = "POST">
                Titre : <input type = "text" name = "titre">
                Auteur : <input type = "text" name = "auteur">
                Image : <input type = "text" name = "lienImage">

                <div class="starRating">
                        <input id="s5" type="radio" name="etoile" value="5">
                        <label for="s5">5</label>
                        <input id="s4" type="radio" name="etoile" value="4">
                        <label for="s4">4</label>
                        <input id="s3" type="radio" name="etoile" value="3">
                        <label for="s3">3</label>
                        <input id="s2" type="radio" name="etoile" value="2">
                        <label for="s2">2</label>
                        <input id="s1" type="radio" name="etoile" value="1">
                        <label for="s1">1</label>
                    </div>

                <input type = "submit" name = "create">
            </form> 
            <?php

        } else {
            echo "👤 Vous êtes un simple utilisateur, vous n'avez pas la permission d'ajouter des films par vous même. Veuillez contacter un administrateur pour toutes demandes.";
        ?> 
        <div> <a href = "../index.php"> Retourner en lieu sûr </a></div>
        <?php
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