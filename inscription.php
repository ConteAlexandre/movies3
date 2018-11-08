<?php
include('inc/pdo.php');
include('inc/function.php');


$errors = array();

if (!empty($_POST['submitted'])) {

  $pseudo = trim(strip_tags($_POST['pseudo']));
  $email = trim(strip_tags($_POST['email']));
  $password = trim(strip_tags($_POST['password']));
  $password2 = trim(strip_tags($_POST['password2']));




  if (!empty($pseudo)) {
    if (strlen($pseudo) < 3) {
      $errors['pseudo'] = "plus de 3 caract";
    }elseif (strlen($pseudo) > 255) {
      $errors['pseudo'] = "pas plus de 255";
    }else {
      $sql = "SELECT pseudo FROM m3_users WHERE pseudo = :Pseudo ";
          $query = $pdo -> prepare($sql);
          $query -> bindValue(':Pseudo',$pseudo);
          $query -> execute();

      $verifPseudo = $query->fetch();
      if (!empty($verifPseudo)) {
        $errors['pseudo'] = "changez de pseudo";
      }
    }
  }else{
    $errors['pseudo'] = "Ecrie stp";
  }





  if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $sql = "SELECT email FROM m3_users WHERE email = :Email ";
        $query = $pdo -> prepare($sql);
        $query -> bindValue(':Email',$email);
        $query -> execute();

    $verifEmail = $query->fetch();
    if (!empty($verifEmail)) {
      $errors['email'] = "cette email est deja utiliser sur le site";
    }

  } else {
    $errors['email'] = "veuillez renseigner un email valide";
  }

  if (!empty($password) && !empty($password2)) {
    if ($password != $password2) {
      $errors['password'] = 'mot de passe pas correct !';
    }else {

      if (strlen($password) < 3) {
        $errors['password'] = 'plus de 3 caract';
      }elseif (strlen($password) > 255) {
        $errors['password'] = 'pas plus de 255';
      }


    }
  }else {
    $errors['password'] = 'veuillez renseigner un mot de passe';
  }


if (count($errors) == 0) {
  $success = true;
  $hash = password_hash($password,PASSWORD_DEFAULT);
  $token = generateRandomString(255);


  $sql = "INSERT INTO m3_users (pseudo, email, password, token, created_at) VALUES (:Pseudo, :Email, :Password, '$token', NOW()) ";
      $query = $pdo->prepare($sql);
      $query->bindValue(':Pseudo',$pseudo);
      $query->bindValue(':Email',$email);
      $query->bindValue(':Password',$hash);
      $query->execute();


  header('Location: connection.php');


}






}









include('inc/header.php');
?>

<div class="wrap">
  <form class="" action="" method="post">
    <p>Pseudo</p>
    <input type="text" name="pseudo" value=""><?php afficheErrors($errors,'pseudo') ?>
    <p>Email</p>
    <input type="text" name="email" value=""><?php afficheErrors($errors,'email') ?>
    <p>Mot de passe</p>
    <input type="password" name="password" value=""><?php afficheErrors($errors,'password') ?>
    <p>confirmation du mot de passe</p>
    <input type="password" name="password2" value="">
    <input type="submit" name="submitted" value="S'incrire !">
  </form>
</div>


<?php




include('inc/footer.php');
