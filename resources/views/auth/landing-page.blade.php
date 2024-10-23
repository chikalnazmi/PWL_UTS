<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Blooms Accessories</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background-color: #f7f7f7;
        }

        /* Navbar */
        .navbar {
            background-color: transparent;
            position: fixed;
            width: 100%;
            z-index: 1000;
            transition: background-color 0.5s;
        }

        .navbar.scrolled {
            background-color: #7e8c69; /* Sage Green */
        }

        .navbar .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .navbar-brand {
            color: white !important;
            font-size: 28px;
            font-weight: bold;
        }

        /* Hero Section */
        .hero {
            background-image: url('dist/img/hero_banner.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }

        .hero-content {
            z-index: 1;
            text-align: center;
            animation: fadeInUp 1.5s;
        }

        .hero h1 {
            font-size: 50px;
            margin-bottom: 20px;
            letter-spacing: 3px;
        }

        .hero p {
            font-size: 22px;
            margin-bottom: 40px;
        }

        .btn-custom {
            background-color: #cb8587; /* Soft Pink */
            color: white;
            padding: 15px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #b67678;
        }

        /* About Us Section */
        .about-us {
            padding: 100px 0;
            background-color: #f7f7f7;
        }

        .about-us h2 {
            font-size: 42px;
            color: #7e8c69; /* Sage Green */
            text-align: center;
            margin-bottom: 40px;
        }

        .about-us p {
            font-size: 20px;
            color: #333;
            text-align: center;
            margin-bottom: 40px;
        }

        .about-us img {
            border-radius: 10px;
            max-width: 80%;
            display: block;
            margin: 0 auto;
        }

        /* Gallery Section */
        .gallery {
            padding: 80px 0;
            background-color: white;
        }

        .gallery h2 {
            font-size: 36px;
            margin-bottom: 40px;
            text-align: center;
            color: #7e8c69; /* Sage Green */
        }

        /* Carousel */
        .carousel-item img {
            width: 100%;
            height: auto;
            max-height: 600px;
        }

        /* Footer */
        .footer {
            background-color: #7e8c69; /* Sage Green */
            padding: 30px;
            text-align: center;
            color: white;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Flower Blooms</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Flower Blooms</h1>
            <p>Aksesori lucu dan elegan untuk mempercantik hari-harimu</p>
            <a href="{{ route('login') }}" class="btn-custom">Masuk</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us">
        <div class="container">
            <h2>Tentang Flower Blooms</h2>
            <p>Flower Blooms adalah toko aksesori yang menghadirkan pernak-pernik elegan dan cantik untuk mempercantik harimu. Kami tidak menjual pakaian, tetapi fokus pada berbagai aksesori yang dibuat dengan penuh perhatian dan detail. Setiap produk kami dirancang untuk menambah keindahan dan kebahagiaan dalam setiap penampilanmu, sehingga memberikan sentuhan akhir yang sempurna untuk gaya harianmu.</p>
            <img src="image/store_story.jpg" alt="Our Story" class="img-fluid">
        </div>
    </section>

    <!-- Gallery Section with Slider -->
    <section class="gallery">
        <h2>Koleksi Kami</h2>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="image/produk-4.jpg" class="d-block w-50 mx-auto" alt="Gallery Image 1">
                </div>
                <div class="carousel-item">
                    <img src="image/produk-2.jpg" class="d-block w-50 mx-auto" alt="Gallery Image 2">
                </div>
                <div class="carousel-item">
                    <img src="image/produk-3.jpg" class="d-block w-50 mx-auto" alt="Gallery Image 3">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Flower Blooms. Created by: Chikal Nazmi Mahira.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Change navbar background on scroll
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
