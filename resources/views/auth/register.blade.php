<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Report System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <h2 class="text-center text-primary fw-bold mb-4">Register</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label fw-bold">Role</label>
                        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="">-- Select Role --</option>
                            <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pelapor" {{ old('role') == 'pelapor' ? 'selected' : '' }}>Pelapor</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
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

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Already Registered -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="text-primary text-decoration-none small" href="{{ route('login') }}">Already registered?</a>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
