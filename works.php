<?php
session_start(); // Mulai sesi
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../../assets/ico/favicon.png">

  <title>FotoMemori</title>

  <!-- Bootstrap core CSS -->

  <link href="dist/css/jasny-bootstraps.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  <link href="css/bootstrapss.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/navmenu-reveals.css" rel="stylesheet">
  <link href="css/styless.css" rel="stylesheet">
  <link href="css/full-slider.css" rel="stylesheet">
  <link href="css/Icomoon/style.css" rel="stylesheet" type="text/css" />
  <link href="css/animated-masonry-gallery.css" rel="stylesheet" type="text/css" />
  <link href="css/lightbox.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
    .nav-icon {
      margin-right: 5px;
      /* Atur jarak sesuai kebutuhan */
    }
  </style>
</head>

<body>
  <div class="navmenu navmenu-default navmenu-fixed-left in">
    <ul class="nav navmenu-nav">
      <li><a href="index.php"><i class="fa fa-home nav-icon"></i> Beranda</a></li>
      <li><a href="works.php"><i class="fa fa-image nav-icon"></i> Galeri Karya</a></li>
      <li><a href="blog.php"><i class="fa fa-camera nav-icon"></i> Fotografer</a></li>
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <li><a href="membership.php"><i class="fa fa-users nav-icon"></i> Membership</a></li>
        <li><a href="edituser.php"><i class="fa fa-cog nav-icon"></i> Pengaturan</a></li>
        <li><a href="logout.php" onclick="return confirmLogout();"><i class="fa fa-sign-out-alt nav-icon"></i> Logout</a></li>
      <?php else: ?>
        <li><a href="login.php"><i class="fa fa-sign-in-alt nav-icon"></i> Login</a></li>
      <?php endif; ?>
    </ul>
    <a class="navmenu-brand" href="#"><img src="LogoFotoMemoriRevTransparant.png" width="160"></a>
    <div class="social">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
    </div>
    <div class="copyright-text">©Copyright <a href="https://themewagon.com/"> Depasaa</a> 2024</div>
  </div>


  <div class="canvas gallery"><br>
    <h1 class="blog-post-title text-center">Karya-karya terbaik kami</h1>
    <span class="title-divider"></span>

    <div id="gallery">
      <div id="gallery-header">
        <div id="gallery-header-center">
          <div id="gallery-header-center-left">
            <!-- <div id="gallery-header-center-left-icon">
                </div> -->
            <div id="gallery-header-center-left-title">Semua Galeri</div>
          </div>
          <div id="gallery-header-center-right">
            <div class="gallery-header-center-right-links gallery-header-center-right-links-current" data-filter="*">
              Semua</div>
            <div class="gallery-header-center-right-links" data-filter=".studio">Studio</div>
            <div class="gallery-header-center-right-links" data-filter=".landscape">Landscapes</div>
            <div class="gallery-header-center-right-links" data-filter=".action">Action</div>
          </div>
        </div>
      </div>
      <div id="gallery-content">
        <div id="gallery-content-center" class="row gallery-content-center-full">
          <a class="col-md-4 studio action" href="assets/studio1.jpg" data-lightbox="studio1"><img
              src="assets/studio1.jpg" class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape1.jpg" data-lightbox="studio1"><img
              src="assets/landscape1.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio2.jpg" data-lightbox="studio1"><img src="assets/studio2.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio25.jpg" data-lightbox="studio1"><img src="assets/studio25.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape2.jpg" data-lightbox="studio1"><img
              src="assets/landscape2.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio27.jpg" data-lightbox="studio1"><img src="assets/studio27.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio3.jpg" data-lightbox="studio1"><img src="assets/studio3.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape action" href="assets/landscape3.jpg" data-lightbox="studio1"><img
              src="assets/landscape3.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio26.jpg" data-lightbox="studio1"><img src="assets/studio26.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio4.jpg" data-lightbox="studio1"><img src="assets/studio4.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape4.jpg" data-lightbox="studio1"><img
              src="assets/landscape4.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio5.jpg" data-lightbox="studio1"><img src="assets/studio5.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape5.jpg" data-lightbox="studio1"><img
              src="assets/landscape5.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio6.jpg" data-lightbox="studio1"><img src="assets/studio6.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape6.jpg" data-lightbox="studio1"><img
              src="assets/landscape6.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio7.jpg" data-lightbox="studio1"><img src="assets/studio7.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape7.jpg" data-lightbox="studio1"><img
              src="assets/landscape7.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio8.jpg" data-lightbox="studio1"><img src="assets/studio8.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape8.jpg" data-lightbox="studio1"><img
              src="assets/landscape8.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio9.jpg" data-lightbox="studio1"><img src="assets/studio9.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape9.jpg" data-lightbox="studio1"><img
              src="assets/landscape9.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio10.jpg" data-lightbox="studio1"><img src="assets/studio10.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape10.jpg" data-lightbox="studio1"><img
              src="assets/landscape10.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio11.jpg" data-lightbox="studio1"><img src="assets/studio11.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape11.jpg" data-lightbox="studio1"><img
              src="assets/landscape11.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio12.jpg" data-lightbox="studio1"><img src="assets/studio12.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape12.jpg" data-lightbox="studio1"><img
              src="assets/landscape12.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio13.jpg" data-lightbox="studio1"><img src="assets/studio13.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape13.jpg" data-lightbox="studio1"><img
              src="assets/landscape13.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio14.jpg" data-lightbox="studio1"><img src="assets/studio14.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape14.jpg" data-lightbox="studio1"><img
              src="assets/landscape14.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio15.jpg" data-lightbox="studio1"><img src="assets/studio15.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape15.jpg" data-lightbox="studio1"><img
              src="assets/landscape15.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio16.jpg" data-lightbox="studio1"><img src="assets/studio16.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape16.jpg" data-lightbox="studio1"><img
              src="assets/landscape16.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio17.jpg" data-lightbox="studio1"><img src="assets/studio17.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape17.jpg" data-lightbox="studio1"><img
              src="assets/landscape17.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio18.jpg" data-lightbox="studio1"><img src="assets/studio18.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 landscape" href="assets/landscape18.jpg" data-lightbox="studio1"><img
              src="assets/landscape18.jpg" class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio19.jpg" data-lightbox="studio1"><img src="assets/studio19.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio20.jpg" data-lightbox="studio1"><img src="assets/studio20.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio21.jpg" data-lightbox="studio1"><img src="assets/studio21.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio22.jpg" data-lightbox="studio1"><img src="assets/studio22.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio23.jpg" data-lightbox="studio1"><img src="assets/studio23.jpg"
              class="img-responsive"></a>
          <a class="col-md-4 studio" href="assets/studio24.jpg" data-lightbox="studio1"><img src="assets/studio24.jpg"
              class="img-responsive"></a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
  </script>
  <script type="text/javascript" src="js/isotope.js"></script>
  <script src="dist/js/jasny-bootstrap.min.js"></script>
  <script src="js/lightbox.js"></script>
  <script type="text/javascript" src="js/animated-masonry-gallery.js"></script>
  <script>
    function confirmLogout() {
      return confirm("Apakah Anda yakin ingin keluar?");
    }
  </script>
</body>

</html>