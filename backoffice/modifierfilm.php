<?php include('../inc/pdo.php'); ?>
<?php include('../inc/function.php'); ?>

<?php 
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM movies_full WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $movie = $query->fetch();
        // debug($movie);
    }
    $errors = array();
    if (!empty($_POST['submittedmovie'])) {
        
        $slug = trim(strip_tags($_POST['slug']));
        $errors = formVerif($errors,$slug,3,255,'slug',$empty = true);

        $title = trim(strip_tags($_POST['title']));
        $errors = formVerif($errors,$title,3,500,'title',$empty = true);

        $year = trim(strip_tags($_POST['year']));
        $errors = formVerif($errors,$year,2,4,'year',$empty = true);

        $genres = trim(strip_tags($_POST['genres']));
        $errors = formVerif($errors,$genres,3,255,'genres',$empty = true);

        $plot = trim(strip_tags($_POST['plot']));
        $errors = formVerif($errors,$plot,3,500,'plot',$empty = true);

        $directors = trim(strip_tags($_POST['directors']));
        $errors = formVerif($errors,$directors,3,255,'directors',$empty = true);

        $cast = trim(strip_tags($_POST['cast']));
        $errors = formVerif($errors,$cast,3,255,'cast',$empty = true);

        $writers = trim(strip_tags($_POST['writers']));
        $errors = formVerif($errors,$writers,3,255,'writers',$empty = true);

        $runtime = trim(strip_tags($_POST['runtime']));
        $errors = formVerif($errors,$runtime,2,11,'runtime',$empty = true);
        
        $mpaa = trim(strip_tags($_POST['mpaa']));
        $errors = formVerif($errors,$mpaa,3,25,'mpaa',$empty = true);

        $rating = trim(strip_tags($_POST['rating']));
        $errors = formVerif($errors,$rating,1,3,'rating',$empty = true);

        $popularity = trim(strip_tags($_POST['popularity']));
        $errors = formVerif($errors,$popularity,1,11,'popularity',$empty = true);

        if (count($errors)==0) {
            $sql2 = "UPDATE movies_full SET slug = :slug, title = :title, year = :year, genres = :genres, plot = :plot, directors = :directors, 
            cast = :cast, writers = :writers, runtime = :runtime, mpaa = :mpaa, rating = :rating, popularity = :popularity, modified = NOW() WHERE id = :id";
            $query2 = $pdo->prepare($sql2);
            $query2->bindValue(':slug', $slug, PDO::PARAM_STR);
            $query2->bindValue(':title', $title, PDO::PARAM_STR);
            $query2->bindValue(':year', $year, PDO::PARAM_INT);
            $query2->bindValue(':genres', $genres, PDO::PARAM_STR);
            $query2->bindValue(':plot', $plot, PDO::PARAM_STR);
            $query2->bindValue(':directors', $directors, PDO::PARAM_STR);
            $query2->bindValue(':cast', $cast, PDO::PARAM_STR);
            $query2->bindValue(':writers', $writers, PDO::PARAM_STR);
            $query2->bindValue(':runtime', $runtime, PDO::PARAM_INT);
            $query2->bindValue(':mpaa', $mpaa, PDO::PARAM_STR);
            $query2->bindValue(':rating', $rating, PDO::PARAM_STR);
            $query2->bindValue(':popularity', $popularity, PDO::PARAM_INT);
            $query2->bindValue(':id', $id, PDO::PARAM_INT);
            $query2->execute();
            header('Location: films.php');
        }else {
            die('../404.php');
        }
    }

?>




<?php include('inc/headerb.php'); ?>

<form action="" method="post">
    
    <label for="slug">Slug: </label>
    <span class="errors"><?php if (!empty($errors['slug'])) { echo $errors['slug']; } ?></span>
    <br><input type="text" name="slug" id="slug" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'slug'); ?>">

    <br><label for="title">Title: </label>
    <span class="errors"><?php if (!empty($errors['title'])) { echo $errors['title']; } ?></span>
    <br><input type="text" name="title" id="title" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'title'); ?>">

    <br><label for="year">Year: </label>
    <span class="errors"><?php if (!empty($errors['year'])) { echo $errors['year']; } ?></span>
    <br><input type="text" name="year" id="year" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'year'); ?>">

    <br><label for="genres">Genres: </label>
    <span class="errors"><?php if (!empty($errors['genres'])) { echo $errors['genres']; } ?></span>
    <br><input type="text" name="genres" id="genres" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'genres'); ?>">

    <br><label for="plot">Plot: </label>
    <span class="errors"><?php if (!empty($errors['plot'])) { echo $errors['plot']; } ?></span>
    <br><input type="text" name="plot" id="plot" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'plot'); ?>">

    <br><label for="directors">Directors: </label>
    <span class="errors"><?php if (!empty($errors['directors'])) { echo $errors['directors']; } ?></span>
    <br><input type="text" name="directors" id="directors" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'directors'); ?>">

    <br><label for="cast">Cast: </label>
    <span class="errors"><?php if (!empty($errors['cast'])) { echo $errors['cast']; } ?></span>
    <br><input type="text" name="cast" id="cast" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'cast'); ?>">

    <br><label for="writers">Writers: </label>
    <span class="errors"><?php if (!empty($errors['writers'])) { echo $errors['writers']; } ?></span>
    <br><input type="text" name="writers" id="writers" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'writers'); ?>">

    <br><label for="runtime">Runtime: </label>
    <span class="errors"><?php if (!empty($errors['runtime'])) { echo $errors['runtime']; } ?></span>
    <br><input type="text" name="runtime" id="runtime" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'runtime'); ?>">

    <br><label for="mpaa">Mpaa: </label>
    <span class="errors"><?php if (!empty($errors['mpaa'])) { echo $errors['mpaa']; } ?></span>
    <br><input type="text" name="mpaa" id="mpaa" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'mpaa'); ?>">

    <br><label for="rating">Rating: </label>
    <span class="errors"><?php if (!empty($errors['rating'])) { echo $errors['rating']; } ?></span>
    <br><input type="text" name="rating" id="rating" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'rating'); ?>">

    <br><label for="popularity">Popularity: </label>
    <span class="errors"><?php if (!empty($errors['popularity'])) { echo $errors['popularity']; } ?></span>
    <br><input type="text" name="popularity" id="popularity" value="<?php remplissageUpdateValue($errors,$_POST,$movie,'popularity'); ?>">

    <br><input type="submit" name="submittedmovie" value="ENVOYER">
</form>




<?php include('inc/footerb.php'); ?>