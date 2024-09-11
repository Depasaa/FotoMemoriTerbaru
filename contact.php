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
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="dist/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/navmenu-reveal.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Style for Dark Mode and Clean Mode -->
    <style>
        body {
            transition: background-color 0.5s, color 0.5s;
        }
        body.clean-mode {
            background-color: #ffffff;
            color: #000000;
        }
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .navbar-toggle .icon-bar {
            background-color: #000;
        }
        body.dark-mode .navbar-toggle .icon-bar {
            background-color: #fff;
        }
        .carousel-caption h2, .carousel-caption h1 {
            transition: color 0.5s;
        }
        body.dark-mode .carousel-caption h2, body.dark-mode .carousel-caption h1 {
            color: #ffffff;
        }
        .navmenu {
            background-color: #f8f8f8;
            transition: background-color 0.5s;
        }
        body.dark-mode .navmenu {
            background-color: #333;
        }
        .social a {
            color: #000;
            transition: color 0.5s;
        }
        body.dark-mode .social a {
            color: #fff;
        }
        .navmenu a {
            color: #000;
            transition: color 0.5s;
        }
        body.dark-mode .navmenu a {
            color: #fff;
        }
        footer {
            background-color: #f8f8f8;
            padding: 10px 0;
            text-align: center;
            transition: background-color 0.5s, color 0.5s;
        }
        body.dark-mode footer {
            background-color: #333;
            color: #fff;
        }
        /* Toggle button */
        #toggleMode {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1000;
        }
        #toggleMode:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body class="clean-mode">
  <div class="bar">
    <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu" data-canvas=".canvas">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>

  <div class="navmenu navmenu-default navmenu-fixed-left">
     <ul class="nav navmenu-nav">
        <li><a href="index.html">Beranda</a></li>
        <li><a href="works.html">Galeri Karya</a></li>
        <li><a href="blog.html">Fotografer</a></li>
        <li><a href="contact.php">Hubungi</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
      <a class="navmenu-brand" href="#"><img src="LogoFotoMemoriRevTransparant.png" width="160"></a>
      <div class="social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-youtube"></i></a>
      </div>
      <div class="copyright-text">©Copyright <a href="https://themewagon.com/"> Depasaa</a> 2024</div>
  </div>

  <div id="myCarousel" class="canvas carousel slide" data-ride="carousel">
    <ol class="carousel-indicators xtra-border">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
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

  <button id="toggleMode">Toggle Mode</button>

  <!-- Section About -->
  <div class="about-section">
    <div class="container">
      <h2>Tentang Kami</h2>
      <div class="row">
        <div class="col-md-4">
          <i class="fa fa-camera fa-3x" aria-hidden="true"></i>
          <h4>Fotografi Profesional</h4>
          <p>Menangkap setiap momen dengan sempurna. Tim fotografer kami memiliki pengalaman bertahun-tahun di berbagai acara.</p>
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
  <div class="services-section">
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

  <!-- Footer -->
  <footer>
    <p>©2024 FotoMemori | All Rights Reserved</p>
  </footer>

  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="dist/js/jasny-bootstrap.min.js"></script>

  <!-- Script to Toggle Dark and Clean Mode -->
  <script>
    document.getElementById('toggleMode').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        document.body.classList.toggle('clean-mode');
    });
  </script>
</body>
</html>
