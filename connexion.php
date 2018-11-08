<?php


include('inc/pdo.php');
include('inc/function.php');

$errors = array();

if (!empty($_POST)) {

  $login = trim(strip_tags($_POST['login']));
  $password = trim(strip_tags($_POST['password']));


  $sql = "SELECT * FROM m3_users
          WHERE pseudo = :login OR email = :login";
          $query = $pdo->prepare($sql);
          $query->bindvalue(':login',$login);
          $query->execute();
      $tritri = $query->fetch();

  if (!empty($tritri)) {

    if (password_verify($password,$tritri['password'])) {
      if (count($errors) == 0) {
        $_SESSION['user'] = array(
          'id' => $tritri ['id'], 'pseudo' => $tritri ['pseudo'], 'email' => $tritri ['email'], 'role' => $tritri['role'], 'ip' => $_SERVER['REMOTE_ADDR']
        );
        header('Location: index.php');
      }
    }else {
      $errors['password'] = 'votre mdp est incorrect';
    }


  }else {
    $errors['login'] = 'Vos identifient ne fonctionne pas !';
  }

  }








include('inc/header.php');



?>

<form class="" action="" method="post">
  <label for="login">Pseudo or Email</label>
  <input type="text" name="login" value=""><?php afficheErrors($errors,'login'); ?>
  <label for="login">Password</label>
  <input type="password" name="password" value=""><?php afficheErrors($errors,'password'); ?>
  <input type="submit" name="submitted" value="connexion">
</form>

<a href="passwordforget.php">mot de passe oublier</a>

<?php
include('inc/footer.php');
