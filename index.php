<?php
$titlepage = "Accueil";
include('inc/function.php');
include('inc/pdo.php');

 ?>

<?php


$sql="SELECT * FROM movies_full ORDER BY rand() LIMIT 9";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchAll();

$sql="SELECT * FROM movies_full ";
$query = $pdo -> prepare($sql);
$query -> execute();
$years = $query -> fetchAll();

?>

<?php include('inc/header.php'); ?>
<div class="background">
  <div class="wrap">
    <div class="filtre">


    <?php
      $sql = "SELECT genres FROM movies_full";
      $query = $pdo->prepare($sql);
      $query->execute();
      $genres = $query->fetchall();

      $tableau = array();

      foreach ($genres as $genre) {
        $g = $genre['genres'];
        $explode = explode(',',$g);
          foreach ($explode as $ex) {
            $ex = trim($ex);
            if (!in_array($ex,$tableau)) {
              if (!empty($ex)) {
                $tableau[] = $ex;
              }
            }
          }
      }

      $sql = "SELECT year FROM movies_full ORDER BY year ASC";
      $query = $pdo->prepare($sql);
      $query->execute();
      $years = $query->fetchall();

      $annees = array();

      foreach ($years as $year) {
        $y = $year['year'];
        $explode = explode(' ',$y);
          foreach ($explode as $ex) {
            $ex = trim($ex);
            if (!in_array($ex,$annees)) {
              if (!empty($ex)) {
                $annees[] = $ex;
              }
            }
          }
      }
      // print_r($annees);



    ?>

    <div class="filtres">


    <p><h1>Tier par :</h1></p>
    <p><h2>Genre :</h2></p></br>
    </div>
    <form class="" action="" method="post">
    <ul>
    <?php
    foreach ($tableau as $table) {
      ?><li>
          <input type="checkbox" name="recherche[]" value="<?= $table;?>"><?php echo $table;?></li><?php
    } ?>
  </ul>
  </br>


  <div class="filtres">
  <p><h2>Années : </h2></p></br>
  <select name="annees">
  <?php
  foreach ($annees as $annee) {
    ?>
        <option value="<?php echo $annee; ?>"><?php echo $annee; ?></option><?php
  } ?>

</br>
  </div>
<div class="clear"></div>
<input type="submit" name="submitted" value="recherche">

<?php
if (!empty($_POST['submitted'])) {
  print_r($_POST['recherche']);
  } ?>

</form>





    </div>
    <div class="clear"></div>


    <?php
      foreach ($movies as $movie) {
        echo '<div class="film"><a href="detail.php?valeur='. $movie['id'] .'"><img src="posters/' . $movie['id'] . '.jpg" class="image" alt="' . $movie['title'] . '"></a>';
        echo '<div class="titre">' . $movie['title'] . '</div>';
        echo '<div class="year">' . $movie['year'] . '</div></div>';

      }
    ?>

  </div>
  <div class="clear"></div>

  <div class="bouton">
    <a href="index.php">Voir d'autres films</a>
  </div>
</div>

<?php include('inc/footer.php'); ?>
