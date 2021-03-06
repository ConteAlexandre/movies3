<?php
$titlepage = "Detail";
include('inc/pdo.php');
include('inc/function.php');


global $movies;
global $slug;
global $film;

if (!empty($_GET['slug'])) {
  $slug = trim(strip_tags($_GET['slug']));
  // $slug = $_GET['slug'];
  $sql="SELECT * FROM movies_full WHERE slug = :slug";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':slug', $slug);
  $query -> execute();
  $movies = $query -> fetchAll();


  foreach ($movies as $movie) {
    if ($slug == $movie['slug']) {
      $film = $movie;
    }
    else {
  die('404');
}
}

}
include('inc/header.php');

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

  if (isLogged()) {


  $iduser = $_SESSION['user']['id'];
  $idmovie = $movie['id'];


  if (!empty($_POST['submittedAVoir'])) {
    $sql = "INSERT INTO m3_users_movies (id_user, id_movie, created_at) VALUES (:Iduser, :Idmovie, NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Iduser',$iduser);
        $query->bindValue(':Idmovie',$idmovie);
        $query->execute();

  }

  if (!empty($_POST['submittedNePlusVoir'])) {
    $sql = "DELETE FROM m3_users_movies WHERE id_user = :iduser AND id_movie = :Idmovie";
        $query = $pdo->prepare($sql);
        $query->bindValue(':iduser',$iduser);
        $query->bindValue(':Idmovie',$idmovie);
        $query->execute();
  }

  $sql = "SELECT id FROM m3_users_movies WHERE id_user = :iduser AND id_movie = :Idmovie";
      $query = $pdo->prepare($sql);
      $query->bindValue(':iduser',$iduser);
      $query->bindValue(':Idmovie',$idmovie);
      $query->execute();
  $verifVoir=$query->fetch();


  ?>
  <form class="" method="post">
    <?php if (!empty($verifVoir)) {
      ?><input type="submit" name="submittedNePlusVoir" value="Ne plus voir"><?php
    }else {
      ?><input type="submit" name="submittedAVoir" value="A voir"><?php
    } ?>
  </form>


  <?php
  }

 ?>
 </div>
</div>
