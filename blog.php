<?php
session_start(); // Mulai sesi

// Koneksi ke database
require 'koneksi.php'; // Ganti dengan file koneksi Anda

// Query untuk mengambil data fotografer
$sql = "SELECT * FROM users WHERE role = 'fotografer'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$photographers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

  <style>
    .nav-icon {
      margin-right: 5px;
    }

    .m-t-5 {
      margin-top: 5px;
    }

    .card {
      background: #1e1e1e;
      margin-bottom: 30px;
      transition: .5s;
      border: 0;
      border-radius: .1875rem;
      box-shadow: none;
      opacity: 0; /* Mulai dengan opacity 0 */
      transform: translateY(-50px); /* Mulai dari atas */
      transition: opacity 2.5s ease, transform 2.5s ease; /* Transisi 2,5 detik */
    }

    .card.visible {
      opacity: 1; /* Menjadi terlihat */
      transform: translateY(0); /* Pindah ke posisi normal */
    }

    .card .body {
      font-size: 14px;
      color: #f0f0f0;
      padding: 20px;
      font-weight: 400;
    }

    .profile-image img {
      border-radius: 50%;
      width: 140px;
      border: 3px solid #fff;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .container-card {
      max-width: 90%;
      padding-top: 30px;
      margin: 0 auto;
    }

    .card-items {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }

    /* Mengatasi overflow layar */
    .overflow-hidden {
      overflow-x: hidden;
    }
  </style>
</head>

<body class="overflow-hidden">
<div class="canvas gallery"><br>
    <h1 class="blog-post-title text-center">Daftar Fotografer</h1>
    <span class="title-divider"></span>
</div>

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

  <div class="canvas col-md-12">
    <div class="container-card">
        <div class="card-items">
            <?php foreach ($photographers as $photographer): ?>
                <div class="col-lg-10 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card profile-header text-center">
                        <div class="body">
                            <div class="profile-image"> 
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""> 
                            </div>
                            <h4 class="m-t-0 m-b-0"><strong><?php echo $photographer['name']; ?></strong></h4>
                            <p class="m-t-0 m-b-0"><small><em><?php echo $photographer['role']; ?></em></small></p>
                            <div class="mt-3">
                                <a href="portofolio.php?id=<?php echo $photographer['id']; ?>" class="btn btn-secondary btn-round">Lihat Portofolio</a>
                                <a href="order.php?id=<?php echo $photographer['id']; ?>" class="btn btn-primary btn-round">Order Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script>
    function confirmLogout() {
      return confirm("Apakah Anda yakin ingin keluar?");
    }

    // Menggunakan Intersection Observer untuk animasi saat scroll
    $(document).ready(function() {
      const cards = document.querySelectorAll('.card');

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible'); // Tambahkan kelas 'visible' saat card terlihat
            observer.unobserve(entry.target); // Hentikan pengamatan setelah card terlihat
          }
        });
      }, {
        threshold: 0.1 // 10% dari card terlihat sebelum memicu animasi
      });

      cards.forEach(card => {
        observer.observe(card); // Mulai mengamati setiap card
      });
    });
  </script>
</body>

</html>
