<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Wastutalk STT Wastukancana</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Montserrat', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-container {
            background: rgba(255,255,255,0.13);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);
            border-radius: 20px;
            padding: 40px 30px 30px 30px;
            width: 350px;
            max-width: 95vw;
            text-align: center;
            backdrop-filter: blur(6px);
        }
        .auth-container h2 {
            margin-bottom: 20px;
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .auth-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .auth-container input[type="text"],
        .auth-container input[type="password"],
        .auth-container input[type="email"] {
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            background: rgba(255,255,255,0.85);
            font-size: 1rem;
            outline: none;
            transition: box-shadow 0.2s;
        }
        .auth-container input:focus {
            box-shadow: 0 0 0 2px #764ba2;
        }
        .auth-container button {
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .auth-container button:hover {
            background: linear-gradient(90deg, #764ba2 0%, #667eea 100%);
        }
        .toggle-link {
            color: #fff;
            font-size: 0.95rem;
            margin-top: 10px;
            cursor: pointer;
            text-decoration: underline;
            transition: color 0.2s;
        }
        .toggle-link:hover {
            color: #ffd700;
        }
        .logo {
            width: 60px;
            margin-bottom: 10px;
        }
        .alert {
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 0.95rem;
        }
        .alert-danger {
            background: #ff4d4f;
            color: #fff;
        }
        .alert-info {
            background: #4da6ff;
            color: #fff;
        }
        @media (max-width: 400px) {
            .auth-container {
                padding: 25px 8px 20px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <img src="<?= base_url('assets/logo.png') ?>" alt="Logo" class="logo">
        <h2 id="form-title">Login</h2>
        <?php if ($this->session->flashdata('message')): ?>
            <?= $this->session->flashdata('message'); ?>
        <?php endif; ?>
        <!-- Login Form -->
        <form id="login-form" method="post" action="<?= base_url('auth'); ?>" autocomplete="off">
            <input type="email" name="email" placeholder="Email" required autofocus value="<?= set_value('email'); ?>">
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <!-- Register Form -->
        <form id="register-form" method="post" action="<?= base_url('auth/register'); ?>" autocomplete="off" style="display: none;">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password1" placeholder="Password" required>
            <input type="password" name="password2" placeholder="Konfirmasi Password" required>
            <button type="submit">Register</button>
        </form>
        <div>
            <span class="toggle-link" id="to-register">Belum punya akun? Register</span>
            <span class="toggle-link" id="to-login" style="display:none;">Sudah punya akun? Login</span>
        </div>
    </div>
    <script>
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const toRegister = document.getElementById('to-register');
        const toLogin = document.getElementById('to-login');
        const formTitle = document.getElementById('form-title');

        toRegister.onclick = function() {
            loginForm.style.display = 'none';
            registerForm.style.display = 'flex';
            toRegister.style.display = 'none';
            toLogin.style.display = 'inline';
            formTitle.textContent = 'Register';
        };
        toLogin.onclick = function() {
            loginForm.style.display = 'flex';
            registerForm.style.display = 'none';
            toRegister.style.display = 'inline';
            toLogin.style.display = 'none';
            formTitle.textContent = 'Login';
        };
    </script>
</body>
</html>
