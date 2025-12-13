@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Booking Masuk</h3>

    @forelse($bookings as $booking)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold">{{ $booking->kost->nama }}</h5>

                <p class="mb-1">
                    <strong>Penyewa:</strong> {{ $booking->user->name }}
                </p>

                <p class="mb-1">
                    <strong>Tanggal Mulai:</strong> {{ $booking->start_date }}
                </p>

                <span class="badge bg-warning text-dark">
                    {{ strtoupper($booking->status) }}
                </span>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada booking masuk.</p>
    @endforelse
</div>
@endsection
