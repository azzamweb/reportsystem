<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Pelaporan</title>

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
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background: linear-gradient(135deg, #1a202c, #2d3748, #4a5568);
                color: #e2e8f0;
            }

            header {
                text-align: center;
                padding: 50px 20px;
            }

            header img {
                width: 120px;
                margin-bottom: 20px;
            }

            header h1 {
                font-size: 2.5rem;
                font-weight: 700;
                color: #63b3ed;
                margin-bottom: 10px;
            }

            header p {
                font-size: 1.125rem;
                color: #a0aec0;
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
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 15px;
                color: #81e6d9;
            }

            main p {
                font-size: 1.125rem;
                color: #cbd5e0;
                margin-bottom: 30px;
                max-width: 600px;
            }

            .cta-buttons {
                display: flex;
                gap: 15px;
            }

            .cta-buttons a {
                text-decoration: none;
                padding: 14px 28px;
                font-size: 1rem;
                font-weight: 600;
                color: #1a202c;
                background: #63b3ed;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .cta-buttons a:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
                background: #3182ce;
            }

            footer {
                text-align: center;
                padding: 20px;
                font-size: 0.875rem;
                background: #2d3748;
                color: #e2e8f0;
                width: 100%;
            }

            footer a {
                color: #81e6d9;
                text-decoration: none;
                font-weight: 600;
            }

            footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="{{ asset('images/logo.png') }}" alt="Logo Sistem Pelaporan">
            <h1>Sistem Pelaporan</h1>
            <p>Meningkatkan kemudahan manajemen laporan dengan platform digital.</p>
        </header>

        <main>
            <h2>Selamat Datang!</h2>
            <p>
                Gunakan platform kami untuk mengelola laporan, memantau progres, dan membuat tindak lanjut secara efisien dan terorganisir.
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
            &copy; {{ date('Y') }} Sistem Pelaporan. by: <a href="https://hermanspace.id">hspace</a>.
        </footer>
    </body>
</html>
