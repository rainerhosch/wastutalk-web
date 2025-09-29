<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Wastutalk STT Wastukancana">
    <meta name="author" content="WithDiv">
    <meta property="og:image" content="<?= base_url('assets/logo.png') ?>">
    <meta property="og:image:type" content="image/png">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.png">

    <title><?php echo isset($page_title) ? $page_title . ' - Wastutalk STT Wastukancana' : 'Wastutalk STT Wastukancana'; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0D47A1;
            /* Deep Blue */
            --secondary-color: #1976D2;
            /* Lighter Blue */
            --accent-color: #FFC107;
            /* Gold/Amber */
            --background-color: #F8F9FA;
            --text-color: #212529;
            --muted-color: #6c757d;
            --card-bg: #FFFFFF;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        /* --- Navbar --- */
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }

        .navbar .nav-link {
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s;
            padding: 0.5rem 1rem;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--primary-color);
        }

        .dropdown-menu {
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .dropdown-item {
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-color);
            color: #fff;
        }

        /* --- Main Content --- */
        .main-content {
            padding-top: 2rem;
            padding-bottom: 4rem;
        }

        /* --- Section Titles --- */
        .section-title {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        /* --- Cards --- */
        .post-card {
            background-color: var(--card-bg);
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .post-card .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .post-card .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .post-card .card-title {
            font-weight: 600;
            color: var(--text-color);
        }

        .post-card .card-meta {
            font-size: 0.85rem;
            color: var(--muted-color);
        }

        .post-card .badge {
            font-weight: 600;
        }

        .post-card .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            margin-top: auto;
        }

        .post-card .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        /* --- Footer --- */
        .footer {
            background-color: var(--primary-color);
            color: rgba(255, 255, 255, 0.9);
            padding: 4rem 0 0 0;
        }

        .footer h5 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #fff;
        }

        .footer .list-unstyled li {
            margin-bottom: 0.75rem;
        }

        .footer .footer-bottom {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        /* --- Article/Page Specific --- */
        .page-header {
            padding: 4rem 0;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            text-align: center;
        }

        .page-header h1 {
            color: var(--primary-color);
            font-weight: 700;
        }

        .article-content,
        .guide-content {
            background: var(--card-bg);
            padding: 2rem 3rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .article-meta {
            color: var(--muted-color);
            margin-bottom: 2rem;
        }

        .article-meta span {
            margin-right: 1rem;
        }

        .article-featured-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            border-radius: 0.75rem;
            margin-bottom: 2rem;
        }

        /* List Group for Article List */
        .article-list-item {
            background-color: #fff;
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .article-list-item:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            transform: translateY(-3px);
        }

        .article-list-item h5 {
            color: var(--primary-color);
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php $this->load->view('templates/navbar'); ?>
    <?php $this->load->view($content); ?>
    <?php $this->load->view('templates/footer'); ?>
    <!-- Cookie Consent Banner -->
    <div id="cookie-consent-banner">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <p class="mb-0 me-3">Situs ini menggunakan cookie untuk memastikan Anda mendapatkan pengalaman terbaik. Dengan melanjutkan, Anda menyetujui penggunaan cookie kami.</p>
            <button id="accept-cookie-consent" class="btn btn-light btn-sm flex-shrink-0 mt-2 mt-md-0">Saya Mengerti</button>
        </div>
    </div>

    <!-- Back to Top Button -->
    <a id="back-to-top-btn" title="Kembali ke atas"><i class="fas fa-arrow-up"></i></a>

    <style>
        #cookie-consent-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #2c3e50;
            /* Warna gelap yang elegan */
            color: white;
            padding: 1rem;
            z-index: 1050;
            display: none;
            /* Sembunyi secara default */
            font-size: 0.9rem;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        }

        /* --- Back to Top Button Style --- */
        #back-to-top-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 50px;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 1040;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            opacity: 0;
            transform: translateY(10px);
            visibility: hidden;
        }

        #back-to-top-btn:hover {
            background-color: var(--secondary-color);
        }

        #back-to-top-btn.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const banner = document.getElementById('cookie-consent-banner');
            const acceptButton = document.getElementById('accept-cookie-consent');
            const backToTopButton = document.getElementById('back-to-top-btn');

            // --- Cookie Consent Logic ---
            function getCookie(name) {
                let nameEQ = name + "=";
                let ca = document.cookie.split(';');
                for (let i = 0; i < ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            function setCookie(name, value, days) {
                let expires = "";
                if (days) {
                    let date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            if (!getCookie('lppm_cookie_consent')) {
                banner.style.display = 'block';
            }

            acceptButton.addEventListener('click', function() {
                setCookie('lppm_cookie_consent', 'true', 365);
                banner.style.display = 'none';
            });

            // --- Back to Top Button Logic ---
            if (backToTopButton) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) { // Tampilkan tombol setelah scroll 300px
                        backToTopButton.classList.add('show');
                    } else {
                        backToTopButton.classList.remove('show');
                    }
                });

                backToTopButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>

</body>

</html>