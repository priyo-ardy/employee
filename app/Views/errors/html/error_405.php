<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>405 - Method Tidak Diizinkan</title>
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

        .error-container {
            width: 100%;
            max-width: 500px;
            margin: 0 20px;
        }

        .error-card {
            border: none;
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.15);
            background-color: white;
            transition: transform 0.3s ease;
        }

        .error-card:hover {
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
            height: 60px;
            filter: brightness(0) invert(1);
            margin-bottom: 10px;
        }

        .company-name {
            font-size: 22px;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
        }

        .system-name {
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
        }

        .error-icon {
            font-size: 80px;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .error-title {
            color: #dc3545;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .error-description {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .error-details {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
        }

        .error-details strong {
            color: #0d6efd;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-error {
            padding: 12px 24px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary-error {
            background: linear-gradient(to right, #0d6efd, #0a58ca);
            color: white;
        }

        .btn-primary-error:hover {
            background: linear-gradient(to right, #0a58ca, #0d6efd);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-secondary-error {
            background: #6c757d;
            color: white;
        }

        .btn-secondary-error:hover {
            background: #5a6268;
            transform: translateY(-2px);
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

        /* Remove all border-radius */
        .error-card,
        .card-header,
        .btn,
        .error-details {
            border-radius: 0 !important;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .error-container {
                margin: 0 15px;
            }

            .card-header {
                padding: 25px 15px;
            }

            .error-icon {
                font-size: 60px;
            }

            .error-title {
                font-size: 24px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-error {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="card error-card">
            <div class="card-header">
                <div class="company-logo-container">
                    <!-- Logo Perusahaan -->
                    <img src="<?= base_url() . '/img/logo_1.png' ?>" alt="Schlemmer Automotive Indonesia Logo" class="company-logo">

                    <div class="system-name">Employee Management System</div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="text-center">
                    <div class="error-icon">
                        <i class="fas fa-ban"></i>
                    </div>

                    <h1 class="error-title">405 - Request Not Allowed</h1>

                    <p class="error-description">
                        Your request not allowed.
                    </p>

                    <div class="action-buttons">
                        <button onclick="history.back()" class="btn btn-error btn-secondary-error">
                            <i class="fas fa-arrow-left me-2"></i> Back
                        </button>
                    </div>
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

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript tambahan -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Log error untuk debugging
            // console.error('405 Error: Method Not Allowed');
            // console.log('URL:', window.location.href);
            // console.log('Method:', '<?= $method ?? "UNKNOWN" ?>');

            // Auto redirect setelah 30 detik
            setTimeout(function() {
                window.location.href = '<?= base_url() ?>';
            }, 30000);

            // Tampilkan countdown
            let seconds = 30;
            const countdownElement = document.createElement('div');
            countdownElement.className = 'text-center mt-3 text-muted small';
            countdownElement.id = 'countdown';
            countdownElement.innerHTML = `<i class="fas fa-clock me-1"></i> Redirect otomatis dalam <span id="countdown-seconds">${seconds}</span> detik`;
            document.querySelector('.action-buttons').after(countdownElement);

            // Update countdown setiap detik
            const countdownInterval = setInterval(function() {
                seconds--;
                document.getElementById('countdown-seconds').textContent = seconds;

                if (seconds <= 0) {
                    clearInterval(countdownInterval);
                }
            }, 1000);
        });
    </script>
</body>

</html>