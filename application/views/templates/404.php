<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Wastutalk STT Wastukancana">
    <meta name="author" content="WithDiv">
    <meta property="og:image" content="<?= base_url('assets/logo.png') ?>">
    <meta property="og:image:type" content="image/png">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.png">

    <title>
        <?php echo isset($page_title) ? $page_title . ' - Wastutalk STT Wastukancana' : 'Wastutalk STT Wastukancana'; ?>
    </title>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-404 {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            padding: 40px 60px;
            text-align: center;
            max-width: 400px;
        }

        .container-404 h1 {
            font-size: 7rem;
            margin: 0;
            font-weight: 700;
            letter-spacing: 10px;
            color: #fff;
            text-shadow: 2px 4px 16px rgba(0, 0, 0, 0.2);
        }

        .container-404 h2 {
            font-size: 2rem;
            margin: 10px 0 20px 0;
            font-weight: 400;
            color: #f3f3f3;
        }

        .container-404 p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #e0e0e0;
        }

        .container-404 a {
            display: inline-block;
            padding: 12px 32px;
            background: #fff;
            color: #764ba2;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(118, 75, 162, 0.15);
            transition: background 0.2s, color 0.2s;
        }

        .container-404 a:hover {
            background: #764ba2;
            color: #fff;
        }

        .icon-404 {
            font-size: 4rem;
            margin-bottom: 10px;
            color: #fff;
            animation: float 2s infinite ease-in-out;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @media (max-width: 600px) {
            .container-404 {
                padding: 30px 10px;
                max-width: 90vw;
            }

            .container-404 h1 {
                font-size: 4rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-404">
        <div class="icon-404">🚀</div>
        <h1>404</h1>
        <h2>Oops! Halaman tidak ditemukan</h2>
        <p>Sepertinya kamu tersesat.<br>
            Halaman yang kamu cari tidak tersedia atau sudah dipindahkan.</p>
        <a href="<?= base_url(); ?>">Kembali ke Beranda</a>
    </div>
</body>

</html>