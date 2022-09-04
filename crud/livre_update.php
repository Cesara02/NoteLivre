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
        $Livre = new Livre (null, null, null, null, 0);
        $tabLivres = $Livre->getAllLivre();    
    if(isset($_SESSION['connexion'])) {
    ?>
        <div> Vous êtes connecté en tant que : <?php echo $TheUser->getLogin()?></div>

        <?php 
        
        if($TheUser->isAdmin()>0) {
            echo "👑 Vous êtes sur une session administrateur";

            if(isset($_POST['idLivre'])) {
                $Livre->setLivreByID($_POST["idLivre"]);
            }

            if(isset($_POST['update'])) {
                $Livre->setLivreByID($_POST["id"]); // Id champ "hidden"
                $Livre->setTitre($_POST["titre"]);
                $Livre->setAuteur($_POST["auteur"]);
                $Livre->setLienImage($_POST["lienImage"]);
                $Livre->setMoyenneNote($_POST["note"]);
                $Livre->SaveInBDD();
            }
        ?>
        <form action = "" method = "POST" onchange= "this.submit()">
            <select id = "idLivre" name = "idLivre">
                <option value = "null"> -- </option>
                <?php
                    foreach ($tabLivres as $TheLivre) {

                        if ($Livre->getId() == $TheLivre->getId()) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }

                        echo '<option '.$selected.' value = "'.$TheLivre->getId().'">'.$TheLivre->getTitre().'</option>';
                    }
                ?>
            </select>
        </form>

        <form action = "" method = "POST">
            Titre : <input type = "text" name = "titre" value = "<?= $Livre->getTitre() ?>">
            Auteur : <input type = "text" name = "auteur" value = "<?= $Livre->getAuteur() ?>">
            Image : <input type = "text" name = "lienImage" value = "<?= $Livre->getlienImage() ?>">
            <input type = "hidden" name = "id" value = "<?= $Livre->getId() ?>">
            <input type = "submit" name = "update" value = "Mise à jour">
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