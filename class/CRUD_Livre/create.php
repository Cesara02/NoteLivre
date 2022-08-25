
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

        if(isset($_SESSION['Connexion'])) {
        ?>
        <h1> Accueil </h1>
        <div> Bienvenue <?php echo $TheUser->getLogin()?></div>
        <?php
            if($TheUser->isAdmin()) {
                echo "👑 Vous êtes administrateur";
                if(isset($_POST["createLivre"])) {
                    echo "Création du livre..." .$_POST["titre"];
                    $newlivre = new Livre (null, $_POST["titre"], $_POST["auteur"], $_POST["lienImage"]);
                    $newlivre->saveInBdd();
                }
            ?>

            <form action = "" method = "POST">
                Titre : <input type = "text" name = "titre">
                Auteur : <input type = "text" name = "auteur">
                Lien Image : <input type = "text" name = "lienImage">
                <input type = "submit" name = "createLivre"> 
            </form>

            <?php
            } else {
                echo "👤 Vous êtes un simple membre, vous ne pouvez pas ajouter de livre";
            }
        }

        // Affichage des livres en BDD
        $Livre = new Livre (null, null, null, null);
        $tabLivres = $Livre->getAllLivre();
        echo "<ul>";
        foreach ($tabLivres as $Livre) {
            $Livre->renderHTML();
        }
        echo "</ul>";
    ?>
</body>
</html>