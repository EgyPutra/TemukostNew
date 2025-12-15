@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-3">Booking Saya</h4>

    @forelse($bookings as $booking)
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold">{{ $booking->kost->nama }}</h6>
                <p class="mb-1">
                    <strong>Tanggal Mulai:</strong> {{ $booking->start_date }}
                </p>
                <span class="badge bg-warning text-dark">
                    {{ strtoupper($booking->status) }}
                </span>

                <div class="mt-2">
                    <a href="{{ route('chat.show', $booking) }}"
                       class="btn btn-sm btn-outline-primary">
                        Chat Pemilik
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada booking.</p>
    @endforelse
</div>
@endsection
