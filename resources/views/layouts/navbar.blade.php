<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <img src="/images/logo.png"
                 alt="TemuKost"
                 height="40"
                 class="me-2">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Empty space to push menu to right -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-2">
                @auth
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" 
                           href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <!-- Cari Kost -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" 
                           href="{{ route('home') }}">
                            Cari Kost
                        </a>
                    </li>

                    <!-- Menu Seeker -->
                    @if(auth()->user()->role === 'seeker')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('booking.my') ? 'active fw-bold' : '' }}" 
                               href="{{ route('booking.my') }}">
                                Booking Saya
                            </a>
                        </li>
                    @endif

                    <!-- Menu Owner -->
                    @if(auth()->user()->role === 'owner')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('owner.bookings.*') ? 'active fw-bold' : '' }}" 
                               href="{{ route('owner.bookings.index') }}">
                                Booking Masuk
                            </a>
                        </li>
                    @endif

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" 
                           href="#" 
                           id="userDropdown" 
                           role="button"
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <i class="bi bi-person-circle me-1 fs-5"></i>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Guest Menu -->
                    <li class="nav-item">
                        <a class="btn btn-outline-primary btn-navbar-login me-2"
                        href="{{ route('login') }}">
                         Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-navbar-register"
                        href="{{ route('register') }}">
                         Daftar
                         </a>
                    </li>

                @endauth
            </ul>
        </div>
    </div>
</nav>