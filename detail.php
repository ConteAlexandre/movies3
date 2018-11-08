<?php
include('inc/function.php');
include('inc/pdo.php');
include('inc/header.php');
?>



<?php
global $movies;
global $valeur;
global $film;
if (!empty($_GET['valeur']) && is_numeric($_GET['valeur'])) {
  $valeur = $_GET['valeur'];
  $sql="SELECT * FROM movies_full WHERE id = :id";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':id', $valeur);
  $query -> execute();
  $movies = $query -> fetchAll();


  foreach ($movies as $movie) {
    if ($valeur == $movie['id']) {
      $film = $movie;
    }
    else {
  die('404');
}
}

}
?>

<div class="wrap">


<div class="details">


<?php
echo '<img src="posters/' . $movie['id'] . '.jpg" class="image" alt="' . $movie['title'] . '">';
echo '</br>';
echo 'Voici les détails de : ' . $movie['title'];
echo '</br>';
echo 'Ce film a été produit en : ' . $movie['year'] ;
echo '</br>';
echo 'Il a été réalisé par : ' . $movie['directors'];
echo '</br>';
echo 'Ce film a une note de : ' . $movie['rating'] . ' sur IMDB';
echo '</br>';
echo 'Le cast du film est :' . $movie['cast'];
echo '</br>';



 ?>;
 </div>
</div>
