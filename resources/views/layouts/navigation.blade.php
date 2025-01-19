<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Report System Logo" style="height: 100px;">

      
        </a>

        <!-- Hamburger (Toggler) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

                <!-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tindaklanjut.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('tindaklanjut.index') }}">
                        <i class="bi bi-cardlist"></i> {{ __('Tindak Lanjut') }}
                    </a>
                </li> -->

                <!-- Peta sebaran -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('laporans.map') ? 'active fw-bold text-primary' : '' }}" href="{{ route('laporans.map') }}">
                        <i class="bi bi-map"></i> {{ __('Peta Sebaran') }}
                    </a>
                </li>

                <!-- Data Pendukung Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('kecamatans.*', 'desas.*', 'jenis_laporans.*') ? 'active fw-bold text-primary' : '' }}" href="#" id="dataPendukungDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-database"></i> {{ __('Data Pendukung') }}
                    </a>
                    <ul class="dropdown-menu shadow-sm" aria-labelledby="dataPendukungDropdown">
                        @if(Route::has('kecamatans.index'))
                            <li>
                                <a class="dropdown-item" href="{{ route('kecamatans.index') }}">
                                    <i class="bi bi-building"></i> {{ __('Manage Kecamatan') }}
                                </a>
                            </li>
                        @endif
                        @if(Route::has('desas.index'))
                            <li>
                                <a class="dropdown-item" href="{{ route('desas.index') }}">
                                    <i class="bi bi-tree"></i> {{ __('Manage Desa') }}
                                </a>
                            </li>
                        @endif
                        @if(Route::has('jenis_laporans.index'))
                            <li>
                                <a class="dropdown-item" href="{{ route('jenis_laporans.index') }}">
                                    <i class="bi bi-card-list"></i> {{ __('Manage Jenis Laporan') }}
                                </a>
                            </li>
                        @endif
                        @if(Route::has('sumber_dana.index'))
                            <li>
                                <a class="dropdown-item" href="{{ route('sumber_dana.index') }}">
                                    <i class="bi bi-card-list"></i> {{ __('Sumber Dana') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <!-- Tools Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('users.*', 'profile.*') ? 'active fw-bold text-primary' : '' }}" href="#" id="toolsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-tools"></i> {{ __('Tools') }}
                    </a>
                    <ul class="dropdown-menu shadow-sm" aria-labelledby="toolsDropdown">
                        @if(Route::has('users.index'))
                            <li>
                                <a class="dropdown-item" href="{{ route('feature.unavailable') }}">
                                    <i class="bi bi-people"></i> {{ __('Manage Users') }}
                                </a>
                            </li>
                        @endif
                        @if(Route::has('profile.edit'))
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person"></i> {{ __('Profile') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-primary fw-bold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person"></i> {{ __('Profile') }}
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
