<!-- Sur cette page, nous allons  integrer la liste des films en base données ATTENTION : il faut en afficher 100 par page donc une pagination doit etre faite -->
<?php include('../inc/pdo.php'); ?>
<?php include('../inc/function.php'); ?>

<?php 
$num=100;
$page=1;
$offset=0;

if (!empty($_GET['page'])) {
    $page=$_GET['page'];
    $offset= $page*$num-$num;
}
//requete pour appeler la table movie full et selectionner tout, puis ensuite on limit a 100 et aussi on definit par quels films on commence
    $sql = "SELECT * FROM movies_full ORDER BY id LIMIT $offset,$num";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listingfilms = $query->fetchAll();
    // debug($listingfilms);
//requete pour compter le nombre d'élément total dans la table
    $sql2 = "SELECT COUNT(*) FROM movies_full";
    $query2 = $pdo->prepare($sql2);
    $query2->execute();
    $count = $query2->fetchColumn();

?>




<?php include('inc/headerb.php'); ?>

    <?php paginationfilms($num,$page,$count); ?>

<table class="listingfilms">
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td>Year</td>
        <td>Rating</td>
        <td>Actions</td>
    </tr>
    <?php 
    //boucle pour pouvoir afficher les films dans la table avec la caractéristiques demandé
        foreach ($listingfilms as $listingfilm) {
            echo('<tr><td>'.$listingfilm['id'].'</td><td>'.$listingfilm['title'].'</td><td>'.$listingfilm['year'].'</td><td>'.$listingfilm['rating'].'</td><td><a href="../detail.php?valeur='.$listingfilm['id'].'">Voir sur site</a><br><a href="modifierfilm.php?id='.$listingfilm['id'].'">Modifier</a><br><a href="#">Effacer</a></td></tr>');
        }
    ?>
</table>

    <?php paginationfilms($num,$page,$count); ?>


<?php include('inc/footerb.php'); ?>