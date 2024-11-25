<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi.php sudah terhubung

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil ID pengguna yang sudah login
$user_id = $_SESSION['user_id'];

// Ambil data profil pengguna dari database
$statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
$statement->bindParam(':id', $user_id, PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

// Periksa jika data pengguna tidak ditemukan
if (!$user) {
    echo "Pengguna tidak ditemukan.";
    exit();
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
    <!-- Memuat Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


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
                        <span>Profil User</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Profil User Section Begin -->
    <section class="profile-section spad">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-4">
                    <div class="profile-card text-center p-4">
                        <!-- Ganti gambar dengan foto profil pengguna dan menambahkan link untuk mengubah foto profil -->
                        <form action="upload_photo.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="profile_photo" accept="image/*" id="fileInput"
                                style="display:none;" onchange="this.form.submit();">
                            <img src="uploads/<?php echo (!empty($user['profiluser']) ? $user['profiluser'] : 'defaultprofil.jpg'); ?>"
                                alt="User Profile Picture" class="profile-img mb-3" id="profileImage"
                                onclick="document.getElementById('fileInput').click();">
                        </form>
                        <h3 class="username"><?php echo htmlspecialchars($user['name']); ?></h3>
                        <p class="role text-muted"><?php echo htmlspecialchars($user['role']); ?></p>

                        <?php if ($user['role'] === 'fotografer' && !empty($user['skills'])): ?>
                            <div class="skills-list mt-3">
                                <?php
                                $skillsArray = explode(',', $user['skills']); // Mengubah string keahlian menjadi array
                                $count = 0; // Inisialisasi penghitung untuk membatasi 3 skill per baris
                                foreach ($skillsArray as $skill) {
                                    echo '<div class="skill-item">' . htmlspecialchars($skill) . '</div>';

                                    $count++;
                                    if ($count == 3) {
                                        echo '<div class="clearfix"></div>'; // Membuat baris baru setelah 3 skill
                                        $count = 0; // Reset penghitung untuk baris berikutnya
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>


                        <div class="button-group mt-3">
                            <!-- Tombol Edit Profil dan Logout -->
                            <button class="btn btn-primary" onclick="openEditModal()">Edit Profil</button>
                            <button class="btn btn-danger ms-2" onclick="logout()">Logout</button>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="profile-info">
                        <h4 class="section-title mb-4">Account Information</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Username:</strong> <?php echo htmlspecialchars($user['name']); ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Tentang Saya:</strong>
                                <p style="max-width: 900px; word-wrap: break-word;">
                                    <?php echo htmlspecialchars($user['bio']); ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal untuk Edit Profil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk mengedit profil -->
                    <form action="update_profile.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="username" name="name"
                                value="<?php echo htmlspecialchars($user['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="aboutme" class="form-label">Tentang Saya</label>
                            <textarea class="form-control" id="aboutme" name="bio" rows="3"
                                required><?php echo htmlspecialchars($user['bio']); ?></textarea>
                        </div>
                        <!-- Pilihan keahlian -->
                        <?php if ($user['role'] === 'fotografer'): ?>
                            <div class="mb-3">
                                <label class="form-label">Keahlian</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" value="Pernikahan" <?php echo (strpos($user['skills'], 'Pernikahan') !== false ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="skillWedding">Pernikahan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" value="Potret" <?php echo (strpos($user['skills'], 'Potret') !== false ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="skillPortrait">Potret</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" value="Acara" <?php echo (strpos($user['skills'], 'Acara') !== false ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="skillEvent">Acara</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" value="Produk" <?php echo (strpos($user['skills'], 'Produk') !== false ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="skillProduct">Produk</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skills[]" value="Alam" <?php echo (strpos($user['skills'], 'Alam') !== false ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="skillNature">Alam</label>
                                </div>
                                <small class="text-muted">Pilih lebih dari satu jika diperlukan.</small>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Tambahkan Script JavaScript untuk Logout dan Edit Profil -->
    <script>
        // Fungsi Logout dengan konfirmasi
        function logout() {
            // Menampilkan konfirmasi logout
            if (confirm("Apakah anda yakin ingin keluar?")) {
                // Jika ya, logout dan arahkan ke halaman index.php
                window.location.href = 'logout.php';
            }
        }

        // Fungsi Edit Profil untuk membuka modal
        function openEditModal() {
            // Menampilkan modal untuk mengedit profil
            $('#editProfileModal').modal('show');
        }
    </script>

    <!-- Profil User Section End -->

    <style>
        .profile-section {
            padding: 50px 0;
        }

        .row.align-items-stretch {
            display: flex;
        }

        .profile-card,
        .profile-info {
            background: #fff;
            /* Sama dengan warna latar belakang card kiri */
            border: 1px solid #ddd;
            /* Warna border yang sama */
            border-radius: 0;
            /* Remove rounded corners for all boxes */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            min-height: 100%;
        }

        .profile-card {
            text-align: center;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            /* Keep profile image rounded */
            border: 3px solid #009603;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .username {
            font-size: 24px;
            font-weight: 700;
            margin-top: 10px;
        }

        .role {
            font-size: 14px;
            color: #888;
        }

        .profile-info {
            padding: 20px;
            /* Menyesuaikan padding agar serupa dengan .profile-card */
            background-color: #fff;
            /* Warna latar belakang disamakan */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            /* Sama dengan .profile-card */
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

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
            background-color: #007f02;
        }

        .btn-danger {
            background-color: #dc3545;
            /* Warna merah untuk tombol logout */
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

        .btn-danger:hover {
            background-color: #c82333;
            /* Warna lebih gelap saat hover */
        }

        .button-group {
            display: flex;
            /* Flexbox untuk align tombol */
            justify-content: center;
            /* Center align tombol */
        }

        .button-group .btn {
            margin-left: 10px;
            /* Margin kiri untuk jarak antar tombol */
        }

        /* Kontainer untuk menampilkan keahlian */
        .skills-list {
            display: flex;
            /* Menyusun keahlian secara horizontal */
            flex-wrap: wrap;
            /* Membungkus keahlian jika melebihi lebar */
            justify-content: center;
            /* Menyusun skill di tengah */
            gap: 6px;
            /* Mengurangi jarak antar elemen (dari sebelumnya 10px menjadi 6px) */
            margin-top: 10px;
            /* Menambahkan jarak atas */
            align-items: center;
            /* Menyusun skill secara vertikal di tengah */
            text-align: center;
            /* Mengatur teks agar terpusat */
        }

        /* Setiap item keahlian tanpa card, hanya teks */
        .skill-item {
            font-size: 12px;
            /* Ukuran teks tetap kecil */
            color: #333;
            /* Warna teks */
            font-weight: 500;
            /* Teks lebih tebal */
            display: inline-block;
            /* Setiap item skill muncul dalam baris yang sama */
            text-align: center;
            /* Menyusun teks di tengah */
            padding: 5px 10px;
            /* Mengatur jarak di dalam elemen skill */
            transition: transform 0.3s ease;
            /* Transisi saat hover */
            cursor: pointer;
            /* Mengubah kursor untuk interaktivitas */
            max-width: 80px;
            /* Membatasi lebar tiap elemen skill */
        }

        /* Efek saat hover pada item keahlian */
        .skill-item:hover {
            transform: scale(1.05);
            /* Memperbesar saat hover */
            color: #007bff;
            /* Warna teks berubah saat hover */
        }

        /* Responsif untuk perangkat kecil */
        @media (max-width: 768px) {
            .skill-item {
                font-size: 11px;
                /* Ukuran font lebih kecil di layar kecil */
                max-width: 100%;
                /* Maksimal lebar 100% pada perangkat kecil */
            }
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