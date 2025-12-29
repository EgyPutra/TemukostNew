<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>TemuKost Bali</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-danger" href="/">
            TemuKost
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-2">
                @auth
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="hero-section d-flex align-items-center">
    <div class="overlay"></div>

    <div class="container position-relative text-white">
        <div class="row justify-content-center">
            <div class="col-lg-9 text-center">
                <h1 class="display-4 fw-bold mb-3">
                    Temukan Kost Impianmu di Bali
                </h1>

                <p class="lead mb-4">
                    Putra, putri, atau campur — semua ada.
                </p>

                {{-- SEARCH BAR --}}
                <form method="GET" action="{{ route('kost.search') }}"
                      class="search-box bg-white p-3 rounded-pill shadow d-flex flex-wrap gap-2">

                    <input type="text" name="kota"
                        class="form-control border-0 flex-fill"
                        placeholder="Kota (Denpasar, Badung...)">

                    <select name="tipe" class="form-select border-0 w-auto">
                        <option value="">Semua Tipe</option>
                        <option value="putra">Putra</option>
                        <option value="putri">Putri</option>
                        <option value="campur">Campur</option>
                    </select>

                    <button class="btn btn-danger px-4 rounded-pill">
                        <i class="bi bi-search"></i>
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="bg-light py-4 text-center text-muted">
    © {{ date('Y') }} TemuKost — Laravel Project
</footer>

</body>
</html>
