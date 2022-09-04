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
                $Livre->deleteInBDD();
            ?>

            <form action = "" method = "POST">
                <input type = "hidden" name = "id" value = "<?= $Livre->getId() ?>">
                <input type = "submit" name = "delete" value = "Supprimer <?= $Livre->getTitre() ?>">
            </form>

            <?php 
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

        <?php
        } else {
            echo "👤 Vous êtes un simple utilisateur, vous n'avez pas la permission d'ajouter des films par vous même. Veuillez contacter un administrateur pour toutes demandes.";
        ?> 
        <div> <a href = "../index.php"> Retourner en lieu sûr </a></div>
        <?php
        }
    }
    ?>
</body>
</html>