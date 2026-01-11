@extends('layouts.app')

@section('content')
<!-- Hero Section dengan Foto Background -->
<div class="hero-gradient text-white py-5 mb-5" 
     style="background: linear-gradient(135deg, rgba(74, 144, 226, 0.9) 0%, rgba(86, 204, 242, 0.9) 100%), 
            url('/images/dashboard-seeker.jpeg') center/cover; 
            background-blend-mode: overlay;">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-5 fw-bold mb-3">Dashboard Pencari Kost </h1>
                <p class="lead mb-4">
                    Selamat datang, <strong>{{ auth()->user()->name }}</strong> 
                </p>
                <p class="mb-0">
                    Temukan kost impianmu di Bali dengan mudah. Cari, booking, dan mulai pengalaman baru!
                </p>
            </div>
            
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Action Cards seperti Owner -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="dashboard-card card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-search text-primary fs-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-2">Cari Kost</h5>
                            <p class="text-muted mb-3">Temukan kost sesuai budget dan lokasi favoritmu. Filter berdasarkan tipe, fasilitas, dan harga.</p>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                                <i class="bi bi-search me-2"></i> Mulai Cari
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="dashboard-card card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-calendar2-check text-success fs-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-2">Booking Saya</h5>
                            <p class="text-muted mb-3">Lihat status dan riwayat booking kost-mu. Pantau konfirmasi dari pemilik kost.</p>
                            <a href="{{ route('booking.my') }}" class="btn btn-success">
                                <i class="bi bi-calendar-check me-2"></i> Lihat Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips Section -->
    <div class="mt-5">
        <div class="card dashboard-card border-0 bg-light">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-lightbulb text-warning me-2"></i> Tips Booking Kost
                </h5>
                <ul class="mb-0">
                    <li class="mb-2">Lihat foto dan fasilitas dengan teliti sebelum booking</li>
                    <li class="mb-2">Chat dengan pemilik kost untuk informasi lebih detail</li>
                    <li>Konfirmasi tanggal masuk sebelum melakukan booking</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection