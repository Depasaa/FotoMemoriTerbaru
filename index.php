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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom styles for this template -->
  <link href="css/navmenu-reveals.css" rel="stylesheet">
  <link href="css/stylesss.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  <style>
    .nav-icon {
      margin-right: 5px;
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


  <div id="myCarousel" class="carousel slide canvas" data-ride="carousel">
    <!-- Full Page Image Background Carousel Header -->
    <!-- Indicators -->
    <ol class="carousel-indicators xtra-border">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for Slides -->
    <div class="carousel-inner " role="listbox">
      <div class="item active">
        <img src="background1.jpg" alt="First slide">
        <div class="carousel-caption">
          <h2 class="sub-title-home">Kami Tidak Mengambil Foto</h2>
          <h1 class="title-home">Kami Membuatnya</h1>
        </div>
      </div>
      <div class="item">
        <img src="background2.jpg" alt="Second slide">
        <div class="carousel-caption">
          <h2 class="sub-title-home">Kami Tidak Mengambil Foto</h2>
          <h1 class="title-home">Kami Membuatnya</h1>
        </div>
      </div>
      <div class="item">
        <img src="background3.jpg" alt="Third slide">
        <div class="carousel-caption">
          <h2 class="sub-title-home">Kami Tidak Mengambil Foto</h2>
          <h1 class="title-home">Kami Membuatnya</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Section About -->
  <div class="about-section section">
    <div class="container">
      <h2>Tentang Kami</h2>
      <div class="row">
        <div class="col-md-4">
          <i class="fa fa-camera fa-3x" aria-hidden="true"></i>
          <h4>Fotografi Profesional</h4>
          <p>Menangkap setiap momen dengan sempurna. Tim fotografer kami memiliki pengalaman bertahun-tahun di berbagai
            acara.</p>
        </div>
        <div class="col-md-4">
          <i class="fa fa-heart fa-3x" aria-hidden="true"></i>
          <h4>Personalized Service</h4>
          <p>Setiap klien adalah unik. Kami memastikan setiap sesi foto mencerminkan kepribadian dan kebutuhan Anda.</p>
        </div>
        <div class="col-md-4">
          <i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i>
          <h4>Hasil Terbaik</h4>
          <p>Kami tidak hanya mengambil foto, kami menciptakan karya seni yang dapat dikenang seumur hidup.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Services -->
  <div class="services-section section">
    <div class="container">
      <h2>Layanan Kami</h2>
      <div class="row">
        <div class="col-md-4">
          <i class="fa fa-venus fa-3x" aria-hidden="true"></i>
          <h4>Wedding Photography</h4>
          <p>Mengabadikan setiap momen penuh cinta dari hari pernikahan Anda.</p>
        </div>
        <div class="col-md-4">
          <i class="fa fa-users fa-3x" aria-hidden="true"></i>
          <h4>Family Portraits</h4>
          <p>Potret keluarga yang indah untuk kenangan seumur hidup.</p>
        </div>
        <div class="col-md-4">
          <i class="fa fa-birthday-cake fa-3x" aria-hidden="true"></i>
          <h4>Event Photography</h4>
          <p>Mengabadikan momen terbaik dari setiap acara yang Anda selenggarakan.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Testimonial -->
  <div class="testimonial-section section">
    <div class="container">
      <h2>Apa Kata Pelanggan</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="testimonial-box">
            <p>"Pelayanan yang sangat profesional, hasil foto sangat memuaskan!"</p>
            <h4>- John Doe</h4>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-box">
            <p>"Tim FotoMemori menangkap setiap momen dengan indah. Sangat merekomendasikan!"</p>
            <h4>- Sarah Smith</h4>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-box">
            <p>"Kualitas foto yang luar biasa dan layanan yang ramah."</p>
            <h4>- Michael Lee</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="dist/js/jasny-bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script>
    $('.carousel').carousel({
      interval: 6000 //changes the speed
    });
  </script>
  <script>
  function confirmLogout() {
    return confirm("Apakah Anda yakin ingin keluar?");
  }
</script>
</body>

</html>