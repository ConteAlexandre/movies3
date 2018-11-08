<?php
include('inc/header.php');
include('inc/function.php');
include('inc/pdo.php');

 ?>

<?php
$sql="SELECT * FROM movies_full ORDER BY rand() LIMIT 9";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchAll();
?>


<div class="background">
<div class="wrap">
<?php
foreach ($movies as $movie) {
  echo '<div class="film"><a href="detail.php?valeur='. $movie['id'] .'"><img src="posters/' . $movie['id'] . '.jpg" class="image" alt="' . $movie['title'] . '"></a>';
  echo '<div class="titre">' . $movie['title'] . '</div>';
  echo '<div class="year">' . $movie['year'] . '</div></div>';

}
?>

</div>
<div class="clear">

</div>

<div class="bouton">
  <a href="index.php">Voir d'autres films</a>
</div>
</div>
