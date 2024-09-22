<?php
session_start(); // Start session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">
    <title>FotoMemori - Membership Registration</title>

    <!-- Bootstrap CSS -->
    <link href="dist/css/jasny-bootstraps.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="css/bootstrapss.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom styles for this template -->
    <link href="css/navmenu-reveals.css" rel="stylesheet">
    <link href="css/styless.css" rel="stylesheet">

    <style>
    body {
        background-color: #121212;
        color: #f0f0f0;
    }
    .card {
        background-color: #1e1e1e;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        margin: 20px auto; /* Center the card */
        max-width: 800px; /* Lebarkan card */
        padding: 20px; /* Tambahkan padding untuk isi card */
        opacity: 0; /* Mulai dengan opacity 0 */
        transform: translateY(-50px); /* Mulai dari atas */
        transition: opacity 2.5s ease, transform 2.5s ease; /* Ubah durasi transisi menjadi 2,5 detik */
    }
    .card.visible {
        opacity: 1; /* Menjadi terlihat */
        transform: translateY(0); /* Pindah ke posisi normal */
    }
    .membership-option {
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        transition: transform 0.2s, border-color 0.2s;
        margin: 10px 0; /* Vertical spacing */
        background-color: #282828;
        color: #f0f0f0;
    }
    .membership-option:hover {
        transform: scale(1.05);
    }
    .membership-option.active {
        border-color: #1db954;
    }
    .rules-title, .form-check-label {
        color: #1db954; /* Bright color for headings */
    }
    #paymentSection {
        display: none;
        margin-top: 20px;
        background-color: #282828;
        padding: 20px;
        border-radius: 8px;
    }
    .nav-icon {
        margin-right: 5px;
    }
</style>


</head>

<body>
<div class="canvas gallery"><br>
    <h1 class="blog-post-title text-center" id="membershipTitle">Membership</h1>
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

    <div class="container mt-5">
        <div class="card" id="membershipCard">
            <div class="card-body">
                <div class="membership-option" data-value="basic">
                    <h5>Permanent Membership</h5>
                    <p>Dapat mengakses semua fitur Fotografer.</p>
                </div>

                <form id="membershipForm" class="mt-4">
                    <div class="form-group">
                        <label for="fullName">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Masukan nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukan email" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Nomor Handphone</label>
                        <input type="tel" class="form-control" id="phoneNumber" placeholder="Masukan nomor handphone" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukan username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukan password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
                    </div>

                    <div id="paymentSection">
                        <h5 class="mt-3">Payment Method</h5>
                        <select class="form-control" id="paymentMethod" required>
                            <option value="" disabled selected>Select Payment Method</option>
                            <option value="creditCard">Credit/Debit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="bankTransfer">Bank Transfer</option>
                        </select>
                        <div id="cardDetails" style="display:none;">
                            <h5 class="mt-3">Card Details</h5>
                            <div class="form-group">
                                <label for="cardNumber">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" placeholder="Enter your card number" required>
                            </div>
                            <div class="form-group">
                                <label for="expiryDate">Expiry Date</label>
                                <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" class="form-control" id="cvv" placeholder="Enter CVV" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-3 rules-title">Rules for Membership</h5>
                    <ul class="text-left text-muted">
                        <li>Anda harus berusia minimal 18 tahun.</li>
                        <li>Harus memiliki portofolio foto yang dapat diverifikasi.</li>
                        <li>Menjaga etika dan profesionalisme dalam setiap pekerjaan.</li>
                        <li>Setuju untuk mematuhi semua ketentuan yang berlaku.</li>
                    </ul>

                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#" class="text-primary">terms and conditions</a>.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Menampilkan card dengan animasi
            $('#membershipCard').addClass('visible');

            // Menangani pilihan membership
            $('.membership-option').on('click', function () {
                $('.membership-option').removeClass('active');
                $(this).addClass('active');
                $('#paymentSection').show(); // Tampilkan section pembayaran
            });

            // Menangani pilihan metode pembayaran
            $('#paymentMethod').on('change', function () {
                if ($(this).val() === 'creditCard') {
                    $('#cardDetails').show();
                } else {
                    $('#cardDetails').hide();
                }
            });
        });
    </script>
</body>
</html>
