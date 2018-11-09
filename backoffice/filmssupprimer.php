<?php include('../inc/pdo.php'); ?>
<?php include('../inc/function.php'); ?>
<?php if(isadmin()){ ?>







<?php include('inc/headerb.php'); ?>


<p>Bravo votre film a été supprimé de la base de donnée.</p>





<?php include('inc/footerb.php'); ?>
<?php }else {
    die('403');
}