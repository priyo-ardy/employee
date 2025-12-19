<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('img/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('img/favicon.ico') ?>" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="<?= base_url('image/favicon.ico') ?>" sizes="180x180">

    <title>Login - Employee Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            margin: 0 20px;
        }

        .login-card {
            border: none;
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.15);
            background-color: white;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(13, 110, 253, 0.2);
        }

        .card-header {
            background: linear-gradient(to right, #0d6efd, #0a58ca);
            color: white;
            text-align: center;
            padding: 30px 20px;
            border: none;
        }

        .company-logo-container {
            margin-bottom: 15px;
        }

        .company-logo {
            height: 70px;
            filter: brightness(0) invert(1);
            margin-bottom: 10px;
        }

        .company-name {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
        }

        .system-name {
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
        }

        .form-control {
            border: 1px solid #dee2e6;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
            background-color: white;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #6c757d;
            padding: 0 15px;
        }

        .btn-login {
            background: linear-gradient(to right, #0d6efd, #0a58ca);
            color: white;
            border: none;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: linear-gradient(to right, #0a58ca, #0d6efd);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .forgot-password {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .forgot-password a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
        }

        .forgot-password a:hover {
            color: #0a58ca;
            background-color: #f8f9fa;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #6c757d;
            font-size: 14px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
        }

        .footer .company {
            color: #0d6efd;
            font-weight: 600;
        }

        /* Modal styles */
        .modal-content {
            border: none;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15);
        }

        .modal-header {
            background: linear-gradient(to right, #0d6efd, #0a58ca);
            color: white;
            border: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .modal-footer .btn-primary {
            background: linear-gradient(to right, #0d6efd, #0a58ca);
            border: none;
        }

        .modal-footer .btn-primary:hover {
            background: linear-gradient(to right, #0a58ca, #0d6efd);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-container {
                margin: 0 15px;
            }

            .card-header {
                padding: 25px 15px;
            }

            .company-logo {
                height: 60px;
            }

            .company-name {
                font-size: 22px;
            }
        }

        /* Remove all border-radius */
        .card,
        .card-header,
        .form-control,
        .btn,
        .input-group-text,
        .modal-content,
        .alert {
            border-radius: 0 !important;
        }

        /* Focus state untuk input */
        .input-group:focus-within .input-group-text {
            border-color: #0d6efd;
            background-color: #e7f1ff;
        }

        /* Placeholder styling */
        .form-control::placeholder {
            color: #adb5bd;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="card-header">
                <div class="company-logo-container">
                    <!-- Logo Perusahaan (SVG) -->
                    <img src="<?= base_url() . 'img/logo_1.png' ?>" alt="Schlemmer Automotive Indonesia Logo" class="company-logo">

                    <div class="system-name">Employee Management System</div>
                </div>
            </div>

            <div class="card-body p-4">
                <!-- Form Login -->
                <form id="formLogin" class="mb-3">
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@schlemmer.co.id" required autofocus autocomplete="off">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <button type="button" id="btnLogin" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> Sign In
                    </button>
                </form>

                <div class="alert alert-danger" role="alert" id="alertError" hidden>
                    <h4 class="alert-heading">Error !</h4>
                    <p id="alertMessage">

                    </p>
                </div>

                <div class="alert alert-success" role="alert" id="alertSuccess" hidden>
                    <h4 class="alert-heading">Error !</h4>
                    <p id="alertSuccessMessage">

                    </p>
                </div>

                <!-- Forgot Password Link -->
                <div class="forgot-password">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                        <i class="fas fa-key me-1"></i> Forgot Password?
                    </a>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <div class="mb-2">
                        <i class="fas fa-building text-primary me-1"></i>
                        <span class="company">PT. Schlemmer Automotive Indonesia</span>
                    </div>
                    <div class="text-muted">
                        Internal Employee Management System &copy; <?= date("Y") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Forgot Password -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">
                        <i class="fas fa-key me-2"></i>Reset Kata Sandi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                        <p class="mb-0">Masukkan alamat email perusahaan Anda yang terdaftar dalam sistem.</p>
                        <p>Kami akan mengirimkan tautan untuk mereset kata sandi Anda.</p>
                    </div>

                    <form id="forgotPassword">
                        <div class="mb-3">
                            <label for="resetEmail" class="form-label fw-semibold">Email Perusahaan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="resetEmail" name="email" placeholder="nama@schlemmer.co.id" required autocomplete="off">
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="form-text text-primary mt-2" id="emailMessage">Pastikan email yang dimasukkan benar dan aktif</div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="button" id="btnReset" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                            </button>
                            <button type="button" id="btnCancel" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Batal
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="text-muted small">
                        <i class="fas fa-info-circle text-primary me-1"></i>
                        Tautan reset akan berlaku selama 24 jam
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle (untuk modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() . 'js/App/fetching.js'  ?>"></script>
    <script src="<?= base_url() . 'js/Auth/auth.js'  ?>"></script>
</body>

</html>