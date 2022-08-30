
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='CSS/main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
        include("../../session.php");
        $Livre = new Livre (null, null, null, null);

        if(isset($_POST["idLivre"])) {
            $Livre->setLivreById($_POST["idLivre"]);
            $Livre->deleteInBdd();
        }

        $tabLivres = $Livre->getAllLivre();
        
        if(isset($_SESSION['Connexion'])) {
        ?>
        <h1> Accueil </h1>
        <div> Bienvenue <?php echo $TheUser->getLogin()?></div>
        <?php
            if($TheUser->isAdmin()) {
                echo "👑 Vous êtes administrateur";

                if(isset($_POST["idLivre"])) {
                    $Livre->setLivreById($_POST["idLivre"]);
                    $Livre->renderHTML();
                    ?>
                    <form action = "" method = "POST">
                        <!-- Titre : <input type = "text" name = "titre" maxlength = "100" value = "<?= $Livre->getTitre() ?>">
                        Auteur : <input type = "text" name = "auteur"  value = "<?= $Livre->getAuteur() ?>">
                        Lien Image : <input type = "text" name = "lienImage"  value = "<?= $Livre->getLienImage() ?>"> -->

                        <input type = "hidden" name = "id" value = "<?= $Livre->getId() ?>">
                        <input type = "submit" name = "deleteLivre" value = "Supprimer"> 
                    </form>
                    <?php
                }

                /* if(isset($_POST["updateLivre"])) {
                    $Livre->setLivreById($_POST["id"]);
                    $Livre->setTitre($_POST["titre"]);
                    $Livre->setAuteur($_POST["auteur"]);
                    $Livre->setLienImage($_POST["lienImage"]);
                    $Livre->saveInBDD();
                } */
            ?>

            <form action = "" method = "POST" onchange = "this.submit()">
                <select id = "idLivre" name = "idLivre">
                    <option value = "null">Selection d'un livre</option>
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
                echo "👤 Vous êtes un simple membre, vous ne pouvez pas ajouter de livre";
            }
        }
    ?>
</body>
</html>