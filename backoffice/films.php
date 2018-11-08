<!-- Sur cette page, nous allons  integrer la liste des films en base données ATTENTION : il faut en afficher 100 par page donc une pagination doit etre faite -->
<?php include('../inc/pdo.php'); ?>
<?php include('../inc/function.php'); ?>

<?php 
    $sql = "SELECT * FROM movies_full";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listingfilms = $query->fetchAll();
    // print_r($listingfilms);
?>




<?php include('inc/headerb.php'); ?>



<table class="listingfilms">
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td>Year</td>
        <td>Rating</td>
        <td>Actions</td>
    </tr>
</table>



<?php include('inc/footerb.php'); ?>