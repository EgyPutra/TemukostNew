@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-gradient text-white py-5 mb-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-5 fw-bold mb-3">Dashboard Owner</h1>
                <p class="lead mb-4">
                    Selamat datang, <strong>{{ auth()->user()->name }}</strong> 
                </p>
                <p class="mb-0">
                    Kelola kost-mu dengan mudah. Lihat booking masuk, atur harga, dan komunikasi dengan penyewa secara real-time.
                </p>
            </div>
            <div class="col-lg-5 text-center">
                <img src="/images/dashboard-owner.jpeg" 
                     alt="Dashboard" class="img-fluid rounded-4 shadow-lg" style="max-height: 300px; object-fit: cover;">
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Action Cards -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="dashboard-card card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-house-gear text-primary fs-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-2">Kelola Kost</h5>
                            <p class="text-muted mb-3">Tambah, edit, dan hapus data kost milikmu. Upload foto, atur fasilitas, dan tentukan harga sewa.</p>
                            <a href="{{ route('owner.kost.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-right-circle me-2"></i> Kelola Kost
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
                            <h5 class="fw-bold mb-2">Booking Masuk</h5>
                            <p class="text-muted mb-3">Lihat dan kelola semua booking dari pencari kost. Terima atau tolak permintaan booking dengan mudah.</p>
                            <a href="{{ route('owner.bookings.index') }}" class="btn btn-primary">
                                <i class="bi bi-inbox me-2"></i> Lihat Booking
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
                    <i class="bi bi-lightbulb text-warning me-2"></i> Tips untuk Owner
                </h5>
                <ul class="mb-0">
                    <li class="mb-2">Upload foto berkualitas tinggi untuk menarik lebih banyak penyewa</li>
                    <li class="mb-2">Respons cepat terhadap booking akan meningkatkan kepercayaan</li>
                    <li>Update ketersediaan kamar secara berkala</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection