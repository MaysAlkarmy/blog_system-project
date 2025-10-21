<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to right, #ccbbb7, #6bb4aa);
            font-family: "Poppins", sans-serif;
        }

        .login-card {
            background: #fff;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .login-card .card-body {
            padding: 2.5rem;
        }

        .login-card h3 {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(to right, #ccbbb7, #6bb4aa);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg,#b8a6a2, #97f5e8);
        }

        a {
            text-decoration: none;
            color: #6c63ff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card">
                    <div class="card-body">
                        <h3 class="text-center">Login</h3>

                        <form action="{{ route('login') }}" method="POST">
                            {{-- Show Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Show Login Failed Message --}}
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    name="email" 
                                    id="email" 
                                    placeholder="Enter your email" 
                                    required>
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input 
                                    type="password" 
                                    class="form-control" 
                                    name="password" 
                                    id="password" 
                                    placeholder="Enter your password" 
                                    required>
                            </div>

                            {{-- Remember Me --}}
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>

                            {{-- Extra Link --}}
                            <div class="text-center mt-3">
                                <a href="/user/register">Don't have an account ? Register now</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
