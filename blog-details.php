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
    <header class="header-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo">
                        <a href="./index.html">
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

    <!-- Blog Details Section Begin -->
    <div class="blog-hero set-bg" data-setbg="img/blog/details/blog-hero.jpg"></div>
    <section class="blog-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-text">
                        <div class="bd-title">
                            <div class="bt-bread">
                                <a href="./index.html"><i class="fa fa-home"></i> Beranda</a>
                                <a href="./index.html">Blog</a>
                                <span>5 tips for improving low light smartphone photography</span>
                            </div>
                            <h2>5 tips for improving low light smartphone photography</h2>
                            <ul>
                                <li>by <span>Admin</span></li>
                                <li>Aug,15, 2019</li>
                                <li>20 Comment</li>
                            </ul>
                        </div>
                        <div class="bd-top-text">
                            <p>Around 40% of B2B marketers say email newsletters are one of the key features to their
                                content marketing success. There are tons of statistics that prove just how profitable
                                emails can be for your business. What the numbers don’t show is that there’s a lot of
                                testing and tweaking that goes into the email’s design and layout that allows the sender
                                to get massive rewards.</p>
                            <p>What makes a successful email or email campaign? One of the major elements in the design
                                and layout that draws people in and grows your click-through rate. Today, I’ll be
                                showing you ten examples of winning email design and how to make your own.</p>
                        </div>
                        <div class="bd-quote">
                            <p>Bringing the reader towards each CTA with “Awareness, Consideration, and Action” as the
                                main stages. Harry’s used a color block design to guide the reader through each step of
                                the email. Color blocking helps to guide the reader through your copy, making it easy to
                                read with a pleasing layout.</p>
                        </div>
                        <div class="bd-desc">
                            <p>Design: Contrasting colors like yellow and blue grab the reader’s attention, in this case
                                they also happen to be Tock’s brand colors. At the center of the email is a simple
                                illustration of the city to highlight the hustle and bustle of the life surrounding
                                restaurants. They decided to match the color of their button or designs to their brand’s
                                colors, with the help of a contrasting background color for yellow and dark blue and
                                yellow and white. Placement: Two CTAs are placed in the emailer: “Explore Tock” and
                                “Learn more.” If someone’s ready to use Tock’s services, they’re more likely to press
                                the first CTA.</p>
                        </div>
                        <div class="bd-pics">
                            <img src="img/blog/details/bd-1.jpg" alt="">
                            <img src="img/blog/details/bd-2.jpg" alt="">
                            <img src="img/blog/details/bd-3.jpg" alt="">
                        </div>
                        <div class="bd-last-desc">
                            <p>If they’re still in the awareness stages of getting to know the brand, then they’ll most
                                likely keep reading more on what Tock has to offer. They’re using one email design to
                                speak to two types of readers both in the first stage of their welcome email.You can
                                also change an email design’s color based on new product, season or to match a marketing
                                campaign’s new look and feel.</p>
                            <p>Design: The email imitates a product marketing funnel system, bringing the reader towards
                                each CTA with “Awareness, Consideration, and Action” as the main stages. Harry’s used a
                                color block design to guide the reader through each step of the email. Color blocking
                                helps to guide the reader through your copy, making it easy to read with a pleasing
                                layout.</p>
                        </div>
                        <div class="bd-tag-share">
                            <div class="tags">
                                <a href="#">Typography</a>
                                <a href="#">Guides</a>
                                <a href="#">Improving</a>
                                <a href="#">Smartphone</a>
                            </div>
                            <div class="share">
                                <span>Share</span>
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a>
                                <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bd-related-post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="#" class="post-item prev-item">
                                        <h6><span class="arrow_carrot-left"></span> Previous posts</h6>
                                        <div class="pi-pic">
                                            <img src="img/blog/details/prev.jpg" alt="">
                                        </div>
                                        <div class="pi-text">
                                            <div class="label">Stories</div>
                                            <h5>The Best Weeknight Baked<br /> Potatoes, 3 Creative Ways</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="#" class="post-item next-item">
                                        <h6>Next posts <span class="arrow_carrot-right"></span></h6>
                                        <div class="pi-pic">
                                            <img src="img/blog/details/next.jpg" alt="">
                                        </div>
                                        <div class="pi-text">
                                            <div class="label">Typography</div>
                                            <h5>The $8 French Rosé I Buy in<br /> Bulk Every Summer</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="bd-author">
                            <div class="avatar-pic">
                                <img src="img/blog/details/post-author.jpg" alt="">
                            </div>
                            <div class="avatar-text">
                                <h4>Lena Mollein</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation.</p>
                                <div class="at-social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="bd-comment-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>Comment</h4>
                                    <div class="comment-item">
                                        <div class="ci-pic">
                                            <img src="img/blog/details/comment/comment-1.jpg" alt="">
                                        </div>
                                        <div class="ci-text">
                                            <h5>Brandon Kelley</h5>
                                            <p>Consectetur adipiscing eiusmod tempor incididunt t labore et dolore magna
                                                aliqua. Quis ipsum suspendisse ultrices.</p>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug,15, 2019</li>
                                                <li><i class="fa fa-heart-o"></i> Like</li>
                                                <li><i class="fa fa-share-square-o"></i> Reply</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="comment-item">
                                        <div class="ci-pic">
                                            <img src="img/blog/details/comment/comment-2.jpg" alt="">
                                        </div>
                                        <div class="ci-text">
                                            <h5>Brandon Kelley</h5>
                                            <p>Consectetur adipiscing eiusmod tempor incididunt t labore et dolore magna
                                                aliqua. Quis ipsum suspendisse ultrices.</p>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug,15, 2019</li>
                                                <li><i class="fa fa-heart-o"></i> Like</li>
                                                <li><i class="fa fa-share-square-o"></i> Reply</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="comment-item">
                                        <div class="ci-pic">
                                            <img src="img/blog/details/comment/comment-3.jpg" alt="">
                                        </div>
                                        <div class="ci-text">
                                            <h5>Brandon Kelley</h5>
                                            <p>Consectetur adipiscing eiusmod tempor incididunt t labore et dolore magna
                                                aliqua. Quis ipsum suspendisse ultrices.</p>
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i> Aug,15, 2019</li>
                                                <li><i class="fa fa-heart-o"></i> Like</li>
                                                <li><i class="fa fa-share-square-o"></i> Reply</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="leave-form">
                                        <h4>Leave a comment</h4>
                                        <form action="#">
                                            <input type="text" placeholder="Name">
                                            <input type="text" placeholder="Email">
                                            <input type="text" placeholder="Website">
                                            <textarea placeholder="Comment"></textarea>
                                            <button type="submit" class="site-btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

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
                        <p>Ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua.</p>
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
                        <p>Imolor amet consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
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
                            <script>document.write(new Date().getFullYear());</script> All rights reserved | This
                            template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib</a>
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