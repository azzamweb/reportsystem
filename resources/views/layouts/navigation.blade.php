<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Report System Logo" style="height: 50px;">
        </a>

        <!-- Hamburger (Toggler) -->
        <button class="navbar-toggler" type="button" id="navbarToggler">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold text-primary' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> {{ __('Dashboard') }}
                    </a>
                </li>

                <!-- Peta Sebaran -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('laporans.map') ? 'active fw-bold text-primary' : '' }}" href="{{ route('laporans.map') }}">
                        <i class="bi bi-map"></i> {{ __('Peta Sebaran') }}
                    </a>
                </li>

                <!-- Data Pendukung Dropdown -->
                <li class="nav-item dropdown" id="dataPendukungDropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('kecamatans.*', 'desas.*', 'jenis_laporans.*') ? 'active fw-bold text-primary' : '' }}" href="#" role="button">
                        <i class="bi bi-database"></i> {{ __('Data Pendukung') }}
                    </a>
                    <ul class="dropdown-menu shadow-sm">
                        @if(Route::has('kecamatans.index'))
                        <li><a class="dropdown-item" href="{{ route('kecamatans.index') }}"><i class="bi bi-building"></i> {{ __('Manage Kecamatan') }}</a></li>
                        @endif
                        @if(Route::has('desas.index'))
                        <li><a class="dropdown-item" href="{{ route('desas.index') }}"><i class="bi bi-tree"></i> {{ __('Manage Desa') }}</a></li>
                        @endif
                        @if(Route::has('jenis_laporans.index'))
                        <li><a class="dropdown-item" href="{{ route('jenis_laporans.index') }}"><i class="bi bi-card-list"></i> {{ __('Manage Jenis Laporan') }}</a></li>
                        @endif
                        @if(Route::has('sumber_dana.index'))
                        <li><a class="dropdown-item" href="{{ route('sumber_dana.index') }}"><i class="bi bi-card-list"></i> {{ __('Sumber Dana') }}</a></li>
                        @endif
                    </ul>
                </li>

                <!-- Tools Dropdown -->
                <li class="nav-item dropdown" id="toolsDropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('users.*', 'profile.*') ? 'active fw-bold text-primary' : '' }}" href="#" role="button">
                        <i class="bi bi-tools"></i> {{ __('Tools') }}
                    </a>
                    <ul class="dropdown-menu shadow-sm">
                        @if(Route::has('users.index'))
                        <li><a class="dropdown-item" href="{{ route('feature.unavailable') }}"><i class="bi bi-people"></i> {{ __('Manage Users') }}</a></li>
                        @endif
                        @if(Route::has('profile.edit'))
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> {{ __('Profile') }}</a></li>
                        @endif
                    </ul>
                </li>
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown" id="userDropdown">
                    <a class="nav-link dropdown-toggle text-primary fw-bold" href="#" role="button">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> {{ __('Profile') }}</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> {{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Custom CSS -->
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .navbar .dropdown-menu {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Custom JS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggler = document.getElementById('navbarToggler');
        const navbar = document.getElementById('navbarNav');

        toggler.addEventListener('click', () => {
            navbar.classList.toggle('collapse');
        });
    });
</script>
