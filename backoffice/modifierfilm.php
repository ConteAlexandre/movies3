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
        debug($movie);
    }
    $error = array();
    if (!empty($_POST['submittedmovie'])) {
        
        $slug = trim(strip_tags($_POST['slug']));
        $error = formVerif($errors,$slug,3,255,'slug',$empty = true);

        $title = trim(strip_tags($_POST['title']));
        $error = formVerif($errors,$title,3,500,'title',$empty = true);

        $year = trim(strip_tags(is_numeric($_POST['year'])));
        $error = formVerif($errors,$year,2,11,'year',$empty = true);

        $genres = trim(strip_tags($_POST['genres']));
        $error = formVerif($errors,$genres,3,255,'genres',$empty = true);

        $plot = trim(strip_tags($_POST['plot']));
        $error = formVerif($errors,$plot,3,500,'plot',$empty = true);

        $directors = trim(strip_tags($_POST['directors']));
        $error = formVerif($errors,$directors,3,255,'directors',$empty = true);

        $cast = trim(strip_tags($_POST['cast']));
        $error = formVerif($errors,$cast,3,255,'cast',$empty = true);

        $writers = trim(strip_tags($_POST['writers']));
        $error = formVerif($errors,$writers,3,255,'writers',$empty = true);

        $runtime = trim(strip_tags(is_numeric($_POST['runtime'])));
        $error = formVerif($errors,$runtime,2,11,'runtime',$empty = true);
        
        $mpaa = trim(strip_tags($_POST['mpaa']));
        $error = formVerif($errors,$mpaa,3,25,'mpaa',$empty = true);

        $rating = trim(strip_tags($_POST['rating']));
        $error = formVerif($errors,$rating,1,3,'rating',$empty = true);

        $popularity = trim(strip_tags(is_numeric($_POST['popularity'])));
        $error = formVerif($errors,$popularity,1,11,'popularity',$empty = true);
    }

?>




<?php include('inc/headerb.php'); ?>

<form action="" method="post">
    
    <label for="slulg">Slug: </label>
    <br><input type="text" name="slug" id="slug" value="<?php remplissageUpdateValue($error,$_POST,$movie,'slug'); ?>">

    <br><label for="title">Title: </label>
    <br><input type="text" name="title" id="title" value="<?php remplissageUpdateValue($error,$_POST,$movie,'title'); ?>">

    <br><label for="year">Year: </label>
    <br><input type="text" name="year" id="year" value="<?php remplissageUpdateValue($error,$_POST,$movie,'year'); ?>">

    <br><label for="genres">Genres: </label>
    <br><input type="text" name="genres" id="genres" value="<?php remplissageUpdateValue($error,$_POST,$movie,'genres'); ?>">

    <br><label for="plot">Plot: </label>
    <br><input type="text" name="plot" id="plot" value="<?php remplissageUpdateValue($error,$_POST,$movie,'plot'); ?>">

    <br><label for="directors">Directors: </label>
    <br><input type="text" name="directors" id="directors" value="<?php remplissageUpdateValue($error,$_POST,$movie,'directors'); ?>">

    <br><label for="cast">Cast: </label>
    <br><input type="text" name="cast" id="cast" value="<?php remplissageUpdateValue($error,$_POST,$movie,'cast'); ?>">

    <br><label for="writers">Writers: </label>
    <br><input type="text" name="writers" id="writers" value="<?php remplissageUpdateValue($error,$_POST,$movie,'writers'); ?>">

    <br><label for="runtime">Runtime: </label>
    <br><input type="text" name="runtime" id="runtime" value="<?php remplissageUpdateValue($error,$_POST,$movie,'runtime'); ?>">

    <br><label for="mpaa">Mpaa: </label>
    <br><input type="text" name="mpaa" id="mpaa" value="<?php remplissageUpdateValue($error,$_POST,$movie,'mpaa'); ?>">

    <br><label for="rating">Rating: </label>
    <br><input type="text" name="rating" id="rating" value="<?php remplissageUpdateValue($error,$_POST,$movie,'rating'); ?>">

    <br><label for="popularity">Popularity: </label>
    <br><input type="text" name="popularity" id="popularity" value="<?php remplissageUpdateValue($error,$_POST,$movie,'popularity'); ?>">

    <br><input type="submit" name="submittedmovie" value="ENVOYER">
</form>




<?php include('inc/footerb.php'); ?>