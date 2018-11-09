<!-- Afficher le nombre d'inscrit sur notre site, afficher le nombre de vote total sur le site-->

<?php include('../inc/pdo.php'); ?>
<?php include('../inc/function.php'); ?>
<?php if(isadmin()){?>

<?php 
    //requete pour aller cherche le nombre d'users qui se sont enregistre
    $sql = "SELECT COUNT(id) FROM m3_users";
    $query = $pdo->prepare($sql);
    $query->execute();
    $statsusers = $query->fetchColumn();
    // print_r($statsusers);

    //requete pour aller chercher le nombre de films que l'on possede sur le site
    $sqlfilm = "SELECT COUNT(id) FROM movies_full";
    $queryfilm = $pdo->prepare($sqlfilm);
    $queryfilm->execute();
    $statsfilm = $queryfilm->fetchColumn();
?>






<?php include('inc/headerb.php'); ?>

<h1 class="titlestats">Bienvenu sur le Back-Office</h1>
<div class="filmsbdd">
    <h2>Nombre de films total</h2>
    <p>Vous avez actuellement <?php echo($statsfilm); ?> films sur votre site</p>
</div>
<div class="statusers">
    <h2>Voici les Statistiques du nombre d'utilisateurs enregistrés: </h2>
    <p>Vous avez actuellement <?php echo($statsusers); ?> utilisateurs inscrits sur votre site.</p>
    <?php 
        if ($statsusers < 10) {
            echo('Vous n\'en avez pas beaucoup mais ne baissez pas les bras, c\'est le début!');
        }elseif ($statsusers > 50) {
            echo('Bravo, votre site commence à se faire connaître, vous êtes sur la bonne voie.');
        }else {
            echo('Votre site se maintient et évolue tranquillement');
        }
    ?>
</div>






<?php include('inc/footerb.php'); ?>

<?php }else {
    die('403');
} ?>