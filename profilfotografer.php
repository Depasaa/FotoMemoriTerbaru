<?php
session_start();
require_once 'koneksi.php'; // Pastikan file ini mengandung koneksi ke database dengan variabel $conn


if (isset($_GET['id'])) {
    $fotografer_id = $_GET['id'];

    // Query untuk mendapatkan data fotografer berdasarkan ID dan role 'fotografer'
    $query = $conn->prepare("SELECT * FROM users WHERE id = :id AND role = 'fotografer'");
    $query->bindParam(':id', $fotografer_id, PDO::PARAM_INT);
    $query->execute();
    $fotografer = $query->fetch(PDO::FETCH_ASSOC);

    // Jika fotografer ditemukan, simpan data 
    if ($fotografer) {
        $nama = htmlspecialchars($fotografer['name']);
        $profile_image = $fotografer['profiluser'];  // Sesuaikan dengan nama kolom yang benar
        $description = htmlspecialchars($fotografer['bio']); // Sesuaikan dengan nama kolom yang benar

        // Query untuk mengambil gambar portofolio dari kolom img1 - img7
        $query_portfolio = $conn->prepare("SELECT img1, img2, img3, img4, img5, img6, img7 FROM portofolio WHERE idportofolio = :id");
        $query_portfolio->bindParam(':id', $fotografer_id, PDO::PARAM_INT);
        $query_portfolio->execute();
        $portfolio_images = $query_portfolio->fetch(PDO::FETCH_ASSOC); // Mengambil hasil sebagai array
    } else {
        echo "Fotografer tidak ditemukan.";
        exit;
    }
} else {
    echo "ID fotografer tidak diberikan.";
    exit;
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
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bo-links">
                        <a href="./index.php"><i class="fa fa-home"></i> Beranda</a>
                        <span>Profil Fotografer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Pricing Section Begin -->
    <section class="fotografer-profile-section spad">
        <div class="container">
            <div class="row">
                <!-- Fotografer Profile Begin -->
                <div class="col-lg-4">
                    <div class="fotografer-profile">
                        <div class="profile-img">
                            <img src="<?php echo 'uploads/' . (!empty($fotografer['profiluser']) ? $fotografer['profiluser'] : 'defaultprofil.jpg'); ?>"
                                alt="Fotografer Profile" class="img-fluid rounded-circle">
                        </div>
                        <div class="profile-info mt-4">
                            <h3><?php echo $nama; ?></h3>
                            <p><?php echo $description; ?></p>
                        </div>
                    </div>

                </div>
                <!-- Fotografer Profile End -->

                <!-- Fotografer Portfolio Begin -->
                <!-- Pricing Section Begin -->
                <section class="fotografer-profile-section spad">
                    <div class="container">
                        <div class="row">

                            <!-- Fotografer Portfolio Begin -->
                            <div class="col-lg-8">
                                <div class="fotografer-portfolio">
                                    <h4>Portofolio</h4>
                                    <div class="portfolio-gallery">
                                        <?php
                                        // Loop melalui kolom gambar jika ada gambar yang tersedia
                                        $portfolio_columns = ['img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7'];
                                        $portfolio_empty = true; // Untuk mengecek apakah ada gambar yang ditampilkan
                                        
                                        foreach ($portfolio_columns as $column) {
                                            // Cek jika kolom gambar ada isinya, jika tidak, gunakan gambar default di folder uploads
                                            $image_url = !empty($portfolio_images[$column]) ? 'uploads/' . $portfolio_images[$column] : 'uploads/defaultprofil.jpg';

                                            echo '<div class="portfolio-item">';
                                            echo '<img src="' . htmlspecialchars($image_url) . '" alt="Portfolio Image" class="img-fluid">';
                                            echo '</div>';
                                            $portfolio_empty = false;
                                        }

                                        if ($portfolio_empty) {
                                            echo "<p>Tidak ada gambar portofolio yang tersedia.</p>";
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <!-- Fotografer Portfolio End -->
                        </div>
                    </div>
                </section>
                <!-- Pricing Section End -->

                <!-- Fotografer Portfolio End -->

                <!-- CSS Customization -->
                <style>
                    .btn-primary {
                        background-color: #009603;
                        border: none;
                        color: white;
                        padding: 12px 20px;
                        font-size: 16px;
                        cursor: pointer;
                        transition: background-color 0.3s ease;
                    }

                    .btn-primary:hover {
                        background-color: #009603;
                    }

                    .fotografer-portfolio {
                        margin-top: 20px;
                    }

                    .fotografer-portfolio h4 {
                        font-size: 24px;
                        margin-bottom: 15px;
                    }

                    .portfolio-gallery {
                        display: flex;
                        overflow-x: auto;
                        padding-bottom: 10px;
                    }

                    .portfolio-item {
                        flex: 0 0 auto;
                        margin-right: 15px;
                    }

                    .portfolio-item img {
                        width: 300px;
                        height: 200px;
                        object-fit: cover;
                        border-radius: 10px;
                    }

                    /* Optional: hide the scrollbar for a cleaner look */
                    .portfolio-gallery::-webkit-scrollbar {
                        display: none;
                    }

                    .portfolio-gallery {
                        -ms-overflow-style: none;
                        /* IE and Edge */
                        scrollbar-width: none;
                        /* Firefox */
                    }

                    /* Menghilangkan border-radius pada tombol dan form */
                    .btn-primary {
                        background-color: #009603;
                        border: none;
                        padding: 10px 30px;
                        /* Menyesuaikan padding */
                        color: #fff;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        border-radius: 0;
                        /* Remove rounded corners */
                    }

                    .btn-primary:hover {
                        background-color: #006c03;
                    }

                    .fotografer-order .form-control {
                        margin-bottom: 20px;
                        border-radius: 0;
                        /* Menghilangkan sudut bundar pada input form */
                    }
                </style>

            </div>

            <div class="row mt-5">
                <!-- Order Section Begin -->
                <div class="col-lg-12">
                    <div class="fotografer-order">
                        <h4>Order Fotografer</h4>
                        <form action="order-fotografer.php" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal">Pilih Tanggal:</label>
                                        <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="jam">Pilih Waktu:</label>
                                        <input type="time" id="jam" name="jam" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi Pemotretan:</label>
                                        <input type="text" id="lokasi" name="lokasi" class="form-control"
                                            placeholder="Contoh: Jakarta" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kategori">Kategori Pemotretan:</label>
                                        <select id="kategori" name="kategori" class="form-control" required>
                                            <option value="pernikahan">Pernikahan</option>
                                            <option value="keluarga">Keluarga</option>
                                            <option value="corporate">Corporate</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Tambahan input pesan -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pesan">Pesan untuk Fotografer:</label>
                                        <textarea id="pesan" name="pesan" class="form-control" rows="4"
                                            placeholder="Tulis pesan atau instruksi untuk fotografer..."
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary btn-block">Pesan Sekarang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Order Section End -->

            </div>
        </div>
    </section>
    <!-- Pricing Section End -->

    <!-- CSS Customization -->
    <style>
        .fotografer-profile-section {
            padding: 50px 0;
        }

        .fotografer-profile .profile-img img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .fotografer-profile .profile-info h3 {
            font-size: 28px;
            margin-top: 15px;
        }

        .fotografer-portfolio h4 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .portfolio-item img {
            margin-bottom: 15px;
        }

        .fotografer-order h4 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .fotografer-order .form-control {
            margin-bottom: 20px;
        }
    </style>




    <!-- Testimoial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Apa kata mereka tentang saya?</h2>
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