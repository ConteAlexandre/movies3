<?php
$titlepage = "Mes Film A Voir";
include('inc/pdo.php');
include('inc/function.php');

// print_r($_SESSION);
//

$iduser = $_SESSION['user']['id'];

$errors = array();

$sql ="SELECT * FROM m3_users_movies WHERE id_user = :iduser ORDER BY created_at DESC ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':iduser',$iduser);
    $query->execute();
$usermovies=$query->fetchall();

// debug($usermovies);
include('inc/header.php');
if (!empty($usermovies)) {
  foreach ($usermovies as $usermovie) {
    $id_movie = $usermovie['id_movie'];

    $sql = "SELECT * FROM movies_full WHERE id = :Id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':Id',$id_movie);
        $query->execute();
    $movies[] = $query->fetch();
  }

  foreach ($movies as $movie) {
    echo '<div class=""><a href="detail.php?valeur='. $movie['id'] .'"><img src="posters/' . $movie['id'] . '.jpg" class="" alt="' . $movie['title'] . '"></a>';
    echo '<div class="">' . $movie['title'] . '</div>';
    echo '<div class="">' . $movie['year'] . '</div></div>';
    ?>
    <form class="" method="post">
      <input type="text" name="note" value="">
      <input type="submit" name="submitted" value="Noté">
    </form>

    <?php
  }
  if (!empty($_POST['submitted'])) {
    $note = trim(strip_tags($_POST['note']))

    formVerif($errors,$note,1,3,'note');
  }

}
