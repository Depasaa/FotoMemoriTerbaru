<?php
session_start();
require_once 'koneksi.php'; // Pastikan file ini mengandung koneksi ke database dengan variabel $conn
require_once 'vendor/autoload.php'; // Pastikan path ke autoload.php sesuai

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-YRtF6v9UqDDfyW4LeOSther8';
\Midtrans\Config::$clientKey = 'SB-Mid-client-Qvh1BNENrpm1dwOr';
\Midtrans\Config::$isProduction = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $user_id = $_SESSION['user_id']; // Pastikan user sudah login dan user_id disimpan di session
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $portfolio_url = $_POST['portfolio'];
    $experience_level = $_POST['experience'];
    $description = $_POST['description'];
    $amount = 100000.00; // Jumlah tetap untuk pembayaran seumur hidup

    // Query untuk memasukkan data ke dalam tabel tb_membership
    $sql = "INSERT INTO tb_membership (user_id, fullname, email, portfolio_url, experience_level, description, amount, payment_status)
            VALUES (:user_id, :fullname, :email, :portfolio_url, :experience_level, :description, :amount, 'Pending')";

    // Menyiapkan statement
    $stmt = $conn->prepare($sql);

    // Mengikat parameter
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':portfolio_url', $portfolio_url);
    $stmt->bindParam(':experience_level', $experience_level);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':amount', $amount);

    // Menjalankan query
    if ($stmt->execute()) {
        // Ambil ID dari record terakhir yang disisipkan
        $membership_id = $conn->lastInsertId();

        // Membuat transaksi Midtrans
        $transaction_details = array(
            'order_id' => 'ORDER-' . uniqid(),  // ID unik untuk setiap transaksi
            'gross_amount' => $amount,
        );

        $customer_details = array(
            'first_name' => $fullname,
            'email' => $email,
        );

        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        );

        try {
            // Request ke Midtrans untuk membuat transaksi
            $charge = \Midtrans\Snap::createTransaction($transaction);

            // Redirect ke halaman pembayaran Midtrans
            header('Location: ' . $charge->redirect_url);
            exit();
        } catch (Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
            exit();
        }
    } else {
        echo "Terjadi kesalahan saat mengajukan membership.";
    }
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
                        <span>Membership</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Membership Section Begin -->
    <section class="membership-section spad">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Gabung Menjadi Anggota Kami</h2>
                <p>Daftar sebagai fotografer dan nikmati berbagai keuntungan bersama kami.</p>
            </div>

            <!-- Membership Layout -->
            <div class="membership-layout d-flex">
                <!-- Benefits Column -->
                <div class="benefits-column">
                    <div class="benefit-card p-4 mb-4">
                        <i class="fa fa-bullhorn fa-2x mb-3 icon-green"></i>
                        <h5>Eksposur Luas</h5>
                        <p>Menjangkau ribuan klien potensial di seluruh kota dan wilayah lain.</p>
                    </div>
                    <div class="benefit-card p-4 mb-4">
                        <i class="fa fa-gear fa-2x mb-3 icon-green"></i>
                        <h5>Kontrol Penuh</h5>
                        <p>Atur jadwal pemotretan Anda sesuai kebutuhan tanpa ada batasan.</p>
                    </div>
                    <div class="benefit-card p-4 mb-4">
                        <i class="fa fa-comments fa-2x mb-3 icon-green"></i>
                        <h5>Dukungan Tim</h5>
                        <p>Dapatkan dukungan pemasaran dan konsultasi untuk karier fotografi Anda.</p>
                    </div>
                </div>

                <!-- Membership Form Column -->
                <div class="membership-form-card">
                    <h3 class="text-center mb-4">Ajukan Membership</h3>
                    <!-- Membership Price Tag -->
                    <div class="price-tag text-center mb-4">
                        <h4 class="text-success">Hanya Rp100.000 / seumur hidup</h4>
                        <p class="text-muted">Nikmati akses eksklusif secara permanen dengan harga terjangkau!</p>
                    </div>
                    <form action="#" method="POST" class="membership-form">
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap</label>
                            <input type="text" id="fullname" name="fullname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="portfolio">Link Portofolio</label>
                            <input type="url" id="portfolio" name="portfolio" class="form-control"
                                placeholder="https://contohportofolio.com" required>
                        </div>
                        <div class="form-group">
                            <label for="experience">Pengalaman Fotografi</label>
                            <select id="experience" name="experience" class="form-control">
                                <option value="beginner">Pemula (0-1 tahun)</option>
                                <option value="intermediate">Menengah (1-3 tahun)</option>
                                <option value="advanced">Lanjutan (3+ tahun)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi Singkat</label>
                            <textarea id="description" name="description" class="form-control" rows="3"
                                placeholder="Ceritakan sedikit tentang diri Anda dan gaya fotografi Anda"
                                required></textarea>
                        </div>
                        <button id="checkoutButton" class="btn btn-primary btn-block mt-4">Ajukan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Membership Section End -->

    <style>
        .membership-section {
            background-color: #ffffff;
        }

        .section-title h2 {
            font-size: 36px;
            text-align: center;
            font-weight: 700;
        }

        .section-title p {
            font-size: 16px;
            color: #666;
        }

        .membership-layout {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
        }

        /* Benefits Column */
        .benefits-column {
            flex: 1;
        }

        .benefit-card {
            border: 1px solid #eaeaea;
            background-color: #f9f9f9;
            text-align: center;
            transition: box-shadow 0.3s ease;
            border-radius: 0;
        }

        .benefit-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .benefit-card h5 {
            font-weight: 600;
            color: #333;
            margin-top: 10px;
        }

        .benefit-card p {
            font-size: 14px;
            color: #666;
        }

        /* Membership Form Column */
        .membership-form-card {
            flex: 1;
            background-color: #fff;
            padding: 40px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 0;
        }

        .price-tag {
            font-size: 24px;
            font-weight: 700;
        }

        .membership-form .form-group {
            margin-bottom: 20px;
        }

        .membership-form label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .membership-form .form-control {
            border-radius: 0;
            font-size: 14px;
            border: 1px solid #ced4da;
        }

        .membership-form .btn {
            background-color: #009603;
            border: none;
            padding: 10px 30px;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .membership-form .btn:hover {
            background-color: #007a03;
        }

        /* Custom icon color */
        .icon-green {
            color: #009603;
        }
    </style>


    <!--Modal Midtrans saat dipencet ajukan sekarang-->

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-Qvh1BNENrpm1dwOr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('checkoutButton').addEventListener('click', function () {
            if ("<?= $_SESSION['snapToken'] ?>" === "") {
                alert("Snap Token tidak ditemukan.");
                return;
            }
            snap.pay("<?= $_SESSION['snapToken'] ?>", {
                onSuccess: function (result) {
                    $.ajax({
                        url: 'simpan_transaksi.php',
                        type: 'POST',
                        data: {
                            user_id: <?= $user_id ?>,
                            order_id: result.order_id,
                            gross_amount: result.gross_amount,
                            payment_type: result.payment_type,
                            transaction_status: result.transaction_status
                        },
                        success: function (response) {
                            alert("Transaksi berhasil dan data disimpan ke database");
                            console.log(response);
                        },
                        error: function () {
                            alert("Gagal menyimpan transaksi. Silakan coba lagi.");
                        }
                    });
                },
                onPending: function (result) {
                    alert("Waiting for payment confirmation!");
                    console.log(result);
                },
                onError: function (result) {
                    alert("Payment Error!");
                    console.log(result);
                }
            });
        });
    </script>

    <!--End modal midtrans cuy-->

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