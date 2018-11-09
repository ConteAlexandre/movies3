<?php

function formVerif($errors,$data,$min,$max,$key,$empty = true){
  if (!empty($data)) {
    if (strlen($data) < $min) {
      $errors[$key] = 'Minimum de '.$min.' caracteres';
    } elseif (strlen($data) > $max) {
      $errors[$key] = 'Maximum de '.$max.' caracteres';
    }
  }else {
    if ($empty) {
      $errors[$key] = 'veuillez renseigner ce champ';
    }
  }

  return $errors;
}
function formVerifNmb($errors,$data,$min,$max,$key,$empty = true){
  if (!empty($data)) {
    if (strlen((string)$data) < $min) {
      $errors[$key] = 'Minimum de '.$min.' caracteres';
    } elseif (strlen((string)$data) > $max) {
      $errors[$key] = 'Maximum de '.$max.' caracteres';
    }
  }else {
    if ($empty) {
      $errors[$key] = 'veuillez renseigner ce champ';
    }
  }

  return $errors;
}


function afficheErrors($errors,$key){
?>
<span class="errors"><?php if (!empty($errors[$key])) { echo $errors[$key]; } ?></span>
<?php
}

function remplissageValue($bl,$key){
  if (!empty($bl)) {
  echo $bl[$key];
  }
}

function br(){
  echo '<br>';
}

function debug($a){
  echo('<pre>');
  print_r($a);
  echo('</pre>');
}

function remplissageComValue($errors,$post,$key){
  if (!empty($errors)) {
  echo $post[$key];
  }
}

  function remplissageUpdateValue($err,$var1,$var2,$key){ //si erreur on recup $post mais si pas d'erreur on envoie le form
    if (!empty($err)) {
      echo $var1[$key];
    }else{
      echo $var2[$key];
  }
}


// generation token
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// connecter ou pas
function isLogged(){
  if (!empty($_SESSION['user'])) {
    if (!empty($_SESSION['user']['id'])) {
      if (!empty($_SESSION['user']['email'])) {
        if (!empty($_SESSION['user']['role'])) {
          if (!empty($_SESSION['user']['ip'])) {
            if ($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
              return true;
            }
          }
        }
      }
    }
  }
  return false;
}
function isadmin(){
  if (!empty($_SESSION['user'])) {
    if (!empty($_SESSION['user']['id'])) {
      if (!empty($_SESSION['user']['email'])) {
        if (!empty($_SESSION['user']['role'])&&$_SESSION['user']['role']=='admin') {
          if (!empty($_SESSION['user']['ip'])) {
            if ($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
              return true;
            }
          }
        }
      }
    }
  }
  return false;
}
//creer une pagination pour lister les films en backoffice
function paginationfilms($num,$page,$count){
  echo '<div class="pagination">';
	if ($page > 1){
        echo '<a href="films.php?page=' . ($page - 1) . '">Précédent</a>';
  }

 	//n'affiche le lien vers la page suivante que s'il y en a un
 	//basée sur le count() de MYSQL
  if ($page*$num < $count) {
        echo '<a href="films.php?page=' . ($page + 1) . '"">Suivant</a>';
  }

    echo '</div>';
}
