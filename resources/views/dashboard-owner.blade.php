@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-2">Dashboard Owner</h3>

    <p class="text-muted">
        Selamat datang, {{ auth()->user()->name }} 👋
    </p>

    <div class="row mt-4 g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold">Kelola Kost</h6>
                    <p class="text-muted small">Tambah, edit, dan hapus kost</p>
                    <a href="{{ route('owner.kost.index') }}" class="btn btn-outline-primary btn-sm">
                        Kelola Kost
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold">Booking Masuk</h6>
                    <p class="text-muted small">Lihat booking dari pencari kost</p>
                    <a href="{{ route('owner.bookings.index') }}" class="btn btn-primary btn-sm">
                        Booking Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
