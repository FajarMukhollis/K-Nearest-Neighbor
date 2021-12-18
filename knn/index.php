<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Klasifikasi Metode k-Nearest Neighbor (KNN)" />
  <link rel="icon" href="assets/favicon.ico" />

  <title>K Nearest Neighbor</title>
  <link href="assets/css/cerulean-bootstrap.min.css" rel="stylesheet" />
  <!-- <link href="assets/css/general.css" rel="stylesheet" /> -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="?">k-NN</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <?php if ($_SESSION['login']) : ?>
            <li><a href="?m=atribut"><span class="glyphicon glyphicon-th-large"></span> Atribut</a></li>
            <li><a href="?m=nilai"><span class="glyphicon glyphicon-th"></span> Nilai Atribut</a></li>
            <li><a href="?m=dataset"><span class="glyphicon glyphicon-star"></span> Dataset</a></li>
            <li><a href="?m=hitung"><span class="glyphicon glyphicon-calendar"></span> Perhitungan</a></li>
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          <?php else : ?>
            <li><a href="?m=hitung"><span class="glyphicon glyphicon-calendar"></span> Konsultasi</a></li>
            <li><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <?php
    if (file_exists($mod . '.php'))
      include $mod . '.php';
    else
      include 'home.php';
    ?>
  </div>
</body>

</html>