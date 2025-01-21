<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Pelaporan Modern</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', sans-serif;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
                min-height: 100vh;
                background: linear-gradient(to bottom, #f8fafc, #e2e8f0);
                color: #2d3748;
            }

            header {
                text-align: center;
                margin-top: 50px;
            }

            header img {
                width: 150px;
                margin-bottom: 20px;
            }

            header h1 {
                font-size: 2.5rem;
                font-weight: 700;
                color: #2b6cb0;
            }

            header p {
                font-size: 1rem;
                color: #4a5568;
            }

            main {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
                text-align: center;
            }

            main h2 {
                font-size: 2rem;
                font-weight: 600;
                margin-bottom: 20px;
                color: #2c5282;
            }

            main p {
                font-size: 1.125rem;
                color: #4a5568;
                margin-bottom: 30px;
                max-width: 600px;
            }

            .cta-buttons {
                display: flex;
                gap: 20px;
            }

            .cta-buttons a {
                text-decoration: none;
                padding: 12px 24px;
                font-size: 1rem;
                font-weight: 600;
                color: #fff;
                background: #3182ce;
                border-radius: 8px;
                transition: background-color 0.3s ease;
            }

            .cta-buttons a:hover {
                background: #2b6cb0;
            }

            footer {
                text-align: center;
                padding: 20px;
                font-size: 0.875rem;
                background: #2c5282;
                color: #fff;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="{{ asset('images/logo.png') }}" alt="Logo Sistem Pelaporan">
            <h1>Report System</h1>
            <p>Mengelola laporan lebih mudah dan efisien.</p>
        </header>

        <main>
            <h2>Selamat Datang!</h2>
            <p>
                Akses sistem kami untuk membuat laporan, menindaklanjuti, dan memantau progres laporan secara real-time
                dengan antarmuka yang intuitif dan modern.
            </p>
            <div class="cta-buttons">
                @auth
                    <a href="{{ route('dashboard') }}">Ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Daftar Sekarang</a>
                    @endif
                @endauth
            </div>
        </main>

        <footer>
            &copy; {{ date('Y') }} Report System. All rights reserved.
        </footer>
    </body>
</html>
