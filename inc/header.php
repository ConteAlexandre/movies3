<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= $titlepage ?></title>
    <link rel="stylesheet" href="asset/css/style.css">
  </head>

    <div class="container">

      <div class="wrap">

        <div class="logo">
          <a href="index.php"> <img src="asset\images\logo.png" alt=""></a>
        </div>

        <nav>

          <ul>
            <?php if (isLogged()) {
              ?><li> <a href="deconnexion.php">Logout</a> </li><?php
            }else {
              ?><li> <a href="connexion.php">Login</a> </li>
              <li> <a href="inscription.php">Sign in</a> </li><?php
            } ?>
          </ul>

        </nav>

      </div>
    </div>
  <div class="clear">

  </div>
  <body>
