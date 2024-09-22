<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Fotografer</title>
    <link rel="stylesheet" href="portofoliooo.css">
    <style>
        /* Tambahkan gaya untuk carousel testimonial */
        .testimonial-section {
            overflow: hidden;
            position: relative;
        }

        .testimonial-grid {
            display: flex;
            transition: transform 0.3s ease;
            will-change: transform;
        }

        .testimonial-card {
            min-width: 300px; /* Atur lebar minimum untuk setiap testimonial */
            margin-right: 20px; /* Jarak antar kartu testimonial */
            flex-shrink: 0; /* Mencegah penyusutan kartu */
        }

        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .carousel-button.left {
            left: 10px;
        }

        .carousel-button.right {
            right: 10px;
        }
    </style>
</head>
<body>
   <div class="container" id="fadeInContainer">
        <div class="card-container">
            <span class="pro">FOTOGRAFER</span>
            <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
            <h3>Ricky Park</h3>
            <h6>New York</h6>
            <p>Fotografer Profesional <br /> Harga Murah tapi Kualitas tak Murahan </p>
            <div class="buttons">
                <button class="primary">Order Sekarang</button>
                <button class="primary">Feedback</button>
            </div>
            <div class="skills">
                <h6>Skills</h6>
                <ul>
                    <li>Romance</li>
                    <li>Portrait</li>
                    <li>Happy Birthday</li>
                    <li>Wedding</li>
                    <li>Family</li>
                </ul>
            </div>
        </div>

        <!-- Testimonial Section -->
        <div class="testimonial-section" id="testimonialSection">
            <button class="carousel-button left" onclick="scrollTestimonials(-1)">&#10094;</button>
            <div class="testimonial-grid">
                <div class="testimonial-card zoom-in">
                    <p class="testimonial-text">"Pelayanan yang sangat memuaskan, hasil foto sangat profesional dan tepat waktu. Sangat direkomendasikan!"</p>
                    <div class="testimonial-author">
                        <img class="testimonial-img" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                        <div class="author-info">
                            <h4>John Doe</h4>
                            <p>Klien Pernikahan</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card zoom-in">
                    <p class="testimonial-text">"Fotografer sangat ramah dan hasil fotonya benar-benar memuaskan. Kualitas top dengan harga yang sangat terjangkau."</p>
                    <div class="testimonial-author">
                        <img class="testimonial-img" src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                        <div class="author-info">
                            <h4>Jane Smith</h4>
                            <p>Klien Ulang Tahun</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card zoom-in">
                    <p class="testimonial-text">"Pengalaman yang luar biasa, saya sangat menyukai foto-fotonya. Akan menggunakan layanan ini lagi di masa mendatang!"</p>
                    <div class="testimonial-author">
                        <img class="testimonial-img" src="https://randomuser.me/api/portraits/men/64.jpg" alt="User">
                        <div class="author-info">
                            <h4>David Lee</h4>
                            <p>Klien Keluarga</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card zoom-in">
                    <p class="testimonial-text">"Pengalaman yang luar biasa, saya sangat menyukai foto-fotonya. Akan menggunakan layanan ini lagi di masa mendatang!"</p>
                    <div class="testimonial-author">
                        <img class="testimonial-img" src="https://randomuser.me/api/portraits/men/64.jpg" alt="User">
                        <div class="author-info">
                            <h4>David Lee</h4>
                            <p>Klien Keluarga</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-button right" onclick="scrollTestimonials(1)">&#10095;</button>
        </div>

        <!-- Portfolio Section -->
        <div class="portfolio-gallery" id="portfolioGallery">
            <h2>Hasil Karya</h2>
            <div class="gallery-grid">
                <img src="https://via.placeholder.com/400" alt="Work 1" class="work-img zoom-in">
                <img src="https://via.placeholder.com/400" alt="Work 2" class="work-img zoom-in">
                <img src="https://via.placeholder.com/400" alt="Work 3" class="work-img zoom-in">
                <img src="https://via.placeholder.com/400" alt="Work 4" class="work-img zoom-in">
            </div>
        </div>
    </div>

    <footer>
        <p>
            Dibuat oleh <i class="fa fa-heart"></i>
            <a target="_blank" href="https://florin-pop.com">Depasaa</a>
            - Desain oleh
            <a target="_blank" href="https://dribbble.com/shots/6276930-Profile-Card-UI-Design">Depasaa</a>
        </p>
    </footer>

    <script>
        const fadeInElements = document.querySelectorAll('#fadeInContainer, #testimonialSection, #portfolioGallery');

        const options = {
            root: null,
            threshold: 0.1,
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                } else {
                    entry.target.classList.remove('visible');
                }
            });
        }, options);

        fadeInElements.forEach(element => {
            element.classList.add('fade-in');
            observer.observe(element);
        });

        let currentScroll = 0;

        function scrollTestimonials(direction) {
            const grid = document.querySelector('.testimonial-grid');
            const cardWidth = document.querySelector('.testimonial-card').offsetWidth + 20; // Lebar kartu + margin
            currentScroll += direction * cardWidth;
            grid.style.transform = `translateX(-${currentScroll}px)`;
        }
    </script>
</body>
</html>
