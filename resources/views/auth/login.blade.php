<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-card {
            max-width: 400px;
            margin: 80px auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }
        .brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="login-card">

            <div class="brand">ArtCart Login</div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="emailInput" placeholder="Email" required autofocus>
                    <label for="emailInput">Email address</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password" required>
                    <label for="passwordInput">Password</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>
        </div>
    </div>

</body>
</html>
