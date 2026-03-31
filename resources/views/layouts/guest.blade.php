<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gestion Stock') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        * { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a237e 0%, #283593 50%, #1565c0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-logo .logo-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #1a237e, #1565c0);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            box-shadow: 0 8px 20px rgba(26, 35, 126, 0.35);
        }

        .auth-logo .logo-icon i {
            font-size: 32px;
            color: white;
        }

        .auth-logo h4 {
            color: #1a237e;
            font-weight: 700;
            font-size: 1.2rem;
            margin: 0 0 4px 0;
            letter-spacing: 1px;
        }

        .auth-logo p {
            color: #7986cb;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
        }

        /* Override Bootstrap form controls */
        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #3949ab;
            margin-bottom: 6px;
        }

        .form-control {
            padding: 11px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            color: #333;
            background: #fafafa;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #3949ab;
            background: white;
            box-shadow: 0 0 0 3px rgba(57, 73, 171, 0.12);
        }

        /* Remember me */
        .form-check-label {
            font-size: 0.83rem;
            color: #666;
        }

        .form-check-input:checked {
            background-color: #3949ab;
            border-color: #3949ab;
        }

        /* Forgot password */
        .forgot-link {
            font-size: 0.82rem;
            color: #5c6bc0;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover {
            color: #1a237e;
            text-decoration: underline;
        }

        /* Login button */
        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #1a237e, #3949ab);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.92rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(26, 35, 126, 0.35);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #283593, #3f51b5);
            box-shadow: 0 6px 20px rgba(26, 35, 126, 0.45);
            transform: translateY(-1px);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Error messages */
        .text-danger {
            font-size: 0.78rem;
        }

        /* Responsive mobile */
        @media (max-width: 480px) {
            body {
                padding: 16px;
                align-items: flex-start;
                padding-top: 40px;
            }

            .auth-card {
                padding: 28px 20px;
                border-radius: 16px;
            }

            .auth-logo .logo-icon {
                width: 60px;
                height: 60px;
            }

            .auth-logo .logo-icon i {
                font-size: 26px;
            }

            .auth-logo h4 {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-logo">
            <div class="logo-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <h4>GESTION STOCK</h4>
            <p>ALL SOLUTION TECH</p>
        </div>
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
