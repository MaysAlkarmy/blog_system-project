<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | My Blog</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom Style --}}
    <style>
        body {
            background: linear-gradient(to right, #ccbbb7, #6bb4aa);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .welcome-box {
            background: rgb(244, 246, 247);
            padding: 40px;
            width: 90%;
            max-width: 550px;
            border-radius: 20px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.15);
            text-align: center;
            animation: fadeIn 1.2s ease-in-out;
        }

        .welcome-box h1 {
            font-weight: 700;
            font-size: 2.2rem;
            color: #333;
        }

        .welcome-box p {
            color: #666;
            font-size: 1rem;
        }

        .btn-custom {
            padding: 10px 22px;
            font-size: 1.05rem;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-login {
            background-color: #648dc4;
            color: white;
        }

        .btn-login:hover {
            background-color: #70a2ec;
            color: white;
        }

        .btn-register {
            background-color: #8ea7b9;
            color: white;
        }

        .btn-register:hover {
            background-color: #6bb4aa;
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0px); }
        }
    </style>
</head>

<body>

    <div class="welcome-box">
        <i class="bi bi-journal-text" style="font-size: 3rem; color:#6a11cb;"></i>

        <h1 class="mt-3">Welcome to My Blog</h1>
        <p>Your space to read, write and share amazing stories.</p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('login') }}" class="btn btn-login btn-custom">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>

            <a href="{{ route('register') }}" class="btn btn-register btn-custom">
                <i class="bi bi-person-plus"></i> Register
            </a>
        </div>
    </div>

</body>
</html>
