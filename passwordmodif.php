<?php

include('inc/pdo.php');
include('inc/function.php');

if (!empty($_GET['email']) && !empty($_GET['token'])) {
  $errors = array();
  //decode
  $email = urldecode($_GET['email']);
  $token = urldecode($_GET['token']);
  //requet sql
  $sql = "SELECT * FROM m3_users WHERE email= :Email AND token= :Token";
        $query = $pdo->prepare($sql);
        $query -> bindValue(':Email',$email);
        $query -> bindValue(':Token',$token);
        $query -> execute();
  $user = $query -> fetch();
  if (!empty($user)) {
    if (!empty($_POST['submitted'])) {
      $password = trim(strip_tags($_POST['password']));
      $password2 = trim(strip_tags($_POST['password2']));
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
        $sql = "UPDATE m3_users SET password=:Password, token=:Token, update_at= NOW() WHERE id=:Id";
            $query = $pdo->prepare($sql);
            $query->bindValue(':Id',$user['id']);
            $query->bindValue(':Password',$hash);
            $query->bindValue(':Token',$token);
            $query->execute();
        header('Location: connexion.php');
      }
    }
    include('inc/header.php');
    ?>
    <form class="" method="post">
      <input type="password" name="password" value=""><?php afficheErrors($errors,'password'); ?>
      <input type="password" name="password2" value="">
      <input type="submit" name="submitted" value="changez">
    </form>
    <?php
  }else {
    die('404');
  }



}else {
  die('404');
}

include('inc/footer.php');
