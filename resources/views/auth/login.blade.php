<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Report System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <h2 class="text-center text-primary fw-bold mb-4">Log in</h2>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input type="checkbox" id="remember_me" name="remember" class="form-check-input">
                        <label for="remember_me" class="form-check-label">Remember me</label>
                    </div>

                    <!-- Forgot Password and Submit Button -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                </form>

                <!-- Back to Homepage -->
                <div class="text-center">
                    <a href="{{ url('/') }}" class="text-decoration-none text-primary small">Back to Homepage</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
