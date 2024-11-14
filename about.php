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

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bo-links">
                        <a href="./index.php"><i class="fa fa-home"></i> Beranda</a>
                        <span>Tentang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- About Section Begin -->
    <section class="about-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="about-pic set-bg" data-setbg="img/about/about-pic.jpg">
                        <a href="https://www.youtube.com/watch?v=hxADTEJalRw&list=WL&index=49&t=0s"
                            class="play-btn video-popup"><i class="fa fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="about-text">
                        <div class="section-title">
                            <h2>Mengabadikan momen yang memikat hati Anda</h2>
                            <p>Setiap momen berharga dalam hidup layak untuk diabadikan dengan sempurna. Kami hadir
                                untuk menangkap emosi, kebahagiaan, dan keindahan di setiap detiknya. Dari acara penting
                                hingga momen-momen sederhana yang penuh makna, tim fotografer profesional kami
                                berkomitmen untuk menghadirkan hasil terbaik yang bisa dikenang selamanya. Biarkan kami
                                menjadi bagian dari cerita Anda dan menciptakan kenangan visual yang memikat hati,
                                sesuai dengan gaya dan kebutuhan Anda. Dengan lensa kami, setiap momen akan terlukis
                                abadi.
                            </p>
                        </div>
                        <div class="at-list">
                            <div class="al-item">
                                <div class="al-pic">
                                    <img src="img/about/list-1.png" alt="">
                                </div>
                                <div class="al-text">
                                    <h5>Profesionalisme</h5>
                                    <p>Profesionalisme adalah prioritas kami. Para fotografer
                                        berpengalaman kami siap memenuhi kebutuhan Anda dengan hasil terbaik dan
                                        pelayanan yang ramah.</p>
                                </div>
                            </div>
                            <div class="al-item">
                                <div class="al-pic">
                                    <img src="img/about/list-2.png" alt="">
                                </div>
                                <div class="al-text">
                                    <h5>Pendekatan Khusus</h5>
                                    <p>Kami percaya bahwa setiap klien unik. Kami mengutamakan pendekatan
                                        individu untuk memahami kebutuhan dan harapan Anda, memastikan setiap sesi foto
                                        disesuaikan dengan gaya dan kepribadian Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="al-item">
                                <div class="al-pic">
                                    <img src="img/about/list-3.png" alt="">
                                </div>
                                <div class="al-text">
                                    <h5>Jadwal Fleksibel</h5>
                                    <p>Kami memahami pentingnya kenyamanan Anda. Dengan jadwal fleksibel,
                                        kami siap menyesuaikan waktu sesi foto sesuai kebutuhan dan preferensi Anda,
                                        memastikan pengalaman yang nyaman dan menyenangkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Cta Section Begin -->
    <section class="cta-section spad set-bg" data-setbg="img/cta-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-text">
                        <h2>Ingin menjadi fotografer?</h2>
                        <p>Jika Anda seorang fotografer berbakat yang ingin
                            menunjukkan karya Anda dan mendapatkan kesempatan untuk bekerja dengan klien yang beragam,
                            daftarkan diri Anda sekarang. Mari ciptakan momen-momen berharga bersama!</p>
                        <a href="membership.php" class="primary-btn">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cta Section End -->

    <!-- Testimoial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Apa kata klien?</h2>
                        <p>Dengarkan langsung testimonial dari klien kami yang puas dengan layanan yang
                            kami tawarkan.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="testimonial-item">
                        <div class="ti-author">
                            <div class="ta-pic">
                                <img src="img/testimonial/ta-1.jpg" alt="">
                            </div>
                            <div class="ta-text">
                                <h5>ANDREW FILDER</h5>
                                <span>@filder_muko</span>
                            </div>
                        </div>
                        <p>FotoMemori menangkap momen spesial kami dengan sempurna! Hasilnya luar biasa dan timnya
                            sangat profesional.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="testimonial-item">
                        <div class="ti-author">
                            <div class="ta-pic">
                                <img src="img/testimonial/ta-2.jpg" alt="">
                            </div>
                            <div class="ta-text">
                                <h5>David Guetta</h5>
                                <span>@filder_muko</span>
                            </div>
                        </div>
                        <p>Saya sangat puas dengan layanan yang diberikan. Fotografernya ramah dan tahu cara membuat
                            kami merasa nyaman di depan kamera!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="testimonial-item">
                        <div class="ti-author">
                            <div class="ta-pic">
                                <img src="img/testimonial/ta-3.jpg" alt="">
                            </div>
                            <div class="ta-text">
                                <h5>Bebe Rexha</h5>
                                <span>@filder_muko</span>
                            </div>
                        </div>
                        <p>Kualitas foto yang dihasilkan melebihi ekspektasi saya. Terima kasih, FotoMemori, atas
                            pengalaman yang tak terlupakan!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="testimonial-item">
                        <div class="ti-author">
                            <div class="ta-pic">
                                <img src="img/testimonial/ta-4.jpg" alt="">
                            </div>
                            <div class="ta-text">
                                <h5>Adam Levine</h5>
                                <span>@filder_muko</span>
                            </div>
                        </div>
                        <p>Jadwal yang fleksibel dan pendekatan personal membuat seluruh proses menjadi menyenangkan.
                            Saya pasti akan merekomendasikan!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

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