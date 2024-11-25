<?php
// Memulai session dan memastikan user sudah login
session_start();
include('koneksi.php'); // Pastikan file koneksi database sudah disertakan

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Jika tidak login, redirect ke halaman login
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session

// Query untuk mengambil data pengguna berdasarkan user_id
$query = "SELECT * FROM users WHERE id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $name = $user['name'];
    $email = $user['email'];
    $role = $user['role']; // Mendapatkan role pengguna

    // Tidak ada lagi pengambilan status membership dan tanggal bergabung
}
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Phozogy Template">
    <meta name="keywords" content="Phozogy, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phozogy | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Quantico:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        .logo {
            max-width: 146px;
        }

        .fa-logo {
            max-width: 200px;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section header-normal">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo">
                        <a href="./index.php">
                            <img src="img/logo2.png" alt="">
                        </a>
                    </div>
                    <nav class="nav-menu mobile-menu">
                    <ul>
                            <li><a href="./index.php">Beranda</a></li>
                            <li class="active"><a href="./about.php">Tentang</a></li>
                            <li><a href="./services.php">Layanan</a></li>
                            <li><a href="./pricing.php">Harga</a></li>
                            <li><a href="./portfolio.php">Galeri Karya</a></li>
                            <!-- Menampilkan menu tambahan jika pengguna sudah login -->
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                                <li><a href="./blog.php">Lens</a></li>
                                <li><a href="#">Laman</a>
                                    <ul class="dropdown">
                                        <!-- Pengecekan role dan pengalihan link Membership -->
                                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'fotografer'): ?>
                                            <li><a href="./membership_details.php">Membership</a></li>
                                        <?php else: ?>
                                            <li><a href="./membership.php">Membership</a></li>
                                        <?php endif; ?>
                                        <li><a href="./portfolio-details.php">Detail Portofolio</a></li>
                                        <li><a href="./blog-details.php">Detail Blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="./contact.php">Hubungi</a></li>
                                <li><a href="profiluser.php">Akun</a></li>
                            <?php else: ?>
                                <li><a href="login.php">Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <div id="mobile-menu-wrap"></div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bo-links">
                        <a href="./index.php"><i class="fa fa-home"></i> Beranda</a>
                        <span>Membership</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

<!-- Membership Details Begin -->
<div class="membership-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="section-title">Detail Membership Anda</h2>
                <p class="membership-description">Lihat informasi lengkap tentang keanggotaan Anda dan keuntungan yang Anda dapatkan.</p>
            </div>
        </div>
        <div class="row">
            <!-- Combined Membership Info and Benefits -->
            <div class="col-lg-12">
                <div class="membership-info-and-benefits card-equal-height">
                    <?php if ($role == 'fotografer') { ?>
                        <h4>Keanggotaan Seumur Hidup</h4>
                        <p>Selamat! Anda telah memilih membership seumur hidup. Sekarang Anda memiliki status sebagai seorang fotografer, Anda akan terus mendapatkan semua keuntungan tanpa batasan waktu.</p>

                        <h5>Keuntungan Membership</h5>
                        <ul>
                            <li>Menjangkau ribuan klien potensial di seluruh kota dan wilayah lain.</li>
                            <li>Atur jadwal pemotretan Anda sesuai kebutuhan tanpa ada batasan.</li>
                            <li>Dapatkan dukungan pemasaran dan konsultasi untuk karier fotografi Anda.</li>
                        </ul>

                        <!-- Button for Ending Membership -->
                        <?php if ($role == 'fotografer') ?>
    <!-- Tombol Akhiri Membership -->
    <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmEndMembershipModal">
        Akhiri Membership
    </button>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmEndMembershipModal" tabindex="-1" aria-labelledby="confirmEndMembershipModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmEndMembershipModalLabel">Konfirmasi Penghentian Membership</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengakhiri membership Anda? Setelah mengakhiri, status Anda akan berubah menjadi pengguna biasa.
                </div>
                <div class="modal-footer">
                    <form method="POST" action="end_membership.php">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                        <button type="submit" class="btn btn-danger">Akhiri Membership</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <p>Anda sekarang sudah bukan seorang fotografer. Silahkan login ulang dengan keluar/logout terlebih dahulu pada <a href="profiluser.php">akun</a> saat ini agar status membership anda diperbarui.</p>
<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Mengakhiri Membership -->
<div class="modal fade" id="endMembershipModal" tabindex="-1" aria-labelledby="endMembershipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="endMembershipModalLabel">Akhiri Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mengakhiri membership Anda? Semua keuntungan akan hilang setelah mengakhiri membership.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <form method="post" action="end_membership.php">
                    <button type="submit" class="btn btn-danger">Akhiri Membership</button>
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Tambahkan Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- CSS untuk Konsistensi Desain -->
<style>
  /* Membership Section Styling */
  .membership-details-section {
      padding: 50px 0;
      background-color: #ffffff;
  }

  .membership-details-section .section-title {
      font-size: 32px;
      color: #333;
      margin-bottom: 20px;
  }

  .membership-details-section .membership-description {
      font-size: 18px;
      color: #777;
      margin-bottom: 40px;
  }

  /* Combined Card Styling */
  .membership-info-and-benefits {
      background-color: #ffffff;
      border: 1px solid #ddd;
      padding: 30px; 
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 0;
  }

  .membership-info-and-benefits h4, .membership-info-and-benefits h5 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #333;
  }

  .membership-info-and-benefits p, .membership-info-and-benefits ul li {
      font-size: 16px;
      color: #555;
      line-height: 1.6;
  }

  /* List Styling */
  .membership-info-and-benefits ul {
      list-style: none;
      padding-left: 0;
      margin-top: 0;
  }

  .membership-info-and-benefits ul li {
      margin-bottom: 15px;
      padding-left: 20px;
      position: relative;
  }

  .membership-info-and-benefits ul li::before {
      content: "\2022";
      position: absolute;
      left: 0;
      color: #4caf50;
      font-size: 20px;
      top: 0;
  }

  /* Tombol Akhiri Membership */
  .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
      color: white;
      font-size: 16px;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 0;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
  }

  .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
  }

  /* Equal Height for Cards */
  .card-equal-height {
      height: 100%;
  }
</style>



    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="fs-about">
                        <div class="fa-logo">
                            <a href="#">
                                <img src="img/f-logo2.png" alt="">
                            </a>
                        </div>
                        <p>Layanan fotografer profesional untuk setiap momen spesial Anda. Abadikan kenangan terbaik
                            bersama kami. Hubungi: fotomemori@gmail.com | +62-85731095875.</p>
                        <div class="fa-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="fs-widget">
                        <h5>Instagram</h5>
                        <div class="fw-instagram">
                            <img src="img/instagram/insta-1.jpg" alt="">
                            <img src="img/instagram/insta-2.jpg" alt="">
                            <img src="img/instagram/insta-3.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="fs-widget">
                        <h5>Untuk Pengunjung</h5>
                        <ul>
                            <li><a href="index.php">Beranda</a></li>
                            <li><a href="about.php">Tentang</a></li>
                            <li><a href="contact.php">Layanan</a></li>
                        </ul>
                        <ul>
                            <li><a href="portfolio.php">Harga</a></li>
                            <li><a href="blog.html">Galeri Karya</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="fs-widget">
                        <h5>Subscribe</h5>
                        <p>Dapatkan penawaran dan update terbaru dari kami langsung ke email Anda..</p>
                        <div class="fw-subscribe">
                            <form action="#">
                                <input type="text" placeholder="Email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script> Seluruh hak cipta | Developed
                            </i> by <a href="https://colorlib.com" target="_blank">Depasaa</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>