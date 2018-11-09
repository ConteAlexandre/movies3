<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="asset/styleb.css">
    <link rel="stylesheet" href="dist/css/metisMenu.min.css">
    <link rel="stylesheet" href="dist/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">




    <title><?php $title ?></title>
</head>
<body class="panel panel-default panel-body">
    <div id="wraper">
        <header id="header">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h4 style="margin-left: 20px">BackOffice</h4>
            </div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="dashboard.php   " role="tab" aria-controls="pills-home" aria-selected="true">Statistiques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="films.php" role="tab" aria-controls="pills-profile" aria-selected="false">Films</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#" role="tab" aria-controls="pills-contact" aria-selected="false">Utilisateurs</a>
                    </li>
                </ul>
            </nav>
        </header>
        