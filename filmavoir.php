<?php
$titlepage = "Mes Film A Voir";
include('inc/pdo.php');
include('inc/function.php');






$iduser = $_SESSION['user']['id'];

$errors = array();

$sql = "SELECT * FROM m3_users_movies AS mum
            LEFT JOIN movies_full AS mf
            ON mum.id_movie = mf.id
            WHERE note_movie IS NULL";
        $query = $pdo->prepare($sql);
        $query->execute();
$movies = $query->fetchAll();

// debug($usermovies);
////////////////////////////////////////////////////////////////////////////////
include('inc/header.php');
if (!empty($movies)) {

  if (!empty($_POST['submitted'])) {
    $note = trim(strip_tags($_POST['note']));

    $movieIdForm = $_POST['movieId'];

    // echo $movieIdForm;

    if (!empty($note)) {
      if ($note >= 100) {
        $errors['note'] = 'une note sur 100 svp';
      }
    }else{
      $errors['note'] = 'veuillez rentrer une note svp';
    }

    if (count($errors) == 0) {
      $sql ="UPDATE m3_users_movies
      SET note_movie = :note, updated_at = NOW()
      WHERE id_user = :iduser AND id_movie = :idmovie";
      $query=$pdo->prepare($sql);
      $query->bindValue(':note',$note);
      $query->bindValue(':iduser',$iduser);
      $query->bindValue(':idmovie',$movieIdForm);
      $query->execute();
    }
  }

  foreach ($movies as $movie) {
    echo '<div class=""><a href="detail.php?slug='. $movie['slug'] .'"><img src="posters/' . $movie['id'] . '.jpg" class="" alt="' . $movie['title'] . '"></a>';
    echo '<div class="">' . $movie['title'] . '</div>';
    echo '<div class="">' . $movie['year'] . '</div></div>';
    ?>
    <form class="" method="post">
      <input type="hidden" name="movieId" value="<?= $movie['id']; ?>">
      <?php
      if (!empty($_POST['submitted']) && !empty($errors)) {
        if ($movie['id'] == $movieIdForm) {
          echo $errors['note'];
        }
      }
       ?>
      <input type="text" name="note" value="">
      <input type="submit" name="submitted" value="Noté">
    </form>
    <?php
  }


}
