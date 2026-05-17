<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Web</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
  <?php
        include_once 'koneksi.php';
        include_once 'models/Jenis.php';
        include_once 'models/Produk.php';
        include_once 'models/Member.php';
        include_once 'models/Study.php';

        $isLoggedIn = isset($_SESSION['MEMBER']);
        $hal = $_GET['hal'] ?? 'home';

        // Guest hanya boleh akses studies + login
        if (!$isLoggedIn) {
          $allowedGuestPages = ['studies', 'login'];
          if (!in_array($hal, $allowedGuestPages, true)) {
            header('Location: index.php?hal=studies');
            exit;
          }
        }
  ?>
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <?php include_once 'header.php'; ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <?php include_once 'menu.php'; ?>
      </div>
    </div>

    <br />

    <div class="row">
      
      <div class="col-md-3">
        <?php include_once 'sidebar.php'; ?>
      </div>

      <div class="col-md-9">
        <?php
        $req = $hal;
        $file = $req . '.php';
        if (is_file($file)) {
          include_once $file;
        } else {
          include_once 'studies.php';
        }
        ?>
      </div>

      
    </div>

    <br />

    <div class="row">
      <div class="col-md-12">
        <?php include_once 'footer.php'; ?>
      </div>
    </div>

  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>