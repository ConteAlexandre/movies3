<?php include('../inc/pdo.php'); ?>
<?php include('../inc/function.php'); ?>
<?php if(isadmin()){ ?>

<?php 
    if (!empty($_GET['id'])&&is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        if (!empty($_POST['submittedoui'])) {
            $sql = "DELETE FROM movies_full WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->bindValue(':id',$id, PDO::PARAM_STR);
            $query->execute();
            header('Location: filmssupprimer.php');
        }elseif (!empty($_POST['submittednon'])) {
            header('Location: films.php');
        }             
    }else {
        header('Location: ../404.php');
    }
   
?>


<?php include('inc/headerb.php'); ?>

<p>Voulez vous supprimer ce film?</p>
<form action="" method="post">
<input type="submit" name="submittedoui" value="OUI" class="btn btn-outline">
<input type="submit" name="submittednon" value="NON">
</form>


<?php include('inc/footerb.php'); ?>
<?php }else {
    die('403');
}