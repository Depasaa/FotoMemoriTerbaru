<?php
session_start();
require_once 'koneksi.php'; // Pastikan file ini mengandung koneksi ke database dengan variabel $conn

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
                                        <li><a href="./membership.php">Membership</a></li>
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

    <!-- Breadcrumb Begin -->6ggggggggg
    <div class="breadcrumb-option spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bo-links">
                        <a href="./index.php"><i class="fa fa-home"></i> Beranda</a>
                        <span>Layanan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Services Section Begin -->
    <section class="services-section services-normal spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="services-item">
                        <img src="img/services/service-1.jpg" alt="">
                        <h3>Pemotretan</h3>
                        <p>Menyediakan layanan pemotretan profesional untuk berbagai jenis acara, mulai dari
                            pernikahan, ulang tahun, hingga pemotretan produk, dengan fokus pada detail dan keindahan
                            setiap momen.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="services-item">
                        <img src="img/services/service-2.jpg" alt="">
                        <h3>Video</h3>
                        <p>Menawarkan layanan videografi berkualitas tinggi untuk merekam dan menyunting momen-momen
                            spesial Anda, menciptakan film yang penuh emosi dan kenangan yang abadi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="services-item">
                        <img src="img/services/service-3.jpg" alt="">
                        <h3>Pengeditan</h3>
                        <p>Menyediakan layanan pengeditan foto dan video profesional, membantu Anda mengubah hasil
                            jepretan mentah menjadi karya seni yang menakjubkan dan siap dibagikan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Services Option Section Begin -->
    <section class="services-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="so-item">
                        <div class="so-title">
                            <div class="so-number">01</div>
                            <h5>Syuting dan Pengeditan</h5>
                        </div>
                        <p>Kami menawarkan layanan syuting profesional dan pengeditan berkualitas untuk menghasilkan
                            foto dan video yang memukau.</p>
                    </div>
                    <div class="so-item">
                        <div class="so-title">
                            <div class="so-number">02</div>
                            <h5>Fotografi Pertunangan</h5>
                        </div>
                        <p>Kami menangkap momen indah pertunangan Anda dengan gaya yang romantis dan unik, memastikan
                            setiap detail terabadikan dengan sempurna.</p>
                    </div>
                    <div class="so-item">
                        <div class="so-title">
                            <div class="so-number">03</div>
                            <h5>Fotografi Komersial</h5>
                        </div>
                        <p>Dapatkan hasil foto profesional untuk produk atau layanan Anda, membantu meningkatkan
                            branding dan menarik perhatian pelanggan.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="so-item">
                        <div class="so-title">
                            <div class="so-number">04</div>
                            <h5>Fotografi Media Sosial</h5>
                        </div>
                        <p>Buat konten menarik untuk platform media sosial Anda dengan foto berkualitas tinggi yang
                            menggambarkan kepribadian dan gaya unik Anda.</p>
                    </div>
                    <div class="so-item">
                        <div class="so-title">
                            <div class="so-number">02</div>
                            <h5>Fotografi Acara</h5>
                        </div>
                        <p>Abadikan setiap momen berharga dalam acara Anda, dari perayaan hingga pertemuan, dengan
                            perhatian khusus pada detail dan suasana.</p>
                    </div>
                    <div class="so-item">
                        <div class="so-title">
                            <div class="so-number">03</div>
                            <h5>Fotografi Pribadi</h5>
                        </div>
                        <p>Kami menyediakan sesi fotografi pribadi yang disesuaikan dengan kebutuhan dan kepribadian
                            Anda, menciptakan kenangan yang akan selalu diingat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Option Section End -->

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